<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom functions, filters, actions for visual composer page builder.
 */
if ( ! class_exists( 'Brook_VC' ) ) {
	class Brook_VC {

		protected static $instance = null;

		public function init() {
			if ( ! class_exists( 'Vc_Manager' ) ) {
				return;
			}

			if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
				vc_set_shortcodes_templates_dir( get_template_directory() . '/vc-extend/vc-templates' );
			}

			add_action( 'vc_before_init', array( $this, 'vc_set_as_theme' ) );
			add_action( 'vc_after_init', array( $this, 'load_vc_maps' ), 9999 );
			add_action( 'vc_after_init', array( $this, 'vc_after_init' ) );

			// Hook for admin editor.
			add_action( 'vc_build_admin_page', array( $this, 'remove_default_elements' ), 11 );
			// Hook for frontend editor.
			add_action( 'vc_load_shortcode', array( $this, 'remove_default_elements' ), 11 );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			add_filter( 'vc_google_fonts_get_fonts_filter', array( $this, 'update_google_fonts' ) );

			if ( defined( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' ) ) {
				add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, array(
					$this,
					'add_css_animation_wbp_elements',
				), 3, 10 );
			}
		}

		function add_css_animation_wbp_elements( $classes, $element, $atts ) {
			$allowed = array(
				'vc_column_text',
			);

			if ( in_array( $element, $allowed, true ) ) {
				$classes .= Brook_Helper::get_animation_classes();
			}

			return $classes;
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function vc_set_as_theme() {
			vc_set_as_theme();
		}

		function autocomplete_pages_field_render( $term ) {
			$args = array(
				'post_type'      => 'page',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'name'           => $term['value'],
				'no_found_rows'  => true,
			);

			$query = new WP_Query( $args );
			$data  = false;
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) :
					$query->the_post();
					global $post;

					$data = array(
						'label' => get_the_title(),
						'value' => $post->post_name,
					);
				endwhile;
			}

			return $data;
		}

		function autocomplete_pages_field_callback( $search_string ) {
			$data   = array();
			$parent = array();

			global $wpdb, $post;
			$query   = $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_type = 'page' AND post_title LIKE '%s'", '%' . $wpdb->esc_like( $search_string ) . '%' );
			$results = $wpdb->get_results( $query );

			foreach ( $results as $post ) {
				setup_postdata( $post );

				$parent_name = '';

				if ( ! isset( $parent[ $post->post_parent ] ) ) {

					if ( $post->post_parent !== 0 ) {
						$parent_post = get_post( $post->post_parent );
						$parent_name = $parent_post->post_title;
					}

					$parent[ $post->post_parent ] = $parent_name;
				} else {
					$parent_name = $parent[ $post->post_parent ];
				}

				$data[] = array(
					'label'    => get_the_title(),
					'value'    => $post->post_name,
					'group_id' => $post->post_parent,
					'group'    => $parent_name,
				);
			}
			wp_reset_postdata();

			return $data;
		}

		function vc_after_init() {
			$this->load_vc_params();
		}

		public function remove_default_elements() {
			vc_remove_element( 'vc_icon' );
			vc_remove_element( 'vc_empty_space' );
			vc_remove_element( 'vc_single_image' );
			vc_remove_element( 'vc_images_carousel' );
			vc_remove_element( 'vc_gallery' );
			vc_remove_element( 'vc_gmaps' );
			vc_remove_element( 'vc_custom_heading' );
			vc_remove_element( 'vc_posts_slider' );
			vc_remove_element( 'vc_hoverbox' );
			vc_remove_element( 'vc_toggle' );
			vc_remove_element( 'rev_slider_vc' );
			vc_remove_element( 'vc_pie' );
			vc_remove_element( 'contact-form-7' );
			vc_remove_element( 'vc_pinterest' );
			vc_remove_element( 'vc_facebook' );
			vc_remove_element( 'vc_tweetmeme' );
			vc_remove_element( 'vc_googleplus' );

			if ( Brook_Helper::active_woocommerce() ) {
				vc_remove_element( 'woocommerce_cart' );
				vc_remove_element( 'woocommerce_checkout' );
				vc_remove_element( 'woocommerce_order_tracking' );
				vc_remove_element( 'woocommerce_my_account' );
				vc_remove_element( 'product' );
				vc_remove_element( 'products' );
				vc_remove_element( 'add_to_cart_url' );
				vc_remove_element( 'product_page' );
				vc_remove_element( 'product_categories' );
				vc_remove_element( 'product_attribute' );
				vc_remove_element( 'product_category' );
				vc_remove_element( 'recent_products' );
				vc_remove_element( 'featured_products' );
				vc_remove_element( 'sale_products' );
				vc_remove_element( 'best_selling_products' );
				vc_remove_element( 'top_rated_products' );
			}
		}

		public function load_vc_maps() {
			require_once BROOK_VC_MAPS_DIR . '/tm_accordion.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_blog.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_blog_widget.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_box_icon.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_icon.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_rotate_box.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_button_group.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_button.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_countdown.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_counter.php';

			if ( class_exists( 'WPCF7' ) ) {
				require_once BROOK_VC_MAPS_DIR . '/tm_contact_form_7_box.php';
				require_once BROOK_VC_MAPS_DIR . '/tm_contact_form_7.php';
			}

			if ( function_exists( 'mc4wp_show_form' ) ) {
				require_once BROOK_VC_MAPS_DIR . '/tm_mailchimp_form.php';
				require_once BROOK_VC_MAPS_DIR . '/tm_mailchimp_form_box.php';
				require_once BROOK_VC_MAPS_DIR . '/tm_mailchimp_form_popup.php';
			}

			require_once BROOK_VC_MAPS_DIR . '/tm_search_form.php';

			require_once BROOK_VC_MAPS_DIR . '/tm_gmaps.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_gallery.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_heading.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_drop_cap.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_text_box.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_blockquote.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_message_box.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_list.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_image.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_table.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_services_list.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_grid.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_gradation.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_restaurant_carousel.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_restaurant_menu.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_instagram.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_twitter.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_circle_progress_chart.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_bar_chart.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_line_chart.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_pie_chart.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_attribute_list.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_case_study_slider.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_portfolio.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_portfolio_featured.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_portfolio_details.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_info_boxes.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_banner.php';

			if ( Brook_Helper::active_woocommerce() ) {
				require_once BROOK_VC_MAPS_DIR . '/tm_product.php';
				require_once BROOK_VC_MAPS_DIR . '/tm_product_categories.php';
				require_once BROOK_VC_MAPS_DIR . '/tm_product_search_form.php';
			}

			require_once BROOK_VC_MAPS_DIR . '/tm_problem_solution.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_pricing_group.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_pricing.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_pricing_table.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_pricing_rotate_box.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_popup_video.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_client.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_slider_group.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_slider_gallery.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_slider.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_slider_button.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_slider_modern.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_product_banner_slider.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_group.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_team_member.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_testimonial.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_timeline.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_social_networks.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_soundcloud.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_view_demo.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_w_better_custom_menu.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_separator.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_spacer.php';
			require_once BROOK_VC_MAPS_DIR . '/tm_widget_title.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_section.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_row.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_row_inner.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_column.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_column_inner.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_progress_bar.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_separator.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_widget_sidebar.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_tta_tabs.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_tta_section.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_wp_custom_html.php';
			require_once BROOK_VC_MAPS_DIR . '/vc_wp_posts.php';
		}

		public function load_vc_params() {
			require_once BROOK_VC_PARAMS_DIR . '/number/number.php';
			require_once BROOK_VC_PARAMS_DIR . '/number_responsive/number_responsive.php';
			require_once BROOK_VC_PARAMS_DIR . '/spacing/spacing.php';
			require_once BROOK_VC_PARAMS_DIR . '/datetime_picker/datetime_picker.php';
			require_once BROOK_VC_PARAMS_DIR . '/gradient/gradient.php';
			require_once BROOK_VC_PARAMS_DIR . '/radio_image/radio_image.php';
		}

		public static function get_slider_navs() {
			$list = array(
				esc_html__( 'None', 'brook' )                              => '',
				esc_html__( 'Custom Button', 'brook' )                     => 'custom',
				esc_html__( '01 - Standard', 'brook' )                     => '01',
				esc_html__( '02 - Standard - Light', 'brook' )             => '02',
				esc_html__( '03 - Half Circle', 'brook' )                  => '03',
				esc_html__( '04 - Standard - Inside - Light', 'brook' )    => '04',
				esc_html__( '05 - Circle - Light', 'brook' )               => '05',
				esc_html__( '06 - Big Arrow - in Grid - Light ', 'brook' ) => '06',
				esc_html__( '07 - Long Arrow - Light', 'brook' )           => '07',
				esc_html__( '08 - Standard - Grey', 'brook' )              => '08',
				esc_html__( '09 - Circle Solid', 'brook' )                 => '09',
			);

			return $list;
		}

		public static function get_slider_dots() {
			return array(
				esc_html__( 'None', 'brook' )                                 => '',
				esc_html__( '01 - Dots', 'brook' )                            => '01',
				esc_html__( '02 - Dots 02', 'brook' )                         => '02',
				esc_html__( '03 - Overlay Dots', 'brook' )                    => '03',
				esc_html__( '04 - Square Dots', 'brook' )                     => '04',
				esc_html__( '05 - Vertical Overlay Dots - Light', 'brook' )   => '05',
				esc_html__( '06 - Vertical Overlay Dots - Dark', 'brook' )    => '06',
				esc_html__( '07 - Progress Bar - Dark', 'brook' )             => '07',
				esc_html__( '08 - Fraction / Progress Bar - Light', 'brook' ) => '08',
				esc_html__( '09 - Dots 03', 'brook' )                         => '09',
				esc_html__( '10 - Rectangle Dots', 'brook' )                  => '10',
				esc_html__( '11 - Rectangle Dots - Light', 'brook' )          => '11',
			);
		}

		public static function equal_height_class_field() {
			return array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Equal Height Elements', 'brook' ),
				'param_name'  => 'equal_height_elements',
				'description' => esc_html__( 'Input class name or id of elements that you want to equal height. For e.g: .image OR .image, #content-wrap', 'brook' ),
				'std'         => '',
			);
		}

		public static function extra_class_field() {
			return array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'brook' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'brook' ),
				'std'         => '',
			);
		}

		public static function extra_id_field( $args = array() ) {
			$defaults = array(
				'type'        => 'el_id',
				'heading'     => esc_html__( 'Element ID', 'brook' ),
				'param_name'  => 'el_id',
				'description' => wp_kses( sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'brook' ), 'https://www.w3schools.com/tags/att_global_id.asp' ), array(
					'a' => array(
						'href'   => array(),
						'target' => array(),
					),
				) ),
			);

			$args = wp_parse_args( $args, $defaults );

			return $args;
		}

		public static function css_editor_field() {
			return array(
				'group'      => esc_html__( 'Design Options', 'brook' ),
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'brook' ),
				'param_name' => 'css',
			);
		}

		public static function get_animation_field( $args = array() ) {
			$defaults = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'CSS Animation', 'brook' ),
				'desc'       => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'brook' ),
				'param_name' => 'animation',
				'value'      => array(
					esc_html__( 'Default', 'brook' )    => '',
					esc_html__( 'None', 'brook' )       => 'none',
					esc_html__( 'Fade In', 'brook' )    => 'fade-in',
					esc_html__( 'Move Up', 'brook' )    => 'move-up',
					esc_html__( 'Move Down', 'brook' )  => 'move-down',
					esc_html__( 'Move Left', 'brook' )  => 'move-left',
					esc_html__( 'Move Right', 'brook' ) => 'move-right',
					esc_html__( 'Scale Up', 'brook' )   => 'scale-up',
					esc_html__( 'Fly', 'brook' )        => 'fly',
					esc_html__( 'Flip', 'brook' )       => 'flip',
					esc_html__( 'Helix', 'brook' )      => 'helix',
					esc_html__( 'Pop Up', 'brook' )     => 'pop-up',
				),
				'std'        => '',
			);
			$args     = wp_parse_args( $args, $defaults );

			return $args;
		}

		public static function get_grid_filter_fields() {
			$tab = esc_html__( 'Filter', 'brook' );

			return array(
				array(
					'group'      => $tab,
					'heading'    => esc_html__( 'Filter Enable', 'brook' ),
					'type'       => 'checkbox',
					'param_name' => 'filter_enable',
					'value'      => array( esc_html__( 'Enable', 'brook' ) => '1' ),
				),
				array(
					'group'      => $tab,
					'heading'    => esc_html__( 'Filter Type', 'brook' ),
					'type'       => 'dropdown',
					'param_name' => 'filter_type',
					'value'      => array(
						esc_html__( 'Static', 'brook' ) => 'static',
						esc_html__( 'Ajax', 'brook' )   => 'ajax',
					),
					'std'        => 'static',
				),
				array(
					'group'              => $tab,
					'heading'            => esc_html__( 'Filter By', 'brook' ),
					'description'        => esc_html__( 'Enter only categories that you want to show in filter or leave blank to show all.', 'brook' ),
					'type'               => 'autocomplete',
					'param_name'         => 'filter_by',
					'settings'           => array(
						'multiple'       => true,
						'min_length'     => 1,
						'groups'         => true,
						// In UI show results grouped by groups, default false.
						'unique_values'  => true,
						// In UI show results except selected. NB! You should manually check values in backend, default false.
						'display_inline' => true,
						// In UI show results inline view, default false (each value in own line).
						'delay'          => 500,
						// delay for search. default 500.
						'auto_focus'     => true,
						// auto focus input, default true.
					),
					'param_holder_class' => 'vc_not-for-custom',
				),
				array(
					'group'      => $tab,
					'heading'    => esc_html__( 'Filter Counter', 'brook' ),
					'type'       => 'checkbox',
					'param_name' => 'filter_counter',
					'value'      => array( esc_html__( 'Enable', 'brook' ) => '1' ),
				),
				array(
					'group'      => $tab,
					'heading'    => esc_html__( 'Filter Counter Style', 'brook' ),
					'type'       => 'dropdown',
					'param_name' => 'filter_counter_style',
					'value'      => array(
						esc_html__( '01', 'brook' ) => '01',
						esc_html__( '02', 'brook' ) => '02',
					),
					'std'        => '01',
				),
				array(
					'group'       => $tab,
					'heading'     => esc_html__( 'Filter Grid Wrapper', 'brook' ),
					'description' => esc_html__( 'Wrap filter into grid container.', 'brook' ),
					'type'        => 'checkbox',
					'param_name'  => 'filter_wrap',
					'value'       => array( esc_html__( 'Enable', 'brook' ) => '1' ),
				),
				array(
					'group'      => $tab,
					'heading'    => esc_html__( 'Filter Align', 'brook' ),
					'type'       => 'dropdown',
					'param_name' => 'filter_align',
					'value'      => array(
						esc_html__( 'Left', 'brook' )   => 'left',
						esc_html__( 'Center', 'brook' ) => 'center',
						esc_html__( 'Right', 'brook' )  => 'right',
					),
					'std'        => 'center',
				),
			);
		}

		public static function get_grid_pagination_fields() {
			$tab = esc_html__( 'Pagination', 'brook' );

			return array(
				array(
					'group'      => $tab,
					'heading'    => esc_html__( 'Pagination', 'brook' ),
					'type'       => 'dropdown',
					'param_name' => 'pagination',
					'value'      => array(
						esc_html__( 'No Pagination', 'brook' ) => '',
						esc_html__( 'Pagination', 'brook' )    => 'pagination',
						esc_html__( 'Button', 'brook' )        => 'loadmore',
						esc_html__( 'Custom Button', 'brook' ) => 'loadmore_alt',
						esc_html__( 'Infinite', 'brook' )      => 'infinite',
					),
					'std'        => '',
				),
				array(
					'group'       => $tab,
					'heading'     => esc_html__( 'Button ID', 'brook' ),
					'description' => esc_html__( 'Input id of custom button to load more posts when click. For e.g: #product-load-more-btn', 'brook' ),
					'type'        => 'el_id',
					'param_name'  => 'pagination_custom_button_id',
					'dependency'  => array(
						'element' => 'pagination',
						'value'   => 'loadmore_alt',
					),
				),
				array(
					'group'      => $tab,
					'heading'    => esc_html__( 'Pagination Align', 'brook' ),
					'type'       => 'dropdown',
					'param_name' => 'pagination_align',
					'value'      => array(
						esc_html__( 'Left', 'brook' )   => 'left',
						esc_html__( 'Center', 'brook' ) => 'center',
						esc_html__( 'Right', 'brook' )  => 'right',
					),
					'std'        => 'left',
					'dependency' => array(
						'element' => 'pagination',
						'value'   => array( 'pagination', 'infinite', 'loadmore', 'loadmore_alt' ),
					),
				),
				array(
					'group'      => $tab,
					'heading'    => esc_html__( 'Pagination Button Text', 'brook' ),
					'type'       => 'textfield',
					'param_name' => 'pagination_button_text',
					'std'        => esc_html__( 'Load More', 'brook' ),
					'dependency' => array(
						'element' => 'pagination',
						'value'   => 'loadmore',
					),
				),
			);
		}

		/**
		 * @param $term
		 *
		 * @return array|bool
		 */
		function autocomplete_taxonomies_field_render( $term ) {
			$t    = explode( ':', $term['value'] );
			$term = get_term_by( 'slug', $t[1], $t[0] );

			$data = false;
			if ( $term !== false ) {
				$data = $this->vc_get_term_object( $term );
			}

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_get_data_from_post_type( $search_string, $post_type ) {
			$data             = array();
			$taxonomies_types = get_object_taxonomies( $post_type );
			$taxonomies       = get_terms( $taxonomies_types, array(
				'hide_empty' => false,
				'search'     => $search_string,
			) );
			if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = $this->vc_get_term_object( $t );
					}
				}
			}

			return $data;
		}

		function vc_get_term_object( $term ) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label'    => $term->name,
				'value'    => $term->taxonomy . ':' . $term->slug,
				'group_id' => $term->taxonomy,
				'group'    => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'brook' ),
			);
		}

		public static function get_tax_query_of_taxonomies( $brook_post_args, $taxonomies ) {
			if ( empty( $taxonomies ) ) {
				return $brook_post_args;
			}

			$terms       = explode( ', ', $taxonomies );
			$tax_queries = array(); // List of taxonomies.

			if ( ! isset( $brook_post_args['tax_query'] ) ) {
				$brook_post_args['tax_query'] = array();

				foreach ( $terms as $term ) {
					$tmp       = explode( ':', $term );
					$taxonomy  = $tmp[0];
					$term_slug = $tmp[1];
					if ( ! isset( $tax_queries[ $taxonomy ] ) ) {
						$tax_queries[ $taxonomy ] = array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => array( $term_slug ),
						);
					} else {
						$tax_queries[ $taxonomy ]['terms'][] = $term_slug;
					}
				}
				$brook_post_args['tax_query']             = array_values( $tax_queries );
				$brook_post_args['tax_query']['relation'] = 'AND';
			} else {
				foreach ( $terms as $term ) {
					$tmp       = explode( ':', $term );
					$taxonomy  = $tmp[0];
					$term_slug = $tmp[1];

					foreach ( $brook_post_args['tax_query'] as $key => $query ) {
						if ( is_array( $query ) ) {
							if ( $query['taxonomy'] == $taxonomy ) {
								$brook_post_args['tax_query'][ $key ]['terms'][] = $term_slug;
								break;
							} else {
								$brook_post_args['tax_query'][] = array(
									'taxonomy' => $taxonomy,
									'field'    => 'slug',
									'terms'    => array( $term_slug ),
								);
							}
						}
					}
				}
			}

			return $brook_post_args;
		}

		public function admin_enqueue_scripts() {
			if ( ! function_exists( 'get_current_screen' ) ) {
				return;
			}

			$screen = get_current_screen();

			if ( $screen->base !== 'post' ) {
				return;
			}

			wp_enqueue_style( 'datetime-picker', BROOK_THEME_URI . '/assets/libs/datetimepicker/jquery.datetimepicker.min.css' );
			wp_enqueue_script( 'datetime-picker', BROOK_THEME_URI . '/assets/libs/datetimepicker/jquery.datetimepicker.full.min.js', array( 'jquery' ), BROOK_THEME_VERSION, true );

			// Enqueue CSS.
			wp_enqueue_style( 'colorpicker-alt', BROOK_THEME_URI . '/assets/libs/colorpicker/css/jquery-colorpicker.css' );
			wp_enqueue_style( 'classygradient-alt', BROOK_THEME_URI . '/assets/libs/classygradient/css/jquery-classygradient-min.css' );

			wp_enqueue_script( 'colorpicker-alt', BROOK_THEME_URI . '/assets/libs/colorpicker/js/jquery-colorpicker.js', array( 'jquery' ), BROOK_THEME_VERSION, false );
			wp_enqueue_script( 'classygradient-alt', BROOK_THEME_URI . '/assets/libs/classygradient/js/jquery-classygradient-min.js', array( 'jquery' ), BROOK_THEME_VERSION, false );
		}

		public static function get_progress_bar_inline_css( $selector, $atts ) {
			global $brook_shortcode_lg_css;
			extract( $atts );

			if ( $atts['bar_height'] !== '' ) {
				$brook_shortcode_lg_css .= "$selector.vc_progress_bar .vc_general.vc_single_bar { height: {$atts['bar_height']}px; }";
			}

			if ( $atts['track_color'] === 'custom' ) {
				$brook_shortcode_lg_css .= "$selector .vc_single_bar { background-color: {$atts['custom_track_color']}; }";
			}

			if ( $atts['background_color'] === 'custom' ) {
				$brook_shortcode_lg_css .= "$selector .vc_single_bar .vc_bar { background-color: {$atts['custom_background_color']}; }";
			}

			if ( $atts['text_color'] === 'custom' ) {
				$brook_shortcode_lg_css .= "$selector .vc_single_bar_title { color: {$atts['custom_text_color']}; }";
			}

			Brook_VC::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_section_css( $selector, $atts ) {
			global $brook_shortcode_lg_css;
			global $brook_shortcode_md_css;
			global $brook_shortcode_sm_css;
			global $brook_shortcode_xs_css;
			extract( $atts );
			$tmp = '';

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= Brook_Helper::get_css_prefix( 'border-radius', $atts['border_radius'] );
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= Brook_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
			}

			$tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'] );

			$_url = false;

			if ( $atts['background_image'] !== '' ) {
				$_url = Brook_Image::get_attachment_url_by_id( array( 'id' => $atts['background_image'] ) );

				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";
				}
			}

			if ( $atts['background_color'] === 'gradient' && $atts['background_gradient'] !== '' ) {

				if ( $_url !== false ) {
					$_tmp = str_replace( 'background:', "background: url($_url),", $atts['background_gradient'] );
					$tmp  .= $_tmp;
				} else {
					$tmp .= $atts['background_gradient'];
				}
			}

			if ( $_url !== false ) {
				if ( $atts['background_size'] !== 'auto' ) {
					if ( $atts['background_size'] === 'manual' ) {
						if ( $atts['background_size_manual'] !== '' ) {
							$tmp .= "background-size: {$atts['background_size_manual']};";
						}
					} else {
						$tmp .= "background-size: {$atts['background_size']};";
					}
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";

				if ( $atts['background_attachment'] === 'fixed' ) {
					$tmp .= "background-attachment: {$atts['background_attachment']};";
				}

				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}

			if ( $atts['hide_background_image'] === 'md' ) {
				$brook_shortcode_md_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'sm' ) {
				$brook_shortcode_sm_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'xs' ) {
				$brook_shortcode_xs_css .= "$selector { background-image: none !important; }";
			}

			if ( $tmp !== '' ) {
				$brook_shortcode_lg_css .= "$selector{ $tmp }";
			}

			if ( $atts['overlay_background'] !== '' ) {

				$_overlay = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['overlay_background'], $atts['overlay_custom_background'], $atts['overlay_gradient_background'] );

				$_overlay .= 'opacity: ' . $atts['overlay_opacity'] / 100 . ';';

				$brook_shortcode_lg_css .= "$selector .vc_container-overlay { $_overlay }";
			}

			self::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_row_css( $selector, $atts ) {
			global $brook_shortcode_lg_css;
			global $brook_shortcode_md_css;
			global $brook_shortcode_sm_css;
			global $brook_shortcode_xs_css;
			$gutter = '';
			extract( $atts );
			$tmp = '';

			if ( $atts['separator_type'] !== '' ) {

				$_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'fill', $atts['separator_color'], $atts['custom_separator_color'] );

				$brook_shortcode_lg_css .= "$selector .vc_row-separator svg{ $_tmp }";

				if ( isset( $atts['separator_height'] ) ) {
					Brook_VC::get_responsive_css( array(
						'element' => "$selector .vc_row-separator svg",
						'atts'    => array(
							'height' => array(
								'media_str' => $atts['separator_height'],
								'unit'      => 'px',
							),
						),
					) );
				}
			}

			if ( $atts['effect'] === 'wavify' && isset( $atts['wavify_height'] ) && $atts['wavify_height'] !== '' ) {
				Brook_VC::get_responsive_css( array(
					'element' => "$selector .wavify-wrapper svg",
					'atts'    => array(
						'height' => array(
							'media_str' => $atts['wavify_height'],
							'unit'      => 'px',
						),
					),
				) );
			}

			if ( isset( $layer_index ) && $layer_index !== '' ) {
				$tmp .= "position: relative; z-index: {$layer_index};";
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= Brook_Helper::get_css_prefix( 'border-radius', $atts['border_radius'] );
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= Brook_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
			}

			$tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'] );

			$_url = false;

			if ( $atts['background_image'] !== '' ) {
				$_url = Brook_Image::get_attachment_url_by_id( array( 'id' => $atts['background_image'] ) );

				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";
				}
			}

			if ( $atts['background_color'] === 'gradient' && $atts['background_gradient'] !== '' ) {

				if ( $_url !== false ) {
					$_tmp = str_replace( 'background:', "background: url($_url),", $atts['background_gradient'] );
					$tmp  .= $_tmp;
				} else {
					$tmp .= $atts['background_gradient'];
				}
			}

			if ( $_url !== false ) {
				if ( $atts['background_size'] !== 'auto' ) {
					if ( $atts['background_size'] === 'manual' ) {
						if ( $atts['background_size_manual'] !== '' ) {
							$tmp .= "background-size: {$atts['background_size_manual']};";
						}
					} else {
						$tmp .= "background-size: {$atts['background_size']};";
					}
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";

				if ( $atts['background_attachment'] === 'fixed' ) {
					$tmp .= "background-attachment: {$atts['background_attachment']};";
				}

				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}

			if ( $atts['hide_background_image'] === 'md' ) {
				$brook_shortcode_md_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'sm' ) {
				$brook_shortcode_sm_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'xs' ) {
				$brook_shortcode_xs_css .= "$selector { background-image: none !important; }";
			}

			if ( $atts['overlay_background'] !== '' ) {

				$_overlay = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['overlay_background'], $atts['overlay_custom_background'], $atts['overlay_gradient_background'] );

				$_overlay .= 'opacity: ' . $atts['overlay_opacity'] / 100 . ';';

				$brook_shortcode_lg_css .= "$selector .vc_container-overlay { $_overlay }";
			}

			if ( $tmp !== '' ) {
				$brook_shortcode_lg_css .= "$selector{ $tmp }";
			}

			$brook_shortcode_lg_css .= self::get_vc_row_gutter( $selector, $gutter );

			self::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_row_inner_css( $selector, $atts ) {
			global $brook_shortcode_lg_css;
			global $brook_shortcode_md_css;
			global $brook_shortcode_sm_css;
			global $brook_shortcode_xs_css;
			$gutter = '';
			extract( $atts );
			$tmp = '';

			if ( $atts['max_width'] !== '' ) {
				$tmp .= "width: {$atts['max_width']}; max-width: 100%;";
				if ( $atts['content_alignment'] === 'center' ) {
					$tmp .= "margin: 0 auto;";
				} elseif ( $atts['content_alignment'] === 'right' ) {
					$tmp .= "float: right;";
				}

				if ( $atts['md_content_alignment'] !== '' ) {
					if ( $atts['md_content_alignment'] === 'left' ) {
						$brook_shortcode_md_css .= "$selector{ float: left; }";
					} elseif ( $atts['md_content_alignment'] === 'center' ) {
						$brook_shortcode_md_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['md_content_alignment'] === 'right' ) {
						$brook_shortcode_md_css .= "$selector{ float: right; }";
					}
				}

				if ( $atts['sm_content_alignment'] !== '' ) {
					if ( $atts['sm_content_alignment'] === 'left' ) {
						$brook_shortcode_sm_css .= "$selector{ float: left; }";
					} elseif ( $atts['sm_content_alignment'] === 'center' ) {
						$brook_shortcode_sm_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['sm_content_alignment'] === 'right' ) {
						$brook_shortcode_sm_css .= "$selector{ float: right; }";
					}
				}

				if ( $atts['xs_content_alignment'] !== '' ) {
					if ( $atts['xs_content_alignment'] === 'left' ) {
						$brook_shortcode_xs_css .= "$selector{ float: left; }";
					} elseif ( $atts['xs_content_alignment'] === 'center' ) {
						$brook_shortcode_xs_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['xs_content_alignment'] === 'right' ) {
						$brook_shortcode_xs_css .= "$selector{ float: right; }";
					}
				}
			}

			if ( isset( $layer_index ) && $layer_index !== '' ) {
				$tmp .= "position: relative; z-index: {$layer_index};";
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= Brook_Helper::get_css_prefix( 'border-radius', $atts['border_radius'] );
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= Brook_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
			}

			$tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'] );

			$_url = false;

			if ( $atts['background_image'] !== '' ) {
				$_url = Brook_Image::get_attachment_url_by_id( array( 'id' => $atts['background_image'] ) );

				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";
				}
			}

			if ( $atts['background_color'] === 'gradient' && $atts['background_gradient'] !== '' ) {

				if ( $_url !== false ) {
					$_tmp = str_replace( 'background:', "background: url($_url),", $atts['background_gradient'] );
					$tmp  .= $_tmp;
				} else {
					$tmp .= $atts['background_gradient'];
				}
			}

			if ( $_url !== false ) {
				if ( $atts['background_size'] !== 'auto' ) {
					if ( $atts['background_size'] === 'manual' ) {
						if ( $atts['background_size_manual'] !== '' ) {
							$tmp .= "background-size: {$atts['background_size_manual']};";
						}
					} else {
						$tmp .= "background-size: {$atts['background_size']};";
					}
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";

				if ( $atts['background_attachment'] === 'fixed' ) {
					$tmp .= "background-attachment: {$atts['background_attachment']};";
				}

				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}

			if ( $atts['hide_background_image'] === 'md' ) {
				$brook_shortcode_md_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'sm' ) {
				$brook_shortcode_sm_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'xs' ) {
				$brook_shortcode_xs_css .= "$selector { background-image: none !important; }";
			}

			if ( $tmp !== '' ) {
				$brook_shortcode_lg_css .= "$selector{ $tmp }";
			}

			if ( $atts['overlay_background'] !== '' ) {

				$_overlay = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['overlay_background'], $atts['overlay_custom_background'], $atts['overlay_gradient_background'] );

				$_overlay .= 'opacity: ' . $atts['overlay_opacity'] / 100 . ';';

				$brook_shortcode_lg_css .= "$selector .vc_container-overlay { $_overlay }";
			}

			$brook_shortcode_lg_css .= self::get_vc_row_gutter( $selector, $gutter );

			self::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_column_css( $selector, $atts ) {
			global $brook_shortcode_lg_css;
			global $brook_shortcode_md_css;
			global $brook_shortcode_sm_css;
			global $brook_shortcode_xs_css;
			$selector_inner   = "$selector > .vc_column-inner";
			$tmp              = '';
			$column_inner_tmp = '';

			$tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'] );

			$_url = false;

			if ( $atts['background_image'] !== '' ) {
				$_url = Brook_Image::get_attachment_url_by_id( array( 'id' => $atts['background_image'] ) );

				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";
				}
			}

			if ( $atts['background_color'] === 'gradient' && $atts['background_gradient'] !== '' ) {

				if ( $_url !== false ) {
					$_tmp = str_replace( 'background:', "background: url($_url),", $atts['background_gradient'] );
					$tmp  .= $_tmp;
				} else {
					$tmp .= $atts['background_gradient'];
				}
			}

			if ( $_url !== false ) {
				if ( $atts['background_size'] !== 'auto' ) {
					if ( $atts['background_size'] === 'manual' ) {
						if ( $atts['background_size_manual'] !== '' ) {
							$tmp .= "background-size: {$atts['background_size_manual']};";
						}
					} else {
						$tmp .= "background-size: {$atts['background_size']};";
					}
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";

				if ( $atts['background_attachment'] === 'fixed' ) {
					$tmp .= "background-attachment: {$atts['background_attachment']};";
				}

				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}

			if ( $atts['hide_background_image'] === 'md' ) {
				$brook_shortcode_md_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'sm' ) {
				$brook_shortcode_sm_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'xs' ) {
				$brook_shortcode_xs_css .= "$selector { background-image: none !important; }";
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= Brook_Helper::get_css_prefix( 'border-radius', $atts['border_radius'] );
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= Brook_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
			}

			if ( isset( $atts['layer_index'] ) && $atts['layer_index'] !== '' ) {
				$tmp .= "position: relative; z-index: {$atts['layer_index']};";
			}

			if ( $tmp !== '' ) {
				$brook_shortcode_lg_css .= "$selector { $tmp }";
			}

			if ( $atts['max_width'] !== '' ) {
				$column_inner_tmp .= "width: {$atts['max_width']}; max-width: 100%;";
				if ( $atts['content_alignment'] === 'center' ) {
					$column_inner_tmp .= "margin: 0 auto;";
				} elseif ( $atts['content_alignment'] === 'right' ) {
					$column_inner_tmp .= "float: right;";
				}

				if ( $atts['md_content_alignment'] !== '' ) {
					if ( $atts['md_content_alignment'] === 'left' ) {
						$brook_shortcode_md_css .= "$selector_inner { float: left; }";
					} elseif ( $atts['md_content_alignment'] === 'center' ) {
						$brook_shortcode_md_css .= "$selector_inner { margin: 0 auto; float: none; }";
					} elseif ( $atts['md_content_alignment'] === 'right' ) {
						$brook_shortcode_md_css .= "$selector_inner { float: right; }";
					}
				}

				if ( $atts['sm_content_alignment'] !== '' ) {
					if ( $atts['sm_content_alignment'] === 'left' ) {
						$brook_shortcode_sm_css .= "$selector_inner { float: left; }";
					} elseif ( $atts['sm_content_alignment'] === 'center' ) {
						$brook_shortcode_sm_css .= "$selector_inner { margin: 0 auto; float: none; }";
					} elseif ( $atts['sm_content_alignment'] === 'right' ) {
						$brook_shortcode_sm_css .= "$selector_inner { float: right; }";
					}
				}

				if ( $atts['xs_content_alignment'] !== '' ) {
					if ( $atts['xs_content_alignment'] === 'left' ) {
						$brook_shortcode_xs_css .= "$selector_inner { float: left; }";
					} elseif ( $atts['xs_content_alignment'] === 'center' ) {
						$brook_shortcode_xs_css .= "$selector_inner { margin: 0 auto; float: none; }";
					} elseif ( $atts['xs_content_alignment'] === 'right' ) {
						$brook_shortcode_xs_css .= "$selector_inner { float: right; }";
					}
				}
			}

			if ( isset( $atts['order'] ) && $atts['order'] !== '' ) {
				$orders = explode( ';', $atts['order'] );
				foreach ( $orders as $order ) {
					$value = explode( ':', $order );
					if ( $value['0'] === 'lg' ) {
						$_css                   = Brook_Helper::get_css_prefix( 'order', $value['1'] );
						$brook_shortcode_lg_css .= "$selector { $_css }";
					} elseif ( $value['0'] === 'md' ) {
						$_css                   = Brook_Helper::get_css_prefix( 'order', $value['1'] );
						$brook_shortcode_md_css .= "$selector { $_css }";
					} elseif ( $value['0'] === 'sm' ) {
						$_css                   = Brook_Helper::get_css_prefix( 'order', $value['1'] );
						$brook_shortcode_sm_css .= "$selector { $_css }";
					} elseif ( $value['0'] === 'xs' ) {
						$_css                   = Brook_Helper::get_css_prefix( 'order', $value['1'] );
						$brook_shortcode_xs_css .= "$selector { $_css }";
					}
				}
			}

			if ( $column_inner_tmp !== '' ) {
				$brook_shortcode_lg_css .= "$selector_inner { $column_inner_tmp }";
			}

			$spacing_selector = $selector . ' > .vc_column-inner';

			if ( $atts['overlay_background'] !== '' ) {

				$_overlay = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['overlay_background'], $atts['overlay_custom_background'], $atts['overlay_gradient_background'] );

				$_overlay .= 'opacity: ' . $atts['overlay_opacity'] / 100 . ';';

				$brook_shortcode_lg_css .= "$selector .vc_container-overlay { $_overlay }";
			}

			self::get_vc_spacing_css( $spacing_selector, $atts );
		}

		public static function vc_spacing_has_border( $atts ) {
			$spacings = array(
				'lg_spacing',
				'md_spacing',
				'sm_spacing',
				'xs_spacing',
			);
			foreach ( $spacings as $val ) {
				if ( isset( $atts[ $val ] ) && $atts[ $val ] !== '' ) {
					if ( strpos( $atts[ $val ], 'border' ) !== false ) {
						return true;
					}
				}
			}

			return false;
		}

		public static function get_vc_spacing_tab() {
			$spacing_tab = esc_html__( 'Design Options', 'brook' );

			return array(
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Border Color', 'brook' ),
					'type'             => 'dropdown',
					'param_name'       => 'border_color',
					'value'            => array(
						esc_html__( 'Primary Color', 'brook' ) => 'primary',
						esc_html__( 'Custom Color', 'brook' )  => 'custom',
					),
					'std'              => 'custom',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Custom Border Color', 'brook' ),
					'type'             => 'colorpicker',
					'param_name'       => 'custom_border_color',
					'dependency'       => array(
						'element' => 'border_color',
						'value'   => array( 'custom' ),
					),
					'std'              => '#eeeeee',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Border Style', 'brook' ),
					'type'             => 'dropdown',
					'param_name'       => 'border_style',
					'value'            => array(
						esc_html__( 'Solid', 'brook' )  => 'solid',
						esc_html__( 'Dashed', 'brook' ) => 'dashed',
						esc_html__( 'Dotted', 'brook' ) => 'dotted',
						esc_html__( 'Double', 'brook' ) => 'double',
						esc_html__( 'Groove', 'brook' ) => 'groove',
						esc_html__( 'Ridge', 'brook' )  => 'ridge',
						esc_html__( 'Inset', 'brook' )  => 'inset',
						esc_html__( 'Outset', 'brook' ) => 'outset',
					),
					'std'              => 'solid',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Large Device Spacing', 'brook' ),
					'type'         => 'spacing',
					'param_name'   => 'lg_spacing',
					'spacing_icon' => 'fa-desktop',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Medium Device Spacing', 'brook' ),
					'type'         => 'spacing',
					'param_name'   => 'md_spacing',
					'spacing_icon' => 'fa-tablet fa-rotate-270',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Small Device Spacing', 'brook' ),
					'type'         => 'spacing',
					'param_name'   => 'sm_spacing',
					'spacing_icon' => 'fa-tablet',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Extra Small Spacing', 'brook' ),
					'type'         => 'spacing',
					'param_name'   => 'xs_spacing',
					'spacing_icon' => 'fa-mobile',
				),
			);
		}

		public static function get_custom_style_tab() {
			$group = esc_html__( 'Custom Style', 'brook' );

			return array(
				array(
					'group'       => $group,
					'heading'     => esc_html__( 'Custom Css', 'brook' ),
					'description' => esc_html__( 'Input custom css. Using $selector to reference to this shortcode. For e.g: "$selector .text { color: red; }"', 'brook' ),
					'type'        => 'textarea_raw_html',
					'param_name'  => 'custom_css',
				),
			);
		}

		public static function get_alignment_fields( $args = array() ) {

			$defaults = array(
				'first_element' => false,
			);
			$args     = wp_parse_args( $args, $defaults );

			$_first_field_classes = 'vc_col-sm-3';
			if ( $args['first_element'] == true ) {
				$_first_field_classes .= ' vc_column-with-padding';
			}

			return array(
				array(
					'heading'          => '<label class="hint--right hint-bounce" style="margin-right: 10px;" data-hint="' . esc_attr__( 'Large Device', 'brook' ) . '"><i class="fa fa-desktop"></i></label>' . esc_html__( 'Alignment', 'brook' ),
					'type'             => 'dropdown',
					'param_name'       => 'align',
					'value'            => array(
						esc_html__( 'Left', 'brook' )   => 'left',
						esc_html__( 'Center', 'brook' ) => 'center',
						esc_html__( 'Right', 'brook' )  => 'right',
					),
					'std'              => 'left',
					'edit_field_class' => $_first_field_classes,
				),
				array(
					'heading'          => '<label class="hint--top hint-bounce" style="margin-right: 10px;" data-hint="' . esc_attr__( 'Medium Device', 'brook' ) . '"><i class="fa fa-tablet-alt fa-rotate-270"></i></label>' . esc_html__( 'Alignment', 'brook' ),
					'type'             => 'dropdown',
					'param_name'       => 'md_align',
					'value'            => array(
						esc_html__( 'Inherit From Larger', 'brook' ) => '',
						esc_html__( 'Left', 'brook' )                => 'left',
						esc_html__( 'Center', 'brook' )              => 'center',
						esc_html__( 'Right', 'brook' )               => 'right',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'heading'          => '<label class="hint--top hint-bounce" style="margin-right: 10px;" data-hint="' . esc_attr__( 'Small Device', 'brook' ) . '"><i class="fa fa-tablet-alt"></i></label>' . esc_html__( 'Alignment', 'brook' ),
					'type'             => 'dropdown',
					'param_name'       => 'sm_align',
					'value'            => array(
						esc_html__( 'Inherit From Larger', 'brook' ) => '',
						esc_html__( 'Left', 'brook' )                => 'left',
						esc_html__( 'Center', 'brook' )              => 'center',
						esc_html__( 'Right', 'brook' )               => 'right',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'heading'          => '<label class="hint--top hint-bounce" style="margin-right: 10px;" data-hint="' . esc_attr__( 'Extra Small Device', 'brook' ) . '"><i class="fa fa-mobile-alt"></i></label>' . esc_html__( 'Alignment', 'brook' ),
					'type'             => 'dropdown',
					'param_name'       => 'xs_align',
					'value'            => array(
						esc_html__( 'Inherit From Larger', 'brook' ) => '',
						esc_html__( 'Left', 'brook' )                => 'left',
						esc_html__( 'Center', 'brook' )              => 'center',
						esc_html__( 'Right', 'brook' )               => 'right',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-3',
				),
			);
		}

		/**
		 * Generate to gutter CSS
		 *
		 * @param $selector
		 * @param $gutter
		 *
		 * @return string
		 */
		public static function get_vc_row_gutter( $selector, $gutter ) {
			$css = $default_css = $css_lg_tmp = $css_md_tmp = $css_sm_tmp = $css_xs_tmp = '';

			if ( $gutter !== '' ) {

				if ( ! is_numeric( $gutter ) ) {
					$arr = self::parse_responsive_string( $gutter );

					if ( ! empty( $arr ) ) {
						if ( count( $arr ) > 1 ) {

							foreach ( $arr as $key => $number ) {
								$number /= 2;
								switch ( $key ) {
									case 'xs':
										$css_xs_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_xs_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'sm':
										$css_sm_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_sm_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'md':
										$css_md_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_md_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'lg':
										$css_lg_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_lg_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									default:
										break;
								}
							}
						} else { // default css.
							$number     = $arr['lg'] / 2;
							$css_lg_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
							$css_lg_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
						}
					}
				} else {
					$number      = $gutter / 2;
					$default_css .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
					$default_css .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
				}

				if ( $default_css ) {
					$css .= $default_css;
				}

				if ( $css_lg_tmp ) {
					$css .= $css_lg_tmp;
				}
				if ( $css_md_tmp ) {
					$css .= "@media (max-width: 1199px){ $css_md_tmp }";
				}

				if ( $css_sm_tmp ) {
					$css .= "@media (max-width: 767px){ $css_sm_tmp }";
				}

				if ( $css_xs_tmp ) {
					$css .= "@media (max-width: 543px){ $css_xs_tmp }";
				}
			}

			return $css;
		}

		public static function get_vc_spacing_css( $selector, $atts ) {
			global $brook_shortcode_lg_css;
			global $brook_shortcode_md_css;
			global $brook_shortcode_sm_css;
			global $brook_shortcode_xs_css;

			if ( isset( $atts['lg_spacing'] ) && $atts['lg_spacing'] !== '' ) {
				$brook_shortcode_lg_css .= self::parse_spacing_value( $atts, $selector, $atts['lg_spacing'] );
			}

			if ( $atts['md_spacing'] !== '' ) {
				$brook_shortcode_md_css .= self::parse_spacing_value( $atts, $selector, $atts['md_spacing'] );
			}

			if ( $atts['sm_spacing'] !== '' ) {
				$brook_shortcode_sm_css .= self::parse_spacing_value( $atts, $selector, $atts['sm_spacing'] );
			}

			if ( $atts['xs_spacing'] !== '' ) {
				$brook_shortcode_xs_css .= self::parse_spacing_value( $atts, $selector, $atts['xs_spacing'] );
			}
		}

		public static function get_grid_css( $selector, $atts ) {
			$grid_selector = "$selector .modern-grid";

			if ( isset( $atts['columns'] ) && $atts['columns'] !== '' ) {
				Brook_VC::get_responsive_css( array(
					'element' => $grid_selector,
					'atts'    => array(
						'grid-template-columns' => array(
							'media_str' => $atts['columns'],
							'prefix'    => ' repeat(',
							'suffix'    => ', 1fr)',
						),
					),
				) );
			}

			if ( isset( $atts['column_gutter'] ) && $atts['column_gutter'] !== '' ) {
				Brook_VC::get_responsive_css( array(
					'element' => $grid_selector,
					'atts'    => array(
						'grid-column-gap' => array(
							'media_str' => $atts['column_gutter'],
							'unit'      => 'px',
						),
					),
				) );
			}

			if ( isset( $atts['row_gutter'] ) && $atts['row_gutter'] !== '' ) {
				Brook_VC::get_responsive_css( array(
					'element' => $grid_selector,
					'atts'    => array(
						'grid-row-gap' => array(
							'media_str' => $atts['row_gutter'],
							'unit'      => 'px',
						),
					),
				) );
			}
		}

		/**
		 * Generate to responsive CSS
		 *
		 * @param array  $atts
		 * @param string $selector
		 * @param string $values
		 *
		 * @return string
		 */
		public static function parse_spacing_value( $atts, $selector, $values ) {

			$css = '';
			if ( $selector ) {
				$spacing = explode( ';', $values );

				$css .= "$selector {";

				foreach ( $spacing as $value ) {
					$tmp  = explode( ':', $value );
					$attr = str_replace( '_', '-', $tmp[0] );
					$val  = $tmp[1];

					if ( strpos( $attr, 'border' ) !== false ) {
						$css          .= "$attr-width : {$val}px !important;";
						$border_color = '';
						if ( $atts['border_color'] === 'custom' ) {
							$border_color = $atts['custom_border_color'];
						} elseif ( $atts['border_color'] === 'primary' ) {
							$border_color = Brook::setting( 'primary_color' );
						}
						$css .= "$attr-color: $border_color;";
						$css .= "$attr-style: {$atts['border_style']};";
					} else {
						$css .= "$attr : {$val}px !important;";
					}
				}

				$css .= "}";
			}

			return $css;
		}

		public static function get_media_query_css( $selector, $attr, $value, $media ) {
			$css = '';
			if ( $selector ) {
				$css .= "@media ( $media ) { $selector { $attr:{$value}; } }";
			}

			return $css;
		}

		/**
		 * Generate to responsive CSS
		 *
		 * @param $args
		 *
		 * @return string
		 */
		public static function get_responsive_css( $args = array() ) {
			global $brook_shortcode_lg_css_array;
			global $brook_shortcode_md_css_array;
			global $brook_shortcode_sm_css_array;
			global $brook_shortcode_xs_css_array;

			$css_lg_tmp = $css_md_tmp = $css_sm_tmp = $css_xs_tmp = '';

			if ( ! empty( $args['element'] ) && ! empty( $args['atts'] ) ) {

				$element = $args['element'];

				foreach ( $args['atts'] as $prop => $prop_array ) {
					$unit   = isset( $prop_array['unit'] ) ? $prop_array['unit'] : '';
					$prefix = isset( $prop_array['prefix'] ) ? $prop_array['prefix'] : '';
					$suffix = isset( $prop_array['suffix'] ) ? $prop_array['suffix'] : '';

					if ( ! is_numeric( $prop_array['media_str'] ) ) {
						$arr = self::parse_responsive_string( $prop_array['media_str'] );

						if ( ! empty( $arr ) ) {
							foreach ( $arr as $key => $number ) {
								switch ( $key ) {
									case 'xs':
										$css_xs_tmp .= "{$prop}: {$prefix} {$number}{$unit} {$suffix};";
										break;
									case 'sm':
										$css_sm_tmp .= "{$prop}: {$prefix} {$number}{$unit} {$suffix};";
										break;
									case 'md':
										$css_md_tmp .= "{$prop}: {$prefix} {$number}{$unit} {$suffix};";
										break;
									case 'lg':
										$css_lg_tmp .= "{$prop}: {$prefix} {$number}{$unit} {$suffix};";
										break;
									default:
										break;
								}
							}
						}
					} else {
						$css_lg_tmp .= $prop . ':' . $prefix . $prop_array['media_str'] . $unit . $suffix . ';';
					}
				}

				if ( $css_lg_tmp ) {
					$brook_shortcode_lg_css_array[ $element ][] = $css_lg_tmp;
				}

				if ( $css_md_tmp ) {
					$brook_shortcode_md_css_array[ $element ][] = $css_md_tmp;
				}

				if ( $css_sm_tmp ) {
					$brook_shortcode_sm_css_array [ $element ][] = $css_sm_tmp;
				}

				if ( $css_xs_tmp ) {
					$brook_shortcode_xs_css_array  [ $element ][] = $css_xs_tmp;
				}
			}
		}

		/**
		 * Parse responsive string to array
		 *
		 * @param $str
		 *
		 * @return array
		 */
		public static function parse_responsive_string( $str ) {
			$data     = preg_split( '/;/', $str );
			$data_arr = array();

			foreach ( $data as $d ) {
				$pieces = explode( ':', $d );
				if ( count( $pieces ) == 2 ) {
					$key              = $pieces[0];
					$number           = $pieces[1];
					$data_arr[ $key ] = $number;
				}
			}

			return $data_arr;
		}

		public static function icon_libraries( $args = array() ) {
			$defaults = array(
				'dependency'     => array(),
				'admin_label'    => false,
				'allow_none'     => false,
				'param_name'     => 'icon_type',
				'icon_libraries' => array(),
				'group'          => esc_html__( 'Icon', 'brook' ),
				'allow_svg'      => false,
			);
			$args     = wp_parse_args( $args, $defaults );

			$icon_libraries         = apply_filters( 'brook_vc_icon_libraries', $args['icon_libraries'] );
			$args['icon_libraries'] = $icon_libraries;

			if ( $args['allow_none'] ) {
				$args['icon_libraries'] = array( esc_html__( 'None', 'brook' ) => '' ) + $args['icon_libraries'];
			}

			$type = array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon library', 'brook' ),
				'value'       => $args['icon_libraries'],
				'param_name'  => $args['param_name'],
				'description' => esc_html__( 'Select icon library.', 'brook' ),
			);

			if ( $args['admin_label'] ) {
				$type['admin_label'] = true;
			}

			if ( ! empty( $args['dependency'] ) ) {
				$type['dependency'] = $args['dependency'];
			}

			$results = array(
				$type,
			);

			$results = apply_filters( 'brook_vc_icon_libraries_fields', $results, $args );

			if ( $args['group'] !== '' ) {
				foreach ( $results as $key => $item ) {
					$results[ $key ]['group'] = $args['group'];
				}
			}

			return $results;
		}

		public function update_google_fonts() {
			global $wp_filesystem;

			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();

			$path = get_template_directory() . '/vc-extend/vc_google_fonts.json';

			$fonts = array();

			if ( file_exists( $path ) ) {

				$json  = $wp_filesystem->get_contents( $path );
				$fonts = json_decode( $json );
			}

			return $fonts;
		}

		public static function get_separator_svg( $type ) {
			$output = '';

			switch ( $type ) {
				case 'triangle' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 0.156661 0.1"><polygon points="0.156661,3.93701e-006 0.156661,0.000429134 0.117665,0.05 0.0783307,0.0999961 0.0389961,0.05 -0,0.000429134 -0,3.93701e-006 0.0783307,3.93701e-006 "/></svg>';
					break;

				case 'big_triangle' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil0" d="M-0 0.333331l4.66666 0 0 -3.93701e-006 -2.33333 0 -2.33333 0 0 3.93701e-006zm0 -0.333331l4.66666 0 0 0.166661 -4.66666 0 0 -0.166661zm4.66666 0.332618l0 -0.165953 -4.66666 0 0 0.165953 1.16162 -0.0826181 1.17171 -0.0833228 1.17171 0.0833228 1.16162 0.0826181z"/></svg>';
					break;

				case 'big_triangle_alt' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none"><polygon points="0,0 50,100 100,0 100,100 0,100"></polygon></svg>';
					break;

				case 'big_triangle_left' :
				case 'big_triangle_right' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 2000 90" preserveAspectRatio="none"><polygon xmlns="https://www.w3.org/2000/svg" points="535.084,64.886 0,0 0,90 2000,90 2000,0 "></polygon></svg>';
					break;

				case 'tilt_left' :
				case 'tilt_right' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4 0.266661" preserveAspectRatio="none"><polygon class="fil0" points="4,0 4,0.266661 -0,0.266661 "/></svg>';
					break;

				case 'circle' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1"  viewBox="0 0 0.2 0.1"><path d="M0.200004 0c-3.93701e-006,0.0552205 -0.0447795,0.1 -0.100004,0.1 -0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1l0.200004 0z"/></svg>';
					break;

				case 'curve' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil0" d="M-7.87402e-006 0.0148858l0.00234646 0c0.052689,0.0154094 0.554437,0.154539 1.51807,0.166524l0.267925 0c0.0227165,-0.00026378 0.0456102,-0.000582677 0.0687992,-0.001 1.1559,-0.0208465 2.34191,-0.147224 2.79148,-0.165524l0.0180591 0 0 0.166661 -7.87402e-006 0 0 0.151783 -4.66666 0 0 -0.151783 -7.87402e-006 0 0 -0.166661z"/></svg>';
					break;

				case 'waves' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 6 0.1" preserveAspectRatio="none"><path d="M0.199945 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c-0.0541102,0 -0.0981929,-0.0430079 -0.0999409,-0.0967008l0 0.0967008 0.0999409 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm2.00004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm-0.1 0.1l-0.200008 0c-0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1 -7.87402e-006,0.0552205 -0.0447874,0.1 -0.1,0.1l0.2 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm-0.400008 0l-0.200008 0c-0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1 -7.87402e-006,0.0552205 -0.0447874,0.1 -0.1,0.1l0.2 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm-0.400008 0l-0.200008 0c-0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1 -7.87402e-006,0.0552205 -0.0447874,0.1 -0.1,0.1l0.2 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm-0.400008 0l-0.200008 0c-0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1 -7.87402e-006,0.0552205 -0.0447874,0.1 -0.1,0.1l0.2 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm-0.400008 0l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm1.90004 -0.1c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.199945 0.00329921l0 0.0967008 -0.0999409 0c0.0541102,0 0.0981929,-0.0430079 0.0999409,-0.0967008z"/></svg>';
					break;

				case 'clouds' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 2.23333 0.1" preserveAspectRatio="none"><path class="fil0" d="M2.23281 0.0372047c0,0 -0.0261929,-0.000389764 -0.0423307,-0.00584252 0,0 -0.0356181,0.0278268 -0.0865354,0.0212205 0,0 -0.0347835,-0.00524803 -0.0579094,-0.0283701 0,0 -0.0334252,0.0112677 -0.0773425,-0.00116929 0,0 -0.0590787,0.0524724 -0.141472,0.000779528 0,0 -0.0288189,0.0189291 -0.0762362,0.0111535 -0.00458268,0.0141024 -0.0150945,0.040122 -0.0656811,0.0432598 -0.0505866,0.0031378 -0.076126,-0.0226614 -0.0808425,-0.0308228 -0.00806299,0.000854331 -0.0819961,0.0186969 -0.111488,-0.022815 -0.0076378,0.0114843 -0.059185,0.0252598 -0.083563,-0.000385827 -0.0295945,0.0508661 -0.111996,0.0664843 -0.153752,0.019 -0.0179843,0.00227559 -0.0571181,0.00573622 -0.0732795,-0.0152953 -0.027748,0.0419646 -0.110602,0.0366654 -0.138701,0.00688189 0,0 -0.0771732,0.0395709 -0.116598,-0.0147677 0,0 -0.0497598,0.02 -0.0773346,-0.00166929 0,0 -0.0479646,0.0302756 -0.0998937,0.00944094 0,0 -0.0252638,0.0107874 -0.0839488,0.00884646 0,0 -0.046252,0.000775591 -0.0734567,-0.0237087 0,0 -0.046252,0.0101024 -0.0769567,-0.00116929 0,0 -0.0450827,0.0314843 -0.118543,0.0108858 0,0 -0.0715118,0.0609803 -0.144579,0.00423228 0,0 -0.0385787,0.00770079 -0.0646299,0.000102362 0,0 -0.0387559,0.0432205 -0.125039,0.0206811 0,0 -0.0324409,0.0181024 -0.0621457,0.0111063l-3.93701e-005 0.0412205 2.2323 0 0 -0.0627953z"/></svg>';
					break;

				case 'square' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" width="90px" height="90px" viewBox="0 0 100 100" preserveAspectRatio="none"><rect x="33.3333%" y="0" width="66.6667" height="66.6667"></rect>
  <rect x="0" y="66.6667%" width="33.3333%" height="33.3333%"></rect></svg>';
					break;

			}

			return $output;
		}

		static function get_shortcode_custom_css( $selector, $atts = array() ) {
			if ( ! isset( $atts['custom_css'] ) && $atts['custom_css'] === '' ) {
				return;
			}
			global $brook_shortcode_lg_css;

			$content = rawurldecode( insight_core_base_decode( strip_tags( $atts['custom_css'] ) ) );
			$content = wpb_js_remove_wpautop( apply_filters( 'vc_raw_html_module_content', $content ) );

			$content = str_replace( array( "\r", "\n" ), '', $content );
			$content = str_replace( '$selector', $selector, $content );

			$brook_shortcode_lg_css .= $content;
		}

		static function get_shortcode_el_id( $atts = array(), $prefix = '' ) {
			if ( isset( $atts['el_id'] ) && $atts['el_id'] !== '' ) {
				return $atts['el_id'];
			}

			$el_id = uniqid( $prefix );

			return $el_id;
		}

		static function get_tooltip_skin_list() {
			return array(
				esc_html__( 'Black', 'brook' )           => '',
				esc_html__( 'White', 'brook' )           => 'white',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			);
		}

		function get_contact_form_7_list() {
			$contact_forms = array();

			if ( is_admin() ) {
				$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

				if ( $cf7 ) {
					foreach ( $cf7 as $cform ) {
						$contact_forms[ $cform->post_title ] = $cform->ID;
					}
				} else {
					$contact_forms[ esc_html__( 'No contact forms found', 'brook' ) ] = 0;
				}
			}

			return $contact_forms;
		}
	}

	Brook_VC::instance()->init();
}

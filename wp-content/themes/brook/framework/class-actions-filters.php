<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom filters that act independently of the theme templates
 */
if ( ! class_exists( 'Brook_Actions_Filters' ) ) {
	class Brook_Actions_Filters {

		public function __construct() {
			add_filter( 'wp_kses_allowed_html', array( $this, 'wp_kses_allowed_html' ), 2, 99 );

			// Disable default share buttons.
			add_filter( 'addtoany_sharing_disabled', array( $this, 'addtoany_disable_default_buttons' ) );

			/* Move post count inside the link */
			add_filter( 'wp_list_categories', array( $this, 'move_post_count_inside_link_category' ) );
			/* Move post count inside the link */
			add_filter( 'get_archives_link', array( $this, 'move_post_count_inside_link_archive' ) );

			add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );

			add_filter( 'embed_oembed_html', array( $this, 'add_wrapper_for_video' ), 10, 3 );
			add_filter( 'video_embed_html', array( $this, 'add_wrapper_for_video' ) ); // Jetpack.

			add_filter( 'excerpt_length', array(
				$this,
				'custom_excerpt_length',
			), 999 ); // Change excerpt length is set to 55 words by default.

			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			// Adds custom attributes to body tag.
			add_filter( 'brook_body_attributes', array( $this, 'add_attributes_to_body' ) );

			if ( ! is_admin() ) {
				add_action( 'pre_get_posts', array( $this, 'alter_search_loop' ), 1 );
				add_filter( 'pre_get_posts', array( $this, 'search_filter' ) );
				add_filter( 'pre_get_posts', array( $this, 'empty_search_filter' ) );
			}

			// Add inline style for shortcode.
			add_action( 'wp_footer', array( $this, 'shortcode_style' ) );

			add_filter( 'insightcore_bmw_nav_args', array( $this, 'add_extra_params_to_insightcore_bmw' ) );
		}

		function addtoany_disable_default_buttons() {
			return true;
		}

		public function wp_kses_allowed_html( $allowedtags, $context ) {

			$basic_atts = array(
				'id'    => array(),
				'class' => array(),
				'style' => array(),
			);

			switch ( $context ) {
				case 'brook-img':
					$allowedtags = array(
						'img' => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'src'    => array(),
							'width'  => array(),
							'height' => array(),
							'alt'    => array(),
							'srcset' => array(),
							'sizes'  => array(),
						),
					);
					break;
				case 'brook-a':
					$allowedtags = array(
						'a' => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'title'  => array(),
						),
					);
					break;
				case 'brook-default' :
					$allowedtags = array(
						'a'      => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'title'  => array(),
						),
						'img'    => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'src'    => array(),
							'width'  => array(),
							'height' => array(),
							'alt'    => array(),
							'srcset' => array(),
							'sizes'  => array(),
						),
						'br'     => array(),
						'ul'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'ol'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'li'     => $basic_atts,
						'h1'     => $basic_atts,
						'h2'     => $basic_atts,
						'h3'     => $basic_atts,
						'h4'     => $basic_atts,
						'h5'     => $basic_atts,
						'h6'     => $basic_atts,
						'div'    => $basic_atts,
						'strong' => $basic_atts,
						'b'      => $basic_atts,
						'span'   => $basic_atts,
						'i'      => $basic_atts,
						'del'    => $basic_atts,
						'ins'    => $basic_atts,
					);
					break;
			}

			return $allowedtags;
		}

		function add_extra_params_to_insightcore_bmw( $args ) {
			$args['link_before'] = '<div class="menu-item-wrap"><span class="menu-item-title">';
			$args['link_after']  = '</span></div>';

			return $args;
		}

		function move_post_count_inside_link_category( $links ) {
			// First remove span that added by woocommerce.
			$links = str_replace( '<span class="count">', '', $links );
			$links = str_replace( '</span>', '', $links );

			// Then add span again for both blog & shop.

			$links = str_replace( '</a> ', ' <span class="count">', $links );
			$links = str_replace( ')', ')</span></a>', $links );
			$links = str_replace( '<span class="count">(', '<span class="count">(', $links );

			return $links;
		}

		function move_post_count_inside_link_archive( $links ) {
			$links = str_replace( '</a>&nbsp;(', ' (', $links );
			$links = str_replace( ')', ')</a>', $links );

			return $links;
		}


		function change_widget_tag_cloud_args( $args ) {
			/* set the smallest & largest size in px */
			$args['separator'] = ', ';

			return $args;
		}

		function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			return $fields;
		}

		function shortcode_style() {
			global $brook_shortcode_lg_css_array;
			global $brook_shortcode_md_css_array;
			global $brook_shortcode_sm_css_array;
			global $brook_shortcode_xs_css_array;
			global $brook_shortcode_lg_css;
			global $brook_shortcode_md_css;
			global $brook_shortcode_sm_css;
			global $brook_shortcode_xs_css;
			$css = '';

			if ( $brook_shortcode_lg_css && $brook_shortcode_lg_css !== '' ) {
				$css .= $brook_shortcode_lg_css;
			}

			if ( ! empty( $brook_shortcode_lg_css_array ) ) {
				foreach ( $brook_shortcode_lg_css_array as $selector => $value ) {
					$css .= "$selector { " . implode( '', $value ) . " }";
				}
			}

			if ( $brook_shortcode_md_css && $brook_shortcode_md_css !== '' ) {
				$css .= "@media (max-width: 1199px) { $brook_shortcode_md_css }";
			}

			if ( ! empty( $brook_shortcode_md_css_array ) ) {
				$css .= "@media (max-width: 1199px) {";
				foreach ( $brook_shortcode_md_css_array as $selector => $value ) {
					$css .= "$selector { " . implode( '', $value ) . " }";
				}
				$css .= "}";
			}

			if ( $brook_shortcode_sm_css && $brook_shortcode_sm_css !== '' ) {
				$css .= "@media (max-width: 992px) { $brook_shortcode_sm_css }";
			}

			if ( ! empty( $brook_shortcode_sm_css_array ) ) {
				$css .= "@media (max-width: 992px) {";
				foreach ( $brook_shortcode_sm_css_array as $selector => $value ) {
					$css .= "$selector { " . implode( '', $value ) . " }";
				}
				$css .= "}";
			}

			if ( $brook_shortcode_xs_css && $brook_shortcode_xs_css !== '' ) {
				$css .= "@media (max-width: 767px) { $brook_shortcode_xs_css }";
			}

			if ( ! empty( $brook_shortcode_xs_css_array ) ) {
				$css .= "@media (max-width: 767px) {";
				foreach ( $brook_shortcode_xs_css_array as $selector => $value ) {
					$css .= "$selector { " . implode( '', $value ) . " }";
				}
				$css .= "}";
			}

			if ( $css !== '' ) : ?>
				<?php $css = Brook_Minify::css( $css ); ?>
				<script>
					var mainStyle = document.getElementById( 'brook-style-inline-css' );
					if ( mainStyle !== null ) {
						mainStyle.textContent += '<?php echo '' . $css; ?>';
					}
				</script>
			<?php endif;
		}

		/**
		 * @param WP_Query $query Query instance.
		 */
		public function alter_search_loop( $query ) {
			if ( $query->is_main_query() && $query->is_search() ) {
				$number_results = Brook::setting( 'search_page_number_results' );
				$query->set( 'posts_per_page', $number_results );
			}
		}

		/**
		 * @param WP_Query $query Query instance.
		 *
		 * @return WP_Query $query
		 *
		 * Apply filters to the search query.
		 * Determines if we only want to display posts/pages and changes the query accordingly
		 */
		public function search_filter( $query ) {
			if ( $query->is_main_query() && $query->is_search ) {
				$filter = Brook::setting( 'search_page_filter' );
				if ( $filter !== 'all' ) {
					$query->set( 'post_type', $filter );
				}
			}

			return $query;
		}

		/**
		 * Make wordpress respect the search template on an empty search
		 */
		public function empty_search_filter( $query ) {
			if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
				$query->is_search = true;
				$query->is_home   = false;
			}

			return $query;
		}

		public function custom_excerpt_length() {
			return 999;
		}

		/**
		 * Add responsive container to embeds
		 */
		public function add_wrapper_for_video( $html, $url ) {
			$array = array(
				'youtube.com',
				'wordpress.tv',
				'vimeo.com',
				'dailymotion.com',
				'hulu.com',
			);

			if ( Brook_Helper::strposa( $url, $array ) ) {
				$html = '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
			}

			return $html;
		}

		public function add_attributes_to_body( $attrs ) {
			$site_width = Brook_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Brook::setting( 'site_width' );
			}
			$attrs['data-site-width']    = $site_width;
			$attrs['data-content-width'] = 1200;

			$font = Brook_Helper::get_body_font();

			$attrs['data-font'] = $font;

			$header_sticky_height               = Brook::setting( 'header_sticky_height' );
			$attrs['data-header-sticky-height'] = $header_sticky_height;

			return $attrs;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Adds a class for mobile device.
			if ( Brook::is_mobile() ) {
				$classes[] = 'mobile';
			}

			// Adds a class for tablet device.
			if ( Brook::is_tablet() ) {
				$classes[] = 'tablet';
			}

			// Adds a class for handheld device.
			if ( Brook::is_handheld() ) {
				$classes[] = 'handheld mobile-menu';
			}

			// Adds a class for desktop device.
			if ( Brook::is_desktop() ) {
				$classes[] = 'desktop desktop-menu';
			}

			if ( Brook_Helper::active_woocommerce() ) {
				$classes[] = 'woocommerce';

				if ( Brook_Woo::is_product_archive() ) {
					$archive_shop_layout = Brook::setting( 'shop_archive_layout' );

					$classes[] = "archive-shop-{$archive_shop_layout}";
				}
			}

			$css_animation = Brook::setting( 'shortcode_animation_enable' );

			if ( ( $css_animation === 'both' ) || ( $css_animation === 'desktop' && Brook::is_desktop() ) || ( $css_animation === 'mobile' && Brook::is_handheld() ) ) {
				$classes[] = 'page-has-animation';
			}

			$one_page_enable = Brook_Helper::get_post_meta( 'menu_one_page', '' );
			if ( $one_page_enable === '1' ) {
				$classes[] = 'one-page';
			}

			$scroll_nav_style = Brook_Helper::get_post_meta( 'one_page_scroll_nav_style', '01' );
			if ( $scroll_nav_style !== '' ) {
				$classes[] = "scroll-nav-style-{$scroll_nav_style}";
			}

			if ( is_singular( 'post' ) ) {
				$blog_style = Brook_Helper::get_post_meta( 'single_post_style', '' );

				if ( $blog_style === '' ) {
					$blog_style = Brook::setting( 'single_post_style' );
				}

				$classes[] = "single-blog-style-$blog_style";
			}

			if ( is_singular( 'portfolio' ) ) {
				$style = Brook_Helper::get_post_meta( 'portfolio_layout_style', '' );
				if ( $style === '' ) {
					$style = Brook::setting( 'single_portfolio_style' );
				}
				$classes[] = "single-portfolio-style-$style";
			}

			$header_sticky_behaviour = Brook::setting( 'header_sticky_behaviour' );
			$classes[]               = "header-sticky-$header_sticky_behaviour";

			$site_layout = Brook_Helper::get_post_meta( 'site_layout', '' );
			if ( $site_layout === '' ) {
				$site_layout = Brook::setting( 'site_layout' );
			}
			$classes[] = $site_layout;

			$sidebar_status = Brook_Global::instance()->get_sidebar_status();

			if ( $sidebar_status === 'one' ) {
				$classes[] = 'page-has-sidebar page-one-sidebar';
			} elseif ( $sidebar_status === 'both' ) {
				$classes[] = 'page-has-sidebar page-both-sidebar';
			} else {
				$classes[] = 'page-has-no-sidebar';
			}

			return $classes;
		}
	}

	new Brook_Actions_Filters();
}

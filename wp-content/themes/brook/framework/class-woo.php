<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom functions, filters, actions for WooCommerce.
 */
if ( ! class_exists( 'Brook_Woo' ) ) {
	class Brook_Woo {

		protected static $instance = null;
		const MINIMUM_PLUGIN_VERSION = '4.0.2';

		public static $product_image_size_width  = '';
		public static $product_image_size_height = '';
		public static $product_image_crop        = true;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function init() {
			// Disable Woocommerce cart fragments on home page.
			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woocommerce_cart_fragments' ), 11 );

			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'header_add_to_cart_fragment' ) );

			add_filter( 'woocommerce_checkout_fields', array( $this, 'override_checkout_fields' ) );

			add_action( 'wp_head', array( $this, 'wp_init' ) );

			add_action( 'after_switch_theme', array( $this, 'change_woocommerce_image_dimensions' ), 1 );

			/* Begin hook for shop archive */
			add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 );

			add_filter( 'woocommerce_pagination_args', array( $this, 'override_pagination_args' ) );

			// Add link to the product title
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			add_action( 'woocommerce_shop_loop_item_title', array(
				$this,
				'template_loop_product_title',
			), 10 );

			/* End hook for shop archive */

			/*
			 * Begin hooks for single product
			 */

			// Remove tab heading in on single product pages.
			add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
			add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );

			add_filter( 'woocommerce_review_gravatar_size', array( $this, 'woocommerce_review_gravatar_size' ) );

			// Check old version installed.
			if ( defined( 'WOOSCP_VERSION' ) || ( defined( 'WOOSC_VERSION' ) && version_compare( WOOSC_VERSION, self::MINIMUM_PLUGIN_VERSION, '<' ) ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_compare_plugin_version' ] );
			}

			// Hide default smart compare & smart wishlist button.
			add_filter( 'woosw_button_position_archive', '__return_zero_string' );
			add_filter( 'woosw_button_position_single', '__return_zero_string' );
			add_filter( 'woosc_button_position_archive', '__return_false' );
			add_filter( 'woosc_button_position_single', '__return_false' );

			/*
			 * End hooks for single product
			 */

			// Notice Cookie Confirm.
			add_action( 'wp_ajax_notice_cookie_confirm', array( $this, 'notice_cookie_confirm' ) );
			add_action( 'wp_ajax_nopriv_notice_cookie_confirm', array( $this, 'notice_cookie_confirm' ) );

			// Shortcode Product Infinity.
			add_action( 'wp_ajax_product_infinite_load', array( $this, 'product_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_product_infinite_load', array( $this, 'product_infinite_load' ) );

			add_action( 'after_setup_theme', array( $this, 'modify_theme_support' ), 10 );

			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );

			add_action( 'woocommerce_single_product_summary', array( $this, 'add_sharing_in_summary' ), 25 );
		}

		function add_sharing_in_summary() {
			if ( Brook::setting( 'single_product_sharing_enable' ) === '1' ) :
				Brook_Templates::product_sharing();
			endif;
		}

		/**
		 * Modify image width theme support.
		 */
		function modify_theme_support() {
			$theme_support = get_theme_support( 'woocommerce' );
			$theme_support = is_array( $theme_support ) ? $theme_support[0] : array();

			$theme_support['single_image_width']    = 760;
			$theme_support['thumbnail_image_width'] = 400;

			remove_theme_support( 'woocommerce' );
			add_theme_support( 'woocommerce', $theme_support );
		}

		/**
		 * Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and which are also included)
		 *
		 * @access public
		 * @return bool
		 */
		public static function is_woocommerce_page() {
			if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
				return true;
			}

			$woocommerce_keys = array(
				"woocommerce_shop_page_id",
				"woocommerce_terms_page_id",
				"woocommerce_cart_page_id",
				"woocommerce_checkout_page_id",
				"woocommerce_pay_page_id",
				"woocommerce_thanks_page_id",
				"woocommerce_myaccount_page_id",
				"woocommerce_edit_address_page_id",
				"woocommerce_view_order_page_id",
				"woocommerce_change_password_page_id",
				"woocommerce_logout_page_id",
				"woocommerce_lost_password_page_id",
			);

			foreach ( $woocommerce_keys as $wc_page_id ) {
				if ( get_the_ID() == get_option( $wc_page_id, 0 ) ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Returns true if on a page which uses WooCommerce templates exclude single product (cart and checkout are standard pages with shortcodes and which are also included)
		 *
		 * @access public
		 * @return bool
		 */
		public static function is_woocommerce_page_without_product() {
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				return true;
			}

			if ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) {
				return true;
			}

			if ( is_post_type_archive( 'product' ) ) {
				return true;
			}

			$woocommerce_keys = array(
				"woocommerce_shop_page_id",
				"woocommerce_terms_page_id",
				"woocommerce_cart_page_id",
				"woocommerce_checkout_page_id",
				"woocommerce_pay_page_id",
				"woocommerce_thanks_page_id",
				"woocommerce_myaccount_page_id",
				"woocommerce_edit_address_page_id",
				"woocommerce_view_order_page_id",
				"woocommerce_change_password_page_id",
				"woocommerce_logout_page_id",
				"woocommerce_lost_password_page_id",
			);

			foreach ( $woocommerce_keys as $wc_page_id ) {
				if ( get_the_ID() == get_option( $wc_page_id, 0 ) ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Returns true if on a archive product pages.
		 *
		 * @access public
		 * @return bool
		 */
		public static function is_product_archive() {
			if ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Custom product title instead of default product title
		 *
		 * @see woocommerce_template_loop_product_title()
		 */
		public function template_loop_product_title() {
			?>
            <h2 class="woocommerce-loop-product__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
			<?php
			if ( !function_exists( 'isset_column' )) {

				function isset_column( $meta_data, $column_name ) {
					$meta = '';
					if ( isset( $meta_data[ $column_name ] ) ) {
						$meta = $meta_data[ $column_name ]['value'];
					}

					return $meta;
				}
			}
			$meta_data = get_post_meta( get_the_ID(), '_product_attributes' );
			$weight_unit = get_option('woocommerce_weight_unit');;

			$cut = '';
			if ( isset( $meta_data[0]['cut'] ) || isset( $meta_data[0]['pa_cut'] ) ) {
				$cut = $meta_data[0][ isset( $meta_data[0]['cut'] ) ? 'cut' : 'pa_cut' ]['value'];
			}
			$color = '';
			if ( isset( $meta_data[0]['color'] ) ) {
				$color = isset_column( $meta_data[0], 'color' );
			}
			$clarity = '';
			if ( isset( $meta_data[0]['clarity'] )) {
				$clarity = isset_column( $meta_data[0], 'clarity' );
			}
			$weight = '';
			if ( isset( $meta_data[0]['clarity'] )) {
				$weight = isset_column( $meta_data[0], 'weight' );
			}
			?>
            <p>
	            <?php if ( $weight != '' ) { ?>
                    <span>WEIGHT</span>&nbsp;|&nbsp;
	            <?php } ?>
	            <?php if ( $color != '' ) { ?>
                    <span>COLOR</span>&nbsp;|&nbsp;
	            <?php } ?>
	            <?php if ( $clarity != '' ) { ?>
                    <span>CLARITY</span>&nbsp;|&nbsp;
	            <?php } ?>
				<?php if ( $cut != '' ) { ?>
                    <span>CUT</span>
				<?php } ?>
            </p>
            <p>
	            <?php if ( $weight != '' ) { ?>
                    <span><b><?php echo $weight . ' '. $weight_unit; ?></b></span>&nbsp;|&nbsp;
	            <?php } ?>
	            <?php if ( $color != '' ) { ?>
                    <span><b><?php echo $color; ?></b></span>&nbsp;|&nbsp;
	            <?php } ?>
	            <?php if ( $clarity != '' ) { ?>
                    <span><b><?php echo $clarity; ?></b></span>&nbsp;|&nbsp;
	            <?php } ?>
				<?php if ( $cut != '' ) { ?>
                    <span><b><?php echo $cut; ?></b></span>&nbsp;
				<?php } ?>
            </p>
			<?php
		}

		function loop_shop_per_page( $cols ) {
			if ( isset( $_GET['shop_archive_number_item'] ) && $_GET['shop_archive_number_item'] !== '' ) {
				$number = $_GET['shop_archive_number_item'];
			} elseif ( isset( $_GET['shop_archive_preset'] ) && in_array( $_GET['shop_archive_preset'], array(
					'minimal',
					'wide',
				), true ) ) {
				// Hard set post per page. because override preset settings run after init hook.
				$number = 9;
			} else {
				$number = Brook::setting( 'shop_archive_number_item' );
			}

			return isset( $_GET['product_per_page'] ) ? wc_clean( $_GET['product_per_page'] ) : $number;
		}

		function override_pagination_args( $args ) {
			$args['prev_text'] = '<i class="fa fa-angle-left"></i>';
			$args['next_text'] = '<i class="fa fa-angle-right"></i>';

			return $args;
		}

		public function woocommerce_review_gravatar_size() {
			return 70;
		}

		public function wp_init() {
			if ( Brook::setting( 'single_product_up_sells_enable' ) === '0' ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			}

			if ( Brook::setting( 'single_product_related_enable' ) === '0' ) {
				// Clear the query arguments for related products so none show.
				add_filter( 'woocommerce_related_products_args', '__return_empty_array', 10 );
			}

			// Remove Cross Sells from default position at Cart. Then add them back UNDER the Cart Table.
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			if ( Brook::setting( 'shopping_cart_cross_sells_enable' ) === '1' ) {
				add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );
			}
		}

		public function override_checkout_fields( $fields ) {
			$fields['billing']['billing_first_name']['placeholder'] = esc_attr__( 'First Name *', 'brook' );
			$fields['billing']['billing_last_name']['placeholder']  = esc_attr__( 'Last Name *', 'brook' );
			$fields['billing']['billing_company']['placeholder']    = esc_attr__( 'Company Name', 'brook' );
			$fields['billing']['billing_email']['placeholder']      = esc_attr__( 'Email Address *', 'brook' );
			$fields['billing']['billing_phone']['placeholder']      = esc_attr__( 'Phone *', 'brook' );
			$fields['billing']['billing_address_1']['placeholder']  = esc_attr__( 'Address *', 'brook' );
			$fields['billing']['billing_address_2']['placeholder']  = esc_attr__( 'Address', 'brook' );
			$fields['billing']['billing_city']['placeholder']       = esc_attr__( 'Town / City *', 'brook' );
			$fields['billing']['billing_postcode']['placeholder']   = esc_attr__( 'Zip *', 'brook' );

			$fields['shipping']['shipping_first_name']['placeholder'] = esc_attr__( 'First Name *', 'brook' );
			$fields['shipping']['shipping_last_name']['placeholder']  = esc_attr__( 'Last Name *', 'brook' );
			$fields['shipping']['shipping_company']['placeholder']    = esc_attr__( 'Company Name', 'brook' );
			$fields['shipping']['shipping_city']['placeholder']       = esc_attr__( 'Town / City *', 'brook' );
			$fields['shipping']['shipping_postcode']['placeholder']   = esc_attr__( 'Zip *', 'brook' );

			return $fields;
		}

		public function dequeue_woocommerce_cart_fragments() {
			if ( is_front_page() && Brook_Helper::active_woocommerce() && add_theme_support( 'woo_speed' ) ) {
				wp_dequeue_script( 'wc-cart-fragments' );
			}
		}

		/**
		 * Ensure cart contents update when products are added to the cart via AJAX
		 * ========================================================================
		 *
		 * @param $fragments
		 *
		 * @return mixed
		 */
		function header_add_to_cart_fragment( $fragments ) {
			ob_start();
			$cart_html = self::get_minicart();
			echo '' . $cart_html;
			$fragments['.mini-cart__button'] = ob_get_clean();

			return $fragments;
		}

		/**
		 * Get mini cart HTML
		 * ==================
		 *
		 * @return string
		 */
		static function get_minicart() {
			$cart_html = '';
			$qty       = WC()->cart->get_cart_contents_count();
			$cart_html .= '<div class="mini-cart__button" title="' . esc_attr__( 'View your shopping cart', 'brook' ) . '">';
			$cart_html .= '<span class="mini-cart-icon" data-count="' . $qty . '"></span>';
			$cart_html .= '</div>';

			return $cart_html;
		}

		static function render_mini_cart() {
			$header_type = Brook_Global::instance()->get_header_type();

			$enabled = Brook::setting( "header_style_{$header_type}_cart_enable" );

			if ( Brook_Helper::active_woocommerce() && in_array( $enabled, array( '1', 'hide_on_empty' ) ) ) {
				global $woocommerce;
				$cart_url = '/cart';
				if ( isset( $woocommerce ) ) {
					$cart_url = wc_get_cart_url();
				}
				$classes = 'mini-cart';
				if ( $enabled === 'hide_on_empty' ) {
					$classes .= ' hide-on-empty';
				}
				?>
                <div id="mini-cart" class="<?php echo esc_attr( $classes ); ?>"
                     data-url="<?php echo esc_url( $cart_url ); ?>">
					<?php echo self::get_minicart(); ?>
                    <div class="widget_shopping_cart_content"></div>
                </div>
			<?php }
		}

		static function get_percentage_price() {
			global $product;

			if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
				$_regular_price = $product->get_regular_price();
				$_sale_price    = $product->get_sale_price();

				$percentage = round( ( ( $_regular_price - $_sale_price ) / $_regular_price ) * 100 );

				return "-{$percentage}%";
			} else {
				return esc_html__( 'Sale', 'brook' );
			}
		}

		static function get_wishlist_button_template( $args = array() ) {
			if ( ( Brook::setting( 'shop_archive_wishlist' ) !== '1' ) || ! class_exists( 'WPCleverWoosw' ) ) {
				return;
			}

			global $product;
			$product_id = $product->get_id();

			$defaults = array(
				'show_tooltip'     => true,
				'tooltip_position' => 'top',
			);
			$args     = wp_parse_args( $args, $defaults );

			$_wrapper_classes = 'product-action wishlist-btn';

			if ( $args['show_tooltip'] === true ) {
				$_wrapper_classes .= ' hint--rounded hint--bounce';
				$_wrapper_classes .= " hint--{$args['tooltip_position']}";
			}
			?>
            <div class="<?php echo esc_attr( $_wrapper_classes ); ?>"
                 aria-label="<?php esc_attr_e( 'Add to wishlist', 'brook' ) ?>">
				<?php echo do_shortcode( '[woosw id="' . $product_id . '" type="link"]' ); ?>
            </div>
			<?php
		}

		static function get_compare_button_template( $args = array() ) {
			if ( Brook::setting( 'shop_archive_compare' ) !== '1' || wp_is_mobile() || ! class_exists( 'WPCleverWoosc' ) ) {
				return;
			}

			global $product;
			$product_id = $product->get_id();

			$defaults = array(
				'show_tooltip'     => true,
				'tooltip_position' => 'top',
			);
			$args     = wp_parse_args( $args, $defaults );

			$_wrapper_classes = 'product-action compare-btn';

			if ( $args['show_tooltip'] === true ) {
				$_wrapper_classes .= ' hint--rounded hint--bounce';
				$_wrapper_classes .= " hint--{$args['tooltip_position']}";
			}
			?>
            <div class="<?php echo esc_attr( $_wrapper_classes ); ?>"
                 aria-label="<?php esc_attr_e( 'Compare', 'brook' ) ?>">
				<?php echo do_shortcode( '[woosc id="' . $product_id . '" type="link"]' ); ?>
            </div>
			<?php
		}

		public function product_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Brook_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			if ( in_array( $args['orderby'], array( 'meta_value', 'meta_value_num' ) ) ) {
				$args['meta_key'] = $_POST['meta_key'];
			}

			if ( isset( $_POST['minPrice'] ) && isset( $_POST['maxPrice'] ) ) {
				$args['meta_query'] = array(
					array(
						'key'     => '_price',
						'value'   => array( $_POST['minPrice'], $_POST['maxPrice'] ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC',
					),
				);
			}

			$style = 'grid';
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}

			$brook_query = new WP_Query( $args );

			$response = array(
				'max_num_pages' => $brook_query->max_num_pages,
				'found_posts'   => $brook_query->found_posts,
				'count'         => $brook_query->post_count,
			);

			ob_start();

			if ( $brook_query->have_posts() ) :
				while ( $brook_query->have_posts() ) : $brook_query->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public function notice_cookie_confirm() {
			setcookie( 'notice_cookie_confirm', 'yes', time() + 365 * 86400, COOKIEPATH, COOKIE_DOMAIN );

			wp_die();
		}

		function change_woocommerce_image_dimensions() {
			global $pagenow;

			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}

			// Update single image width
			update_option( 'woocommerce_single_image_width', 760 );

			// Update thumbnail image width
			update_option( 'woocommerce_thumbnail_image_width', 400 );

			// Update ratio
			update_option( 'woocommerce_thumbnail_cropping', 'custom' );
			update_option( 'woocommerce_thumbnail_cropping_custom_width', 3 );
			update_option( 'woocommerce_thumbnail_cropping_custom_height', 4 );
		}

		function get_product_image( $id, $class = '' ) {
			// Calculate product loop image size.
			if ( self::$product_image_size_width === '' ) {
				$width    = get_option( 'woocommerce_thumbnail_image_width' );
				$cropping = get_option( 'woocommerce_thumbnail_cropping' );
				$height   = $width;

				if ( $cropping === 'custom' ) {
					$ratio_w = get_option( 'woocommerce_thumbnail_cropping_custom_width' );
					$ratio_h = get_option( 'woocommerce_thumbnail_cropping_custom_height' );

					$height = ( $width * $ratio_h ) / $ratio_w;
					$height = (int) $height;
				} elseif ( $cropping === 'uncropped' ) {
					self::$product_image_crop = false;
					$height                   = 9999;
				}

				self::$product_image_size_width  = $width;
				self::$product_image_size_height = $height;
			}

			$args = array(
				'id'     => $id,
				'size'   => 'custom',
				'width'  => self::$product_image_size_width,
				'height' => self::$product_image_size_height,
				'crop'   => self::$product_image_crop,
			);

			if ( $class !== '' ) {
				$args['class'] = $class;
			}

			Brook_Image::the_attachment_by_id( $args );
		}

		public function admin_notice_minimum_compare_plugin_version() {
			brook_notice_required_plugin_version( 'WPC Smart Compare for WooCommerce', self::MINIMUM_PLUGIN_VERSION );
		}
	}

	Brook_Woo::instance()->init();
}

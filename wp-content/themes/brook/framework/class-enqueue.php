<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles.
 */
if ( ! class_exists( 'Brook_Enqueue' ) ) {
	class Brook_Enqueue {

		protected static $instance = null;

		public function init() {
			add_filter( 'stylesheet_uri', array( $this, 'use_minify_stylesheet' ), 10, 2 );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

			// Disable all contact form 7 scripts.
			add_filter( 'wpcf7_load_js', '__return_false' );
			add_filter( 'wpcf7_load_css', '__return_false' );

			// Re queue contact form 7 scripts when used.
			add_action( 'wp_enqueue_scripts', array( $this, 'requeue_wpcf7_scripts' ), 99 );

			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woocommerce_styles_scripts' ), 99 );
			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woo_smart_wishlist_scripts' ), 99 );
		}

		function requeue_wpcf7_scripts() {
			global $post;
			if ( is_a( $post, 'WP_Post' ) &&
			     ( has_shortcode( $post->post_content, 'contact-form-7' ) ||
			       has_shortcode( $post->post_content, 'tm_contact_form_7' ) ||
			       has_shortcode( $post->post_content, 'tm_contact_form_7_box' )
			     )
			) {
				if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
					wpcf7_enqueue_scripts();
				}

				if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
					wpcf7_enqueue_styles();
				}
			}
		}

		function use_minify_stylesheet( $stylesheet, $stylesheet_dir ) {
			if ( file_exists( get_template_directory_uri() . '/style.min.css' ) ) {
				$stylesheet = get_template_directory_uri() . '/style.min.css';
			}

			return $stylesheet;
		}

		function dequeue_woocommerce_styles_scripts() {
			if ( function_exists( 'is_woocommerce' ) ) {
				if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
					// Scripts + Styles from Woo Smart Compare
					wp_dequeue_script( 'woosc-frontend' );
					wp_dequeue_script( 'dragarrange' );
					wp_dequeue_script( 'tableHeadFixer' );
				}
			}
		}

		function dequeue_woo_smart_wishlist_scripts() {
			if ( ! class_exists( 'WPCleverWoosw' ) ) {
				return;
			}

			// Dequeue feather font
			wp_dequeue_style( 'woosw-feather' );
		}

		function enqueue_woocommerce_styles_scripts() {
			wp_enqueue_script( 'woosc-frontend' );
			wp_enqueue_script( 'dragarrange' );
			wp_enqueue_script( 'tableHeadFixer' );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Enqueue scripts & styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$post_type = get_post_type();
			$min       = '.min';

			if ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ) || ! Brook::setting( 'use_minify_scripts' ) ) {
				$min = '';
			}

			// Remove prettyPhoto, default light box of woocommerce.
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

			// Remove font awesome from Yith Wishlist plugin.
			wp_dequeue_style( 'yith-wcwl-font-awesome' );

			// Remove hint from Woo Smart Compare plugin.
			wp_dequeue_style( 'hint' );

			// Remove font awesome from Visual Composer plugin.
			wp_deregister_style( 'font-awesome' );
			wp_dequeue_style( 'font-awesome' );

			// RTL custom style
			wp_register_style( 'brook-style-rtl-custom', BROOK_THEME_URI . "/style-rtl-custom{$min}.css", null, null );

			/*
			 * Begin register scripts & styles to be enqueued later.
			 */

			wp_register_style( 'font-awesome', BROOK_THEME_URI . '/assets/fonts/awesome/css/fontawesome-all.min.css', null, '5.13.1' );

			wp_register_style( 'justifiedGallery', BROOK_THEME_URI . '/assets/libs/justifiedGallery/justifiedGallery.min.css', null, '3.6.3' );
			wp_register_script( 'justifiedGallery', BROOK_THEME_URI . '/assets/libs/justifiedGallery/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.6.3', true );

			wp_register_style( 'spinkit', BROOK_THEME_URI . '/assets/libs/spinkit/spinkit.css', null, null );

			wp_register_style( 'lightgallery', BROOK_THEME_URI . '/assets/libs/lightGallery/css/lightgallery.min.css', null, '1.6.12' );
			wp_register_script( 'lightgallery', BROOK_THEME_URI . "/assets/libs/lightGallery/js/lightgallery-all{$min}.js", array(
				'jquery',
				'picturefill',
				'mousewheel',
			), '1.6.12', true );

			wp_register_style( 'lightslider', BROOK_THEME_URI . '/assets/libs/lightslider/css/lightslider.min.css' );
			wp_register_script( 'lightslider', BROOK_THEME_URI . '/assets/libs/lightslider/js/lightslider.min.js', array( 'jquery' ), BROOK_THEME_VERSION, true );

			wp_register_style( 'magnific-popup', BROOK_THEME_URI . '/assets/libs/magnific-popup/magnific-popup.css' );
			wp_register_script( 'magnific-popup', BROOK_THEME_URI . '/assets/libs/magnific-popup/jquery.magnific-popup.js', array( 'jquery' ), BROOK_THEME_VERSION, true );

			wp_register_style( 'growl', BROOK_THEME_URI . '/assets/libs/growl/css/jquery.growl.min.css', null, '1.3.3' );
			wp_register_script( 'growl', BROOK_THEME_URI . "/assets/libs/growl/js/jquery.growl{$min}.js", array( 'jquery' ), '1.3.3', true );

			wp_register_script( 'time-circle', BROOK_THEME_URI . "/assets/libs/time-circle/TimeCircles{$min}.js", array( 'jquery' ), BROOK_THEME_VERSION, true );

			wp_register_style( 'flipclock', BROOK_THEME_URI . '/assets/libs/flipclock/flipclock.css', null, null );
			wp_register_script( 'flipclock', BROOK_THEME_URI . "/assets/libs/flipclock/flipclock{$min}.js", array( 'jquery' ), null, true );

			wp_register_script( 'matchheight', BROOK_THEME_URI . '/assets/libs/matchHeight/jquery.matchHeight-min.js', array( 'jquery' ), BROOK_THEME_VERSION, true );
			wp_register_script( 'gmap3', BROOK_THEME_URI . '/assets/libs/gmap3/gmap3.min.js', array( 'jquery' ), BROOK_THEME_VERSION, true );
			wp_register_script( 'countdown', BROOK_THEME_URI . '/assets/libs/jquery.countdown/js/jquery.countdown.min.js', array( 'jquery' ), BROOK_THEME_VERSION, true );
			wp_register_script( 'typed', BROOK_THEME_URI . '/assets/libs/typed/typed.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'tilt', BROOK_THEME_URI . "/assets/libs/tilt/tilt.jquery{$min}.js", array( 'jquery' ), null, true );

			wp_register_script( 'scrollie', BROOK_THEME_URI . "/assets/libs/jquery-scrollie/jquery.scrollie{$min}.js", array( 'jquery' ), null, true );
			wp_register_script( 'brook-scrolling-background', BROOK_THEME_URI . "/assets/js/scrolling-background.js", array(
				'jquery',
				'scrollie',
			), null, true );

			// Fix Wordpress old version not registered this script.
			if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
				wp_register_script( 'imagesloaded', BROOK_THEME_URI . '/assets/libs/imagesloaded/imagesloaded.min.js', array( 'jquery' ), null, true );
			}

			// Fix VC waypoints.
			if ( ! wp_script_is( 'vc_waypoints', 'registered' ) ) {
				wp_register_script( 'vc_waypoints', BROOK_THEME_URI . '/assets/libs/vc-waypoints/vc-waypoints.min.js', array( 'jquery' ), null, true );
			}

			wp_register_style( 'swiper', BROOK_THEME_URI . '/assets/libs/swiper/css/swiper.min.css', null, '4.4.1' );
			wp_register_script( 'swiper', BROOK_THEME_URI . "/assets/libs/swiper/js/swiper{$min}.js", array(
				'jquery',
				'imagesloaded',
			), '4.4.1', true );

			wp_register_script( 'isotope-masonry', BROOK_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.min.js', array( 'jquery' ), BROOK_THEME_VERSION, true );
			wp_register_script( 'isotope-packery', BROOK_THEME_URI . '/assets/libs/packery-mode/packery-mode.pkgd.min.js', array(
				'jquery',
				'imagesloaded',
				'isotope-masonry',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'sticky-kit', BROOK_THEME_URI . '/assets/js/jquery.sticky-kit.min.js', array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'smooth-scroll', BROOK_THEME_URI . '/assets/libs/smooth-scroll-for-web/SmoothScroll.min.js', array(
				'jquery',
			), '1.4.9', true );

			wp_register_script( 'picturefill', BROOK_THEME_URI . '/assets/libs/picturefill/picturefill.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'mousewheel', BROOK_THEME_URI . "/assets/libs/mousewheel/jquery.mousewheel{$min}.js", array( 'jquery' ), BROOK_THEME_VERSION, true );

			wp_register_script( 'gsap', BROOK_THEME_URI . '/assets/libs/gsap/gsap.min.js', array(
				'jquery',
			), '3.2.4', true );

			wp_register_script( 'hoverIntent', BROOK_THEME_URI . "/assets/libs/hoverIntent/jquery.hoverIntent{$min}.js", array(
				'jquery',
			), null, true );

			wp_register_script( 'easing', BROOK_THEME_URI . '/assets/libs/easing/jquery.easing.min.js', array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'firefly', BROOK_THEME_URI . "/assets/js/firefly{$min}.js", array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'wavify', BROOK_THEME_URI . "/assets/js/wavify{$min}.js", array(
				'jquery',
				'gsap',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'constellation', BROOK_THEME_URI . "/assets/js/constellation{$min}.js", array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'odometer', BROOK_THEME_URI . '/assets/libs/odometer/odometer.min.js', array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'counter-up', BROOK_THEME_URI . '/assets/libs/countTo/jquery.countTo.js', array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'counter', BROOK_THEME_URI . "/assets/js/counter{$min}.js", array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'chart-js', BROOK_THEME_URI . '/assets/libs/chart/Chart.min.js', array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'advanced-chart', BROOK_THEME_URI . "/assets/js/advanced-chart{$min}.js", array(
				'jquery',
				'vc_waypoints',
				'chart-js',
			), BROOK_THEME_VERSION, true );

			wp_register_script( 'circle-progress', BROOK_THEME_URI . '/assets/libs/circle-progress/circle-progress.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'circle-progress-chart', BROOK_THEME_URI . "/assets/js/circle-progress-chart{$min}.js", array(
				'jquery',
				'vc_waypoints',
				'circle-progress',
			), null, true );

			wp_register_script( 'brook-pricing', BROOK_THEME_URI . "/assets/js/pricing{$min}.js", array(
				'jquery',
				'matchheight',
			), null, true );

			wp_register_script( 'brook-accordion', BROOK_THEME_URI . "/assets/js/accordion{$min}.js", array( 'jquery' ), BROOK_THEME_VERSION, true );

			wp_register_script( 'brook-countdown', BROOK_THEME_URI . "/assets/js/countdown{$min}.js", array( 'jquery' ), BROOK_THEME_VERSION, true );

			/*
			 * End register scripts
			 */

			/*
			 * Enqueue the theme's style.css.
			 * This is recommended because we can add inline styles there
			 * and some plugins use it to do exactly that.
			 */
			if ( is_rtl() ) {
				wp_enqueue_style( 'brook-style', get_template_directory_uri() . "/style-rtl{$min}.css" );
				wp_enqueue_style( 'brook-style-rtl-custom' );
			} else {
				wp_enqueue_style( 'brook-style', get_template_directory_uri() . "/style{$min}.css" );
			}

			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_style( 'swiper' );
			wp_enqueue_style( 'spinkit' );

			if ( Brook::setting( 'header_sticky_enable' ) ) {
				wp_enqueue_script( 'headroom', BROOK_THEME_URI . "/assets/js/headroom{$min}.js", array( 'jquery' ), BROOK_THEME_VERSION, true );
			}

			if ( Brook::setting( 'smooth_scroll_enable' ) ) {
				wp_enqueue_script( 'smooth-scroll' );
			}

			wp_enqueue_style( 'lightgallery' );
			wp_enqueue_script( 'lightgallery' );

			wp_enqueue_script( 'jquery-smooth-scroll', BROOK_THEME_URI . '/assets/libs/smooth-scroll/jquery.smooth-scroll.min.js', array( 'jquery' ), BROOK_THEME_VERSION, true );
			wp_enqueue_script( 'swiper' );
			wp_enqueue_script( 'hoverIntent' );
			wp_enqueue_script( 'vc_waypoints' );
			wp_enqueue_script( 'smartmenus', BROOK_THEME_URI . "/assets/libs/smartmenus/jquery.smartmenus{$min}.js", array( 'jquery' ), BROOK_THEME_VERSION, true );

			wp_enqueue_style( 'perfect-scrollbar', BROOK_THEME_URI . '/assets/libs/perfect-scrollbar/css/perfect-scrollbar.min.css' );
			wp_enqueue_style( 'perfect-scrollbar-woosw', BROOK_THEME_URI . '/assets/libs/perfect-scrollbar/css/custom-theme.css' );
			wp_enqueue_script( 'perfect-scrollbar', BROOK_THEME_URI . '/assets/libs/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), BROOK_THEME_VERSION, true );

			if ( Brook::setting( 'notice_cookie_enable' ) && ! isset( $_COOKIE['notice_cookie_confirm'] ) ) {
				wp_enqueue_script( 'growl' );
				wp_enqueue_style( 'growl' );
			}

			$is_product = false;

			//  Enqueue styles & scripts for single portfolio pages.
			if ( is_singular() ) {

				switch ( $post_type ) {
					case 'portfolio':
						$single_portfolio_sticky = Brook::setting( 'single_portfolio_sticky_detail_enable' );
						if ( $single_portfolio_sticky == '1' ) {
							wp_enqueue_script( 'sticky-kit' );
						}

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );
						break;

					case 'product':
						$is_product = true;

						$single_product_sticky = Brook::setting( 'single_product_sticky_enable' );
						if ( $single_product_sticky == '1' ) {
							wp_enqueue_script( 'sticky-kit' );
						}

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );

						$single_product_feature_style = Brook::setting( 'single_product_feature_style' );

						if ( $single_product_feature_style === 'slider' ) {
							wp_enqueue_style( 'lightslider' );
							wp_enqueue_script( 'lightslider' );
						}

						break;
				}
			}

			/*
			 * The comment-reply script.
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				if ( $post_type === 'post' ) {
					if ( Brook::setting( 'single_post_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} elseif ( $post_type === 'portfolio' ) {
					if ( Brook::setting( 'single_portfolio_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} else {
					wp_enqueue_script( 'comment-reply' );
				}
			}

			$maintenance_templates = Brook_Maintenance::get_maintenance_templates_dir();

			if ( is_page_template( $maintenance_templates ) ) {
				wp_enqueue_script( 'time-circle' );
				wp_enqueue_script( 'wavify' );
				wp_enqueue_script( 'brook-maintenance', BROOK_THEME_URI . "/assets/js/maintenance{$min}.js", array( 'jquery' ), BROOK_THEME_VERSION, true );
			}

			if ( is_page_template( 'templates/one-page-scroll.php' ) ) {
				$one_page_scroll = Brook::setting( 'one_page_scroll_enable' );

				if ( $one_page_scroll !== '1' || ! Brook::is_mobile() ) {
					wp_enqueue_script( 'full-page', BROOK_THEME_URI . '/assets/js/jquery.fullPage.js', array( 'jquery' ), null, true );
				}
			}

			wp_enqueue_script( 'wpb_composer_front_js' );

			/*
			 * Enqueue main JS
			 */
			wp_enqueue_script( 'brook-script', BROOK_THEME_URI . "/assets/js/main{$min}.js", array(
				'jquery',
			), BROOK_THEME_VERSION, true );

			if ( Brook_Helper::active_woocommerce() ) {
				wp_enqueue_script( 'brook-woo', BROOK_THEME_URI . "/assets/js/woo{$min}.js", array(
					'brook-script',
				), BROOK_THEME_VERSION, true );
			}

			/*
			 * Enqueue custom variable JS
			 */

			$js_variables = array(
				'isRTL'                     => is_rtl(),
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'header_sticky_enable'      => Brook::setting( 'header_sticky_enable' ),
				'header_sticky_height'      => Brook::setting( 'header_sticky_height' ),
				'scroll_top_enable'         => Brook::setting( 'scroll_top_enable' ),
				'light_gallery_auto_play'   => Brook::setting( 'light_gallery_auto_play' ),
				'light_gallery_download'    => Brook::setting( 'light_gallery_download' ),
				'light_gallery_full_screen' => Brook::setting( 'light_gallery_full_screen' ),
				'light_gallery_zoom'        => Brook::setting( 'light_gallery_zoom' ),
				'light_gallery_thumbnail'   => Brook::setting( 'light_gallery_thumbnail' ),
				'light_gallery_share'       => Brook::setting( 'light_gallery_share' ),
				'mobile_menu_breakpoint'    => Brook::setting( 'mobile_menu_breakpoint' ),
				'isProduct'                 => $is_product,
				'productFeatureStyle'       => Brook::setting( 'single_product_feature_style' ),
				'noticeCookieEnable'        => Brook::setting( 'notice_cookie_enable' ),
				'noticeCookieConfirm'       => isset( $_COOKIE['notice_cookie_confirm'] ) ? 'yes' : 'no',
				'noticeCookieMessages'      => wp_kses( __( 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it. <a id="tm-button-cookie-notice-ok" class="tm-button tm-button-xs tm-button-full-wide tm-button-primary style-flat">OK, GOT IT</a>', 'brook' ), array(
					'a' => array(
						'id'    => array(),
						'class' => array(),
					),
				) ),
				'noticeCookieOKMessages'    => esc_html__( 'Thank you! Hope you have the best experience on our website.', 'brook' ),
			);
			wp_localize_script( 'brook-script', '$insight', $js_variables );

			if ( is_page_template( 'templates/portfolio-fullscreen-type-hover-03.php' ) ) {
				wp_enqueue_script( 'portfolio-hover-type-03', BROOK_THEME_URI . '/assets/js/template-portfolio-hover-type-03.js', array( 'jquery' ), null, true );
			}

			/**
			 * Custom JS
			 */
			if ( Brook::setting( 'custom_js_enable' ) == 1 ) {
				wp_add_inline_script( 'brook-script', html_entity_decode( Brook::setting( 'custom_js' ) ) );
			}

			/**
			 * Custom CSS
			 */
			if ( Brook::setting( 'custom_css_enable' ) ) {
				wp_add_inline_style( 'brook-style', html_entity_decode( Brook::setting( 'custom_css' ), ENT_QUOTES ) );
			}
		}
	}

	Brook_Enqueue::instance()->init();
}

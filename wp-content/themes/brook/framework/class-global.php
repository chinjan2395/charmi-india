<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initialize Global Variables
 */
if ( ! class_exists( 'Brook_Global' ) ) {
	class Brook_Global {

		protected static $instance         = null;
		protected static $slider           = '';
		protected static $slider_position  = 'below';
		protected static $top_bar_type     = '01';
		protected static $header_type      = '01';
		protected static $title_bar_type   = '01';
		protected static $sidebar_1        = '';
		protected static $sidebar_2        = '';
		protected static $sidebar_position = '';
		protected static $sidebar_special  = 'none';
		protected static $sidebar_status   = 'none';
		protected static $footer_type      = '';
		protected static $popup_search     = false;

		function init() {
			/**
			 * Use hook wp instead of init because we need post meta setup.
			 * then we must wait for post loaded.
			 */
			add_action( 'wp', array( $this, 'init_global_variable' ) );

			/**
			 * Setup global variables.
			 * Used priority 12 to wait override settings setup.
			 *
			 * @see Brook_Customize->setup_override_settings()
			 */
			add_action( 'wp', array( $this, 'setup_global_variables' ), 12 );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init_global_variable() {
			global $brook_page_options;
			if ( is_singular( 'portfolio' ) ) {
				$brook_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_portfolio_options', true ) );
			} elseif ( is_singular( 'post' ) ) {
				$brook_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
			} elseif ( is_singular( 'page' ) ) {
				$brook_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_page_options', true ) );
			} elseif ( is_singular( 'product' ) ) {
				$brook_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_product_options', true ) );
			}
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				// Get page id of shop.
				$page_id            = wc_get_page_id( 'shop' );
				$brook_page_options = unserialize( get_post_meta( $page_id, 'insight_page_options', true ) );
			}
		}

		function setup_global_variables() {
			$this->set_slider();
			$this->set_top_bar_type();
			$this->set_header_type();
			$this->set_title_bar_type();
			$this->set_sidebars();
			$this->set_footer_type();
			$this->set_popup_search();
		}

		function set_slider() {
			$alias    = Brook_Helper::get_post_meta( 'revolution_slider', '' );
			$position = Brook_Helper::get_post_meta( 'slider_position', '' );

			if ( $alias === '' ) {
				if ( is_search() && ! is_post_type_archive( 'product' ) ) {
					$alias    = Brook::setting( 'search_page_rev_slider' );
					$position = Brook::setting( 'search_page_slider_position' );
				} elseif ( Brook_Woo::is_product_archive() ) {
					$alias    = Brook::setting( 'product_archive_page_rev_slider' );
					$position = Brook::setting( 'product_archive_page_slider_position' );
				} elseif ( is_post_type_archive( 'portfolio' ) || Brook_Portfolio::is_taxonomy() ) {
					$alias    = Brook::setting( 'portfolio_archive_page_rev_slider' );
					$position = Brook::setting( 'portfolio_archive_page_slider_position' );
				} elseif ( is_archive() ) {
					$alias    = Brook::setting( 'blog_archive_page_rev_slider' );
					$position = Brook::setting( 'blog_archive_page_slider_position' );
				} elseif ( is_home() ) {
					$alias    = Brook::setting( 'home_page_rev_slider' );
					$position = Brook::setting( 'home_page_slider_position' );
				}
			}

			self::$slider          = $alias;
			self::$slider_position = $position;
		}

		function get_slider_alias() {
			return self::$slider;
		}

		function get_slider_position() {
			return self::$slider_position;
		}

		function set_top_bar_type() {
			$type = Brook_Helper::get_post_meta( 'top_bar_type', '' );

			if ( $type === '' ) {
				$type = Brook::setting( 'global_top_bar' );
			}

			self::$top_bar_type = $type;
		}

		function get_top_bar_type() {
			return self::$top_bar_type;
		}

		function set_header_type() {
			$header_type = Brook_Helper::get_post_meta( 'header_type', '' );

			if ( $header_type === '' ) {
				if ( Brook_Woo::is_woocommerce_page_without_product() ) {

					$header_type = Brook::setting( 'archive_product_header_type' );

				} elseif ( is_post_type_archive( 'portfolio' ) || Brook_Portfolio::is_taxonomy() ) {

					$header_type = Brook::setting( 'archive_portfolio_header_type' );

				} elseif ( is_archive() ) {

					$header_type = Brook::setting( 'archive_blog_header_type' );

				} elseif ( is_singular( 'post' ) ) {

					$header_type = Brook::setting( 'single_post_header_type' );

				} elseif ( is_singular( 'portfolio' ) ) {

					$header_type = Brook::setting( 'single_portfolio_header_type' );

				} elseif ( is_singular( 'product' ) ) {

					$header_type = Brook::setting( 'single_product_header_type' );

				} elseif ( is_singular( 'page' ) ) {

					$header_type = Brook::setting( 'single_page_header_type' );

				} else {
					$header_type = Brook::setting( 'global_header' );
				}
			}

			if ( $header_type === '' ) {
				$header_type = Brook::setting( 'global_header' );
			}

			$header_type = apply_filters( 'brook_header_type', $header_type );

			self::$header_type = $header_type;
		}

		function get_header_type() {
			return self::$header_type;
		}

		function set_title_bar_type() {
			$type = Brook_Helper::get_post_meta( 'page_title_bar_layout', '' );

			if ( $type === '' ) {
				if ( Brook_Woo::is_woocommerce_page_without_product() ) {
					$type = Brook::setting( 'product_archive_page_title_bar_layout' );
				} elseif ( is_post_type_archive( 'portfolio' ) || Brook_Portfolio::is_taxonomy() ) {
					$type = Brook::setting( 'portfolio_archive_page_title_bar_layout' );
				} elseif ( is_archive() ) {
					$type = Brook::setting( 'blog_archive_page_title_bar_layout' );
				} elseif ( is_singular( 'post' ) ) {
					$type = Brook::setting( 'post_page_title_bar_layout' );
				} elseif ( is_singular( 'page' ) ) {
					$type = Brook::setting( 'page_title_bar_layout' );
				} elseif ( is_singular( 'product' ) ) {
					$type = Brook::setting( 'product_page_title_bar_layout' );
				} elseif ( is_singular( 'portfolio' ) ) {
					$type = Brook::setting( 'portfolio_page_title_bar_layout' );
				} elseif ( is_home() ) {
					$type = Brook::setting( 'home_page_title_bar_layout' );
				} else {
					$type = Brook::setting( 'title_bar_layout' );
				}

				if ( $type === '' ) {
					$type = Brook::setting( 'title_bar_layout' );
				}
			}

			$type = apply_filters( 'brook_title_bar_type', $type );

			self::$title_bar_type = $type;
		}

		function get_title_bar_type() {
			return self::$title_bar_type;
		}

		function set_sidebars() {
			if ( is_search() && ! is_post_type_archive( 'product' ) ) {
				$page_sidebar1    = Brook::setting( 'search_page_sidebar_1' );
				$page_sidebar2    = Brook::setting( 'search_page_sidebar_2' );
				$sidebar_position = Brook::setting( 'search_page_sidebar_position' );
				$sidebar_special  = Brook::setting( 'search_page_sidebar_special' );
			} elseif ( Brook_Woo::is_product_archive() ) {
				$page_sidebar1    = Brook::setting( 'product_archive_page_sidebar_1' );
				$page_sidebar2    = Brook::setting( 'product_archive_page_sidebar_2' );
				$sidebar_position = Brook::setting( 'product_archive_page_sidebar_position' );
				$sidebar_special  = Brook::setting( 'product_archive_page_sidebar_special' );
			} elseif ( is_post_type_archive( 'portfolio' ) || Brook_Portfolio::is_taxonomy() ) {
				$page_sidebar1    = Brook::setting( 'portfolio_archive_page_sidebar_1' );
				$page_sidebar2    = Brook::setting( 'portfolio_archive_page_sidebar_2' );
				$sidebar_position = Brook::setting( 'portfolio_archive_page_sidebar_position' );
				$sidebar_special  = Brook::setting( 'portfolio_archive_page_sidebar_special' );
			} elseif ( is_archive() ) {
				$page_sidebar1    = Brook::setting( 'blog_archive_page_sidebar_1' );
				$page_sidebar2    = Brook::setting( 'blog_archive_page_sidebar_2' );
				$sidebar_position = Brook::setting( 'blog_archive_page_sidebar_position' );
				$sidebar_special  = Brook::setting( 'blog_archive_page_sidebar_special' );
			} elseif ( is_home() ) {
				$page_sidebar1    = Brook::setting( 'home_page_sidebar_1' );
				$page_sidebar2    = Brook::setting( 'home_page_sidebar_2' );
				$sidebar_position = Brook::setting( 'home_page_sidebar_position' );
				$sidebar_special  = Brook::setting( 'home_page_sidebar_special' );
			} elseif ( is_singular( 'post' ) ) {
				$page_sidebar1    = Brook_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Brook_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Brook_Helper::get_post_meta( 'page_sidebar_position', 'default' );
				$sidebar_special  = Brook_Helper::get_post_meta( 'page_sidebar_special', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Brook::setting( 'post_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Brook::setting( 'post_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Brook::setting( 'post_page_sidebar_position' );
				}

				if ( $sidebar_special === 'default' ) {
					$sidebar_special = Brook::setting( 'post_page_sidebar_special' );
				}

			} elseif ( is_singular( 'portfolio' ) ) {
				$page_sidebar1    = Brook_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Brook_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Brook_Helper::get_post_meta( 'page_sidebar_position', 'default' );
				$sidebar_special  = Brook_Helper::get_post_meta( 'page_sidebar_special', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Brook::setting( 'portfolio_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Brook::setting( 'portfolio_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Brook::setting( 'portfolio_page_sidebar_position' );
				}

				if ( $sidebar_special === 'default' ) {
					$sidebar_special = Brook::setting( 'portfolio_page_sidebar_special' );
				}

			} elseif ( is_singular( 'product' ) ) {
				$page_sidebar1    = Brook_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Brook_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Brook_Helper::get_post_meta( 'page_sidebar_position', 'default' );
				$sidebar_special  = Brook_Helper::get_post_meta( 'page_sidebar_special', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Brook::setting( 'product_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Brook::setting( 'product_page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Brook::setting( 'product_page_sidebar_position' );
				}

				if ( $sidebar_special === 'default' ) {
					$sidebar_special = Brook::setting( 'product_page_sidebar_special' );
				}

			} else {
				$page_sidebar1    = Brook_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2    = Brook_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				$sidebar_position = Brook_Helper::get_post_meta( 'page_sidebar_position', 'default' );
				$sidebar_special  = Brook_Helper::get_post_meta( 'page_sidebar_special', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Brook::setting( 'page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Brook::setting( 'page_sidebar_2' );
				}

				if ( $sidebar_position === 'default' ) {
					$sidebar_position = Brook::setting( 'page_sidebar_position' );
				}

				if ( $sidebar_special === 'default' ) {
					$sidebar_special = Brook::setting( 'page_sidebar_special' );
				}

			}

			if ( ! is_active_sidebar( $page_sidebar1 ) ) {
				$page_sidebar1 = 'none';
			}

			if ( ! is_active_sidebar( $page_sidebar2 ) ) {
				$page_sidebar2 = 'none';
			}

			self::$sidebar_special  = $sidebar_special;
			self::$sidebar_1        = $page_sidebar1;
			self::$sidebar_2        = $page_sidebar2;
			self::$sidebar_position = $sidebar_position;

			if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
				self::$sidebar_status = 'one';
			}

			if ( $page_sidebar1 !== 'none' && $page_sidebar2 !== 'none' ) {
				self::$sidebar_status = 'both';
			}
		}

		function get_sidebar_1() {
			return self::$sidebar_1;
		}

		function get_sidebar_2() {
			return self::$sidebar_2;
		}

		function get_sidebar_special() {
			return self::$sidebar_special;
		}

		function get_sidebar_position() {
			return self::$sidebar_position;
		}

		function get_sidebar_status() {
			return self::$sidebar_status;
		}

		function set_footer_type() {
			$footer = Brook_Helper::get_post_meta( 'footer_page', 'default' );

			if ( $footer === 'default' ) {
				$footer = Brook::setting( 'footer_page' );
			}

			self::$footer_type = $footer;
		}

		function get_footer_type() {
			return self::$footer_type;
		}

		function set_popup_search() {
			$header_type = $this->get_header_type();
			$search      = Brook::setting( "header_style_{$header_type}_search_enable" );

			if ( $search === '1' ) {
				self::$popup_search = true;
			}
		}

		function get_popup_search() {
			return self::$popup_search;
		}
	}

	Brook_Global::instance()->init();
}

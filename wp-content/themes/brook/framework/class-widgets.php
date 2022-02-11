<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Brook_Widgets' ) ) {
	class Brook_Widgets {

		public function __construct() {
			$this->require_widgets();

			// Register widget areas.
			add_action( 'widgets_init', array(
				$this,
				'register_sidebars',
			) );

			add_action( 'widgets_init', array(
				$this,
				'register_widgets',
			) );


			add_filter( 'widget_title', array( $this, 'repair_categories_empty_title' ), 10, 3 );
		}

		public function repair_categories_empty_title( $title, $instance, $base ) {
			if ( $base == 'categories' ) {
				if ( trim( $instance['title'] ) == '' ) {
					return '';
				}
			}

			return $title;
		}

		/**
		 * Register widget area.
		 *
		 * @access public
		 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function register_sidebars() {

			$classes = Brook_Helper::get_animation_classes();

			$defaults = array(
				'before_widget' => '<div id="%1$s" class="' . esc_attr( 'widget %2$s ' . "{$classes}" ) . '">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			);

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'blog_sidebar',
				'name'        => esc_html__( 'Blog Sidebar', 'brook' ),
				'description' => esc_html__( 'Add widgets here.', 'brook' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'special_sidebar',
				'name'        => esc_html__( 'Special Sidebar', 'brook' ),
				'description' => esc_html__( 'Special sidebar will be display right after first sidebar.', 'brook' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'page_sidebar',
				'name'        => esc_html__( 'Page Sidebar', 'brook' ),
				'description' => esc_html__( 'Add widgets here.', 'brook' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar',
				'name'        => esc_html__( 'Shop Sidebar', 'brook' ),
				'description' => esc_html__( 'Add widgets here.', 'brook' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'header_widgets',
				'name'        => esc_html__( 'Header Widgets', 'brook' ),
				'description' => esc_html__( 'Add widgets here.', 'brook' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'top_bar_widgets',
				'name'        => esc_html__( 'Top bar Widgets', 'brook' ),
				'description' => esc_html__( 'Add widgets here.', 'brook' ),
			) ) );
		}

		public function require_widgets() {
			$files = array(
				BROOK_WIDGETS_DIR . '/facebook-page.php',
				BROOK_WIDGETS_DIR . '/posts.php',
			);

			Brook::require_files( $files );
		}

		public function register_widgets() {
			register_widget( 'TM_Posts_Widget' );
			register_widget( 'TM_Facebook_Page_Widget' );
		}

	}

	new Brook_Widgets();
}

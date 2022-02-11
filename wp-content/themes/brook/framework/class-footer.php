<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Brook_Footer' ) ) {

	class Brook_Footer {

		function __construct() {
			add_action( 'admin_bar_menu', array( $this, 'add_edit_footer_link' ), 90 );

			add_action( 'wp_footer', array( $this, 'scroll_top' ) );
			add_action( 'wp_footer', array( $this, 'popup_search' ) );
			add_action( 'wp_footer', array( $this, 'mobile_menu_template' ) );
		}

		function add_edit_footer_link( $wp_admin_bar ) {
			$footer_page = Brook_Global::instance()->get_footer_type();

			if ( $footer_page === '' ) {
				return;
			}

			$args = array(
				'post_type'      => 'ic_footer',
				'posts_per_page' => 1,
				'post_name__in'  => array( $footer_page ),
				'fields'         => 'ids',
			);

			$footer_ids = get_posts( $args );

			if ( ! empty( $footer_ids ) ) {
				$args = array(
					'id'    => 'edit_footer',
					'title' => esc_html__( 'Edit Footer', 'brook' ),
					'href'  => get_edit_post_link( $footer_ids[0] ),
				);

				$wp_admin_bar->add_node( $args );
			}
		}

		public static function get_list_footers( $default = false ) {
			$args = array(
				'post_type'      => 'ic_footer',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'meta_query'     => array(
					'relation' => 'OR',
				),
				'no_found_rows'  => true,
			);

			$query   = new WP_Query( $args );
			$results = array(
				'' => esc_html__( 'Select a footer', 'brook' ),
			);

			if ( $default === true ) {
				$results['default'] = esc_html__( 'Default', 'brook' );
			}

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					global $post;
					$slug             = $post->post_name;
					$results[ $slug ] = get_the_title();
				}
			}

			wp_reset_postdata();

			return $results;
		}

		/**
		 * Add popup search template to footer
		 */
		public function popup_search() {
			$has_popup_search = Brook_Global::instance()->get_popup_search();
			if ( $has_popup_search !== true ) {
				return;
			}
			?>
			<div id="page-search-popup" class="page-search-popup">
				<div class="inner">
					<div class="page-search-popup-header">
						<div class="page-mobile-popup-logo page-search-popup-logo">
							<?php
							$logo_url = Brook::setting( 'mobile_menu_logo' );
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo esc_url( $logo_url ); ?>"
								     alt="<?php esc_attr_e( 'Logo', 'brook' ); ?>"/>
							</a>
						</div>
						<div id="search-popup-close" class="search-popup-close"></div>
					</div>

					<div class="page-search-popup-content">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Add mobile menu template to footer
		 */
		public function mobile_menu_template() {
			$classes = 'page-mobile-main-menu';
			$effect  = Brook::setting( 'mobile_menu_effect' );

			$classes .= " effect-$effect";
			?>
			<div id="page-mobile-main-menu" class="<?php echo esc_attr( $classes ); ?>">
				<div class="inner">
					<div class="page-mobile-menu-header">
						<div class="page-mobile-popup-logo page-mobile-menu-logo">
							<?php
							$logo_url = Brook::setting( 'mobile_menu_logo' );
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo esc_url( $logo_url ); ?>"
								     alt="<?php esc_attr_e( 'Logo', 'brook' ); ?>"/>
							</a>
						</div>
						<div id="page-close-mobile-menu" class="page-close-mobile-menu"></div>
					</div>

					<div class="page-mobile-menu-content">
						<?php Brook::menu_mobile_primary(); ?>

						<?php if ( '1' === Brook::setting( 'mobile_menu_header_button_enable' ) ) : ?>
							<div class="page-mobile-extra-content">
								<?php Brook_Templates::header_button( array(
									'extra_class'          => 'tm-button-white',
									'except_sticky_button' => true,
								) ); ?>
							</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
			<?php
		}

		/**
		 * Add scroll to top template to footer
		 */
		public function scroll_top() {
			?>
			<?php if ( Brook::setting( 'scroll_top_enable' ) ) : ?>
				<a class="page-scroll-up" id="page-scroll-up"><i class="fal fa-angle-up"></i></a>
			<?php endif; ?>
			<?php
		}
	}

	new Brook_Footer();
}

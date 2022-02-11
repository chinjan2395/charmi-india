<?php
defined( 'ABSPATH' ) || exit;

/**
 * Helper functions
 */
if ( ! class_exists( 'Brook_Helper' ) ) {
	class Brook_Helper {

		static $preloader_style = array();

		function __construct() {
			self::$preloader_style = array(
				'rotating-plane'  => esc_attr__( 'Rotating Plane', 'brook' ),
				'double-bounce'   => esc_attr__( 'Double Bounce', 'brook' ),
				'three-bounce'    => esc_attr__( 'Three Bounce', 'brook' ),
				'wave'            => esc_attr__( 'Wave', 'brook' ),
				'wandering-cubes' => esc_attr__( 'Wandering Cubes', 'brook' ),
				'pulse'           => esc_attr__( 'Pulse', 'brook' ),
				'chasing-dots'    => esc_attr__( 'Chasing dots', 'brook' ),
				'circle'          => esc_attr__( 'Circle', 'brook' ),
				'cube-grid'       => esc_attr__( 'Cube Grid', 'brook' ),
				'fading-circle'   => esc_attr__( 'Fading Circle', 'brook' ),
				'folding-cube'    => esc_attr__( 'Folding Cube', 'brook' ),
				'brook-loader'    => esc_attr__( 'Brook Loader', 'brook' ),
			);
		}

		public static function e( $var = '' ) {
			echo "{$var}";
		}

		public static function get_preloader_list() {
			$list = self::$preloader_style + array( 'random' => esc_attr__( 'Random', 'brook' ) );

			return $list;
		}

		public static function get_post_meta( $name, $default = false ) {
			global $brook_page_options;

			if ( $brook_page_options != false && isset( $brook_page_options[ $name ] ) ) {
				return $brook_page_options[ $name ];
			}

			return $default;
		}

		public static function get_the_post_meta( $options, $name, $default = false ) {
			if ( $options != false && isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}

			return $default;
		}

		/**
		 * @return array
		 */
		public static function get_list_revslider() {
			global $wpdb;
			$revsliders = array(
				'' => esc_attr__( 'Select a slider', 'brook' ),
			);

			if ( function_exists( 'rev_slider_shortcode' ) ) {

				$table_name = $wpdb->prefix . "revslider_sliders";
				$query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE type != %s ORDER BY title ASC", 'template' );
				$results    = $wpdb->get_results( $query );
				if ( ! empty( $results ) ) {
					foreach ( $results as $result ) {
						$revsliders[ $result->alias ] = $result->title;
					}
				}
			}

			return $revsliders;
		}

		/**
		 * @param bool $default_option
		 *
		 * @return array
		 */
		public static function get_registered_sidebars( $default_option = false, $empty_option = true ) {
			global $wp_registered_sidebars;
			$sidebars = array();
			if ( $empty_option == true ) {
				$sidebars['none'] = esc_html__( 'No Sidebar', 'brook' );
			}
			if ( $default_option == true ) {
				$sidebars['default'] = esc_html__( 'Default', 'brook' );
			}
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[ $sidebar['id'] ] = $sidebar['name'];
			}

			return $sidebars;
		}

		/**
		 * Get list sidebar positions
		 *
		 * @return array
		 */
		public static function get_list_sidebar_positions( $default = false ) {
			$positions = array(
				'left'  => esc_html__( 'Left', 'brook' ),
				'right' => esc_html__( 'Right', 'brook' ),
			);


			if ( $default == true ) {
				$positions['default'] = esc_html__( 'Default', 'brook' );
			}

			return $positions;
		}

		/**
		 * Get content of file
		 *
		 * @param string $path
		 *
		 * @return mixed
		 */
		static function get_file_contents( $path = '' ) {
			$content = '';
			if ( $path !== '' ) {
				global $wp_filesystem;

				Brook::require_file( ABSPATH . '/wp-admin/includes/file.php' );
				WP_Filesystem();

				if ( file_exists( $path ) ) {
					$content = $wp_filesystem->get_contents( $path );
				}
			}

			return $content;
		}

		/**
		 * @param $var
		 *
		 * Output anything in debug bar.
		 */
		public static function d( $var ) {
			if ( ! class_exists( 'Debug_Bar' ) || ! function_exists( 'kint_debug_ob' ) ) {
				return;
			}

			ob_start( 'kint_debug_ob' );
			d( $var );
			ob_end_flush();
		}

		/**
		 * @param mixed $log Anything to write to log.
		 *
		 * Make sure WP_DEBUG_LOG = true.
		 */
		public static function write_log( $log ) {
			if ( true === WP_DEBUG ) {
				if ( is_array( $log ) || is_object( $log ) ) {
					error_log( print_r( $log, true ) );
				} else {
					error_log( $log );
				}
			}
		}

		public static function strposa( $haystack, $needle, $offset = 0 ) {
			if ( ! is_array( $needle ) ) {
				$needle = array( $needle );
			}
			foreach ( $needle as $query ) {
				if ( strpos( $haystack, $query, $offset ) !== false ) {
					return true;
				} // stop on first true result
			}

			return false;
		}

		public static function w3c_iframe( $iframe ) {
			$iframe = str_replace( 'frameborder="0"', '', $iframe );
			$iframe = str_replace( 'frameborder="no"', '', $iframe );
			$iframe = str_replace( 'scrolling="no"', '', $iframe );
			$iframe = str_replace( 'gesture="media"', '', $iframe );
			$iframe = str_replace( 'allow="encrypted-media"', '', $iframe );

			return $iframe;
		}

		public static function get_lg_media_query() {
			return '@media (min-width: 1200px)';
		}

		public static function get_md_media_query() {
			return '@media (max-width: 1199px)';
		}

		public static function get_sm_media_query() {
			return '@media (max-width: 991px)';
		}

		public static function get_xs_media_query() {
			return '@media (max-width: 767px)';
		}

		public static function get_animation_list( $args = array() ) {
			return array(
				'none'       => esc_html__( 'None', 'brook' ),
				'fade-in'    => esc_html__( 'Fade In', 'brook' ),
				'move-up'    => esc_html__( 'Move Up', 'brook' ),
				'move-down'  => esc_html__( 'Move Down', 'brook' ),
				'move-left'  => esc_html__( 'Move Left', 'brook' ),
				'move-right' => esc_html__( 'Move Right', 'brook' ),
				'scale-up'   => esc_html__( 'Scale Up', 'brook' ),
				'fly'        => esc_html__( 'Fly', 'brook' ),
				'flip'       => esc_html__( 'Flip', 'brook' ),
				'helix'      => esc_html__( 'Helix', 'brook' ),
				'pop-up'     => esc_html__( 'Pop Up', 'brook' ),
			);
		}

		public static function get_animation_classes( $animation = 'move-up' ) {
			$classes = '';
			if ( $animation === '' ) {
				$animation = 'move-up';
			}

			if ( $animation !== 'none' ) {
				$classes .= " tm-animation $animation";
			}

			return $classes;
		}

		public static function get_grid_animation_classes( $animation = 'move-up' ) {
			$classes = '';
			if ( $animation === '' ) {
				$animation = 'move-up';
			}

			if ( $animation !== 'none' ) {
				$classes .= " has-animation $animation";
			}

			return $classes;
		}

		public static function get_css_prefix( $property, $value ) {
			$css = '';
			switch ( $property ) {
				case 'border-radius' :
					$css = "-moz-border-radius: {$value};-webkit-border-radius: {$value};border-radius: {$value};";
					break;

				case 'box-shadow' :
					$css = "-moz-box-shadow: {$value};-webkit-box-shadow: {$value};box-shadow: {$value};";
					break;

				case 'order' :
					$css = "-webkit-order: $value; -moz-order: $value; order: $value;";
					break;
			}

			return $css;
		}

		public static function get_shortcode_color_inherit( $color = '', $custom = '' ) {
			$primary_color   = Brook::setting( 'primary_color' );
			$secondary_color = Brook::setting( 'secondary_color' );

			$_color = '#111111';

			switch ( $color ) {
				case 'primary' :
					$_color = $primary_color;
					break;

				case 'secondary' :
					$_color = $secondary_color;
					break;

				case 'custom' :
					$_color = $custom;
					break;

				default:
					$_color = '#111111';
					break;
			}

			return $_color;
		}

		public static function get_shortcode_css_color_inherit( $attr = 'color', $color = '', $custom = '', $gradient = '' ) {
			$primary_color   = Brook::setting( 'primary_color' );
			$secondary_color = Brook::setting( 'secondary_color' );

			$gradient = isset( $gradient ) ? $gradient : '';

			$css = '';
			switch ( $color ) {
				case 'primary' :
					$css = "$attr: {$primary_color};";
					break;

				case 'secondary' :
					$css = "$attr: {$secondary_color};";
					break;

				case 'custom' :
					if ( $custom !== '' ) {
						$css = "$attr: {$custom};";
					}
					break;

				case 'transparent' :
					$css = "$attr: transparent;";
					break;

				case 'gradient' :
					$css = $gradient;

					if ( $attr === 'color' ) {
						$css .= 'color:transparent;-webkit-background-clip: text;background-clip: text;';
					}

					break;
			}

			return $css;
		}

		public static function get_vc_icon_template( $args = array() ) {

			$defaults = array(
				'type'         => '',
				'icon'         => '',
				'class'        => '',
				'parent_hover' => '.tm-box-icon',
			);

			$args = wp_parse_args( $args, $defaults );

			$_duration    = Brook::setting( 'shortcode_animation_svg_duration', '' );

			vc_icon_element_fonts_enqueue( $args['type'] );

			switch ( $args['type'] ) {
				case 'linea_svg':
					$icon = str_replace( 'linea-', '', $args['icon'] );
					$icon = str_replace( '-', '_', $icon );
					$_svg = BROOK_THEME_URI . "/assets/svg/linea/{$icon}.svg";
					?>
					<div class="icon">
						<div class="tm-svg"
						     data-svg="<?php echo esc_url( $_svg ); ?>"
							<?php if ( isset( $args['svg_animate'] ) ): ?>
								data-type="<?php echo esc_attr( $args['svg_animate'] ); ?>"
							<?php endif; ?>
							<?php if ( $args['parent_hover'] !== '' ) : ?>
								data-hover="<?php echo esc_attr( $args['parent_hover'] ); ?>"
							<?php endif; ?>
							<?php if ( $_duration !== '' ): ?>
								data-duration="<?php echo esc_attr( $_duration ); ?>"
							<?php endif; ?>
						></div>
					</div>
					<?php
					break;
				default:
					?>
					<div class="icon">
						<span class="<?php echo esc_attr( $args['icon'] ); ?>"></span>
					</div>
					<?php
					break;
			}
		}

		public static function get_top_bar_list( $default_option = false ) {

			$results = array(
				'none' => esc_html__( 'Hide', 'brook' ),
				'01'   => esc_html__( 'Top Bar 01', 'brook' ),
			);

			if ( $default_option === true ) {
				$results = array( '' => esc_html__( 'Default', 'brook' ) ) + $results;
			}

			return $results;
		}

		public static function get_header_list( $default_option = false, $default_text = '' ) {

			$headers = array(
				'none' => esc_html__( 'Hide', 'brook' ),
				'01'   => esc_html__( '01 - Standard', 'brook' ),
				'02'   => esc_html__( '02 - Standard - Overlay - Light', 'brook' ),
				'03'   => esc_attr__( '03 - Right Nav - Overlay - Light', 'brook' ),
				'04'   => esc_attr__( '04 - Left Vertical Header - Canvas Nav', 'brook' ),
				'05'   => esc_attr__( '05 - Standard - Overlay - Dark', 'brook' ),
				'06'   => esc_attr__( '06 - Right Nav - Standard - Dark', 'brook' ),
				'07'   => esc_attr__( '07 - Minimal - Fluid - Overlay - Dark', 'brook' ),
				'08'   => esc_attr__( '08 - Minimal - Fluid - Overlay - Light', 'brook' ),
				'09'   => esc_attr__( '09 - Right Nav - Fluid - Overlay - Light', 'brook' ),
				'10'   => esc_attr__( '10 - Left Vertical Header', 'brook' ),
				'11'   => esc_attr__( '11 - Right Nav - Fluid - Overlay - Dark', 'brook' ),
				'12'   => esc_attr__( '12 - Minimal - Fluid - Dark', 'brook' ),
				'13'   => esc_attr__( '13 - Simple - Fluid - Dark', 'brook' ),
				'14'   => esc_attr__( '14 - Left Nav - Fluid - Light', 'brook' ),
				'15'   => esc_attr__( '15 - Minimal - Fluid - Overlay - Light - Alt', 'brook' ),
				'16'   => esc_html__( '16 - Standard - Fluid - Overlay - Light', 'brook' ),
				'17'   => esc_html__( '17 - Minimal - Fluid - With Center Socials', 'brook' ),
				'18'   => esc_html__( '18 - Left Nav - Center Logo', 'brook' ),
				'19'   => esc_html__( '19 - Standard - Fluid - Overlay - Dark', 'brook' ),
				'20'   => esc_attr__( '20 - Left Vertical Header 02', 'brook' ),
				'21'   => esc_html__( '21 - Standard - Border - Fluid - Overlay - Dark', 'brook' ),
				'22'   => esc_attr__( '22 - Minimal - Fluid - Overlay - Light - 02', 'brook' ),
			);

			if ( $default_option === true ) {
				if ( $default_text === '' ) {
					$default_text = esc_html__( 'Default', 'brook' );
				}

				$headers = array( '' => $default_text ) + $headers;
			}

			return $headers;
		}

		public static function get_title_bar_list( $default_option = false ) {

			$options = array(
				'none' => esc_html__( 'Hide', 'brook' ),
				'01'   => esc_html__( 'Style 01', 'brook' ),
				'02'   => esc_html__( 'Style 02', 'brook' ),
				'03'   => esc_html__( 'Style 03', 'brook' ),
				'04'   => esc_html__( 'Style 04', 'brook' ),
				'05'   => esc_html__( 'Style 05', 'brook' ),
			);

			if ( $default_option === true ) {
				$options = array( '' => esc_html__( 'Default', 'brook' ) ) + $options;
			}

			return $options;
		}

		public static function get_sample_countdown_date() {
			$date = date( 'm/d/Y H:i:s', strtotime( '+1 month', strtotime( date( 'm/d/Y H:i:s' ) ) ) );

			return $date;
		}

		/**
		 * process aspect ratio fields
		 */
		public static function process_chart_aspect_ratio( $ar = '4:3', $width = 500 ) {
			$AR = explode( ':', $ar );

			$rat1 = $AR[0];
			$rat2 = $AR[1];

			$height = ( $width / $rat1 ) * $rat2;

			return $height;
		}

		public static function get_body_font() {
			$font = Brook::setting( 'typography_body' );

			if ( isset( $font['font-family'] ) ) {
				return "{$font['font-family']} Helvetica, Arial, sans-serif";
			}

			return 'Helvetica, Arial, sans-serif';
		}

		/**
		 * Check woocommerce plugin active
		 *
		 * @return boolean true if plugin activated
		 */
		public static function active_woocommerce() {
			if ( class_exists( 'WooCommerce' ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Check search page has results
		 *
		 * @return boolean true if has any results
		 */
		public static function is_search_has_results() {
			if ( is_search() ) {
				global $wp_query;
				$result = ( 0 != $wp_query->found_posts ) ? true : false;

				return $result;
			}

			return 0 != $GLOBALS['wp_query']->found_posts;
		}

		public static function get_button_css_selector() {
			return '
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.tm-button,
				.rev-btn, .rev-btn:visited,
				.woocommerce #respond input#submit.disabled,
				.woocommerce #respond input#submit:disabled,
				.woocommerce #respond input#submit:disabled[disabled],
				.woocommerce a.button.disabled,
				.woocommerce a.button:disabled,
				.woocommerce a.button:disabled[disabled],
				.woocommerce button.button.disabled,
				.woocommerce button.button:disabled,
				.woocommerce button.button:disabled[disabled],
				.woocommerce button.button.alt.disabled,
				.woocommerce input.button.disabled,
				.woocommerce input.button:disabled,
				.woocommerce input.button:disabled[disabled],
				.woocommerce #respond input#submit,
				.woocommerce a.button,
				.woocommerce button.button,
				.woocommerce input.button,
				.woocommerce a.button.alt,
				.woocommerce input.button.alt,
				.woocommerce button.button.alt,
				.button,
				.single-product .woo-single-summary .wishlist-btn a,
				.single-product .woo-single-summary .compare-btn a
				';
		}

		public static function get_button_hover_css_selector() {
			return 'button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.woocommerce #respond input#submit.disabled:hover,
				.woocommerce #respond input#submit:disabled:hover,
				.woocommerce #respond input#submit:disabled[disabled]:hover,
				.woocommerce a.button.disabled:hover,
				.woocommerce a.button:disabled:hover,
				.woocommerce a.button:disabled[disabled]:hover,
				.woocommerce button.button.alt.disabled:hover,
				.woocommerce button.button.disabled:hover,
				.woocommerce button.button:disabled:hover,
				.woocommerce button.button:disabled[disabled]:hover,
				.woocommerce input.button.disabled:hover,
				.woocommerce input.button:disabled:hover,
				.woocommerce input.button:disabled[disabled]:hover,
				.woocommerce #respond input#submit:hover,
				.woocommerce a.button:hover,
				.woocommerce button.button:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce input.button:hover,
				.woocommerce a.button.alt:hover,
				.woocommerce input.button.alt:hover,
				.button:hover,
				.single-product .woo-single-summary .wishlist-btn a:hover,
				.single-product .woo-single-summary .compare-btn a:hover
				';
		}

		public static function get_form_input_css_selector() {
			return "
			input[type='text'],
			input[type='email'],
			input[type='url'],
			input[type='password'],
			input[type='search'],
			input[type='number'],
			input[type='tel'],
			input[type='range'],
			input[type='date'],
			input[type='month'],
			input[type='week'],
			input[type='time'],
			input[type='datetime'],
			input[type='datetime-local'],
			input[type='color'],
			select,
			textarea
		";
		}

		public static function get_form_input_focus_css_selector() {
			return "
			input[type='text']:focus,
			input[type='email']:focus,
			input[type='url']:focus,
			input[type='password']:focus,
			input[type='search']:focus,
			input[type='number']:focus,
			input[type='tel']:focus,
			input[type='range']:focus,
			input[type='date']:focus,
			input[type='month']:focus,
			input[type='week']:focus,
			input[type='time']:focus,
			input[type='datetime']:focus,
			input[type='datetime-local']:focus,
			input[type='color']:focus,
			textarea:focus, select:focus,
			select:focus,
			textarea:focus
		";
		}
	}

	new Brook_Helper();
}

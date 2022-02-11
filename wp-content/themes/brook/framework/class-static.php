<?php
defined( 'ABSPATH' ) || exit;

class Brook {

	const PRIMARY_FONT    = 'Poppins';
	const SECONDARY_FONT  = 'Poppins';
	const PRIMARY_COLOR   = '#0038E3';
	const SECONDARY_COLOR = '#899664';
	const HEADING_COLOR   = '#222222';

	/**
	 * is_tablet
	 *
	 * @return bool
	 */
	public static function is_tablet() {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return false;
		}

		return Mobile_Detect::instance()->isTablet();
	}

	/**
	 * is_mobile
	 *
	 * @return bool
	 */
	public static function is_mobile() {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return false;
		}

		if ( self::is_tablet() ) {
			return false;
		}

		return Mobile_Detect::instance()->isMobile();
	}

	/**
	 * is_handheld
	 *
	 * @return bool
	 */
	public static function is_handheld() {
		return ( self::is_mobile() || self::is_tablet() );
	}

	/**
	 * is_desktop
	 *
	 * @since 0.9.8
	 * @return bool
	 */
	public static function is_desktop() {
		return ! self::is_handheld();
	}

	/**
	 * Get settings for Kirki
	 *
	 * @param string $name
	 *
	 * @return mixed
	 */
	public static function setting( $option_name = '', $default = '' ) {
		$value = Brook_Kirki::get_option( 'theme', $option_name );

		$value = $value === null ? '' : $value;

		return $value;
	}

	/**
	 * Requirement one file.
	 *
	 * @param string $file path of file
	 */
	public static function require_file( $file = '' ) {
		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			wp_die( esc_html__( 'Could not load theme file: ', 'brook' ) . $file );
		}
	}

	/**
	 * Requirement multi files.
	 *
	 * @param array $files array path of files
	 */
	public static function require_files( $files = array() ) {
		if ( empty( $files ) ) {
			return;
		}

		foreach ( $files as $file ) {
			if ( file_exists( $file ) ) {
				require_once $file;
			} else {
				wp_die( esc_html__( 'Could not load theme file: ', 'brook' ) . $file );
			}
		}
	}

	/**
	 * Primary Menu
	 */
	public static function menu_primary( $args = array() ) {
		$defaults = array(
			'theme_location' => 'primary',
			'container'      => 'ul',
			'menu_class'     => 'menu__container sm sm-simple',
		);
		$args     = wp_parse_args( $args, $defaults );

		if ( has_nav_menu( 'primary' ) && class_exists( 'Brook_Walker_Nav_Menu' ) ) {
			$args['walker'] = new Brook_Walker_Nav_Menu;
		}

		$menu = Brook_Helper::get_post_meta( 'menu_display', '' );

		if ( $menu !== '' ) {
			$args['menu'] = $menu;
		}

		wp_nav_menu( $args );
	}

	/**
	 * Off Canvas Menu
	 */
	public static function off_canvas_menu_primary() {
		self::menu_primary( array(
			'menu_id' => 'off-canvas-menu-primary',
		) );
	}

	/**
	 * Mobile Menu
	 */
	public static function menu_mobile_primary() {
		self::menu_primary( array(
			'menu_class' => 'menu__container',
			'menu_id'    => 'mobile-menu-primary',
		) );
	}

	/**
	 * Logo
	 */
	public static function branding_logo() {
		$logo_url       = Brook_Helper::get_post_meta( 'custom_logo', '' );
		$logo_light_url = Brook::setting( 'logo_light' );
		$logo_dark_url  = Brook::setting( 'logo_dark' );

		$href = home_url( '/' );
		$href = apply_filters( 'brook_branding_url', $href );
		?>
		<a href="<?php echo esc_url( $href ); ?>" rel="home">
			<?php if ( $logo_url !== '' ) { ?>
				<img src="<?php echo esc_url( $logo_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="main-logo">
			<?php } else { ?>
				<img src="<?php echo esc_url( $logo_light_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="light-logo">
				<img src="<?php echo esc_url( $logo_dark_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="dark-logo">
			<?php } ?>
		</a>
		<?php
	}

	/**
	 * Adds custom attributes to the body tag.
	 */
	public static function body_attributes() {
		$attrs = apply_filters( 'brook_body_attributes', array() );

		$attrs_string = '';
		if ( ! empty( $attrs ) ) {
			foreach ( $attrs as $attr => $value ) {
				$attrs_string .= " {$attr}=" . '"' . esc_attr( $value ) . '"';
			}
		}

		echo '' . $attrs_string;
	}

	/**
	 * Adds custom classes to the header.
	 *
	 * @param string $class extra class
	 */
	public static function top_bar_class( $class = '' ) {
		$classes = array( 'page-top-bar' );

		$type = Brook_Global::instance()->get_top_bar_type();

		$classes[] = "top-bar-{$type}";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'brook_top_bar_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the header.
	 */
	public static function header_class( $class = '' ) {
		$classes = array( 'page-header' );

		$header_type = Brook_Global::instance()->get_header_type();

		$classes[] = "header-{$header_type}";

		$_overlay_enable = Brook::setting( "header_style_{$header_type}_overlay" );

		if ( $_overlay_enable === '1' ) {
			$classes[] = 'header-layout-fixed';
		}

		$_logo     = Brook::setting( "header_style_{$header_type}_logo" );
		$classes[] = "{$_logo}-logo-version";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'brook_header_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the header.
	 */
	public static function title_bar_class( $class = '' ) {
		$classes = array( 'page-title-bar' );

		$type = Brook_Global::instance()->get_title_bar_type();

		$classes[] = "page-title-bar-{$type}";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'brook_title_bar_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the branding.
	 */
	public static function branding_class( $class = '' ) {
		$classes = array( 'branding' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'brook_branding_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the navigation.
	 */
	public static function navigation_class( $class = '' ) {
		$classes = array( 'navigation page-navigation' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'brook_navigation_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the footer.
	 */
	public static function footer_class( $class = '' ) {
		$classes = array( 'page-footer' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'brook_footer_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}
}

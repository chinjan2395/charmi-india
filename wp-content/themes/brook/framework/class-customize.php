<?php
defined( 'ABSPATH' ) || exit;

/**
 * Setup for customizer of this theme
 */
if ( ! class_exists( 'Brook_Customize' ) ) {
	class Brook_Customize {

		protected static $override_settings = array();

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			// Build URL for customizer.
			add_filter( 'kirki_values_get_value', array( $this, 'kirki_db_get_theme_mod_value' ), 10, 2 );

			// Load customizer sections when all widgets init.
			add_action( 'init', array( $this, 'load_customizer' ), 99 );

			/**
			 * Override kirki settings with url preset or post meta preset.
			 * Used priority 11 to wait global variables loaded.
			 *
			 * @see Brook_Global->init_global_variable()
			 */
			add_action( 'wp', array( $this, 'setup_override_settings' ), 11 );

			add_filter( 'kirki_theme_stylesheet', array( $this, 'change_inline_stylesheet' ), 10, 3 );

			add_filter( 'kirki_load_fontawesome', '__return_false' );

			// Disable Telemetry module.
			add_filter( 'kirki_telemetry', '__return_false' );

			// Remove unused native sections and controls.
			add_action( 'customize_register', array( $this, 'remove_customizer_sections' ) );

			// Add custom font to font select
			add_filter( 'kirki_fonts_standard_fonts', array( $this, 'add_custom_font' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_custom_font_css' ) );

			add_action( 'customize_controls_init', array(
				$this,
				'customize_preview_css',
			) );
		}

		function setup_override_settings() {
			if ( ! class_exists( 'Kirki' ) ) {
				return;
			}

			// Make preset in meta box.
			if ( ! is_customize_preview() ) {
				$presets = apply_filters( 'brook_page_meta_box_presets', array() );

				if ( ! empty( $presets ) ) {
					foreach ( $presets as $preset ) {
						$page_preset_value = Brook_Helper::get_post_meta( $preset );
						if ( $page_preset_value !== false ) {
							$_GET[ $preset ] = $page_preset_value;
						}
					}
				}
			}

			// Setup url.
			if ( empty( self::$override_settings ) ) {
				if ( ! empty( $_GET ) ) {

					foreach ( $_GET as $key => $query_value ) {
						if ( ! empty( Kirki::$fields[ $key ] ) ) {

							if ( is_array( Kirki::$fields[ $key ] ) &&
							     in_array( Kirki::$fields[ $key ]['type'], array(
								     'kirki-preset',
								     'kirki-select',
							     ), true ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ]['settings'] )
							) {
								$field_choice = Kirki::$fields[ $key ]['args']['choices'];

								foreach ( $field_choice[ $query_value ]['settings'] as $kirki_setting => $kirki_value ) {
									self::$override_settings[ $kirki_setting ] = $kirki_value;
								}
							} else {
								self::$override_settings[ $key ] = $query_value;
							}
						}
					}
				}
			}
		}

		/**
		 * Build URL for customizer
		 *
		 * @param $value
		 * @param $setting
		 *
		 * @return mixed
		 */
		public function kirki_db_get_theme_mod_value( $value, $setting ) {
			if ( ! is_customize_preview() && ! empty( self::$override_settings ) && isset( self::$override_settings["{$setting}"] ) ) {
				return self::$override_settings["{$setting}"];
			}

			return $value;
		}

		public function change_inline_stylesheet() {
			return 'brook-style';
		}

		function add_custom_font( $fonts ) {
			$fonts['louis_george_cafe'] = array(
				'label'    => 'Louis George Cafe',
				'variants' => array( 300, '300italic', 'regular', 'italic', 700, '700italic' ),
				'stack'    => 'Louis George Cafe, sans-serif',
			);

			$fonts['bebas_neue'] = array(
				'label'    => 'Bebas Neue',
				'variants' => array( 700 ),
				'stack'    => 'Bebas Neue, sans-serif',
			);

			$fonts['cerebrisans'] = array(
				'label'    => 'CerebriSans',
				'variants' => array(
					200,
					'200italic',
					300,
					'300italic',
					'regular',
					'italic',
					500,
					'500italic',
					600,
					'600italic',
					700,
					'700italic',
					800,
					'800italic',
					900,
					'900italic',
				),
				'stack'    => 'CerebriSans, sans-serif',
			);

			return $fonts;
		}

		function add_custom_font_css() {
			$typo_fields = Brook_Kirki::get_typography_fields_id();

			if ( ! is_array( $typo_fields ) || empty( $typo_fields ) ) {
				return;
			}

			foreach ( $typo_fields as $field ) {
				$value = Brook::setting( $field );

				if ( is_array( $value ) && isset( $value['font-family'] ) && $value['font-family'] !== '' ) {
					switch ( $value['font-family'] ) {
						case 'Louis George Cafe':
							wp_enqueue_style( 'louis-george-cafe-font', BROOK_THEME_URI . '/assets/fonts/louis-george-cafe/louis-george-cafe.css', null, null );
							break;
						case 'Bebas Neue':
							wp_enqueue_style( 'bebas-neue-font', BROOK_THEME_URI . '/assets/fonts/bebas-neue/bebas-neue.css', null, null );
							break;
						case 'CerebriSans':
							wp_enqueue_style( 'cerebrisans-font', BROOK_THEME_URI . '/assets/fonts/cerebrisans/cerebrisans.css', null, null );
							break;
						default:
							do_action( 'brook_enqueue_custom_font', $value['font-family'] ); // hook to custom do enqueue fonts
							break;
					}
				}
			}
		}

		/**
		 * Add customize preview css
		 */
		public function customize_preview_css() {
			wp_enqueue_style( 'kirki-custom-css', BROOK_THEME_URI . '/assets/admin/css/customizer.min.css' );
		}

		/**
		 * Load Customizer.
		 */
		public function load_customizer() {
			Brook::require_file( BROOK_THEME_DIR . '/customizer/customizer.php' );
		}

		/**
		 * Remove unused native sections and controls
		 *
		 * @since 0.9.3
		 *
		 * @param $wp_customize
		 */
		public function remove_customizer_sections( $wp_customize ) {
			$wp_customize->remove_section( 'nav' );
			$wp_customize->remove_section( 'colors' );
			$wp_customize->remove_section( 'background_image' );
			$wp_customize->remove_section( 'header_image' );

			$wp_customize->get_section( 'title_tagline' )->priority = '100';

			$wp_customize->remove_control( 'blogdescription' );
			$wp_customize->remove_control( 'display_header_text' );
		}

		public static function get_preset_settings( $args = array() ) {
			$defaults = array(
				'primary_color' => Brook::PRIMARY_COLOR,
			);

			$args = wp_parse_args( $args, $defaults );

			$results = array(
				'primary_color'                          => $args['primary_color'],
				'link_color_hover'                       => $args['primary_color'],
				'form_input_focus_color'                 => array(
					'color'      => $args['primary_color'],
					'background' => '#fff',
					'border'     => $args['primary_color'],
				),
				'button_color'                           => array(
					'color'      => '#ffffff',
					'background' => $args['primary_color'],
					'border'     => $args['primary_color'],
				),
				'button_hover_color'                     => array(
					'color'      => '#ffffff',
					'background' => $args['primary_color'],
					'border'     => $args['primary_color'],
				),
				'navigation_minimal_01_item_hover_color' => $args['primary_color'],
				'navigation_minimal_01_link_hover_color' => $args['primary_color'],
			);

			return $results;
		}

		public static function field_social_networks_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Social Networks', 'brook' ),
				'description' => '<a href="javascript:wp.customize.section( \'socials\' ).focus();">' . esc_html__( 'Edit social network links', 'brook' ) . '</a>',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'brook' ),
					'1' => esc_html__( 'Show', 'brook' ),
				),
			);

			$args = wp_parse_args( $args, $defaults );

			Brook_Kirki::add_field( 'theme', $args );
		}

		public static function field_language_switcher_enable( $args = array() ) {
			$defaults = array(
				'type'    => 'radio-buttonset',
				'label'   => esc_html__( 'Language Switcher', 'brook' ),
				'tooltip' => esc_html__( 'Show language switcher in header. Support for Polylang & WPML plugins.', 'brook' ),
				'choices' => array(
					'0' => esc_html__( 'Hide', 'brook' ),
					'1' => esc_html__( 'Show', 'brook' ),
				),
				'default' => '0',
			);

			$args = wp_parse_args( $args, $defaults );

			Brook_Kirki::add_field( 'theme', $args );
		}
	}

	Brook_Customize::instance()->initialize();
}

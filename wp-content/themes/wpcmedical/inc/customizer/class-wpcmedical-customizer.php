<?php
/**
 * WPCmedical Customizer Class
 *
 * @package  wpcmedical
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPCmedical_Customizer' ) ) :

	/**
	 * The WPCmedical Customizer class
	 */
	class WPCmedical_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'customize_register' ), 10 );
			add_filter( 'body_class', array( $this, 'layout_class' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_customizer_css' ), 130 );
			add_action( 'customize_controls_print_styles', array( $this, 'customizer_custom_control_css' ) );
			add_action( 'customize_register', array( $this, 'edit_default_customizer_settings' ), 99 );
			add_action( 'enqueue_block_assets', array( $this, 'block_editor_customizer_css' ) );
			add_action( 'init', array( $this, 'default_theme_mod_values' ), 10 );
		}

		/**
		 * Returns an array of the desired default WPCmedical Options
		 *
		 * @return array
		 */
		public function get_wpcmedical_default_setting_values() {
			return apply_filters(
				'wpcmedical_setting_default_values',
				$args = array(
					'wpcmedical_primary_color'                 => '#142A65',
					'wpcmedical_secondary_color'               => '#5C98F6',
					'wpcmedical_heading_color'                 => '#000000',
					'wpcmedical_text_color'                    => '#777777',
					'wpcmedical_accent_color'                  => '#000000',
					'wpcmedical_accent_color_hover'            => '#5C98F6',
					'wpcmedical_hero_heading_color'            => '#000000',
					'wpcmedical_hero_text_color'               => '#000000',
					'wpcmedical_header_background_color'       => '#142A65',
					'wpcmedical_header_text_color'             => '#ffffff',
					'wpcmedical_header_link_color'             => '#ffffff',
					'wpcmedical_header_link_color_hover'       => '#5C98F6',
					'wpcmedical_footer_background_color'       => '#142A65',
					'wpcmedical_footer_heading_color'          => '#ffffff',
					'wpcmedical_footer_text_color'             => '#ffffff',
					'wpcmedical_footer_link_color'             => '#ffffff',
					'wpcmedical_button_background_color'       => '#5C98F6',
					'wpcmedical_button_background_color_hover' => '#000000',
					'wpcmedical_button_text_color'             => '#ffffff',
					'wpcmedical_button_border_color'           => '#5C98F6',
					'wpcmedical_button_alt_background_color'   => '#142A65',
					'wpcmedical_button_alt_text_color'         => '#ffffff',
					'wpcmedical_layout'                        => 'right',
					'wpcmedical_page_title_background_color'   => '#eeeeee',
					'background_color'                         => '#ffffff',
				)
			);
		}

		/**
		 * Adds a value to each WPCmedical setting if one isn't already present.
		 *
		 * @uses get_wpcmedical_default_setting_values()
		 */
		public function default_theme_mod_values() {
			foreach ( $this->get_wpcmedical_default_setting_values() as $mod => $val ) {
				add_filter( 'theme_mod_' . $mod, array( $this, 'get_theme_mod_value' ), 10 );
			}
		}

		/**
		 * Get theme mod value.
		 *
		 * @param string $value Theme modification value.
		 *
		 * @return string
		 */
		public function get_theme_mod_value( $value ) {
			$key = substr( current_filter(), 10 );

			$set_theme_mods = get_theme_mods();

			if ( isset( $set_theme_mods[ $key ] ) ) {
				return $value;
			}

			$values = $this->get_wpcmedical_default_setting_values();

			return isset( $values[ $key ] ) ? $values[ $key ] : $value;
		}

		/**
		 * Set Customizer setting defaults.
		 * These defaults need to be applied separately as child themes can filter wpcmedical_setting_default_values
		 *
		 * @param array $wp_customize the Customizer object.
		 *
		 * @uses   get_wpcmedical_default_setting_values()
		 */
		public function edit_default_customizer_settings( $wp_customize ) {
			foreach ( $this->get_wpcmedical_default_setting_values() as $mod => $val ) {
				$wp_customize->get_setting( $mod )->default = $val;
			}
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since  1.0.0
		 */
		public function customize_register( $wp_customize ) {

			// Move background color setting alongside background image.
			$wp_customize->get_control( 'background_color' )->section  = 'background_image';
			$wp_customize->get_control( 'background_color' )->priority = 20;

			// Change background image section title & priority.
			$wp_customize->get_section( 'background_image' )->title    = __( 'Background', 'wpcmedical' );
			$wp_customize->get_section( 'background_image' )->priority = 30;

			// Change header image section title & priority.
			$wp_customize->get_section( 'header_image' )->title    = __( 'Header', 'wpcmedical' );
			$wp_customize->get_section( 'header_image' )->priority = 25;

			// Selective refresh.
			if ( function_exists( 'add_partial' ) ) {
				$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
				$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

				$wp_customize->selective_refresh->add_partial(
					'custom_logo',
					array(
						'selector'        => '.site-branding',
						'render_callback' => array( $this, 'get_site_logo' ),
					)
				);

				$wp_customize->selective_refresh->add_partial(
					'blogname',
					array(
						'selector'        => '.site-title.beta a',
						'render_callback' => array( $this, 'get_site_name' ),
					)
				);

				$wp_customize->selective_refresh->add_partial(
					'blogdescription',
					array(
						'selector'        => '.site-description',
						'render_callback' => array( $this, 'get_site_description' ),
					)
				);
			}

			/**
			 * Custom controls
			 */
			require_once dirname( __FILE__ ) . '/class-wpcmedical-customizer-control-radio-image.php';

			/**
			 * Page Title section
			 */
			$wp_customize->add_section(
				'wpcmedical_page_title',
				array(
					'title'    => __( 'Page Title', 'wpcmedical' ),
					'priority' => 46,
				)
			);

			/**
			 * Page Title background color
			 */
			$wp_customize->add_setting(
				'wpcmedical_page_title_background_color',
				array(
					'default'           => apply_filters( 'wpcmedical_page_title_background_color', '#eeeeee' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_page_title_background_color',
					array(
						'label'    => __( 'Background color', 'wpcmedical' ),
						'section'  => 'wpcmedical_page_title',
						'settings' => 'wpcmedical_page_title_background_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Add 'Page Title Background Image' Setting.
			 */
			$wp_customize->add_setting(
				'wpcmedical_page_title_background_image',
				array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'wpcmedical_page_title_background_image',
					array(
						'settings'    => 'wpcmedical_page_title_background_image',
						'section'     => 'wpcmedical_page_title',
						'label'       => __( 'Page Title Background Image', 'wpcmedical' ),
						'description' => __( 'Select the image to be used for Page Title Background.', 'wpcmedical' ),
					)
				)
			);

			/**
			 * Add the typography section
			 */
			$wp_customize->add_section(
				'wpcmedical_typography',
				array(
					'title'    => __( 'Typography', 'wpcmedical' ),
					'priority' => 45,
				)
			);

			/**
			 * Primary color
			 */
			$wp_customize->add_setting(
				'wpcmedical_primary_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_primary_color', '#5C98F6' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_primary_color',
					array(
						'label'    => __( 'Primary color', 'wpcmedical' ),
						'section'  => 'wpcmedical_typography',
						'settings' => 'wpcmedical_primary_color',
						'priority' => 20,
					)
				)
			);

			/**
			 * Secondary color
			 */
			$wp_customize->add_setting(
				'wpcmedical_secondary_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_secondary_color', '#142A65' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_secondary_color',
					array(
						'label'    => __( 'Secondary color', 'wpcmedical' ),
						'section'  => 'wpcmedical_typography',
						'settings' => 'wpcmedical_secondary_color',
						'priority' => 20,
					)
				)
			);

			/**
			 * Heading color
			 */
			$wp_customize->add_setting(
				'wpcmedical_heading_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_heading_color', '#000000' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_heading_color',
					array(
						'label'    => __( 'Heading color', 'wpcmedical' ),
						'section'  => 'wpcmedical_typography',
						'settings' => 'wpcmedical_heading_color',
						'priority' => 20,
					)
				)
			);

			/**
			 * Text Color
			 */
			$wp_customize->add_setting(
				'wpcmedical_text_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_text_color', '#43454b' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_text_color',
					array(
						'label'    => __( 'Text color', 'wpcmedical' ),
						'section'  => 'wpcmedical_typography',
						'settings' => 'wpcmedical_text_color',
						'priority' => 30,
					)
				)
			);

			/**
			 * Accent Color
			 */
			$wp_customize->add_setting(
				'wpcmedical_accent_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_accent_color', '#000000' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_accent_color',
					array(
						'label'    => __( 'Link / accent color', 'wpcmedical' ),
						'section'  => 'wpcmedical_typography',
						'settings' => 'wpcmedical_accent_color',
						'priority' => 40,
					)
				)
			);

			$wp_customize->add_setting(
				'wpcmedical_accent_color_hover',
				array(
					'default'           => apply_filters( 'wpcmedical_default_accent_color_hover', '#5C98F6' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_accent_color_hover',
					array(
						'label'    => __( 'Link / accent color hover', 'wpcmedical' ),
						'section'  => 'wpcmedical_typography',
						'settings' => 'wpcmedical_accent_color_hover',
						'priority' => 45,
					)
				)
			);

			/**
			 * Hero Heading Color
			 */
			$wp_customize->add_setting(
				'wpcmedical_hero_heading_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_hero_heading_color', '#000000' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_hero_heading_color',
					array(
						'label'    => __( 'Hero heading color', 'wpcmedical' ),
						'section'  => 'wpcmedical_typography',
						'settings' => 'wpcmedical_hero_heading_color',
						'priority' => 50,
					)
				)
			);

			/**
			 * Hero Text Color
			 */
			$wp_customize->add_setting(
				'wpcmedical_hero_text_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_hero_text_color', '#000000' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_hero_text_color',
					array(
						'label'    => __( 'Hero text color', 'wpcmedical' ),
						'section'  => 'wpcmedical_typography',
						'settings' => 'wpcmedical_hero_text_color',
						'priority' => 60,
					)
				)
			);

			/**
			 * Header Background
			 */
			$wp_customize->add_setting(
				'wpcmedical_header_background_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_header_background_color', '#142A65' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_header_background_color',
					array(
						'label'    => __( 'Background color', 'wpcmedical' ),
						'section'  => 'header_image',
						'settings' => 'wpcmedical_header_background_color',
						'priority' => 15,
					)
				)
			);

			/**
			 * Header text color
			 */
			$wp_customize->add_setting(
				'wpcmedical_header_text_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_header_text_color', '#ffffff' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_header_text_color',
					array(
						'label'    => __( 'Text color', 'wpcmedical' ),
						'section'  => 'header_image',
						'settings' => 'wpcmedical_header_text_color',
						'priority' => 20,
					)
				)
			);

			/**
			 * Header link color
			 */
			$wp_customize->add_setting(
				'wpcmedical_header_link_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_header_link_color', '#ffffff' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_header_link_color',
					array(
						'label'    => __( 'Link color', 'wpcmedical' ),
						'section'  => 'header_image',
						'settings' => 'wpcmedical_header_link_color',
						'priority' => 30,
					)
				)
			);

			/**
			 * Header link color hover
			 */
			$wp_customize->add_setting(
				'wpcmedical_header_link_color_hover',
				array(
					'default'           => apply_filters( 'wpcmedical_default_header_link_color', '#5C98F6' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_header_link_color_hover',
					array(
						'label'    => __( 'Link color hover', 'wpcmedical' ),
						'section'  => 'header_image',
						'settings' => 'wpcmedical_header_link_color_hover',
						'priority' => 30,
					)
				)
			);

			/**
			 * Footer section
			 */
			$wp_customize->add_section(
				'wpcmedical_footer',
				array(
					'title'       => __( 'Footer', 'wpcmedical' ),
					'priority'    => 28,
					'description' => __( 'Customize the look & feel of your website footer.', 'wpcmedical' ),
				)
			);

			/**
			 * Footer Background
			 */
			$wp_customize->add_setting(
				'wpcmedical_footer_background_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_footer_background_color', '#142A65' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_footer_background_color',
					array(
						'label'    => __( 'Background color', 'wpcmedical' ),
						'section'  => 'wpcmedical_footer',
						'settings' => 'wpcmedical_footer_background_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Footer heading color
			 */
			$wp_customize->add_setting(
				'wpcmedical_footer_heading_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_footer_heading_color', '#ffffff' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_footer_heading_color',
					array(
						'label'    => __( 'Heading color', 'wpcmedical' ),
						'section'  => 'wpcmedical_footer',
						'settings' => 'wpcmedical_footer_heading_color',
						'priority' => 20,
					)
				)
			);

			/**
			 * Footer text color
			 */
			$wp_customize->add_setting(
				'wpcmedical_footer_text_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_footer_text_color', '#61656b' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_footer_text_color',
					array(
						'label'    => __( 'Text color', 'wpcmedical' ),
						'section'  => 'wpcmedical_footer',
						'settings' => 'wpcmedical_footer_text_color',
						'priority' => 30,
					)
				)
			);

			/**
			 * Footer link color
			 */
			$wp_customize->add_setting(
				'wpcmedical_footer_link_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_footer_link_color', '#2c2d33' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_footer_link_color',
					array(
						'label'    => __( 'Link color', 'wpcmedical' ),
						'section'  => 'wpcmedical_footer',
						'settings' => 'wpcmedical_footer_link_color',
						'priority' => 40,
					)
				)
			);

			/**
			 * Footer copyright text
			 */
			$wp_customize->add_setting(
				'wpcmedical_footer_copyright_text',
				array(
					'default'           => __( 'Built with WPCmedical & WooCommerce', 'wpcmedical' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				'wpcmedical_footer_copyright_text',
				array(
					'label'    => __( 'Copyright', 'wpcmedical' ),
					'type'     => 'text',
					'section'  => 'wpcmedical_footer',
					'priority' => 50,
				)
			);

			/**
			 * Buttons section
			 */
			$wp_customize->add_section(
				'wpcmedical_buttons',
				array(
					'title'       => __( 'Buttons', 'wpcmedical' ),
					'priority'    => 45,
					'description' => __( 'Customize the look & feel of your website buttons.', 'wpcmedical' ),
				)
			);

			/**
			 * Button background color
			 */
			$wp_customize->add_setting(
				'wpcmedical_button_background_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_button_background_color', '#5C98F6' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_button_background_color',
					array(
						'label'    => __( 'Background color', 'wpcmedical' ),
						'section'  => 'wpcmedical_buttons',
						'settings' => 'wpcmedical_button_background_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Button background color hover
			 */
			$wp_customize->add_setting(
				'wpcmedical_button_background_color_hover',
				array(
					'default'           => apply_filters( 'wpcmedical_default_button_background_color_hover', '#000000' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_button_background_color_hover',
					array(
						'label'    => __( 'Background color hover', 'wpcmedical' ),
						'section'  => 'wpcmedical_buttons',
						'settings' => 'wpcmedical_button_background_color_hover',
						'priority' => 10,
					)
				)
			);

			/**
			 * Button text color
			 */
			$wp_customize->add_setting(
				'wpcmedical_button_text_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_button_text_color', '#ffffff' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_button_text_color',
					array(
						'label'    => __( 'Text color', 'wpcmedical' ),
						'section'  => 'wpcmedical_buttons',
						'settings' => 'wpcmedical_button_text_color',
						'priority' => 20,
					)
				)
			);

			/**
			 * Button text color
			 */
			$wp_customize->add_setting(
				'wpcmedical_button_border_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_button_border_color', '#5C98F6' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_button_border_color',
					array(
						'label'    => __( 'Border color', 'wpcmedical' ),
						'section'  => 'wpcmedical_buttons',
						'settings' => 'wpcmedical_button_border_color',
						'priority' => 20,
					)
				)
			);

			/**
			 * Button alt background color
			 */
			$wp_customize->add_setting(
				'wpcmedical_button_alt_background_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_button_alt_background_color', '#5C98F6' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_button_alt_background_color',
					array(
						'label'    => __( 'Alternate button background color', 'wpcmedical' ),
						'section'  => 'wpcmedical_buttons',
						'settings' => 'wpcmedical_button_alt_background_color',
						'priority' => 30,
					)
				)
			);

			/**
			 * Button alt text color
			 */
			$wp_customize->add_setting(
				'wpcmedical_button_alt_text_color',
				array(
					'default'           => apply_filters( 'wpcmedical_default_button_alt_text_color', '#ffffff' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wpcmedical_button_alt_text_color',
					array(
						'label'    => __( 'Alternate button text color', 'wpcmedical' ),
						'section'  => 'wpcmedical_buttons',
						'settings' => 'wpcmedical_button_alt_text_color',
						'priority' => 40,
					)
				)
			);

			/**
			 * Layout
			 */
			$wp_customize->add_section(
				'wpcmedical_layout',
				array(
					'title'    => __( 'Layout', 'wpcmedical' ),
					'priority' => 50,
				)
			);

			$wp_customize->add_setting(
				'wpcmedical_layout',
				array(
					'default'           => apply_filters( 'wpcmedical_default_layout', $layout = is_rtl() ? 'left' : 'right' ),
					'sanitize_callback' => 'wpcmedical_sanitize_choices',
				)
			);

			$wp_customize->add_control(
				new WPCmedical_Custom_Radio_Image_Control(
					$wp_customize,
					'wpcmedical_layout',
					array(
						'settings' => 'wpcmedical_layout',
						'section'  => 'wpcmedical_layout',
						'label'    => __( 'General Layout', 'wpcmedical' ),
						'priority' => 1,
						'choices'  => array(
							'right' => get_template_directory_uri() . '/assets/images/customizer/controls/2cr.png',
							'left'  => get_template_directory_uri() . '/assets/images/customizer/controls/2cl.png',
						),
					)
				)
			);
		}

		/**
		 * Get all of the WPCmedical theme mods.
		 *
		 * @return array $wpcmedical_theme_mods The WPCmedical Theme Mods.
		 */
		public function get_wpcmedical_theme_mods() {
			$wpcmedical_theme_mods = array(
				'background_color'              => wpcmedical_get_content_background_color(),
				'accent_color'                  => get_theme_mod( 'wpcmedical_accent_color' ),
				'accent_color_hover'            => get_theme_mod( 'wpcmedical_accent_color_hover' ),
				'hero_heading_color'            => get_theme_mod( 'wpcmedical_hero_heading_color' ),
				'hero_text_color'               => get_theme_mod( 'wpcmedical_hero_text_color' ),
				'header_background_color'       => get_theme_mod( 'wpcmedical_header_background_color' ),
				'header_link_color'             => get_theme_mod( 'wpcmedical_header_link_color' ),
				'header_link_color_hover'       => get_theme_mod( 'wpcmedical_header_link_color_hover' ),
				'header_text_color'             => get_theme_mod( 'wpcmedical_header_text_color' ),
				'footer_background_color'       => get_theme_mod( 'wpcmedical_footer_background_color' ),
				'footer_link_color'             => get_theme_mod( 'wpcmedical_footer_link_color' ),
				'footer_heading_color'          => get_theme_mod( 'wpcmedical_footer_heading_color' ),
				'footer_text_color'             => get_theme_mod( 'wpcmedical_footer_text_color' ),
				'text_color'                    => get_theme_mod( 'wpcmedical_text_color' ),
				'heading_color'                 => get_theme_mod( 'wpcmedical_heading_color' ),
				'primary_color'                 => get_theme_mod( 'wpcmedical_primary_color' ),
				'secondary_color'               => get_theme_mod( 'wpcmedical_secondary_color' ),
				'button_background_color'       => get_theme_mod( 'wpcmedical_button_background_color' ),
				'button_background_color_hover' => get_theme_mod( 'wpcmedical_button_background_color_hover' ),
				'button_text_color'             => get_theme_mod( 'wpcmedical_button_text_color' ),
				'button_border_color'           => get_theme_mod( 'wpcmedical_button_border_color' ),
				'button_alt_background_color'   => get_theme_mod( 'wpcmedical_button_alt_background_color' ),
				'button_alt_text_color'         => get_theme_mod( 'wpcmedical_button_alt_text_color' ),
				'page_title_background_color'   => get_theme_mod( 'wpcmedical_page_title_background_color' ),
			);

			return apply_filters( 'wpcmedical_theme_mods', $wpcmedical_theme_mods );
		}

		/**
		 * Get Customizer css.
		 *
		 * @return array $styles the css
		 * @see get_wpcmedical_theme_mods()
		 */
		public function get_css() {
			$wpcmedical_theme_mods = $this->get_wpcmedical_theme_mods();

			$styles = '
                body {
                    --primary:' . $wpcmedical_theme_mods['primary_color'] . ';
                    --secondary:' . $wpcmedical_theme_mods['secondary_color'] . ';
                    --background:' . $wpcmedical_theme_mods['background_color'] . ';
                    --accent:' . $wpcmedical_theme_mods['accent_color'] . ';
                    --accent_hover:' . $wpcmedical_theme_mods['accent_color_hover'] . ';
                    --hero_heading:' . $wpcmedical_theme_mods['hero_heading_color'] . ';
                    --hero_text:' . $wpcmedical_theme_mods['hero_text_color'] . ';
                    --header_background:' . $wpcmedical_theme_mods['header_background_color'] . ';
                    --header_link:' . $wpcmedical_theme_mods['header_link_color'] . ';
                    --header_link_hover:' . $wpcmedical_theme_mods['header_link_color_hover'] . ';
                    --header_text:' . $wpcmedical_theme_mods['header_text_color'] . ';
                    --footer_background:' . $wpcmedical_theme_mods['footer_background_color'] . ';
                    --footer_link:' . $wpcmedical_theme_mods['footer_link_color'] . ';
                    --footer_heading:' . $wpcmedical_theme_mods['footer_heading_color'] . ';
                    --footer_text:' . $wpcmedical_theme_mods['footer_text_color'] . ';
                    --text:' . $wpcmedical_theme_mods['text_color'] . ';
                    --heading:' . $wpcmedical_theme_mods['heading_color'] . ';
                    --button_background:' . $wpcmedical_theme_mods['button_background_color'] . ';
                    --button_background_hover:' . $wpcmedical_theme_mods['button_background_color_hover'] . ';
                    --button_text:' . $wpcmedical_theme_mods['button_text_color'] . ';
                    --button_border:' . $wpcmedical_theme_mods['button_border_color'] . ';
                    --button_alt_background:' . $wpcmedical_theme_mods['button_alt_background_color'] . ';
                    --button_alt_text:' . $wpcmedical_theme_mods['button_alt_text_color'] . ';
                    --page_title_background:' . $wpcmedical_theme_mods['page_title_background_color'] . ';
                }';

			return apply_filters( 'wpcmedical_customizer_css', $styles );
		}


		/**
		 * Enqueue dynamic colors to use editor blocks.
		 *
		 * @since 2.4.0
		 */
		public function block_editor_customizer_css() {
			$wpcmedical_theme_mods = $this->get_wpcmedical_theme_mods();

			$styles = '';

			if ( is_admin() ) {
				$styles .= '
				.editor-styles-wrapper {
					background-color: ' . $wpcmedical_theme_mods['background_color'] . ';
				}

				.editor-styles-wrapper table:not( .has-background ) th {
					background-color: ' . wpcmedical_adjust_color_brightness( $wpcmedical_theme_mods['background_color'], - 7 ) . ';
				}

				.editor-styles-wrapper table:not( .has-background ) tbody td {
					background-color: ' . wpcmedical_adjust_color_brightness( $wpcmedical_theme_mods['background_color'], - 2 ) . ';
				}

				.editor-styles-wrapper table:not( .has-background ) tbody tr:nth-child(2n) td,
				.editor-styles-wrapper fieldset,
				.editor-styles-wrapper fieldset legend {
					background-color: ' . wpcmedical_adjust_color_brightness( $wpcmedical_theme_mods['background_color'], - 4 ) . ';
				}

				.editor-post-title__block .editor-post-title__input,
				.editor-styles-wrapper h1,
				.editor-styles-wrapper h2,
				.editor-styles-wrapper h3,
				.editor-styles-wrapper h4,
				.editor-styles-wrapper h5,
				.editor-styles-wrapper h6 {
					color: ' . $wpcmedical_theme_mods['heading_color'] . ';
				}

				/* WP <=5.3 */
				.editor-styles-wrapper .editor-block-list__block,
				/* WP >=5.4 */
				.editor-styles-wrapper .block-editor-block-list__block {
					color: ' . $wpcmedical_theme_mods['text_color'] . ';
				}

				.editor-styles-wrapper a,
				.wp-block-freeform.block-library-rich-text__tinymce a {
					color: ' . $wpcmedical_theme_mods['accent_color'] . ';
				}

				.editor-styles-wrapper a:focus,
				.wp-block-freeform.block-library-rich-text__tinymce a:focus {
					outline-color: ' . $wpcmedical_theme_mods['accent_color'] . ';
				}

				body.post-type-post .editor-post-title__block::after {
					content: "";
				}';
			}

			wp_add_inline_style( 'wpcmedical-gutenberg-blocks', apply_filters( 'wpcmedical_gutenberg_block_editor_customizer_css', $styles ) );
		}

		/**
		 * Add CSS in <head> for styles handled by the theme customizer
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_customizer_css() {
			wp_add_inline_style( 'wpcmedical-style', $this->get_css() );
		}

		/**
		 * Layout classes
		 * Adds 'right-sidebar' and 'left-sidebar' classes to the body tag
		 *
		 * @param array $classes current body classes.
		 *
		 * @return string[]          modified body classes
		 * @since  1.0.0
		 */
		public function layout_class( $classes ) {
			$left_or_right = get_theme_mod( 'wpcmedical_layout' );

			$classes[] = $left_or_right . '-sidebar';

			return $classes;
		}

		/**
		 * Add CSS for custom controls
		 *
		 * This function incorporates CSS from the Kirki Customizer Framework
		 *
		 * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
		 * is licensed under the terms of the GNU GPL, Version 2 (or later)
		 *
		 * @link https://github.com/reduxframework/kirki/
		 * @since  1.5.0
		 */
		public function customizer_custom_control_css() {
			?>
            <style>
                .customize-control-wpcmedical-radio-image input[type=radio] {
                    display: none;
                }

                .customize-control-wpcmedical-radio-image label {
                    display: block;
                    width: 48%;
                    float: left;
                    margin-right: 4%;
                }

                .customize-control-wpcmedical-radio-image label:nth-of-type(2n) {
                    margin-right: 0;
                }

                .customize-control-wpcmedical-radio-image img {
                    opacity: .5;
                }

                .customize-control-wpcmedical-radio-image input[type=radio]:checked + label img,
                .customize-control-wpcmedical-radio-image img:hover {
                    opacity: 1;
                }

            </style>
			<?php
		}

		/**
		 * Get site logo.
		 *
		 * @return string
		 * @since 2.1.5
		 */
		public function get_site_logo() {
			return wpcmedical_site_title_or_logo( false );
		}

		/**
		 * Get site name.
		 *
		 * @return string
		 * @since 2.1.5
		 */
		public function get_site_name() {
			return get_bloginfo( 'name', 'display' );
		}

		/**
		 * Get site description.
		 *
		 * @return string
		 * @since 2.1.5
		 */
		public function get_site_description() {
			return get_bloginfo( 'description', 'display' );
		}

		/**
		 * Check if current page is using the Homepage template.
		 *
		 * @return bool
		 * @since 2.3.0
		 */
		public function is_homepage_template() {
			$template = get_post_meta( get_the_ID(), '_wp_page_template', true );

			if ( ! $template || 'template-homepage.php' !== $template || ! has_post_thumbnail( get_the_ID() ) ) {
				return false;
			}

			return true;
		}

	}

endif;

return new WPCmedical_Customizer();

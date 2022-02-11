<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin installation and activation for WordPress themes
 */
if ( ! class_exists( 'Brook_Register_Plugins' ) ) {
	class Brook_Register_Plugins {

		public function __construct() {
			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
		}

		public function register_required_plugins() {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(
				array(
					'name'     => esc_html__( 'Insight Core', 'brook' ),
					'slug'     => 'insight-core',
					'source'   => $this->get_plugin_source_url( 'insight-core-2.2.8-7uPS58XlH9.zip' ),
					'version'  => '2.2.8',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'WPBakery Page Builder', 'brook' ),
					'slug'     => 'js_composer',
					'source'   => $this->get_plugin_source_url( 'js_composer-6.8.0-8iS5uZAk3e.zip' ),
					'version'  => '6.8.0',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'WPBakery Page Builder (Visual Composer) Clipboard', 'brook' ),
					'slug'    => 'vc_clipboard',
					'source'  => $this->get_plugin_source_url( 'vc_clipboard-5.0.2-c1T0eAUXZF.zip' ),
					'version' => '5.0.2',
				),
				array(
					'name' => esc_html__( 'Contact Form 7', 'brook' ),
					'slug' => 'contact-form-7',
				),
				array(
					'name' => esc_html__( 'MailChimp for WordPress', 'brook' ),
					'slug' => 'mailchimp-for-wp',
				),
				array(
					'name' => esc_html__( 'WooCommerce', 'brook' ),
					'slug' => 'woocommerce',
				),
				array(
					'name' => esc_html__( 'WPC Smart Compare for WooCommerce', 'brook' ),
					'slug' => 'woo-smart-compare',
				),
				array(
					'name' => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'brook' ),
					'slug' => 'woo-smart-wishlist',
				),
				array(
					'name'     => esc_html__( 'Revolution Slider', 'brook' ),
					'slug'     => 'revslider',
					'source'   => $this->get_plugin_source_url( 'revslider-6.5.14-8iS5uZAk3e.zip' ),
					'version'  => '6.5.14',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'Instagram Feed', 'brook' ),
					'slug'    => 'elfsight-instagram-feed-cc',
					'source'  => $this->get_plugin_source_url( 'elfsight-instagram-feed-cc-4.0.2-dYYYZeP8Zo.zip' ),
					'version' => '4.0.2',
				),
			);

			return $plugins;
		}

		public function get_plugin_source_url( $file_name ) {
			return 'https://api.thememove.com/download/' . $file_name;
		}
	}

	new Brook_Register_Plugins();
}

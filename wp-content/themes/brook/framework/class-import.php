<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initial OneClick import for this theme
 */
if ( ! class_exists( 'Brook_Import' ) ) {
	class Brook_Import {

		public function __construct() {
			add_filter( 'insight_core_import_demos', array( $this, 'import_demos' ) );
			add_filter( 'insight_core_import_generate_thumb', '__return_false' );
			add_filter( 'insight_core_import_delete_exist_posts', '__return_true' );
		}

		public function import_demos() {
			return array(
				'main' => array(
					'screenshot' => BROOK_THEME_URI . '/screenshot.jpg',
					'name'       => BROOK_THEME_NAME . ' Main',
					'url'        => 'https://api.thememove.com/import/brook/brook-main-2.6.7.zip',
				),
				'rtl' => array(
					'screenshot' => BROOK_THEME_URI . '/screenshot.jpg',
					'name'       => BROOK_THEME_NAME . ' RTL',
					'url'        => 'https://api.thememove.com/import/brook/brook-rtl-images-2.6.7.zip',
				),
			);
		}
	}

	new Brook_Import();
}

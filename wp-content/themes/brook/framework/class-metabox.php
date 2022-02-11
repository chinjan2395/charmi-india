<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Brook_Metabox' ) ) {
	class Brook_Metabox {

		/**
		 * Brook_Metabox constructor.
		 */
		public function __construct() {
			add_filter( 'insight_core_meta_boxes', array( $this, 'register_meta_boxes' ) );
			add_filter( 'brook_page_meta_box_presets', array( $this, 'page_meta_box_presets' ) );
		}

		public function page_meta_box_presets( $presets ) {
			$presets[] = 'settings_preset';

			return $presets;
		}

		/**
		 * Register Metabox
		 *
		 * @param $meta_boxes
		 *
		 * @return array
		 */
		public function register_meta_boxes( $meta_boxes ) {
			$page_registered_sidebars = Brook_Helper::get_registered_sidebars( true );

			$general_options = array(
				array(
					'title'  => esc_attr__( 'Settings Preset', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'settings_preset_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Notice', 'brook' ),
							'message' => esc_html__( 'This setting applies to demo homepage only. You should set this setting to "none" to use your own settings from Customize.', 'brook' ),
						),
						array(
							'id'      => 'settings_preset',
							'type'    => 'select',
							'title'   => esc_html__( 'Settings Preset', 'brook' ),
							'desc'    => esc_html__( 'Select a settings preset for this page. This setting mixed display different colors and fonts.', 'brook' ),
							'options' => array(
								'-1' => esc_attr__( 'None', 'brook' ),
								'01' => esc_attr__( 'Settings Preset 01', 'brook' ),
								'02' => esc_attr__( 'Settings Preset 02', 'brook' ),
								'03' => esc_attr__( 'Settings Preset 03', 'brook' ),
								'04' => esc_attr__( 'Settings Preset 04', 'brook' ),
								'05' => esc_attr__( 'Settings Preset 05', 'brook' ),
								'06' => esc_attr__( 'Settings Preset 06', 'brook' ),
								'07' => esc_attr__( 'Settings Preset 07', 'brook' ),
								'08' => esc_attr__( 'Settings Preset 08', 'brook' ),
								'09' => esc_attr__( 'Settings Preset 09', 'brook' ),
								'10' => esc_attr__( 'Settings Preset 10', 'brook' ),
								'11' => esc_attr__( 'Settings Preset 11', 'brook' ),
								'12' => esc_attr__( 'Settings Preset 12', 'brook' ),
								'13' => esc_attr__( 'Settings Preset 13', 'brook' ),
								'14' => esc_attr__( 'Settings Preset 14', 'brook' ),
								'15' => esc_attr__( 'Settings Preset 15', 'brook' ),
								'16' => esc_attr__( 'Settings Preset 16', 'brook' ),
								'17' => esc_attr__( 'Settings Preset 17', 'brook' ),
								'18' => esc_attr__( 'Settings Preset 18', 'brook' ),
								'19' => esc_attr__( 'Settings Preset 19', 'brook' ),
								'20' => esc_attr__( 'Settings Preset 20', 'brook' ),
								'21' => esc_attr__( 'Settings Preset 21', 'brook' ),
								'22' => esc_attr__( 'Settings Preset 22', 'brook' ),
								'23' => esc_attr__( 'Settings Preset 23', 'brook' ),
								'24' => esc_attr__( 'Settings Preset 24', 'brook' ),
								'25' => esc_attr__( 'Settings Preset 25', 'brook' ),
								'26' => esc_attr__( 'Settings Preset 26', 'brook' ),
								'27' => esc_attr__( 'Settings Preset 27', 'brook' ),
								'28' => esc_attr__( 'Settings Preset 28', 'brook' ),
								'29' => esc_attr__( 'Settings Preset 29', 'brook' ),
								'30' => esc_attr__( 'Settings Preset 30', 'brook' ),
								'31' => esc_attr__( 'Settings Preset 31', 'brook' ),
								'32' => esc_attr__( 'Settings Preset 32', 'brook' ),
								'33' => esc_attr__( 'Settings Preset 33', 'brook' ),
								'34' => esc_attr__( 'Settings Preset 34', 'brook' ),
							),
							'default' => '-1',
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Layout', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'site_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'brook' ),
							'desc'    => esc_html__( 'Controls the layout of this page.', 'brook' ),
							'options' => array(
								''      => esc_attr__( 'Default', 'brook' ),
								'boxed' => esc_attr__( 'Boxed', 'brook' ),
								'wide'  => esc_attr__( 'Wide', 'brook' ),
							),
							'default' => '',
						),
						array(
							'id'    => 'site_width',
							'type'  => 'text',
							'title' => esc_html__( 'Site Width', 'brook' ),
							'desc'  => esc_html__( 'Controls the site width for this page. Enter value including any valid CSS unit. For e.g: 1200px. Leave blank to use global setting.', 'brook' ),
						),
						array(
							'id'      => 'content_padding',
							'type'    => 'switch',
							'title'   => esc_attr__( 'Page Content Padding', 'brook' ),
							'default' => '1',
							'options' => array(
								'0'      => esc_attr__( 'No Padding', 'brook' ),
								'1'      => esc_attr__( 'Default', 'brook' ),
								'top'    => esc_attr__( 'No Top Padding', 'brook' ),
								'bottom' => esc_attr__( 'No Bottom Padding', 'brook' ),
							),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Background', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'site_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'brook' ),
							'message' => esc_html__( 'These options controls the background on boxed mode.', 'brook' ),
						),
						array(
							'id'    => 'site_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'brook' ),
							'desc'  => esc_html__( 'Controls the background color of the outer background area in boxed mode of this page.', 'brook' ),
						),
						array(
							'id'    => 'site_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'brook' ),
							'desc'  => esc_html__( 'Controls the background image of the outer background area in boxed mode of this page.', 'brook' ),
						),
						array(
							'id'      => 'site_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'brook' ),
							'desc'    => esc_html__( 'Controls the background repeat of the outer background area in boxed mode of this page.', 'brook' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'brook' ),
								'repeat'    => esc_attr__( 'Repeat', 'brook' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'brook' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'brook' ),
							),
						),
						array(
							'id'      => 'site_background_attachment',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Attachment', 'brook' ),
							'desc'    => esc_html__( 'Controls the background attachment of the outer background area in boxed mode of this page.', 'brook' ),
							'options' => array(
								''       => esc_attr__( 'Default', 'brook' ),
								'fixed'  => esc_attr__( 'Fixed', 'brook' ),
								'scroll' => esc_attr__( 'Scroll', 'brook' ),
							),
						),
						array(
							'id'    => 'site_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'brook' ),
							'desc'  => esc_html__( 'Controls the background position of the outer background area in boxed mode of this page.', 'brook' ),
						),
						array(
							'id'    => 'site_background_size',
							'type'  => 'text',
							'title' => esc_html__( 'Background Size', 'brook' ),
							'desc'  => esc_html__( 'Controls the background size of the outer background area in boxed mode of this page.', 'brook' ),
						),
						array(
							'id'      => 'content_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'brook' ),
							'message' => esc_html__( 'These options controls the background of main content on this page.', 'brook' ),
						),
						array(
							'id'    => 'content_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'brook' ),
							'desc'  => esc_html__( 'Controls the background color of main content on this page.', 'brook' ),
						),
						array(
							'id'    => 'content_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'brook' ),
							'desc'  => esc_html__( 'Controls the background image of main content on this page.', 'brook' ),
						),
						array(
							'id'      => 'content_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'brook' ),
							'desc'    => esc_html__( 'Controls the background repeat of main content on this page.', 'brook' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'brook' ),
								'repeat'    => esc_attr__( 'Repeat', 'brook' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'brook' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'brook' ),
							),
						),
						array(
							'id'    => 'content_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'brook' ),
							'desc'  => esc_html__( 'Controls the background position of main content on this page.', 'brook' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Header', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'top_bar_type',
							'type'    => 'select',
							'title'   => esc_html__( 'Top Bar Type', 'brook' ),
							'desc'    => esc_html__( 'Select top bar type that displays on this page.', 'brook' ),
							'default' => '',
							'options' => Brook_Helper::get_top_bar_list( true ),
						),
						array(
							'id'      => 'header_type',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Type', 'brook' ),
							'desc'    => wp_kses(
								sprintf(
									__( 'Select header type that displays on this page. When you choose Default, the value in %s will be used.', 'brook' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=header' ) . '">Customize</a>'
								), 'brook-default' ),
							'default' => '',
							'options' => Brook_Helper::get_header_list( true ),
						),
						array(
							'id'      => 'menu_display',
							'type'    => 'select',
							'title'   => esc_html__( 'Primary menu', 'brook' ),
							'desc'    => esc_html__( 'Select which menu displays on this page.', 'brook' ),
							'default' => '',
							'options' => Brook_Nav_Menu::get_all_menus(),
						),
						array(
							'id'      => 'menu_one_page',
							'type'    => 'switch',
							'title'   => esc_attr__( 'One Page Menu', 'brook' ),
							'default' => '0',
							'options' => array(
								'0' => esc_attr__( 'Disable', 'brook' ),
								'1' => esc_attr__( 'Enable', 'brook' ),
							),
						),
						array(
							'id'      => 'custom_logo',
							'type'    => 'media',
							'title'   => esc_html__( 'Custom Logo', 'brook' ),
							'desc'    => esc_html__( 'Select custom logo for this page.', 'brook' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Logo Width', 'brook' ),
							'desc'    => esc_html__( 'Controls the width of logo. For e.g: 150px', 'brook' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_sticky_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Sticky Logo Width', 'brook' ),
							'desc'    => esc_html__( 'Controls the width of sticky logo. For e.g: 150px', 'brook' ),
							'default' => '',
						),
					),
				),
				array(
					'title'  => esc_html__( 'Page Title Bar', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'page_title_bar_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'brook' ),
							'default' => '',
							'options' => Brook_Helper::get_title_bar_list( true ),
						),
						array(
							'id'      => 'page_title_bar_background_color',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Color', 'brook' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background',
							'type'    => 'media',
							'title'   => esc_html__( 'Background Image', 'brook' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background_overlay',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Overlay', 'brook' ),
							'default' => '',
						),
						array(
							'id'    => 'page_title_bar_custom_heading',
							'type'  => 'text',
							'title' => esc_html__( 'Custom Heading Text', 'brook' ),
							'desc'  => esc_html__( 'Insert custom heading for the page title bar. Leave blank to use default.', 'brook' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sidebars', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'page_sidebar_1',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 1', 'brook' ),
							'desc'    => esc_html__( 'Select sidebar 1 that will display on this page.', 'brook' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_2',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 2', 'brook' ),
							'desc'    => esc_html__( 'Select sidebar 2 that will display on this page.', 'brook' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_position',
							'type'    => 'switch',
							'title'   => esc_html__( 'Sidebar Position', 'brook' ),
							'desc'    => wp_kses(
								sprintf(
									__( 'Select position of Sidebar 1 for this page. If sidebar 2 is selected, it will display on the opposite side. If you set as "Default" then the value in %s will be used.', 'brook' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=sidebars' ) . '">Customize -> Sidebar</a>'
								), 'brook-a' ),
							'default' => 'default',
							'options' => Brook_Helper::get_list_sidebar_positions( true ),
						),
						array(
							'id'      => 'page_sidebar_special',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar Special', 'brook' ),
							'desc'    => esc_html__( 'Select sidebar special that will display on this page.', 'brook' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sliders', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'revolution_slider',
							'type'    => 'select',
							'title'   => esc_html__( 'Revolution Slider', 'brook' ),
							'desc'    => esc_html__( 'Select the unique name of the slider.', 'brook' ),
							'options' => Brook_Helper::get_list_revslider(),
						),
						array(
							'id'      => 'slider_position',
							'type'    => 'select',
							'title'   => esc_html__( 'Slider Position', 'brook' ),
							'default' => 'below',
							'options' => array(
								'above' => esc_attr__( 'Above Header', 'brook' ),
								'below' => esc_attr__( 'Below Header', 'brook' ),
							),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Footer', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'footer_page',
							'type'    => 'select',
							'title'   => esc_html__( 'Footer Page', 'brook' ),
							'default' => 'default',
							'options' => Brook_Footer::get_list_footers( true ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Page Template', 'brook' ),
					'fields' => array(
						array(
							'id'      => 'one_page_scroll_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'brook' ),
							'message' => esc_html__( 'All below options working on page with Template is "One Page Scroll".', 'brook' ),
						),
						array(
							'id'      => 'one_page_scroll_nav_enable',
							'type'    => 'switch',
							'title'   => esc_html__( 'Navigation Display', 'brook' ),
							'default' => '1',
							'options' => array(
								'0' => esc_html__( 'None', 'brook' ),
								'1' => esc_html__( 'Yes', 'brook' ),
							),
						),
						array(
							'id'      => 'one_page_scroll_nav_style',
							'type'    => 'select',
							'title'   => esc_html__( 'Navigation Style', 'brook' ),
							'default' => '01',
							'options' => array(
								'01' => esc_attr__( 'Style 01', 'brook' ),
								'02' => esc_attr__( 'Style 02', 'brook' ),
							),
						),
						array(
							'id'      => 'one_page_scroll_effect',
							'type'    => 'select',
							'title'   => esc_html__( 'Scroll Effect', 'brook' ),
							'default' => '1',
							'options' => array(
								'1' => esc_attr__( 'Slide', 'brook' ),
								'2' => esc_attr__( 'Scale Up', 'brook' ),
								'3' => esc_attr__( 'Cube', 'brook' ),
							),
						),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_page_options',
				'title'      => esc_html__( 'Page Options', 'brook' ),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_post_options',
				'title'      => esc_html__( 'Page Options', 'brook' ),
				'post_types' => array( 'post' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Post', 'brook' ),
								'fields' => array(
									array(
										'id'      => 'single_post_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Single Blog Style', 'brook' ),
										'desc'    => esc_html__( 'Select layout for details page of this post.', 'brook' ),
										'options' => array(
											''         => esc_attr__( 'Default', 'brook' ),
											'standard' => esc_attr__( 'Standard', 'brook' ),
											'modern'   => esc_attr__( 'Modern', 'brook' ),
										),
										'default' => '',
									),
									array(
										'id'    => 'post_gallery',
										'type'  => 'gallery',
										'title' => esc_html__( 'Gallery Format', 'brook' ),
									),
									array(
										'id'    => 'post_video',
										'type'  => 'text',
										'title' => esc_html__( 'Video URL', 'brook' ),
										'desc'  => esc_html__( 'Input the url of video vimeo or youtube. For e.g: https://www.youtube.com/watch?v=9No-FiEInLA', 'brook' ),
									),
									array(
										'id'    => 'post_audio',
										'type'  => 'textarea',
										'title' => esc_html__( 'Audio Format', 'brook' ),
									),
									array(
										'id'    => 'post_quote_text',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Text', 'brook' ),
									),
									array(
										'id'    => 'post_quote_name',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Name', 'brook' ),
									),
									array(
										'id'    => 'post_quote_url',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Url', 'brook' ),
									),
									array(
										'id'    => 'post_link',
										'type'  => 'text',
										'title' => esc_html__( 'Link Format', 'brook' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_product_options',
				'title'      => esc_html__( 'Page Options', 'brook' ),
				'post_types' => array( 'product' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_portfolio_options',
				'title'      => esc_html__( 'Page Options', 'brook' ),
				'post_types' => array( 'portfolio' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Portfolio', 'brook' ),
								'fields' => array(
									array(
										'id'      => 'portfolio_layout_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Single Portfolio Style', 'brook' ),
										'desc'    => esc_html__( 'Select style of this single portfolio post page.', 'brook' ),
										'default' => '',
										'options' => array(
											''                   => esc_attr__( 'Default', 'brook' ),
											'blank'              => esc_attr__( 'Blank (Build with Visual Composer)', 'brook' ),
											'left_details'       => esc_attr__( 'Left Details', 'brook' ),
											'right_details'      => esc_attr__( 'Right Details', 'brook' ),
											'left_details_wide'  => esc_attr__( 'Left Details - Wide', 'brook' ),
											'right_details_wide' => esc_attr__( 'Right Details - Wide', 'brook' ),
										),
									),
									array(
										'id'    => 'portfolio_gallery',
										'type'  => 'gallery',
										'title' => esc_html__( 'Gallery', 'brook' ),
									),
									array(
										'id'    => 'portfolio_video_url',
										'type'  => 'text',
										'title' => esc_html__( 'Video URL', 'brook' ),
										'desc'  => esc_html__( 'Input the url of video vimeo or youtube. For e.g: https://www.youtube.com/watch?v=9No-FiEInLA', 'brook' ),
									),
									array(
										'id'    => 'portfolio_client',
										'type'  => 'text',
										'title' => esc_html__( 'Client', 'brook' ),
									),
									array(
										'id'    => 'portfolio_date',
										'type'  => 'text',
										'title' => esc_html__( 'Date', 'brook' ),
									),
									array(
										'id'    => 'portfolio_awards',
										'type'  => 'editor',
										'title' => esc_html__( 'Awards', 'brook' ),
									),
									array(
										'id'    => 'portfolio_url',
										'type'  => 'text',
										'title' => esc_html__( 'External Url', 'brook' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_testimonial_options',
				'title'      => esc_html__( 'Testimonial Options', 'brook' ),
				'post_types' => array( 'testimonial' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array(
							array(
								'title'  => esc_html__( 'Testimonial Details', 'brook' ),
								'fields' => array(
									array(
										'id'      => 'subject',
										'type'    => 'text',
										'title'   => esc_html__( 'Subject', 'brook' ),
										'default' => '',
									),
									array(
										'id'      => 'by_line',
										'type'    => 'text',
										'title'   => esc_html__( 'By Line', 'brook' ),
										'desc'    => esc_html__( 'Enter a byline for the customer giving this testimonial (for example: "CEO of Thememove").', 'brook' ),
										'default' => '',
									),
									array(
										'id'      => 'url',
										'type'    => 'text',
										'title'   => esc_html__( 'Url', 'brook' ),
										'desc'    => esc_html__( 'Enter a URL that applies to this customer (for example: https://www.thememove.com/).', 'brook' ),
										'default' => '',
									),
									array(
										'id'      => 'rating',
										'type'    => 'select',
										'title'   => esc_attr__( 'Rating', 'brook' ),
										'default' => '',
										'options' => array(
											''  => esc_attr__( 'Select a rating', 'brook' ),
											'1' => esc_attr__( '1 Star', 'brook' ),
											'2' => esc_attr__( '2 Stars', 'brook' ),
											'3' => esc_attr__( '3 Stars', 'brook' ),
											'4' => esc_attr__( '4 Stars', 'brook' ),
											'5' => esc_attr__( '5 Stars', 'brook' ),
										),
									),
								),
							),
						),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_footer_options',
				'title'      => esc_html__( 'Footer Options', 'brook' ),
				'post_types' => array( 'ic_footer' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array(
							array(
								'title'  => esc_html__( 'Effect', 'brook' ),
								'fields' => array(
									array(
										'id'      => 'effect',
										'type'    => 'switch',
										'title'   => esc_html__( 'Footer Effect', 'brook' ),
										'default' => '',
										'options' => array(
											''         => esc_attr__( 'Normal', 'brook' ),
											'parallax' => esc_attr__( 'Parallax', 'brook' ),
											'fixed'    => esc_attr__( 'Fixed', 'brook' ),
											'overlay'  => esc_attr__( 'Overlay', 'brook' ),
										),
									),
								),
							),
							array(
								'title'  => esc_html__( 'Styling', 'brook' ),
								'fields' => array(
									array(
										'id'      => 'style',
										'type'    => 'select',
										'title'   => esc_html__( 'Footer Style', 'brook' ),
										'default' => '01',
										'options' => array(
											'01' => esc_attr__( 'Style 01', 'brook' ),
											'02' => esc_attr__( 'Style 02', 'brook' ),
											'03' => esc_attr__( 'Style 03', 'brook' ),
											'04' => esc_attr__( 'Style 04', 'brook' ),
											'05' => esc_attr__( 'Style 05', 'brook' ),
											'06' => esc_attr__( 'Style 06', 'brook' ),
										),
									),
								),
							),
						),
					),
				),
			);

			return $meta_boxes;
		}

	}

	new Brook_Metabox();
}

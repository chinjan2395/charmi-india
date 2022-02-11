<?php
defined( 'ABSPATH' ) || exit;

class Brook_VC_Templates {

	protected static $instance = null;

	protected $template_count = 0;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		if ( ! class_exists( 'Vc_Manager' ) ) {
			return;
		}

		// Move item to first.
		add_filter( 'vc_get_all_templates', array( $this, 'add_theme_templates' ), 99 );

		add_filter( 'vc_templates_render_category', array( $this, 'render_template_block' ), 20 );

		add_filter( 'vc_load_default_templates', '__return_empty_array' ); // Hook in

		add_action( 'vc_load_default_templates_action', array( $this, 'custom_studio_templates_for_vc' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		if ( ! function_exists( 'get_current_screen' ) ) {
			return;
		}

		$screen = get_current_screen();

		if ( $screen->base !== 'post' ) {
			return;
		}
		
		wp_enqueue_script( 'vc-defaults-template', BROOK_THEME_URI . '/assets/admin/js/vc-defaults-template.js', array( 'jquery' ), null, true );
	}

	public function add_theme_templates( $data ) {
		foreach ( $data as $key => $template ) {
			if ( $template['category'] === 'default_templates' ) {
				$data[ $key ]['category_weight'] = 5;
				$data[ $key ]['category_name']   = esc_html__( 'Brook Studio', 'brook' );
			}
		}

		return $data;
	}

	public function render_template_block( $category ) {
		if ( 'default_templates' === $category['category'] ) {
			$category['output'] = '';

			if ( esc_attr( $category['category'] ) == 'default_templates' ) {
				$cats = $this->default_templates_categories();

				$category['output'] .= '<div class="library_categories"><ul>';

				foreach ( $cats as $cat_name => $cat_sort_text ) {
					$category['output'] .= '<li data-sort="' . $cat_name . '">' . $cat_sort_text . ' <span class="count">0</span></li>';
				}

				$category['output'] .= '</ul></div>';
			}

			$category['output'] .= '<div class="vc_col-md-12">';
			if ( isset( $category['category_name'] ) ) {
				$category['output'] .= '<h3>' . esc_html( $category['category_name'] ) . '</h3>';
			}
			if ( isset( $category['category_description'] ) ) {
				$category['output'] .= '<p class="vc_description">' . esc_html( $category['category_description'] ) . '</p>';
			}
			$category['output'] .= '</div>';
			$category['output'] .= '
				<div class="vc_column vc_col-sm-12">
					<div class="vc_ui-template-list vc_templates-list-default_templates vc_ui-list-bar" data-vc-action="collapseAll">';
			if ( ! empty( $category['templates'] ) ) {
				foreach ( $category['templates'] as $template ) {
					$category['output'] .= $this->render_template_list_item( $template );
				}
			}
			$category['output'] .= '
				</div>
			</div>';

		}

		return $category;
	}

	public function render_template_list_item( $template ) {
		$name                = isset( $template['name'] ) ? esc_html( $template['name'] ) : esc_html__( 'No title', 'brook' );
		$template_id         = esc_attr( $template['unique_id'] );
		$template_id_hash    = md5( $template_id ); // needed for jquery target for TTA
		$template_name       = esc_html( $name );
		$template_name_lower = esc_attr( vc_slugify( $template_name ) );
		$template_type       = esc_attr( isset( $template['type'] ) ? $template['type'] : 'custom' );
		$custom_class        = isset( $template['custom_class'] ) ? $template['custom_class'] : '';

		$cat_display_name = $custom_class;

		if ( $cat_display_name !== '' ) {
			$cat_display_name = str_replace( ' ', ', ', $cat_display_name );
			$cat_display_name = str_replace( '_', ' ', $cat_display_name );
		}

		// Adding in preview img.
		$preview_img = esc_attr( isset( $template['image'] ) && $template['image'] != '' ? $template['image'] : get_template_directory_uri() . '/assets/admin/images/vc-templates/no-img.jpg' );

		$output = <<<HTML
					<div class="vc_ui-template vc_templates-template-type-$template_type $custom_class"
						data-template_id="$template_id"
						data-template_id_hash="$template_id_hash"
						data-category="$template_type"
						data-template_unique_id="$template_id"
						data-template_name="$template_name_lower"
						data-template_type="$template_type"
						data-vc-content=".vc_ui-template-content">
						<div class="vc_ui-list-bar-item">
HTML;

		if ( ! empty( $preview_img ) && $template_type == 'default_templates' ) {
			//lazy load images out of view
			if ( $this->template_count > 6 ) {
				$output .= '<div class="img-wrap"><img data-src="' . $preview_img . '" alt="' . $name . '" width="300" height="200" /></div><div class="display_cat">' . $cat_display_name . '</div>';
			} else {
				$output .= '<div class="img-wrap"><img src="' . $preview_img . '" alt="' . $name . '" width="300" height="200" /></div><div class="display_cat">' . $cat_display_name . '</div>';
			}

		}
		$output .= apply_filters( 'vc_templates_render_template', $name, $template );
		$output .= <<<HTML
						</div>
						<div class="vc_ui-template-content" data-js-content>
						</div>
					</div>
HTML;

		$this->template_count++;

		// End

		return $output;
	}

	public function default_templates_categories() {
		$results = array(
			'all'            => esc_html__( 'All', 'brook' ),
			'about'          => esc_html__( 'About', 'brook' ),
			'blog'           => esc_html__( 'Blog', 'brook' ),
			'call_to_action' => esc_html__( 'Call To Action', 'brook' ),
			'counters'       => esc_html__( 'Counters', 'brook' ),
			'clients'        => esc_html__( 'Clients', 'brook' ),
			'features'       => esc_html__( 'Features', 'brook' ),
			//'hero_section'   => esc_html__( 'Hero Section', 'brook' ),
			//'google_map'     => esc_html__( 'Google Map', 'brook' ),
			'portfolio'      => esc_html__( 'Portfolio', 'brook' ),
			//'pricing'        => esc_html__( 'Pricing', 'brook' ),
			'services'       => esc_html__( 'Services', 'brook' ),
			'team'           => esc_html__( 'Team', 'brook' ),
			'testimonials'   => esc_html__( 'Testimonials', 'brook' ),
			'shop'           => esc_html__( 'Shop', 'brook' ),
		);

		return $results;
	}

	public function custom_studio_templates_for_vc() {
		$template_image_dir = get_template_directory_uri() . '/assets/admin/images/vc-templates';

		$data = array(

			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about services',
				'image_path'   => $template_image_dir . '/about-01.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" background_image="1727" background_position="center" el_id="section-about"][vc_column][tm_spacer size="sm:100;lg:150"][tm_heading style="modern-02" custom_google_font="" align="center" text="WHAT WE DO"][tm_spacer size="lg:35"][tm_heading custom_google_font="" align="center" el_class="secondary-font" text="We design & build brands, campaigns & digital projects for businesses large & small." font_size="sm:36;md:42;lg:48" line_height="1.25"][tm_spacer size="sm:50;lg:107"][tm_grid centered_items="1" columns="xs:1;sm:1;lg:3" column_gutter="lg:30" row_gutter="lg:50" item_max_width="sm:370"][tm_box_icon align="center" icon_type="ion" icon_ion="ion-ios-eye-outline" heading="Modern Design" text="Brook embraces a modern look with various enhanced pre-defined page elements." button="url:%23|title:More%20details||"][tm_box_icon align="center" icon_type="ion" icon_ion="ion-ios-bookmarks-outline" heading="Multi-purpose Use" text="This is the theme for businesses & companies operating in a wide range of areas." button="url:%23|title:More%20details||"][tm_box_icon align="center" icon_type="ion" icon_ion="ion-ios-browsers-outline" heading="Responsive Design" text="Brook is highly responsive thanks to built-in WPBakery & Slider Revolution plugins." button="url:%23|title:More%20details||"][/tm_grid][tm_spacer size="sm:100;lg:140"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Portfolio', 'brook' ),
				'custom_class' => 'portfolio',
				'image_path'   => $template_image_dir . '/creative-portfolio.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row" background_color="custom" custom_background_color="#000000"][vc_column][tm_spacer size="sm:100;lg:150"][tm_heading style="modern-02" custom_google_font="" align="center" text_color="custom" custom_text_color="#ffffff" text="PORTFOLIO"][tm_spacer size="lg:34"][tm_heading custom_google_font="" font_weight="700" align="center" text_color="custom" custom_text_color="#ffffff" el_class="secondary-font" text="Create and make your dream" font_size="sm:36;md:42;lg:48" line_height="1.25"][tm_spacer size="lg:246"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" lg_spacing="padding_right:150;padding_left:150" md_spacing="padding_right:50;padding_left:50" sm_spacing="padding_right:15;padding_left:15"][vc_column][vc_row_inner content_alignment="center" max_width="1650px"][vc_column_inner][tm_portfolio style="metro" metro_layout="%5B%7B%22size%22%3A%222%3A2%22%7D%2C%7B%22size%22%3A%222%3A1%22%7D%2C%7B%22size%22%3A%221%3A1%22%7D%2C%7B%22size%22%3A%221%3A1%22%7D%5D" overlay_style="faded" number="4" columns="xs:1;sm:2;lg:4" taxonomies="portfolio_tags:business" lg_spacing="margin_top:-110"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Counters', 'brook' ),
				'custom_class' => 'counters',
				'image_path'   => $template_image_dir . '/counters-01.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" lg_spacing="padding_top:142;padding_bottom:111" background_image="2566" background_position="top 30px center" sm_spacing="padding_top:100;padding_bottom:100"][vc_column offset="vc_col-md-5"][tm_heading style="modern-02" custom_google_font="" text="NUMBER SPEAKS"][tm_spacer size="lg:34"][tm_heading style="highlight-secondary-color" custom_google_font="" font_weight="700" el_class="secondary-font" text="We always ready
for a challenge." font_size="sm:36;md:42;lg:48" line_height="1.25"][tm_spacer size="lg:44"][tm_button button="url:%23|title:Learn%20More||"][tm_spacer size="sm:50"][/vc_column][vc_column offset="vc_col-md-7"][vc_row_inner content_alignment="right" sm_content_alignment="left" max_width="600px"][vc_column_inner][tm_counter style="03" align="left" number="1035" text="Successful projects" description="Since its establishment in 2000, Brook Creative has been focusing on project management & implementation through cooperation."][tm_spacer size="lg:76"][tm_counter style="03" align="left" number="2034" text="Unique designs" description="In total, Brook Creative has created more than 2000 projects related to constructional designing and landscaping worldwide."][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Team', 'brook' ),
				'custom_class' => 'team',
				'image_path'   => $template_image_dir . '/team-01.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row][vc_column][tm_spacer size="lg:60"][vc_row_inner][vc_column_inner width="1/2"][tm_heading style="modern-02" custom_google_font="" text="Our creative crew."][tm_spacer size="lg:30"][/vc_column_inner][vc_column_inner width="1/2"][tm_button style="text" button="url:%23|title:View%20all%20members||" align="right" xs_align="left" icon_type="fontawesome5" icon_fontawesome5="fa fa-arrow-right" icon_font_size="lg:12"][tm_spacer size="lg:30"][/vc_column_inner][/vc_row_inner][tm_spacer size="xs:0;lg:18"][tm_grid columns="xs:1;sm:2;lg:4" column_gutter="lg:30" row_gutter="lg:50"][tm_team_member style="03" tooltip_enable="1" tooltip_skin="primary" social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="433" name="Caroline Roses" position="Designer"][tm_team_member style="03" tooltip_enable="1" tooltip_skin="primary" social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="434" name="Blake Hamilton" position="Engineer"][tm_team_member style="03" tooltip_enable="1" tooltip_skin="primary" social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="435" name="Kasahara May" position="Founder"][tm_team_member style="03" tooltip_enable="1" tooltip_skin="primary" social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="436" name="Peter Parker" position="Marketing"][/tm_grid][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Testimonials', 'brook' ),
				'custom_class' => 'testimonials',
				'image_path'   => $template_image_dir . '/testimonials-01.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" background_color="custom" custom_background_color="#f5f5f5"][vc_column][vc_row_inner][vc_column_inner lg_spacing="padding_right:15;padding_left:15"][tm_heading style="modern-02" custom_google_font="" align="center" text="Testimonials"][tm_spacer size="lg:35"][tm_heading custom_google_font="" font_weight="700" align="center" el_class="secondary-font" text="Feedback from our clients." font_size="sm:36;md:42;lg:48" line_height="1.25"][/vc_column_inner][/vc_row_inner][tm_spacer size="lg:83"][tm_testimonial style="carousel-free-mode" number="9" auto_play="" pagination="07" carousel_gutter="lg:30" lg_spacing="margin_left:30" sm_spacing="margin_left:0" taxonomies="testimonial_category:standard"][tm_spacer size="lg:95"][/vc_column][/vc_row]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Blog', 'brook' ),
				'custom_class' => 'blog',
				'image_path'   => $template_image_dir . '/blog-01.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row" background_color="primary" background_attachment="fixed" background_image="2525" background_position="center"][vc_column][tm_spacer size="sm:100;lg:150"][tm_heading style="modern-02" custom_google_font="" align="center" text_color="custom" custom_text_color="#ffffff" text="LATEST NEWS"][tm_spacer size="lg:34"][tm_heading custom_google_font="" font_weight="700" align="center" text_color="custom" custom_text_color="#ffffff" el_class="secondary-font" text="From our blogs." font_size="sm:36;md:42;lg:48" line_height="1.25"][tm_spacer size="lg:328"][/vc_column][/vc_row][vc_row full_width="stretch_row_content"][vc_column][vc_row_inner content_alignment="center" max_width="1470px" lg_spacing="margin_top:-252"][vc_column_inner][tm_blog style="grid-sticky" number="3" taxonomies="post_tag:business" columns="xs:1;sm:2;lg:3" custom_css="JTI0c2VsZWN0b3IlMjAucG9zdC12aWRlbyUyMC5pY29uJTIwJTdCJTBBJTIwJTIwYmFja2dyb3VuZCUzQSUyMCUyM0ZGNUVFMSUzQiUwQSU3RA=="][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][/vc_section]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Features', 'brook' ),
				'custom_class' => 'features about',
				'image_path'   => $template_image_dir . '/features-01.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row" content_placement="middle" el_id="section-about"][vc_column offset="vc_col-md-6"][tm_image image="2656"][tm_spacer size="sm:50"][/vc_column][vc_column offset="vc_col-md-6" lg_spacing="padding_left:85" md_spacing="padding_left:15"][tm_heading style="modern-02" custom_google_font="" text_color="custom" custom_text_color="rgba(255,255,255,0.5)" text="about us"][tm_spacer size="lg:34"][tm_heading style="highlight-02" custom_google_font="" text_color="custom" custom_text_color="#ffffff" text="We're motivated by the desire to achieve." font_size="sm:36;md:42;lg:48" line_height="1.21" max_width="470px"][tm_spacer size="lg:47"][tm_heading tag="div" custom_google_font="" text_color="custom" custom_text_color="#777777" text="In order for you to achieve the things you are capable of, you need to constantly be creating goals for yourself." font_size="lg:18" line_height="1.67"][tm_spacer size="lg:45"][tm_button style="text" button="url:%23|title:More%20details||" hover_animation="icon-move" icon_type="fontawesome5" icon_fontawesome5="fa fa-arrow-right" color="custom" font_color="custom" button_icon_color="custom" icon_font_size="lg:12" text_font_size="lg:15" custom_font_color="#ffffff" custom_button_icon_color="#ffffff"][/vc_column][/vc_row][/vc_section]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Services', 'brook' ),
				'custom_class' => 'services',
				'image_path'   => $template_image_dir . '/services-01.jpg',
				'content'      => <<<CONTENT
[vc_row][vc_column][tm_spacer size="lg:103"][tm_grid columns="xs:1;lg:3" column_gutter="lg:30" row_gutter="lg:50"][tm_box_icon style="02" heading_color="custom" custom_heading_color="#ffffff" text_color="custom" custom_text_color="#777777" image="2730" heading="Modern Design" text="Brook embraces a modern look with various enhanced pre-defined page elements." text_width="320px"][tm_box_icon style="02" heading_color="custom" custom_heading_color="#ffffff" text_color="custom" custom_text_color="#777777" image="2729" heading="Multi-purpose Use" text="This is the theme for businesses & companies operating in a wide range of areas." text_width="320px"][tm_box_icon style="02" heading_color="custom" custom_heading_color="#ffffff" text_color="custom" custom_text_color="#777777" image="2728" heading="Responsive Design" text="Brook is highly responsive thanks to built-in WPBakery Page Builder & Slider Revolution." text_width="320px"][/tm_grid][/vc_column][/vc_row]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Portfolio', 'brook' ),
				'custom_class' => 'portfolio shop',
				'image_path'   => $template_image_dir . '/portfolio-02.jpg',
				'content'      => <<<CONTENT
[vc_row][vc_column][tm_spacer size="lg:126"][vc_row_inner content_placement="bottom"][vc_column_inner width="1/2"][tm_heading style="highlight-02" custom_google_font="" text_color="custom" custom_text_color="#ffffff" text="Featured Projects" font_size="sm:36;md:42;lg:48" line_height="1.21"][tm_spacer size="xs:20"][/vc_column_inner][vc_column_inner width="1/2"][tm_button style="text" button="url:%23|title:View%20all%20projects||" hover_animation="icon-move" align="right" xs_align="left" icon_type="fontawesome5" icon_fontawesome5="fa fa-arrow-right" color="custom" font_color="custom" button_icon_color="custom" icon_font_size="lg:12" text_font_size="lg:15" custom_font_color="#ffffff" custom_button_icon_color="#ffffff"][/vc_column_inner][/vc_row_inner][tm_spacer size="sm:40;lg:70"][tm_portfolio style="carousel-auto-wide-02" overlay_style="faded-04" carousel_pagination="08" carousel_gutter="40" lg_spacing="margin_right:-375" md_spacing="margin_right:0" carousel_auto_play="4000" taxonomies="portfolio_tags:standard"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Counters', 'brook' ),
				'custom_class' => 'counters',
				'image_path'   => $template_image_dir . '/counters-02.jpg',
				'content'      => <<<CONTENT
[vc_row][vc_column][tm_heading style="modern-02" custom_google_font="" text_color="custom" custom_text_color="rgba(255,255,255,0.5)" text="Number speaks"][tm_spacer size="lg:48"][/vc_column][/vc_row]t:-375" md_spacing="margin_right:0" carousel_auto_play="4000" taxonomies="portfolio_tags:standard"][/vc_column][/vc_row][vc_section][/vc_section]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Testimonials', 'brook' ),
				'custom_class' => 'testimonials',
				'image_path'   => $template_image_dir . '/testimonials-05.jpg',
				'content'      => <<<CONTENT
[vc_row][vc_column offset="vc_col-md-5" lg_spacing="padding_right:70" md_spacing="padding_right:15"][tm_heading style="highlight-02" custom_google_font="" text_color="custom" custom_text_color="#ffffff" text="Always ready for a challenge." font_size="sm:36;md:42;lg:48" line_height="1.21" max_width="470px"][tm_spacer size="lg:30"][tm_heading tag="div" custom_google_font="" text_color="custom" custom_text_color="#777777" text="Nothing is more important than having a desire deep down to achieve goals." font_size="lg:18" line_height="1.67"][tm_spacer size="sm:50"][/vc_column][vc_column offset="vc_col-md-7"][tm_grid columns="xs:1;lg:3" column_gutter="lg:30" row_gutter="lg:50"][tm_counter style="04" number_color="custom" text_color="custom" icon_type="ion" icon_ion="ion-ios-eye-outline" number="2034" text="Unique designs" custom_number_color="#ffffff" custom_text_color="#ffffff"][tm_counter style="04" number_color="custom" text_color="custom" icon_type="ion" icon_ion="ion-ios-filing-outline" number="580" text="Completed projects" number_prefix="+" custom_number_color="#ffffff" custom_text_color="#ffffff"][tm_counter style="04" number_color="custom" text_color="custom" icon_type="ion" icon_ion="ion-ios-home-outline" number="2376" text="Global partners" custom_number_color="#ffffff" custom_text_color="#ffffff"][/tm_grid][/vc_column][/vc_row]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Blog', 'brook' ),
				'custom_class' => 'blog',
				'image_path'   => $template_image_dir . '/blog-02.jpg',
				'content'      => <<<CONTENT
[vc_row][vc_column][tm_spacer size="lg:114"][vc_row_inner content_placement="bottom"][vc_column_inner width="1/2"][tm_heading style="highlight-02" custom_google_font="" text_color="custom" custom_text_color="#ffffff" text="Blog Updates" font_size="sm:36;md:42;lg:48" line_height="1.21"][tm_spacer size="xs:20"][/vc_column_inner][vc_column_inner width="1/2"][tm_button style="text" button="url:%23|title:View%20all%20posts||" hover_animation="icon-move" align="right" xs_align="left" icon_type="fontawesome5" icon_fontawesome5="fa fa-arrow-right" color="custom" font_color="custom" button_icon_color="custom" icon_font_size="lg:12" text_font_size="lg:15" custom_font_color="#ffffff" custom_button_icon_color="#ffffff"][/vc_column_inner][/vc_row_inner][tm_spacer size="sm:40;lg:70"][tm_blog style="grid-classic-02" number="4" taxonomies="post_tag:format" columns="xs:1;sm:2;lg:4" column_gutter="lg:30" row_gutter="lg:40"][tm_spacer size="lg:120"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Call To Action', 'brook' ),
				'custom_class' => 'call_to_action',
				'image_path'   => $template_image_dir . '/cta-01.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" background_color="gradient" effect="firefly" firefly_color="#ffffff" firefly_total="40" firefly_min_size="2" firefly_max_size="4" background_gradient="background: -webkit-gradient(linear, left top, left bottom, color-stop(5%, #4EA132), color-stop(47%, #FE5448), color-stop(100%, #FE378D));background: -moz-linear-gradient(230deg,#4EA132 5%,#FE5448 47%,#FE378D 100%);background: -webkit-linear-gradient(230deg,#4EA132 5%,#FE5448 47%,#FE378D 100%);background: -o-linear-gradient(230deg,#4EA132 5%,#FE5448 47%,#FE378D 100%);background: -ms-linear-gradient(230deg,#4EA132 5%,#FE5448 47%,#FE378D 100%);background: linear-gradient(230deg,#4EA132 5%,#FE5448 47%,#FE378D 100%);"][vc_column][tm_spacer size="lg:121"][tm_heading style="modern-02" tag="h6" custom_google_font="" align="center" text_color="custom" custom_text_color="#ffffff" text="Build a creative website in no time"][tm_spacer size="lg:24"][tm_heading style="highlight-03" custom_google_font="" align="center" text_color="custom" custom_text_color="#ffffff" text="Ready to enjoy Brook Studio ?" font_size="sm:36;md:42;lg:48" line_height="1.21"][tm_spacer size="lg:59"][tm_button button="url:%23|title:Contact%20us||" align="center" icon_type="fontawesome5" icon_fontawesome5="fa fa-arrow-right" color="custom" button_bg_color="custom" font_color="custom" button_icon_color="custom" button_bg_color_hover="custom" font_color_hover="custom" button_icon_color_hover="custom" custom_button_bg_color="#ffffff" custom_font_color="#222222" custom_button_icon_color="#222222" custom_button_bg_color_hover="#ffffff" custom_font_color_hover="#222222" custom_button_icon_color_hover="#222222" icon_font_size="lg:12"][tm_spacer size="lg:110"][/vc_column][/vc_row][tm_blog style="grid-classic-02" number="4" taxonomies="post_tag:format" columns="xs:1;sm:2;lg:4" column_gutter="lg:30" row_gutter="lg:40"][tm_spacer size="lg:120"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Services', 'brook' ),
				'custom_class' => 'services',
				'image_path'   => $template_image_dir . '/services-02.jpg',
				'content'      => <<<CONTENT
[vc_row background_size="auto" background_image="1465" background_position="top 122px center" el_id="section-about"][vc_column][tm_spacer size="sm:100;lg:140"][tm_heading custom_google_font="" font_weight="700" align="center" el_class="secondary-font" text="We're always ready for challenges." font_size="sm:36;md:42;lg:48" line_height="1.32"][tm_spacer size="lg:78"][tm_slider image_size="500x244" auto_height="" nav="08" gutter="30" fw_image="1" items_display="xs:1;sm:2;md:3;lg:3" items="%5B%7B%22image%22%3A%221044%22%2C%22title%22%3A%22UI%2FUX%20designs%22%2C%22text%22%3A%22We%20successfully%20implemented%20numerous%20UI%2FUX%20projects%20for%20both%20global%20%26%20local%20clients.%20%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AUI%252FUX%2520design%7C%7C%22%7D%2C%7B%22image%22%3A%221411%22%2C%22title%22%3A%22Digital%20marketing%20%22%2C%22text%22%3A%22We%20conduct%20the%20marketing%20of%20products%20%26%20services%20using%20latest%20digital%20technologies.%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3ADigital%2520strategy%7C%7C%22%7D%2C%7B%22image%22%3A%221404%22%2C%22title%22%3A%22SEO%20marketing%22%2C%22text%22%3A%22Our%20approach%20is%20to%20focus%20on%20growing%20visibility%20in%20organic%20search%20engine%20results.%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3ASEO%2520marketing%7C%7C%22%7D%2C%7B%22image%22%3A%22614%22%2C%22title%22%3A%22Resource%20use%22%2C%22text%22%3A%22We%20participate%20in%20knowledge%20and%20technology%20transfers%20to%20promote%20the%20resource%20use.%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3ASEO%2520marketing%7C%7C%22%7D%5D" auto_play="5000"][tm_spacer size="lg:104"][/vc_column][/vc_row]
CONTENT
			),


			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about services',
				'image_path'   => $template_image_dir . '/about-02.jpg',
				'content'      => <<<CONTENT
[vc_section full_width="stretch_row" background_size="contain" background_image="1423" background_position="bottom center"][vc_row][vc_column][tm_popup_video style="button-02" video="https://www.youtube.com/watch?v=9No-FiEInLA" video_text="Watch video"][/vc_column][/vc_row][vc_row full_width="stretch_row_content" content_placement="middle" lg_spacing="padding_top:17;padding_bottom:25"][vc_column offset="vc_col-md-6"][tm_spacer size="sm:50"][vc_row_inner content_alignment="right" sm_content_alignment="center" max_width="600px"][vc_column_inner][tm_heading custom_google_font="" font_weight="700" el_class="secondary-font" text="We're motivated by the desire to achieve." font_size="sm:36;md:42;lg:48" line_height="1.32"][tm_spacer size="lg:80"][tm_box_icon style="02" icon_type="linea" icon_linea="linea-basic-globe" heading="Successful projects" text="Since its establishment in 2000, Brook Creative has been focusing on project management & implementation through cooperation." text_width="450px"][tm_spacer size="lg:37"][tm_box_icon style="02" icon_type="linea" icon_linea="linea-basic-mouse" heading="Unique designs" text="In total, Brook Creative has created more than 2000 projects related to constructional designing and landscaping worldwide." text_width="450px"][/vc_column_inner][/vc_row_inner][tm_spacer size="sm:50"][/vc_column][vc_column offset="vc_col-md-6"][tm_image align="center" image="1417"][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Call To Action', 'brook' ),
				'custom_class' => 'call_to_action',
				'image_path'   => $template_image_dir . '/cta-02.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" content_placement="middle" background_color="primary" lg_spacing="padding_top:72;padding_bottom:72"][vc_column width="2/3"][tm_heading custom_google_font="" font_weight="700" xs_align="center" text_color="custom" custom_text_color="#ffffff" el_class="secondary-font" text="We're motivated by the desire to achieve." font_size="sm:24;md:30;lg:36"][tm_spacer size="xs:30"][/vc_column][vc_column width="1/3"][tm_button button="url:%23|title:Find%20out%20more||" align="right" xs_align="center" color="custom" button_bg_color="custom" font_color="custom" button_border_color="custom" custom_button_bg_color="#ffffff" custom_button_border_color="#ffffff" custom_font_color="#222222"][/vc_column][/vc_row]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Portfolio', 'brook' ),
				'custom_class' => 'portfolio',
				'image_path'   => $template_image_dir . '/portfolio-01.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" background_color="custom" separator_type="square" separator_color="primary" custom_background_color="#f5f5f5" separator_height="lg:90"][vc_column][tm_spacer size="sm:100;lg:150"][tm_heading style="modern-02" custom_google_font="" align="center" text="PORTFOLIOS"][tm_spacer size="lg:34"][tm_heading custom_google_font="" font_weight="700" align="center" el_class="secondary-font" text="Selected works." font_size="sm:36;md:42;lg:48" line_height="1.32"][tm_spacer size="lg:60"][tm_portfolio style="grid-caption-video-popup" number="6" columns="xs:1;sm:2;lg:3" column_gutter="lg:30" row_gutter="lg:30" taxonomies="portfolio_tags:standard"][tm_spacer size="sm:100;lg:150"][/vc_column][/vc_row]
CONTENT
			),


			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/about-03.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row"][vc_column][tm_spacer size="sm:100;lg:150"][tm_heading style="modern-02" custom_google_font="" align="center" text="REASONS WHY"][tm_spacer size="lg:33"][tm_heading custom_google_font="" font_weight="700" align="center" el_class="secondary-font" text="We're trusted by clients" font_size="sm:36;md:42;lg:48" line_height="1.32"][tm_spacer size="lg:80"][tm_grid centered_items="1" columns="xs:1;sm:2;lg:3" column_gutter="lg:30" row_gutter="lg:50" item_max_width="lg:290"][tm_box_icon style="03" align="center" icon_type="ion" icon_ion="ion-ios-eye-outline" heading="Modern Design" text="Brook embraces a modern look with various enhanced pre-defined page elements." button="|||"][tm_box_icon style="03" align="center" icon_type="ion" icon_ion="ion-ios-bookmarks-outline" heading="Multi-purpose Use" text="This is the theme for businesses & companies operating in a wide range of areas." button="|||"][tm_box_icon style="03" align="center" icon_type="ion" icon_ion="ion-ios-browsers-outline" heading="Responsive Design" text="Brook is highly responsive thanks to built-in WPBakery Page Builder & Slider Revolution." button="|||"][/tm_grid][tm_spacer size="sm:100;lg:124"][/vc_column][/vc_row][/vc_section]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Testimonials', 'brook' ),
				'custom_class' => 'testimonials',
				'image_path'   => $template_image_dir . '/testimonials-03.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" background_color="custom" separator_type="triangle" separator_position="top" custom_separator_color="#ffffff" custom_background_color="#f5f5f5" separator_height="lg:27"][vc_column][tm_spacer size="sm:100;lg:150"][tm_testimonial gutter="30" number="6" columns="xs:1;sm:2;lg:3" taxonomies="testimonial_category:standard"][tm_spacer size="lg:47"][tm_button style="text" button="url:%23|title:More%20testimonials||" hover_animation="icon-move" align="center" icon_type="fontawesome5" icon_fontawesome5="fa fa-arrow-right" text_font_size="lg:16" icon_font_size="lg:12"][tm_spacer size="sm:100;lg:150"][/vc_column][/vc_row]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Services', 'brook' ),
				'custom_class' => 'services',
				'image_path'   => $template_image_dir . '/services-03.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row" background_image="2807" background_position="center" el_id="section-our-services"][vc_column][tm_spacer size="lg:115"][tm_heading style="below-separator" custom_google_font="" align="center" text="Best services save the world" font_size="sm:28;md:34;lg:40" line_height="1.4"][tm_spacer size="lg:82"][tm_grid columns="xs:1;lg:3" column_gutter="lg:30" row_gutter="lg:50"][tm_box_icon style="04" align="center" image="2810" heading="Modern Design" link="|||" text="Brook embraces a modern look with various enhanced pre-defined page elements." button="url:%23|title:More%20details||"][tm_box_icon style="04" align="center" image="2809" heading="Multi-purpose Use" link="|||" text="This is the theme for businesses & companies operating in a wide range of areas." button="url:%23|title:More%20details||"][tm_box_icon style="04" align="center" image="2808" heading="Responsive Design" link="|||" text="Brook is highly responsive thanks to built-in WPBakery Page Builder & Slider Revolution plugins." button="url:%23|title:More%20details||"][/tm_grid][tm_spacer size="lg:72"][tm_heading tag="div" custom_google_font="" align="center" text="Since its establishment in 2000, Brook Creative has been focusing on project management & implementation through global cooperation & partners." font_size="lg:16" line_height="1.88" max_width="730px"][tm_spacer size="lg:44"][tm_button button="url:%23|title:Learn%20More||" align="center"][tm_spacer size="lg:118"][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Team', 'brook' ),
				'custom_class' => 'team',
				'image_path'   => $template_image_dir . '/team-02.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row"][vc_column][tm_spacer size="sm:100;lg:115"][tm_heading style="below-separator" custom_google_font="" align="center" text="Teamwork makes the dream works" font_size="sm:28;md:34;lg:40" line_height="1.4"][tm_spacer size="lg:83"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces"][vc_column][tm_slider_group nav="03" gutter="75" auto_play="5000" items_display="xs:1;sm:2;md:3;lg:5"][tm_team_member social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="433" name="Caroline Roses" position="Designer"][tm_team_member social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="434" name="John Doe" position="Founder"][tm_team_member social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="435" name="Kasahara May" position="Project manager"][tm_team_member social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="434" name="Blake Hamilton" position="Engineer"][tm_team_member social_networks="%5B%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-facebook%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Facebook%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-twitter%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Twitter%22%7D%2C%7B%22icon_type%22%3A%22fontawesome5%22%2C%22icon_fontawesome5%22%3A%22fab%20fa-instagram%22%2C%22icon_ion%22%3A%22ion-alert%22%2C%22link%22%3A%22%23%22%2C%22title%22%3A%22Instagram%22%7D%5D" photo="437" name="Sarah Vagan" position="Marketing"][/tm_slider_group][tm_spacer size="sm:100;lg:138"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Features', 'brook' ),
				'custom_class' => 'features',
				'image_path'   => $template_image_dir . '/features-02.jpg',
				'content'      => <<<CONTENT
[/vc_row][vc_row full_width="stretch_row_content_no_spaces" content_placement="middle" background_color="custom" custom_background_color="#f9f9f9"][vc_column offset="vc_col-md-6"][tm_image image_size="custom" full_wide="1" image="2871" image_size_width="960" image_size_height="650"][/vc_column][vc_column offset="vc_col-md-6" lg_spacing="padding_right:15;padding_left:150" md_spacing="padding_left:50" sm_spacing="padding_left:15"][vc_row_inner max_width="610px"][vc_column_inner][tm_heading style="below-separator" custom_google_font="" text="Best services save the world" font_size="sm:28;md:34;lg:40" line_height="1.4"][tm_spacer size="lg:42"][tm_heading tag="div" custom_google_font="" text="Our quality of service assessment involves controlling and managing resources by setting priorities for specific types of clients and projects on the system." font_size="lg:16" line_height="1.88"][tm_spacer size="lg:59"][tm_button button="url:%23|title:Learn%20More||"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Clients', 'brook' ),
				'custom_class' => 'clients',
				'image_path'   => $template_image_dir . '/client-02.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row][vc_column][tm_spacer size="lg:100"][vc_row_inner content_placement="middle"][vc_column_inner offset="vc_col-md-5"][tm_heading style="below-separator" custom_google_font="" text="Company Clients" font_size="sm:28;md:34;lg:40" line_height="1.4"][tm_spacer size="lg:45"][tm_heading tag="div" custom_google_font="" text="We work with clients from all over the world. We had worked with and serving over 2000 customers and 1000 global companies across 13 countries with over 90% satisfaction rate achieved." font_size="lg:16" line_height="1.88"][tm_spacer size="lg:34"][tm_button style="text" button="url:%23|title:Work%20with%20us||" hover_animation="icon-move" icon_type="fontawesome5" icon_fontawesome5="fa fa-arrow-right" color="custom" button_icon_color="primary" icon_font_size="lg:12"][/vc_column_inner][vc_column_inner offset="vc_col-md-offset-1 vc_col-md-6"][tm_client style="grid-no-border" gutter="0" items="%5B%7B%22image%22%3A%22500%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252001%7C%7C%22%7D%2C%7B%22image%22%3A%22499%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252002%7C%7C%22%7D%2C%7B%22image%22%3A%22498%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252003%7C%7C%22%7D%2C%7B%22image%22%3A%22497%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252004%7C%7C%22%7D%2C%7B%22image%22%3A%22496%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252005%7C%7C%22%7D%2C%7B%22image%22%3A%22495%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252006%7C%7C%22%7D%5D" columns="xs:1;sm:2;lg:3" items_display="xs:2;sm:3;md:4;lg:6"][/vc_column_inner][/vc_row_inner][tm_spacer size="lg:100"][/vc_column][/vc_row][/vc_section]
CONTENT
			),


			array(
				'name'         => esc_html__( 'Clients', 'brook' ),
				'custom_class' => 'clients',
				'image_path'   => $template_image_dir . '/client-01.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row"][vc_column][tm_spacer size="sm:40;lg:62"][tm_client gutter="30" auto_play="5000" items_display="xs:2;sm:3;md:4;lg:5" items="%5B%7B%22image%22%3A%22500%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252001%7C%7C%22%7D%2C%7B%22image%22%3A%22499%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252001%7C%7C%22%7D%2C%7B%22image%22%3A%22498%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252003%7C%7C%22%7D%2C%7B%22image%22%3A%22497%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252004%7C%7C%22%7D%2C%7B%22image%22%3A%22496%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252005%7C%7C%22%7D%2C%7B%22image%22%3A%22495%22%2C%22link%22%3A%22url%3A%2523%7Ctitle%3AClient%2520Logo%252006%7C%7C%22%7D%5D"][tm_spacer size="sm:40;lg:62"][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Testimonials', 'brook' ),
				'custom_class' => 'testimonials',
				'image_path'   => $template_image_dir . '/testimonials-02.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" content_placement="middle" background_color="custom" custom_background_color="#222222" background_image="2827" background_position="left top"][vc_column width="1/2"][tm_spacer size="sm:100;lg:150"][vc_row_inner content_alignment="right" sm_content_alignment="center" max_width="600px"][vc_column_inner][tm_heading custom_google_font="" text_color="custom" custom_text_color="#ffffff" text="What
people say
about us" font_size="sm:36;md:42;lg:48" line_height="1.4"][/vc_column_inner][/vc_row_inner][tm_spacer size="sm:100;lg:150"][/vc_column][vc_column width="1/2"][tm_testimonial style="carousel-03" number="9" auto_play="" nav="03" carousel_gutter="lg:30" carousel_items_display="xs:1;sm:2;lg:3" taxonomies="testimonial_category:standard"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Blog', 'brook' ),
				'custom_class' => 'blog',
				'image_path'   => $template_image_dir . '/blog-03.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row"][vc_column][tm_spacer size="sm:100;lg:131"][tm_heading style="below-separator" custom_google_font="" align="center" text="Sharing your thoughts everyday" font_size="sm:28;md:34;lg:40" line_height="1.4"][tm_spacer size="lg:79"][tm_blog style="grid-simple" number="3" taxonomies="post_tag:format" columns="xs:1;sm:2;lg:3" column_gutter="lg:30" row_gutter="lg:50"][tm_spacer size="lg:93"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/about-04.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" content_placement="middle" lg_spacing="padding_top:90;padding_bottom:117"][vc_column offset="vc_col-md-6"][vc_row_inner content_alignment="right" sm_content_alignment="center" max_width="600px" lg_spacing="padding_right:80" md_spacing="padding_right:15" sm_spacing="padding_right:0"][vc_column_inner][tm_heading style="modern" tag="h6" custom_google_font="" text_color="custom" custom_text_color="#b8b8b8" text="our story"][tm_spacer size="lg:25"][tm_heading custom_google_font="" text="Running a
successful business since 2000" font_size="sm:36;md:42;lg:48" line_height="1.25"][tm_spacer size="lg:47"][tm_heading tag="h5" custom_google_font="" text="Architecture is both the process and the product of planning, designing, and constructing buildings or any other structures." font_size="lg:18" line_height="1.67"][tm_spacer size="lg:21"][tm_heading tag="div" custom_google_font="" text="Architectural works, in the material form of buildings, are often perceived as cultural symbols and as works of art. Historical civilizations are often identified with their surviving architectural achievements."][tm_spacer size="lg:57"][tm_image image="3111"][/vc_column_inner][/vc_row_inner][tm_spacer size="sm:60"][/vc_column][vc_column offset="vc_col-md-6"][tm_image full_wide="1" image="3114"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Portfolio', 'brook' ),
				'custom_class' => 'portfolio',
				'image_path'   => $template_image_dir . '/portfolio-03.jpg',
				'content'      => <<<CONTENT
[vc_row][vc_column][tm_spacer size="lg:107"][tm_heading custom_google_font="" text="Latest Projects" font_size="sm:36;md:42;lg:48" line_height="1.25"][tm_spacer size="lg:60"][tm_portfolio style="metro-with-caption" metro_layout="%5B%7B%22size%22%3A%221%3A1%22%7D%2C%7B%22size%22%3A%222%3A1%22%7D%2C%7B%22size%22%3A%221%3A1%22%7D%2C%7B%22size%22%3A%221%3A1%22%7D%2C%7B%22size%22%3A%221%3A1%22%7D%2C%7B%22size%22%3A%222%3A1%22%7D%5D" number="6" filter_enable="1" filter_counter="1" filter_counter_style="02" filter_align="right" columns="xs:1;sm:2;lg:4" column_gutter="sm:30;lg:50" row_gutter="sm:30;lg:50" lg_spacing="margin_top:-110" sm_spacing="margin_top:0" taxonomies="portfolio_tags:architecture"][tm_spacer size="lg:61"][tm_button button="url:%23|title:Learn%20More||" align="center" color="custom" button_bg_color="primary" font_color="secondary" button_border_color="primary" button_icon_color="secondary"][tm_spacer size="sm:100;lg:120"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Testimonials', 'brook' ),
				'custom_class' => 'testimonials',
				'image_path'   => $template_image_dir . '/testimonials-04.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row_content" equal_height="yes" background_color="secondary"][vc_column width="1/2" background_size="auto" background_image="3108" background_position="left bottom"][tm_spacer size="lg:120"][vc_row_inner content_alignment="center" max_width="580px"][vc_column_inner][tm_testimonial style="simple-slider" number="9" text_color="custom" custom_text_color="#ffffff" name_color="custom" custom_name_color="#ffffff" by_line_color="custom" custom_by_line_color="#ffffff" auto_play="5000" taxonomies="testimonial_category:modern" carousel_gutter="lg:30"][/vc_column_inner][/vc_row_inner][tm_spacer size="lg:122"][/vc_column][vc_column width="1/2" background_image="3103"][tm_spacer size="lg:500"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Blog', 'brook' ),
				'custom_class' => 'blog',
				'image_path'   => $template_image_dir . '/blog-04.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row" background_color="custom" custom_background_color="#f7f7f7"][vc_column][tm_spacer size="lg:120"][vc_row_inner content_placement="middle"][vc_column_inner width="1/2"][tm_heading custom_google_font="" text="Blog Updates" font_size="sm:36;md:42;lg:48" line_height="1.25"][/vc_column_inner][vc_column_inner width="1/2"][tm_button style="text-long-arrow" button="url:%23|title:View%20all%20posts||" align="right" color="custom" font_color="secondary"][/vc_column_inner][/vc_row_inner][tm_spacer size="lg:72"][tm_blog style="grid-modern" number="3" columns="xs:1;sm:2;lg:3" column_gutter="sm:30;lg:60" row_gutter="lg:50" taxonomies="post_tag:architecture"][tm_spacer size="sm:100;lg:110"][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Services', 'brook' ),
				'custom_class' => 'services',
				'image_path'   => $template_image_dir . '/services-04.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" equal_height="yes" content_placement="middle" background_color="primary"][vc_column offset="vc_col-md-6" lg_spacing="padding_right:15;padding_left:15"][tm_spacer size="lg:100"][tm_grid align="right" sm_align="center" columns="xs:1;lg:2" column_gutter="lg:30" row_gutter="sm:50;lg:70" max_width="lg:570"][tm_box_icon style="02" icon_type="ion" icon_ion="ion-ios-infinite" heading_color="custom" custom_heading_color="#ffffff" icon_color="custom" custom_icon_color="#ffffff" text_color="custom" custom_text_color="#ffffff" heading="Digital marketing" text="We conduct the marketing of products & services using latest digital technologies."][tm_box_icon style="02" icon_type="ion" icon_ion="ion-monitor" heading_color="custom" custom_heading_color="#ffffff" icon_color="custom" custom_icon_color="#ffffff" text_color="custom" custom_text_color="#ffffff" heading="UI/UX designs" text="We successfully implemented numerous UI/UX projects for both global & local clients."][tm_box_icon style="02" icon_type="ion" icon_ion="ion-ios-baseball-outline" heading_color="custom" custom_heading_color="#ffffff" icon_color="custom" custom_icon_color="#ffffff" text_color="custom" custom_text_color="#ffffff" heading="SEO marketing" text="Our SEO approach is to focus on growing visibility in organic search engine results."][tm_box_icon style="02" icon_type="ion" icon_ion="ion-pinpoint" heading_color="custom" custom_heading_color="#ffffff" icon_color="custom" custom_icon_color="#ffffff" text_color="custom" custom_text_color="#ffffff" heading="Resource use" text="We participate in knowledge and technology transfers to promote the resource use."][/tm_grid][tm_spacer size="lg:100"][/vc_column][vc_column offset="vc_col-md-6"][vc_row_inner content_placement="middle" content_alignment="right" sm_content_alignment="center" background_color="custom" overlay_background="custom" overlay_custom_background="#1d41e3" overlay_opacity="90" max_width="845px" custom_background_color="#1d41e3" lg_spacing="padding_top:168;padding_bottom:168" sm_spacing="padding_top:120;padding_bottom:120" background_image="2180"][vc_column_inner width="1/3"][tm_popup_video style="button" align="center" video="https://www.youtube.com/watch?v=9No-FiEInLA"][tm_spacer size="xs:30"][/vc_column_inner][vc_column_inner width="2/3" lg_spacing="padding_right:100" md_spacing="padding_right:35" sm_spacing="padding_right:15"][tm_heading custom_google_font="" xs_align="center" text_color="custom" custom_text_color="#ffffff" text="We help our clients succeed by delivering products that improve life, work and play." font_size="sm:20;md:26;lg:32" line_height="1.875"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/about-05.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row"][vc_column][tm_spacer size="sm:100;lg:150"][vc_row_inner][vc_column_inner offset="vc_col-md-offset-2 vc_col-md-10"][tm_heading custom_google_font="" text_color="primary" text="What we do" font_size="lg:18" line_height="1.39"][tm_spacer size="lg:30"][tm_heading custom_google_font="" text="Effective solution
for every businesses" font_size="sm:24;md:30;lg:36" line_height="1.42"][tm_spacer size="lg:59"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner offset="vc_col-md-2"][tm_spacer size="lg:12"][tm_separator][tm_spacer size="lg:30"][/vc_column_inner][vc_column_inner offset="vc_col-md-4"][tm_heading custom_google_font="" text_color="primary" text="Fresh ideas" font_size="lg:18" line_height="1.39"][tm_spacer size="lg:21"][tm_heading tag="div" custom_google_font="" text="Brook presents your services with flexible, convenient and multipurpose layouts. You can select your favorite layouts & elements for particular projects with unlimited customization possibilities."][tm_spacer size="lg:40"][/vc_column_inner][vc_column_inner offset="vc_col-md-offset-1 vc_col-md-4"][tm_heading custom_google_font="" text_color="primary" text="Unique designs" font_size="lg:18" line_height="1.39"][tm_spacer size="lg:21"][tm_heading tag="div" custom_google_font="" text="Pixel-perfect replication of the designers is intended for both front-end & back-end developers to build their pages with greater comfort thanks to the higher customizability as well as flexibility."][tm_spacer size="lg:40"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width="stretch_row" content_placement="middle" background_size="auto" background_image="2143" background_position="right center" lg_spacing="margin_bottom:22;padding_top:113;padding_bottom:113" sm_spacing="margin_bottom:0;padding_top:20;padding_bottom:100"][vc_column offset="vc_col-md-7"][tm_image image="2141"][tm_spacer size="sm:20"][/vc_column][vc_column offset="vc_col-md-5"][tm_heading custom_google_font="" text="Effective solution
for every businesses" font_size="sm:24;md:30;lg:36" line_height="1.42"][tm_spacer size="lg:25"][tm_heading tag="div" custom_google_font="" text="We work with clients from all over the world. We had worked with and serving over 2000 customers and 1000 global companies across 13 countries with over 90% satisfaction rate achieved."][tm_spacer size="lg:40"][tm_button style="text" button="url:%23|title:More%20details||" icon_type="fontawesome5" icon_fontawesome5="fa fa-arrow-right" icon_font_size="lg:12"][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/about-06.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" lg_spacing="padding_bottom:100" sm_spacing="padding_bottom:50" el_id="section-about"][vc_column offset="vc_col-lg-5 vc_col-md-6"][tm_heading custom_google_font="" text="Awesome landing
page design." font_size="sm:36;md:42;lg:48" line_height="1.4"][tm_spacer size="lg:25"][tm_heading tag="div" custom_google_font="" text="We learn from landing page's best practices and great landing pages in order to create a clear, crisp design that suits all your needs for a responsive landing site." font_size="lg:18" line_height="1.67"][tm_spacer size="lg:50"][/vc_column][vc_column offset="vc_col-lg-offset-1 vc_col-md-6"][tm_box_icon style="02" icon_type="linea" icon_linea="linea-basic-globe" heading="Successful projects" text="Since its establishment in 2000, Brook Creative has been focusing on project management & implementation through cooperation." text_width="450px"][tm_spacer size="lg:37"][tm_box_icon style="02" icon_type="linea" icon_linea="linea-basic-mouse" heading="Unique designs" text="In total, Brook Creative has created more than 2000 projects related to constructional designing and landscaping industries worldwide." text_width="450px"][tm_spacer size="lg:50"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Services', 'brook' ),
				'custom_class' => 'services',
				'image_path'   => $template_image_dir . '/services-05.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" content_placement="middle"][vc_column offset="vc_col-md-6" lg_spacing="padding_right:60" md_spacing="padding_right:0"][tm_image image_size="custom" full_wide="1" image="2932" image_size_width="960" image_size_height="650"][/vc_column][vc_column offset="vc_col-md-6" lg_spacing="padding_right:30;padding_left:65" sm_spacing="padding_left:30"][tm_spacer size="lg:100"][tm_heading custom_google_font="" text="We are delivering beautiful
digital products for you" font_size="sm:36;md:42;lg:48" line_height="1.4"][tm_spacer size="lg:85"][tm_grid columns="xs:1;lg:2" column_gutter="sm:30;lg:70" row_gutter="sm:50;lg:70" max_width="lg:700"][tm_box_icon style="02" icon_type="ion" icon_ion="ion-ios-infinite" heading="Digital marketing" text="We conduct the marketing of products & services using latest digital technologies."][tm_box_icon style="02" icon_type="ion" icon_ion="ion-monitor" heading="UI/UX designs" text="We successfully implemented numerous UI/UX projects for both global & local clients."][tm_box_icon style="02" icon_type="ion" icon_ion="ion-ios-baseball-outline" heading="SEO marketing" text="Our SEO approach is to focus on growing visibility in organic search engine results."][tm_box_icon style="02" icon_type="ion" icon_ion="ion-pinpoint" heading="Resource use" text="We participate in knowledge and technology transfers to promote the resource use."][/tm_grid][tm_spacer size="lg:100"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/about-07.jpg',
				'content'      => <<<CONTENT
[vc_section][vc_row full_width="stretch_row" content_placement="middle" height="full-calc" background_size="manual" background_image="1908" background_position="top right" background_size_manual="auto 100%"][vc_column offset="vc_col-md-9"][tm_heading custom_google_font="" text_color="primary" text="We're always ready for challenges." font_size="sm:36;md:42;lg:48" line_height="1.11"][tm_spacer size="lg:92"][vc_row_inner][vc_column_inner offset="vc_col-md-2"][tm_spacer size="lg:10"][tm_separator style="thin-short-line"][/vc_column_inner][vc_column_inner offset="vc_col-md-4"][tm_heading custom_google_font="" text="Fresh ideas" font_size="sm:18;md:21;lg:24" line_height="1.13"][tm_spacer size="lg:26"][tm_heading tag="div" custom_google_font="" text="Since its establishment in 2000, Brook Creative has been focusing on project management & implementation through global cooperation."][/vc_column_inner][vc_column_inner width="1/3" offset="vc_col-md-offset-1"][tm_heading custom_google_font="" text="Unique designs" font_size="sm:18;md:21;lg:24" line_height="1.13"][tm_spacer size="lg:26"][tm_heading tag="div" custom_google_font="" text="In total, Brook Creative has created more than 2000 original projects related to constructional designing and landscaping industries worldwide."][/vc_column_inner][/vc_row_inner][tm_spacer size="lg:78"][vc_row_inner][vc_column_inner offset="vc_col-md-offset-2 vc_col-md-8"][vc_progress_bar bar_height="4" values="%5B%7B%22label%22%3A%22UI%2FUX%22%2C%22value%22%3A%2285%22%2C%22custom_background_color%22%3A%22%23222222%22%2C%22custom_track_color%22%3A%22%23ededed%22%2C%22custom_text_color%22%3A%22%23333333%22%7D%2C%7B%22label%22%3A%22Ideas%22%2C%22value%22%3A%2270%22%2C%22custom_background_color%22%3A%22%23222222%22%2C%22custom_track_color%22%3A%22%23ededed%22%2C%22custom_text_color%22%3A%22%23333333%22%7D%2C%7B%22label%22%3A%22Marketing%22%2C%22value%22%3A%2290%22%2C%22custom_background_color%22%3A%22%23222222%22%2C%22custom_track_color%22%3A%22%23ededed%22%2C%22custom_text_color%22%3A%22%23333333%22%7D%5D" units="%"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Features', 'brook' ),
				'custom_class' => 'features services shop',
				'image_path'   => $template_image_dir . '/features-03.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" content_placement="middle"][vc_column offset="vc_col-md-5"][tm_spacer size="lg:25"][tm_image align="right" sm_align="center" image="2039" lg_spacing="margin_left:-180" md_spacing="margin_left:0"][tm_spacer size="lg:28"][/vc_column][vc_column offset="vc_col-md-6"][tm_spacer size="sm:20;lg:100"][tm_image image="2043"][tm_spacer size="lg:61"][tm_heading custom_google_font="" text="Home decoration." font_size="sm:24;md:30;lg:36" line_height="1.42"][tm_spacer size="lg:17"][tm_heading tag="div" custom_google_font="" text="Add an extra-special touch to décor with this charming lantern that features sleek angles and a modern-edge design. A must-have for your house this holiday. Buy now to get a special discount for early bird order." font_size="sm:16;lg:18" line_height="1.84"][tm_spacer size="lg:67"][tm_separator style="thin-line" color="custom" custom_color="#eeeeee"][tm_spacer size="lg:57"][tm_accordion open_first_item="1" items="%5B%7B%22title%22%3A%22Minimal%20design%22%2C%22content%22%3A%22Lighting%20has%20the%20power%20to%20transform%20a%20room.%20From%20the%20way%20it%20casts%20a%20glow%20to%20the%20way%20it%20looks%2C%20there%20is%20a%20reason%20designers%20call%20it%20the%20jewelry%20of%20a%20room.%20Furthermore%2C%20lighting%20is%20probably%20the%20most%20easily%20recognizable%20and%20instantly%20iconic%20piece%20you%20can%20invest%20on.%20%22%7D%2C%7B%22title%22%3A%22Metallic%20gold-plated%22%2C%22content%22%3A%22Designed%20in%20the%201950s%20by%20Isamu%20Noguchi%2C%20these%20paper%20lanterns%20are%20seeing%20a%20resurgence%20this%20year%2C%20especially%20in%20hotel%20designs.%20Imagine%20it%20in%20its%20largest%20size%20making%20a%20bold%20statement%20in%20a%20space%20with%20ultra-high%20ceilings.%20%22%7D%2C%7B%22title%22%3A%22High%20quality%20materials%22%2C%22content%22%3A%22Inspired%20by%20white%20plaster%20Giacometti-style%20chandeliers%2C%20French%20designer%20Serge%20Castella%20designed%20a%20series%20of%20organic-shaped%20white%20plaster%20chandeliers%20that%20have%20become%20instant%20classics%20and%20are%20becoming%20increasingly%20in%20demand.%20%22%7D%5D"][tm_spacer size="lg:100"][/vc_column][/vc_row]2%22%2C%22custom_track_color%22%3A%22%23ededed%22%2C%22custom_text_color%22%3A%22%23333333%22%7D%5D" units="%"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][/vc_section]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Shop', 'brook' ),
				'custom_class' => 'shop',
				'image_path'   => $template_image_dir . '/product-01.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" content_placement="middle" background_color="custom" lg_spacing="padding_top:167;padding_bottom:166" sm_spacing="padding_top:100;padding_bottom:50" custom_background_color="#f7f7f7"][vc_column offset="vc_col-md-6"][tm_heading custom_google_font="" text="The metallic gold vase" font_size="sm:24;md:30;lg:36" line_height="1.42"][tm_spacer size="lg:17"][tm_heading tag="div" custom_google_font="" text="Bring a touch of contemporary style to your abode with this gold-plated table lamp set. A gold-finished metal base down below offers a touch of glamour, while the white light brings harmony and comfort to your eyes." font_size="sm:16;lg:18" line_height="1.84"][tm_spacer size="lg:67"][tm_grid columns="xs:1;lg:2" column_gutter="lg:30" row_gutter="lg:50"][tm_counter align="left" icon_type="ion" icon_ion="ion-ios-people-outline" number="99" number_suffix="%" text="Satisfied clients"][tm_counter align="left" icon_type="ion" icon_ion="ion-ios-eye-outline" number="2034" text="Total purchases"][/tm_grid][tm_spacer size="sm:40"][/vc_column][vc_column offset="vc_col-md-6"][tm_image align="right" sm_align="center" image="2038"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Shop', 'brook' ),
				'custom_class' => 'shop',
				'image_path'   => $template_image_dir . '/product-02.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" content_placement="middle" lg_spacing="padding_top:97;padding_bottom:107"][vc_column offset="vc_col-md-6"][tm_image sm_align="center" image="2037"][tm_spacer size="sm:40"][/vc_column][vc_column offset="vc_col-md-6"][tm_heading custom_google_font="" text="Cube lantern set." font_size="sm:24;md:30;lg:36" line_height="1.42"][tm_spacer size="lg:17"][tm_heading tag="div" custom_google_font="" text="Add some life to your bedroom with this beautiful set of 10 cube golden lantern string solar lights. The lights turn on as darkness falls to add atmosphere and ambiance to your room." font_size="sm:16;lg:18" line_height="1.84"][tm_spacer size="lg:89"][vc_row_inner][vc_column_inner width="1/2"][tm_heading custom_google_font="" text="Feature one" font_size="lg:18" line_height="1.39"][tm_spacer size="lg:15"][tm_heading tag="div" custom_google_font="" text="A great attraction at any outdoor dining event, handy to light pathways and garden ornaments."][tm_spacer size="lg:40"][/vc_column_inner][vc_column_inner width="1/2"][tm_heading custom_google_font="" text="Feature two" font_size="lg:18" line_height="1.39"][tm_spacer size="lg:15"][tm_heading tag="div" custom_google_font="" text="The solar panels absorb the sun in the daytime, powered the lights at night, can work for about 8 hours."][tm_spacer size="lg:40"][/vc_column_inner][/vc_row_inner][tm_spacer size="xs:0;lg:38"][tm_button style="flat-rounded" size="custom" button="url:%23|title:Shop%20collection||" width="190"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/about-08.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" background_color="custom" custom_background_color="#000000"][vc_column][vc_row_inner content_placement="bottom" lg_spacing="padding_top:100"][vc_column_inner offset="vc_col-md-4"][tm_image image="2109" lg_spacing="margin_top:-212" sm_spacing="margin_top:0"][tm_spacer size="sm:40"][/vc_column_inner][vc_column_inner offset="vc_col-md-offset-1 vc_col-md-6"][tm_heading custom_google_font="" text_color="custom" custom_text_color="#ffffff" text="plan. create. grow." font_size="sm:24;md:30;lg:36" line_height="1.42"][tm_spacer size="lg:17"][tm_heading tag="div" custom_google_font="" text="Since its establishment in 2000, Brook Creative has been focusing on project management & implementation through cooperation. In total, Brook Creative has created more than 2000 projects related to constructional designing and landscaping industries worldwide." font_size="sm:16;lg:18" line_height="1.84"][tm_spacer size="lg:62"][tm_button button="url:%23|title:Shop%20collection||"][/vc_column_inner][/vc_row_inner][tm_spacer size="sm:100;lg:147"][vc_row_inner][vc_column_inner offset="vc_col-md-4"][tm_heading style="modern" custom_google_font="" text_color="custom" custom_text_color="#ffffff" text="OUR SKILLS"][tm_spacer size="sm:25;lg:55"][tm_heading custom_google_font="" text_color="custom" custom_text_color="#ffffff" text="We design & build brands, campaigns and digital projects for businesses." font_size="sm:24;md:30;lg:36" line_height="1.42"][tm_spacer size="sm:50"][/vc_column_inner][vc_column_inner offset="vc_col-md-offset-1 vc_col-md-7"][tm_slider_gallery image_size="custom" nav="04" pagination="03" gutter="30" images="1044,1045,1043" image_size_width="670" image_size_height="570" items_display="xs:1;lg:1" lg_spacing="margin_bottom:-194"][/vc_column_inner][/vc_row_inner][tm_spacer size="lg:100"][/vc_column][/vc_row]
CONTENT
			),

			array(
				'name'         => esc_html__( 'Counters', 'brook' ),
				'custom_class' => 'counters about shop',
				'image_path'   => $template_image_dir . '/counters-03.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" lg_spacing="padding_top:181;padding_bottom:20"][vc_column offset="vc_col-md-4"][tm_image sm_align="center" image="2101"][tm_spacer size="sm:50"][/vc_column][vc_column offset="vc_col-md-offset-1 vc_col-md-7"][vc_progress_bar bar_height="4" values="%5B%7B%22label%22%3A%22UI%2FUX%22%2C%22value%22%3A%2285%22%2C%22custom_background_color%22%3A%22%23222222%22%2C%22custom_track_color%22%3A%22%23ededed%22%2C%22custom_text_color%22%3A%22%23333333%22%7D%2C%7B%22label%22%3A%22Ideas%22%2C%22value%22%3A%2270%22%2C%22custom_background_color%22%3A%22%23222222%22%2C%22custom_track_color%22%3A%22%23ededed%22%2C%22custom_text_color%22%3A%22%23333333%22%7D%2C%7B%22label%22%3A%22Marketing%22%2C%22value%22%3A%2290%22%2C%22custom_background_color%22%3A%22%23222222%22%2C%22custom_track_color%22%3A%22%23ededed%22%2C%22custom_text_color%22%3A%22%23333333%22%7D%5D" units="%"][tm_spacer size="sm:60;lg:122"][tm_grid columns="xs:1;lg:2" column_gutter="lg:30" row_gutter="lg:50" max_width="lg:570"][tm_counter align="left" icon_type="ion" icon_ion="ion-ios-people-outline" number="99" number_suffix="%" text="Satisfied clients"][tm_counter align="left" icon_type="ion" icon_ion="ion-ios-eye-outline" number="2034" text="Unique designs"][/tm_grid][/vc_column][/vc_row]
CONTENT
			),
			array(
				'name'         => esc_html__( 'About', 'brook' ),
				'custom_class' => 'about',
				'image_path'   => $template_image_dir . '/about-09.jpg',
				'content'      => <<<CONTENT
[vc_row full_width="stretch_row" background_size="auto" background_image="1496" background_position="top 73px center" lg_spacing="padding_top:167;padding_bottom:138" sm_spacing="padding_top:120;padding_bottom:100"][vc_column width="1/2"][tm_heading custom_google_font="" text="We’re always ready for challenges." font_size="sm:44;md:52;lg:60" line_height="1.34"][tm_spacer size="lg:54"][tm_button button="url:%23|title:Find%20out%20how||" color="secondary"][tm_spacer size="lg:40"][/vc_column][vc_column width="1/2"][tm_heading tag="h4" custom_google_font="" text_color="secondary" text="What we do" font_size="lg:18" line_height="1.39"][tm_spacer size="lg:30"][tm_heading custom_google_font="" text="Fresh ideas & unique designs" font_size="sm:24;md:30;lg:36" line_height="1.42"][tm_spacer size="lg:49"][tm_grid columns="xs:1;lg:2" column_gutter="lg:30" row_gutter="lg:50"][tm_box_icon style="02" image="2776" heading="Original Ideas" text="Our quality of service assessment involves controlling and managing resources by setting priorities for specific types of clients and projects on the system."][tm_box_icon style="02" image="2778" heading="Graphic designs" text="We work with clients from all over the world. We had worked with and serving over 2000 customers and 1000 global companies across 13 countries in the world."][/tm_grid][/vc_column][/vc_row]
CONTENT
			),
		);

		foreach ($data as $test ) {
			vc_add_default_templates( $test );
		}
	}
}

Brook_VC_Templates::instance()->init();

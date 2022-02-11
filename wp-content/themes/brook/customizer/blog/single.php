<?php
$section  = 'blog_single';
$priority = 1;
$prefix   = 'single_post_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'style',
	'label'       => esc_html__( 'Style', 'brook' ),
	'description' => esc_html__( 'Select single blog style layout.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'standard',
	'choices'     => array(
		'standard' => esc_html__( 'Standard', 'brook' ),
		'modern'   => esc_html__( 'Modern', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_feature_enable',
	'label'       => esc_html__( 'Featured Image', 'brook' ),
	'description' => esc_html__( 'Turn on to display featured image (video, audio, quote...) on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_feature_position',
	'label'       => esc_html__( 'Featured Position', 'brook' ),
	'description' => esc_html__( 'Controls position of post featured image.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'below',
	'choices'     => array(
		'below' => esc_html__( 'Below Title', 'brook' ),
		'above' => esc_html__( 'Above Title', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_title_enable',
	'label'       => esc_html__( 'Post Title', 'brook' ),
	'description' => esc_html__( 'Turn on to display the post title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_categories_enable',
	'label'       => esc_html__( 'Categories', 'brook' ),
	'description' => esc_html__( 'Turn on to display the categories on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_tags_enable',
	'label'       => esc_html__( 'Tags', 'brook' ),
	'description' => esc_html__( 'Turn on to display the tags on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_date_enable',
	'label'       => esc_html__( 'Post Meta Date', 'brook' ),
	'description' => esc_html__( 'Turn on to display the date on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_comment_count_enable',
	'label'       => esc_html__( 'Comment Count', 'brook' ),
	'description' => esc_html__( 'Turn on to display the comment count on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_author_enable',
	'label'       => esc_html__( 'Author Meta', 'brook' ),
	'description' => esc_html__( 'Turn on to display the author meta on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_share_enable',
	'label'       => esc_html__( 'Post Sharing', 'brook' ),
	'description' => esc_html__( 'Turn on to display the social sharing on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_author_box_enable',
	'label'       => esc_html__( 'Author Info Box', 'brook' ),
	'description' => esc_html__( 'Turn on to display the author info box on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_pagination_enable',
	'label'       => esc_html__( 'Previous/Next Pagination', 'brook' ),
	'description' => esc_html__( 'Turn on to display the previous/next post pagination on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_related_enable',
	'label'       => esc_html__( 'Related', 'brook' ),
	'description' => esc_html__( 'Turn on to display related posts on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'single_post_related_number',
	'label'           => esc_html__( 'Number of related posts item', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 10,
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_post_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_comment_enable',
	'label'       => esc_html__( 'Comments', 'brook' ),
	'description' => esc_html__( 'Turn on to display comments on blog single posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'button_return_text',
	'label'       => esc_html__( 'Button Return Text', 'brook' ),
	'description' => esc_html__( 'Control the text of button return to blog archive page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Back', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'button_return_link',
	'label'       => esc_html__( 'Button Return Link', 'brook' ),
	'description' => esc_html__( 'Control the link of button return to blog archive page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '#',
) );

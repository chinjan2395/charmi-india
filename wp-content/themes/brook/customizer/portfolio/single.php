<?php
$section  = 'single_portfolio';
$priority = 1;
$prefix   = 'single_portfolio_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_sticky_detail_enable',
	'label'       => esc_html__( 'Sticky Detail Column', 'brook' ),
	'description' => esc_html__( 'Turn on to enable sticky of detail column.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_style',
	'label'       => esc_html__( 'Single Portfolio Style', 'brook' ),
	'description' => esc_html__( 'Select style of all single portfolio post pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'left_details',
	'choices'     => array(
		'blank'              => esc_attr__( 'Blank (Build with Visual Composer)', 'brook' ),
		'left_details'       => esc_attr__( 'Left Details', 'brook' ),
		'right_details'      => esc_attr__( 'Right Details', 'brook' ),
		'left_details_wide'  => esc_attr__( 'Left Details - Wide', 'brook' ),
		'right_details_wide' => esc_attr__( 'Right Details - Wide', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_video_enable',
	'label'       => esc_html__( 'Video', 'brook' ),
	'description' => esc_html__( 'Controls the video visibility on portfolio post pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => array(
		'none'  => esc_html__( 'Hide', 'brook' ),
		'above' => esc_html__( 'Show Above Feature Image', 'brook' ),
		'below' => esc_html__( 'Show Below Feature Image', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_portfolio_feature_caption',
	'label'    => esc_html__( 'Image Caption', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_portfolio_feature_lightbox',
	'label'    => esc_html__( 'Open Images in Light Box?', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'None', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'single_portfolio_about_title',
	'label'       => esc_html__( 'About Project Text', 'brook' ),
	'description' => esc_html__( 'Input label that displays above content. Leave blank to hide it.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'About the project', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_comment_enable',
	'label'       => esc_html__( 'Comments', 'brook' ),
	'description' => esc_html__( 'Turn on to display comments on single portfolio posts.', 'brook' ),
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
	'settings'    => 'single_portfolio_categories_enable',
	'label'       => esc_html__( 'Categories', 'brook' ),
	'description' => esc_html__( 'Turn on to display categories on single portfolio posts.', 'brook' ),
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
	'settings'    => 'single_portfolio_tags_enable',
	'label'       => esc_html__( 'Tags', 'brook' ),
	'description' => esc_html__( 'Turn on to display tags on single portfolio posts.', 'brook' ),
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
	'settings'    => 'single_portfolio_share_enable',
	'label'       => esc_html__( 'Share', 'brook' ),
	'description' => esc_html__( 'Turn on to display Share list on single portfolio posts.', 'brook' ),
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
	'settings'    => 'single_portfolio_related_enable',
	'label'       => esc_html__( 'Related Portfolios', 'brook' ),
	'description' => esc_html__( 'Turn on this option to display related portfolio section.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'portfolio_related_title',
	'label'           => esc_html__( 'Related Title Section', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => esc_html__( 'Related Projects', 'brook' ),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'multicheck',
	'settings'        => 'portfolio_related_by',
	'label'           => esc_attr__( 'Related By', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array( 'portfolio_category' ),
	'choices'         => array(
		'portfolio_category' => esc_html__( 'Portfolio Category', 'brook' ),
		'portfolio_tags'     => esc_html__( 'Portfolio Tags', 'brook' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'portfolio_related_number',
	'label'           => esc_html__( 'Number related portfolios', 'brook' ),
	'description'     => esc_html__( 'Controls the number of related portfolios', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 5,
	'choices'         => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_pagination_enable',
	'label'       => esc_html__( 'Previous/Next Pagination', 'brook' ),
	'description' => esc_html__( 'Turn on to display the previous/next portfolio pagination on single portfolio posts.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

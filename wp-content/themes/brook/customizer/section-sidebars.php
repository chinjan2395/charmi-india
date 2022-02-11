<?php
$section             = 'sidebars';
$priority            = 1;
$prefix              = 'sidebars_';
$sidebar_positions   = Brook_Helper::get_list_sidebar_positions();
$registered_sidebars = Brook_Helper::get_registered_sidebars();

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => sprintf( '<div class="desc">
			<strong class="insight-label insight-label-info">%s</strong>
			<p>%s</p>
			<p>%s</p>
		</div>', esc_html__( 'IMPORTANT NOTE: ', 'brook' ), esc_html__( 'Sidebar 2 can only be used if sidebar 1 is selected.', 'brook' ), esc_html__( 'Sidebar position option will control the position of sidebar 1. If sidebar 2 is selected, it will display on the opposite side.', 'brook' ) ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'General Settings', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'one_sidebar_breakpoint',
	'label'       => esc_html__( 'One Sidebar Breakpoint', 'brook' ),
	'description' => esc_html__( 'Controls the breakpoint when has only one sidebar to make the sidebar 100% width.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 992,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'both_sidebar_breakpoint',
	'label'       => esc_html__( 'Both Sidebars Breakpoint', 'brook' ),
	'description' => esc_html__( 'Controls the breakpoint when has both sidebars to make sidebars 100% width.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 1199,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'sidebars_below_content_mobile',
	'label'       => esc_html__( 'Sidebars Below Content', 'brook' ),
	'description' => esc_html__( 'Move sidebars display after main content on smaller screens.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'No', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Sidebar Layouts', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'single_sidebar_width',
	'label'       => esc_html__( 'Single Sidebar Width', 'brook' ),
	'description' => esc_html__( 'Controls the width of the sidebar when only one sidebar is present. Input value as % unit. For e.g: 33.33333', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '33.333333',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'single_sidebar_offset',
	'label'       => esc_html__( 'Single Sidebar Offset', 'brook' ),
	'description' => esc_html__( 'Controls the offset of the sidebar when only one sidebar is present. Enter value including any valid CSS unit. For e.g: 70px.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '20px',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Dual Sidebar Layouts', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'dual_sidebar_width',
	'label'       => esc_html__( 'Dual Sidebar Width', 'brook' ),
	'description' => esc_html__( 'Controls the width of sidebars when dual sidebars are present. Enter value including any valid CSS unit. For e.g: 33.33333.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '25',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'dual_sidebar_offset',
	'label'       => esc_html__( 'Dual Sidebar Offset', 'brook' ),
	'description' => esc_html__( 'Controls the offset of sidebars when dual sidebars are present. Enter value including any valid CSS unit. For e.g: 70px.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Pages', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on all pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on all pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on all pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Search Page', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on search results page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on search results page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'search_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on search results page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'special_sidebar',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Front Latest Posts Page', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on front latest posts page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on front latest posts page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'home_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on front latest posts page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'special_sidebar',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Posts', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single blog post pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single blog post pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'post_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on single blog post pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Archive', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on blog archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on blog archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on blog archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'special_sidebar',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Portfolio Posts', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single portfolio pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single portfolio pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on single portfolio pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Portfolio Archive', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on portfolio archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on portfolio archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on portfolio archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Product', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single product pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single product pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on single product pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Archive', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'brook' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on product archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'shop_sidebar',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'brook' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on product archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_special',
	'label'       => esc_html__( 'Special Sidebar', 'brook' ),
	'description' => esc_html__( 'Select special sidebar that will display below of first sidebar on product archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

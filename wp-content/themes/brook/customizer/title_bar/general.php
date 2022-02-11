<?php
$section  = 'title_bar';
$priority = 1;
$prefix   = 'title_bar_';

$title_bar_list = Brook_Helper::get_title_bar_list( true );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'Default Title Bar', 'brook' ),
	'description' => esc_html__( 'Select default title bar that displays on all pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => Brook_Helper::get_title_bar_list(),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_title_bar_layout',
	'label'       => esc_html__( 'Pages', 'brook' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '03',
	'choices'     => $title_bar_list,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_title_bar_layout',
	'label'       => esc_html__( 'Home Page', 'brook' ),
	'description' => esc_html__( 'Select default Title Bar that displays on front latest posts page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_title_bar_layout',
	'label'       => esc_html__( 'Blog Archive', 'brook' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all blog archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_title_bar_layout',
	'label'       => esc_html__( 'Single Blog', 'brook' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single blog post pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $title_bar_list,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_title_bar_layout',
	'label'       => esc_html__( 'Portfolio Archive', 'brook' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all archive portfolio page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $title_bar_list,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_title_bar_layout',
	'label'       => esc_html__( 'Single Portfolio', 'brook' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single portfolio pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $title_bar_list,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_title_bar_layout',
	'label'       => esc_html__( 'Woocommerce Pages', 'brook' ),
	'description' => esc_html__( 'Select default Title Bar that displays on woocommerce pages ( Shop catalog, cart, checkout... ).', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '02',
	'choices'     => $title_bar_list,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_title_bar_layout',
	'label'       => esc_html__( 'Single Product', 'brook' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single product pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $title_bar_list,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'search_title',
	'label'       => esc_html__( 'Search Heading', 'brook' ),
	'description' => esc_html__( 'Enter text prefix that displays on search results page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Search results for: ', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'home_title',
	'label'       => esc_html__( 'Home Heading', 'brook' ),
	'description' => esc_html__( 'Enter text that displays on front latest posts page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_category_title',
	'label'       => esc_html__( 'Archive Category Heading', 'brook' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive category page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Category: ', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_tag_title',
	'label'       => esc_html__( 'Archive Tag Heading', 'brook' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive tag page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Tag: ', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_author_title',
	'label'       => esc_html__( 'Archive Author Heading', 'brook' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive author page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Author: ', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_year_title',
	'label'       => esc_html__( 'Archive Year Heading', 'brook' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive year page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Year: ', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_month_title',
	'label'       => esc_html__( 'Archive Month Heading', 'brook' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive month page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Month: ', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_day_title',
	'label'       => esc_html__( 'Archive Day Heading', 'brook' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive day page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Day: ', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_blog_title',
	'label'       => esc_html__( 'Single Blog Heading', 'brook' ),
	'description' => esc_html__( 'Enter text that displays on single blog posts. Leave blank to use post title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_portfolio_title',
	'label'       => esc_html__( 'Single Portfolio Heading', 'brook' ),
	'description' => esc_html__( 'Enter text that displays on single portfolio pages. Leave blank to use portfolio title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Portfolio', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_product_title',
	'label'       => esc_html__( 'Single Product Heading', 'brook' ),
	'description' => esc_html__( 'Enter text that displays on single product pages. Leave blank to use product title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Shop', 'brook' ),
) );

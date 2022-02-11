<?php
$panel    = 'blog';
$priority = 1;

Brook_Kirki::add_section( 'blog_single', array(
	'title'    => esc_html__( 'Blog Single Post', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

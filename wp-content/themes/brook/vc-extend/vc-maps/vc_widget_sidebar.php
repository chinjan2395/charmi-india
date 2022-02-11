<?php

vc_add_params( 'vc_widget_sidebar', array(
	array(
		'heading'    => esc_html__( 'Sidebar Position', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'sidebar_position',
		'value'      => array(
			esc_html__( 'Left', 'brook' )  => 'left',
			esc_html__( 'Right', 'brook' ) => 'right',
		),
		'std'        => 'right',
	),
) );

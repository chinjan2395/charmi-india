<?php

vc_add_params( 'vc_separator', array(
	array(
		'heading'     => esc_html__( 'Position', 'brook' ),
		'description' => esc_html__( 'Make the separator position absolute with column', 'brook' ),
		'type'        => 'dropdown',
		'param_name'  => 'position',
		'value'       => array(
			esc_html__( 'None', 'brook' )   => '',
			esc_html__( 'Top', 'brook' )    => 'top',
			esc_html__( 'Bottom', 'brook' ) => 'bottom',
		),
		'std'         => '',
	),
) );

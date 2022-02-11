<?php
defined( 'ABSPATH' ) || exit;

$labels   = $legend_onclick = $legend_position = $legend_style = '';
$el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-line-chart-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-js-chart tm-line-chart ' . $el_class, $this->settings['base'], $atts );

$datasets = (array) vc_param_group_parse_atts( $datasets );

if ( $labels === '' ) {
	return;
}

if ( count( $datasets ) <= 0 ) {
	return;
}

$labels = explode( '; ', $labels );

$sets = array();

$_thickness = array(
	'thin'    => array(
		'borderWidth'           => 1,
		'pointRadius'           => 3,
		'pointHitRadius'        => 3,
		'pointBorderWidth'      => 1,
		'pointHoverRadius'      => 5,
		'pointHoverBorderWidth' => 1,
	),
	'normal'  => array(
		'borderWidth'           => 2,
		'pointRadius'           => 4,
		'pointHitRadius'        => 3,
		'pointBorderWidth'      => 1,
		'pointHoverRadius'      => 5,
		'pointHoverBorderWidth' => 1,
	),
	'thick'   => array(
		'borderWidth'           => 3,
		'pointRadius'           => 5,
		'pointHitRadius'        => 3,
		'pointBorderWidth'      => 1,
		'pointHoverRadius'      => 6,
		'pointHoverBorderWidth' => 1,
	),
	'thicker' => array(
		'borderWidth'           => 4,
		'pointRadius'           => 6,
		'pointHitRadius'        => 3,
		'pointBorderWidth'      => 1,
		'pointHoverRadius'      => 6,
		'pointHoverBorderWidth' => 1,
	),
);

$_borderDash = array(
	'solid'  => array(),
	'dashed' => array( 16, 8 ),
	'dotted' => array( 3, 3 ),
);

foreach ( $datasets as $set ) {
	if ( ! isset( $set['title'] ) || $set['title'] === '' || ! $set['values'] || $set['values'] === '' ) {
		continue;
	}

	$line_tension = isset( $set['line_tension'] ) ? $set['line_tension'] : 10;
	$line_style   = isset( $set['line_style'] ) ? $set['line_style'] : 'solid';
	$line_step    = isset( $set['line_type'] ) && $set['line_type'] === 'step' ? true : false;
	$thickness    = isset( $set['thickness'] ) ? $set['thickness'] : 'normal';
	$base_color   = $set['color'];
	$fill         = isset( $set['fill'] ) && $set['fill'] !== 'none' ? true : false;

	$fill_color = isset( $set['fill_color'] ) && $set['fill_color'] !== '' ? $set['fill_color'] : $base_color;

	$values = explode( '; ', $set['values'] );

	$_set = array(
		'label'                 => $set['title'],
		'fill'                  => $fill,
		'backgroundColor'       => $fill_color,
		'borderColor'           => $set['color'],
		'borderCapStyle'        => 'butt',
		'borderDash'            => $_borderDash[ $line_style ],
		'borderDashOffset'      => 0,
		'borderJoinStyle'       => 'miter',
		'spanGaps'              => false,
		'showLine'              => true,
		'steppedLine'           => $line_step,
		'pointStyle'            => $set['point_style'],
		'pointBorderWidth'      => 0,
		'pointHoverRadius'      => 1,
		'pointHoverBorderWidth' => 0,
		'hidden'                => false,
		'lineTension'           => ( 100 - absint( $line_tension ) ) * 0.37 / 100,
		'data'                  => $values,
	);

	$_set = wp_parse_args( $_thickness[ $thickness ], $_set );

	if ( $set['point_style'] === 'none' ) {
		$_extra = array(
			'borderColor'           => 'rgba(0, 0, 0, 0)',
			'pointStyle'            => 'circle',
			'borderWidth'           => 0,
			'pointRadius'           => 1,
			'pointHitRadius'        => 0,
			'pointBorderWidth'      => 1,
			'pointHoverRadius'      => 1,
			'pointHoverBorderWidth' => 0,
		);

		$_set = wp_parse_args( $_extra, $_set );
	}

	$sets[] = $_set;
}

$data = array(
	'labels'   => $labels,
	'datasets' => $sets,
);

$options = array(
	'animation'           => array(
		'duration' => 2000,
	),
	'maintainAspectRatio' => true,
	'tooltips'            => array(
		'enabled'      => true,
		'mode'         => 'index',
		'intersect'    => false,
		'bodySpacing'  => 8,
		'titleSpacing' => 6,
		'cornerRadius' => 8,
		'xPadding'     => 10,
	),
	'legend'              => array(
		'display'  => $legend === '1' ? true : false,
		'position' => $legend_position,
		'labels'   => array(
			'usePointStyle' => ( 'point' == $legend_style ) ? true : false,
			'padding'       => 20,
			'boxWidth'      => 16,
		),
	),
	'scales'              => array(
		'yAxes' => array(
			array(
				'ticks'     => array(
					'fontColor'   => '222',
					'beginAtZero' => true,
				),
				'gridLines' => array(
					'color'         => 'rgba(43, 43, 43, 0.2)',
					'zeroLineColor' => 'rgba(43, 43, 43, 0.6)',
				),
			),
		),
	),
);

if ( $legend === '1' ) {

}

if ( $legend_onclick !== '1' ) {
	$options['legend']['onClick'] = null;
}

$chart_options = array(
	'type'    => 'line',
	'data'    => $data,
	'options' => $options,
);

$chart_height = Brook_Helper::process_chart_aspect_ratio( $aspect_ratio );

wp_enqueue_script( 'advanced-chart' );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">

	<div class="chart-data" style="display:none;"><?php echo json_encode( $chart_options ); ?></div>
	<canvas width="500" height="<?php echo esc_attr( $chart_height ); ?>"></canvas>

</div>

<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$labels   = $legend_onclick = $legend_position = $legend_style = '';
$el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-bar-chart-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-js-chart tm-bar-chart ' . $el_class, $this->settings['base'], $atts );
$css_class .= Brook_Helper::get_animation_classes();
$datasets  = (array) vc_param_group_parse_atts( $datasets );

if ( $labels === '' ) {
	return;
}

if ( count( $datasets ) <= 0 ) {
	return;
}

$labels = explode( '; ', $labels );

$sets         = array();
$border_width = isset( $border_width ) ? $border_width : 0;

foreach ( $datasets as $set ) {
	if ( ! isset( $set['title'] ) || $set['title'] === '' || ! $set['values'] || $set['values'] === '' ) {
		continue;
	}

	$base_color = isset( $set['color'] ) ? $set['color'] : 'rgba(0, 0, 0, 0.8)';

	$fill_color   = isset( $set['fill_color'] ) && $set['fill_color'] !== '' ? $set['fill_color'] : $base_color;
	$border_color = isset( $set['border_color'] ) && $set['border_color'] !== '' ? $set['border_color'] : $base_color;

	$values = explode( '; ', $set['values'] );

	$_set = array(
		'label'           => $set['title'],
		'backgroundColor' => $fill_color,
		'borderColor'     => $border_color,
		'data'            => $values,
		'borderWidth'     => $border_width,
	);

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
	'type'    => $type,
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

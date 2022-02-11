<?php
defined( 'ABSPATH' ) || exit;

$cutout          = 0;
$legend_position = 'bottom';
$el_class        = $legend_position = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-pie-chart-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-js-chart tm-pie-chart ' . $el_class, $this->settings['base'], $atts );
$css_class .= Brook_Helper::get_animation_classes();
$datasets  = (array) vc_param_group_parse_atts( $datasets );

if ( count( $datasets ) <= 0 ) {
	return;
}

$labels       = array();
$border_width = isset( $border_width ) && $border_width !== '' ? intval( $border_width ) : 0;
$sets         = array(
	'backgroundColor'      => array(),
	'hoverBackgroundColor' => array(),
	'data'                 => array(),
	'borderWidth'          => $border_width,
	'borderColor'          => $border_color !== '' ? $border_color : 'rgba(0, 0, 0, 0)',
);

foreach ( $datasets as $set ) {
	if ( ! isset( $set['title'] ) || $set['title'] === '' || ! $set['value'] || $set['value'] === '' ) {
		continue;
	}

	$labels[] = $set['title'];

	$sets['backgroundColor'][]      = $set['color'];
	$sets['hoverBackgroundColor'][] = $set['color'];
	$sets['data'][]                 = $set['value'];
}

$data = array(
	'labels'   => $labels,
	'datasets' => array(
		$sets,
	),
);

$options = array(
	'animation'           => array(
		'duration' => 2000,
	),
	'maintainAspectRatio' => true,
	'cutoutPercentage'    => intval( $cutout ),
	'tooltips'            => array(
		'enabled'         => true,
		'bodySpacing'     => 8,
		'titleSpacing'    => 6,
		'cornerRadius'    => 8,
		'xPadding'        => 10,
		'footerFontSize'  => 15,
		'footerFontColor' => '#222222',
	),
	'legend'              => array(
		'display'  => false,
		'position' => $legend_position,
		'labels'   => array(
			'usePointStyle' => true,
			'padding'       => 16,
			'boxWidth'      => 16,
			'fontSize'      => 15,
		),
	),
);

if ( $legend === '1' ) {
	$css_class .= " legends-$legend_position";

	if ( $legend_onclick === '1' ) {
		$css_class .= ' legends-clickable';
	}
}

$chart_options = array(
	'type'    => 'pie',
	'data'    => $data,
	'options' => $options,
);

$chart_height = Brook_Helper::process_chart_aspect_ratio( $aspect_ratio );

wp_enqueue_script( 'advanced-chart' );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
	<?php if ( $legend === '1' )  : ?>
		data-legend-enable="1"
	<?php endif; ?>

	<?php if ( $legend_onclick === '1' ): ?>
		data-legend-clickable="1"
	<?php endif; ?>
>

	<div class="chart-data" style="display:none;"><?php echo json_encode( $chart_options ); ?></div>

	<div class="chart-wrap">
		<?php if ( $legend === '1' && in_array( $legend_position, array( 'left', 'top' ) ) )  : ?>
			<div class="chart-legends"></div>
		<?php endif; ?>

		<div class="chart-canvas">
			<canvas width="500" height="<?php echo esc_attr( $chart_height ); ?>"></canvas>
		</div>

		<?php if ( $legend === '1' && in_array( $legend_position, array( 'right', 'bottom' ) ) )  : ?>
			<div class="chart-legends"></div>
		<?php endif; ?>
	</div>
</div>

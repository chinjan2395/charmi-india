<?php
defined( 'ABSPATH' ) || exit;

$style        = $el_class = $items = '';
$carousel_nav = $carousel_pagination = $carousel_loop = $carousel_auto_play = $slider_button_id = '';
$atts         = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );
$css_id = uniqid( 'tm-problem-solution-' );
$this->get_inline_css( '#' . $css_id, $atts );
$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) < 1 ) {
	return;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-problem-solution ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$slider_class = 'tm-swiper';

if ( $carousel_nav !== '' ) {
	$slider_class .= " nav-style-$carousel_nav";
}

if ( $carousel_pagination !== '' ) {
	$slider_class .= " pagination-style-$carousel_pagination";
}
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="<?php echo esc_attr( trim( $slider_class ) ); ?>"
	     data-lg-items="1"
	     data-lg-gutter="30"

		<?php if ( $carousel_nav !== '' ) : ?>
			data-nav="1"
		<?php endif; ?>

		<?php if ( $carousel_nav === 'custom' ) : ?>
			data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
		<?php endif; ?>

		<?php if ( $carousel_pagination !== '' ) : ?>
			data-pagination="1"
		<?php endif; ?>

		<?php if ( $carousel_auto_play !== '' ) : ?>
			data-autoplay="<?php echo esc_attr( $carousel_auto_play ); ?>"
		<?php endif; ?>

		<?php if ( $carousel_loop === '1' ) : ?>
			data-loop="1"
		<?php endif; ?>
	>
		<div class="swiper-container">
			<div class="swiper-wrapper">

				<?php foreach ( $items as $item ) { ?>
					<div class="swiper-slide">
						<div class="row row-xs-center">
							<div class="col-md-4 problem">
								<div class="ps-label problem-label">
									<?php esc_html_e( 'Problem', 'brook' ); ?>
								</div>

								<?php if ( isset( $item['problem_name'] ) ) : ?>
									<h5 class="name problem-name">
										<?php echo esc_html( $item['problem_name'] ); ?>
									</h5>
								<?php endif; ?>

								<?php if ( isset( $item['problem_desc'] ) ) : ?>
									<div class="desc problem-desc">
										<?php echo esc_html( $item['problem_desc'] ); ?>
									</div>
								<?php endif; ?>
							</div>

							<div class="col-md-4 image-wrap">
								<?php if ( $image ) : ?>
									<div class="image">
										<?php
										Brook_Image::the_attachment_by_id( array(
											'id'     => $image,
											'size'   => 'custom',
											'width'  => 500,
											'height' => 286,
										) );
										?>
									</div>
								<?php endif; ?>
							</div>

							<div class="col-md-4 solution">
								<div class="ps-label solution-label">
									<?php esc_html_e( 'Solution', 'brook' ); ?>
								</div>

								<?php if ( isset( $item['solution_name'] ) ) : ?>
									<h5 class="name solution-name">
										<?php echo esc_html( $item['solution_name'] ); ?>
									</h5>
								<?php endif; ?>

								<?php if ( isset( $item['solution_desc'] ) ) : ?>
									<div class="desc solution-desc">
										<?php echo esc_html( $item['solution_desc'] ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php
$filter_array = array();
foreach ( $items as $key => $row ) {
	$filter_array[] = $row['datetime'];
}

array_multisort( $filter_array, SORT_ASC, $items );

$prev_year = 0;
wp_enqueue_script( 'isotope-packery' );
?>
<div class="tm-grid-wrapper"
     data-type="masonry"
     data-lg-columns="2"
     data-xs-columns="1"
>
	<div class="tm-grid has-animation move-up">
		<div class="line"></div>
		<div class="grid-sizer"></div>
		<?php foreach ( $items as $item ) { ?>
			<div class="grid-item">
				<div class="item-wrapper">
					<?php if ( isset( $item['datetime'] ) ): ?>
						<?php
						$year = date_i18n( 'Y', strtotime( $item['datetime'] ) );

						if ( $prev_year !== $year ) {
							?>
							<div class="year">
								<?php echo esc_html( $year ); ?>
							</div>
						<?php } ?>
						<?php $prev_year = $year; ?>

					<?php endif; ?>
					<div class="dashed"></div>
					<div class="dot"></div>
					<div class="content-wrap">
						<?php if ( isset( $item['title'] ) ) : ?>
							<div class="content-header">
								<?php if ( isset( $item['datetime'] ) ): ?>
									<div class="month">
										<?php
										$month = date_i18n( 'M', strtotime( $item['datetime'] ) );

										echo esc_html( $month );
										?>
									</div>
								<?php endif; ?>

								<h6 class="heading"><?php echo esc_html( $item['title'] ); ?></h6>
							</div>
						<?php endif; ?>

						<div class="content-body">
							<?php if ( isset( $item['image'] ) ) : ?>
								<div class="photo">
									<?php
									Brook_Image::the_attachment_by_id( array(
										'id'     => $item['image'],
										'size'   => 'custom',
										'width'  => 360,
										'height' => 187,
									) );
									?>
								</div>
							<?php endif; ?>

							<?php if ( isset( $item['text'] ) ) : ?>
								<div class="text">
									<?php echo wp_kses( $item['text'], 'brook-default' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<?php
wp_enqueue_script( 'isotope-packery' );
?>
<div class="tm-grid-wrapper"
     data-type="masonry"
     data-lg-columns="1"
>
	<div class="tm-grid has-animation move-up">
		<div class="line"></div>
		<div class="grid-sizer"></div>
		<?php foreach ( $items as $item ) { ?>
			<div class="grid-item">
				<div class="item-wrapper">
					<div class="dot"></div>

					<div class="content-wrap">
						<?php if ( isset( $item['image'] ) ) : ?>
							<div class="photo">
								<?php
								Brook_Image::the_attachment_by_id( array(
									'id'     => $item['image'],
									'size'   => 'full',
								) );
								?>
							</div>
						<?php endif; ?>

						<div class="content">
							<?php if ( isset( $item['title'] ) ) : ?>
								<div class="heading"><?php echo esc_html( $item['title'] ); ?></div>
							<?php endif; ?>

							<?php if ( isset( $item['datetime'] ) ): ?>
								<div class="date">
									<?php echo wp_kses( $item['datetime'], 'brook-default' ); ?>
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

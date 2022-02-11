<?php
$text = $description = $icon_class = $number = $number_prefix = $number_suffix = "";
extract( $brook_shortcode_atts );

if ( isset( ${"icon_{$icon_type}"} ) && ${"icon_{$icon_type}"} !== '' ) {
	$icon_class = esc_attr( ${"icon_{$icon_type}"} );

	vc_icon_element_fonts_enqueue( $icon_type );
}
?>
<div class="row">
	<div class="col-md-4">
		<?php if ( $number !== '' ) : ?>
			<div class="number-wrap">
				<?php if ( $number_prefix !== '' ) : ?>
					<span class="number-prefix"><?php echo esc_html( $number_prefix ); ?></span>
				<?php endif; ?>
				<span class="number"><?php echo esc_html( $number ); ?></span>
				<?php if ( $number_suffix !== '' ) : ?>
					<?php echo '<span class="number-suffix">' . $number_suffix . '</span>'; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="col-md-8">
		<div class="content-wrap">
			<?php if ( $icon_class !== '' ) : ?>
				<div class="icon">
					<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
				</div>
			<?php endif; ?>

			<?php if ( $text !== '' ) : ?>
				<?php printf( '<h6 class="heading">%s</h6>', esc_html( $text ) ); ?>
			<?php endif; ?>

			<?php if ( $description !== '' ) : ?>
				<?php printf( '<div class="description">%s</div>', esc_html( $description ) ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>

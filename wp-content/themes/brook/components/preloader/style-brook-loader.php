<?php
$image = Brook::setting( 'pre_loader_image' );
?>
<div class="">
	<?php if ( $image !== '' ): ?>
		<img src="<?php echo esc_url( $image ); ?>"
		     alt="<?php esc_attr_e( 'Brook Preloader', 'brook' ); ?>">
	<?php endif; ?>
</div>

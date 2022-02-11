<?php
$image_size = $image_size_width = $image_size_height = '';
extract( $brook_shortcode_atts );

$box_link = vc_build_link( $box_link );

if ( ! empty( $image_size ) ) {
	$image_size        = 'custom';
	$image_size_width  = 500;
	$image_size_height = 286;
}
?>

<?php if ( $image ) : ?>
	<div class="image">
		<?php
		Brook_Image::the_attachment_by_id( array(
			'id'     => $image,
			'size'   => $image_size,
			'width'  => $image_size_width,
			'height' => $image_size_height,
		) );
		?>
	</div>
<?php endif; ?>

<?php if ( isset( ${"icon_$icon_type"} ) && ${"icon_$icon_type"} !== '' ) { ?>
	<?php
	$_args = array(
		'type'         => $icon_type,
		'icon'         => ${"icon_$icon_type"},
		'parent_hover' => ".tm-box-icon",
	);

	Brook_Helper::get_vc_icon_template( $_args );
	?>
<?php } ?>

<div class="content">
	<?php if ( $heading ) : ?>
		<h4 class="heading">
			<?php
			$link = vc_build_link( $link );
			if ( $box_link['url'] === '' && $link['url'] !== '' ) {
			?>
			<a class="link-secret" href="<?php echo esc_url( $link['url'] ); ?>"
				<?php if ( $link['target'] !== '' ): ?>
					target="<?php echo esc_attr( $link['target'] ); ?>"
				<?php endif; ?>
			>
				<?php } ?>

				<?php echo esc_html( $heading ); ?>

				<?php if ( $box_link['url'] === '' && $link['url'] !== '' ) { ?>
			</a>
		<?php } ?>

		</h4>
	<?php endif; ?>

	<?php if ( $text ) : ?>
		<?php echo '<div class="text">' . $text . '</div>'; ?>
	<?php endif; ?>
</div>

<?php
if ( $button && $button !== '' ) {
	$button         = vc_build_link( $button );
	$button_classes = 'tm-box-icon__btn tm-button style-text';
	?>
	<?php if ( $button['title'] !== '' ) { ?>
		<?php if ( $box_link['url'] === '' && $button['url'] !== '' ) { ?>
			<a class="<?php echo esc_attr( $button_classes ); ?>"
			   href="<?php echo esc_url( $button['url'] ) ?>"
				<?php if ( $button['target'] !== '' ) { ?>
					target="<?php echo esc_attr( $button['target'] ); ?>"
				<?php } ?>
			>
		<?php } else { ?>
			<?php echo '<div class="' . esc_attr( $button_classes ) . '">'; ?>
		<?php } ?>
			<span class="button-text"><?php echo esc_html( $button['title'] ); ?></span>
			<span class="button-icon"></span>

		<?php if ( $box_link['url'] === '' && $button['url'] !== '' ) { ?>
			<?php echo '</a>'; ?>
		<?php } else { ?>
			<?php echo '</div>'; ?>
		<?php } ?>
	<?php } ?>

<?php } ?>

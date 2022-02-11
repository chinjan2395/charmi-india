<?php
extract( $brook_shortcode_atts );
?>

<div class="photo">
	<?php
	Brook_Image::the_attachment_by_id( array(
		'id'   => $photo,
		'size' => '125x125',
	) );
	?>
</div>

<?php if ( $position !== '' ) : ?>
	<div class="position"><?php echo esc_html( $position ); ?></div>
<?php endif; ?>

<h3 class="name">
	<?php
	if ( $profile != '' ) {
		echo '<a href="' . esc_attr( $profile ) . '">';
		echo esc_html( $name );
		echo '</a>';
	} else {
		echo esc_html( $name );
	}
	?>
</h3>

<?php if ( $desc !== '' ) : ?>
	<div class="description">
		<?php echo wp_kses( $desc, 'brook-default' ); ?>
	</div>
<?php endif; ?>

<?php Brook_Templates::get_team_member_social_networks_template( $social_networks, $tooltip_enable, $tooltip_position, $tooltip_skin ); ?>

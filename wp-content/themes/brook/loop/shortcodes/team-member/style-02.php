<?php
extract( $brook_shortcode_atts );
?>
<div class="photo">
	<?php
	Brook_Image::the_attachment_by_id( array(
		'id'     => $photo,
		'size'   => 'custom',
		'width'  => 370,
		'height' => 370,
	) );
	?>

	<div class="overlay"></div>

	<?php Brook_Templates::get_team_member_social_networks_template( $social_networks, $tooltip_enable, $tooltip_position, $tooltip_skin ); ?>

	<div class="info">
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

		<?php if ( $position !== '' ) : ?>
			<div class="position"><?php echo esc_html( $position ); ?></div>
		<?php endif; ?>
	</div>
</div>

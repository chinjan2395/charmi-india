<?php
extract( $brook_shortcode_atts );
?>
<div class="photo">

	<div class="image-wrap">
		<?php
		Brook_Image::the_attachment_by_id( array(
			'id'     => $photo,
			'size'   => 'custom',
			'width'  => 370,
			'height' => 370,
		) );
		?>

		<?php $photo_url = Brook_Image::get_attachment_url_by_id( array(
			'id'     => $photo,
			'size'   => 'custom',
			'width'  => 370,
			'height' => 370,
		) ); ?>
		<div class="overlay" style="background-image: url(<?php Brook_Helper::e( $photo_url ); ?>)"></div>

		<div class="shape">
			<img src="<?php echo BROOK_THEME_URI . '/assets/images/team-member-shape-01.png'; ?>"
			     alt="<?php esc_attr_e( 'shape-01', 'brook' ); ?>"
			     class="shape-01"/>
			<img src="<?php echo BROOK_THEME_URI . '/assets/images/team-member-shape-02.png'; ?>"
			     alt="<?php esc_attr_e( 'shape-02', 'brook' ); ?>"
			     class="shape-02"/>
			<img src="<?php echo BROOK_THEME_URI . '/assets/images/team-member-shape-03.png'; ?>"
			     alt="<?php esc_attr_e( 'shape-03', 'brook' ); ?>"
			     class="shape-03"/>
		</div>
	</div>

	<?php Brook_Templates::get_team_member_social_networks_template( $social_networks, $tooltip_enable, $tooltip_position, $tooltip_skin ); ?>
</div>
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

	<?php if ( $desc !== '' ) : ?>
		<div class="description">
			<?php echo wp_kses( $desc, 'brook-default' ); ?>
		</div>
	<?php endif; ?>
</div>

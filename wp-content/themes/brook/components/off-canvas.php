<div id="page-close-main-menu" class="page-close-main-menu"></div>

<div class="page-off-canvas-main-menu">
	<div id="page-navigation" <?php Brook::navigation_class(); ?>>
		<?php Brook::menu_primary(); ?>
	</div>

	<div class="off-canvas-content-bottom">
		<div class="row row-xs-bottom">
			<div class="col-md-6">

				<?php $search_enable = Brook::setting( 'navigation_minimal_01_search_enable' ); ?>

				<?php if ( $search_enable === '1' ): ?>
					<div class="off-canvas-search-form">
						<?php get_search_form(); ?>
					</div>
				<?php endif; ?>

				<?php $left_text = Brook::setting( 'navigation_minimal_01_left_text' ); ?>

				<?php if ( $left_text !== '' ) : ?>
					<div class="off-canvas-extra-info">
						<?php echo wp_kses( $left_text, 'brook-default' ); ?>
					</div>
				<?php endif; ?>

				<?php $social_networks_enable = Brook::setting( 'navigation_minimal_01_social_networks_enable' ); ?>

				<?php if ( $social_networks_enable === '1' ) : ?>
					<div class="off-canvas-social-networks">
						<div class="inner">
							<?php Brook_Templates::social_icons( array(
								'tooltip_skin' => 'primary',
							) ); ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
			<div class="col-md-6">

				<?php $right_text = Brook::setting( 'navigation_minimal_01_right_text' ); ?>

				<?php if ( $right_text !== '' ) : ?>
					<div class="off-canvas-copyright">
						<?php echo wp_kses( $right_text, 'brook-default' ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

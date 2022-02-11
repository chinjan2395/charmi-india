<header id="page-header" <?php Brook::header_class(); ?>>
	<div class="page-header-place-holder"></div>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1" data-header-position="left">
		<div class="header-wrap">
			<?php Brook_THA::instance()->header_wrap_top(); ?>

			<div class="header-top">
				<?php get_template_part( 'components/branding' ); ?>

				<?php Brook_Templates::header_open_canvas_menu_button(); ?>
			</div>

			<div class="header-center">
				<?php Brook_Templates::header_social_networks( array(
					'display'        => 'text',
					'tooltip_enable' => false,
				) ); ?>
			</div>

			<div class="header-bottom">
				<?php Brook_Templates::header_search_button(); ?>

				<?php Brook_Templates::header_open_mobile_menu_button(); ?>
			</div>

			<?php Brook_THA::instance()->header_wrap_bottom(); ?>
		</div>
	</div>

	<?php get_template_part( 'components/off-canvas' ); ?>
</header>

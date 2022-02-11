<header id="page-header" <?php Brook::header_class(); ?>>
	<div class="page-header-place-holder"></div>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1" data-header-position="left">
		<div class="header-wrap">
			<?php Brook_THA::instance()->header_wrap_top(); ?>

			<div class="header-top">
				<?php get_template_part( 'components/branding' ); ?>
			</div>

			<div class="header-center">
				<?php get_template_part( 'components/navigation', 'vertical' ); ?>
			</div>

			<div class="header-bottom">
				<?php Brook_Templates::header_widgets(); ?>

				<?php Brook_Templates::header_social_networks(); ?>

				<?php Brook_Templates::header_open_mobile_menu_button(); ?>

				<?php Brook_Templates::header_button( array(
					'style' => 'border-animate',
				) ); ?>
			</div>

			<?php Brook_THA::instance()->header_wrap_bottom(); ?>
		</div>
	</div>
</header>

<header id="page-header" <?php Brook::header_class(); ?>>
	<div class="page-header-place-holder"></div>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="header-wrap">
			<?php Brook_THA::instance()->header_wrap_top(); ?>

			<div class="header-left-wrap">
				<?php get_template_part( 'components/branding' ); ?>

				<div class="header-left-inner">
					<?php Brook_Woo::render_mini_cart(); ?>

					<?php Brook_Templates::header_search_button(); ?>

					<?php Brook_Templates::header_open_canvas_menu_button( array(
						'style' => '02',
					) ); ?>

					<?php Brook_Templates::header_open_mobile_menu_button(); ?>
				</div>
			</div>

			<div class="header-right-wrap">
				<div class="header-right">
					<?php Brook_THA::instance()->header_right_top(); ?>

					<?php Brook_Templates::header_text(); ?>

					<?php Brook_THA::instance()->header_right_bottom(); ?>
				</div>
			</div>

			<?php Brook_THA::instance()->header_wrap_bottom(); ?>
		</div>
	</div>

	<?php get_template_part( 'components/off-canvas' ); ?>
</header>

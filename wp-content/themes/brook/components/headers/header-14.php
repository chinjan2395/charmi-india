<header id="page-header" <?php Brook::header_class(); ?>>
	<div class="page-header-place-holder"></div>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-wrap">
						<?php Brook_THA::instance()->header_wrap_top(); ?>

						<div class="header-left">
							<?php get_template_part( 'components/branding' ); ?>

							<?php get_template_part( 'components/navigation' ); ?>
						</div>

						<div class="header-right">
							<?php Brook_THA::instance()->header_right_top(); ?>

							<?php Brook_Templates::header_language_switcher(); ?>

							<?php Brook_Templates::header_social_networks( array(
								'tooltip_position' => 'bottom',
								'tooltip_skin' => 'white',
							) ); ?>

							<?php Brook_Woo::render_mini_cart(); ?>

							<?php Brook_Templates::header_search_button(); ?>

							<?php Brook_Templates::header_open_mobile_menu_button(); ?>

							<?php Brook_THA::instance()->header_right_bottom(); ?>
						</div>

						<?php Brook_THA::instance()->header_wrap_bottom(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

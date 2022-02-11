<div id="page-title-bar" <?php Brook::title_bar_class(); ?>>
	<div class="page-title-bar-overlay"></div>

	<div class="page-title-bar-inner">
		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<?php Brook_Templates::get_title_bar_title(); ?>
				</div>
			</div>
		</div>

		<?php get_template_part( 'components/breadcrumb' ); ?>
	</div>
</div>

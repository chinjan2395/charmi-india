<?php
$text = Brook::setting( 'top_bar_style_01_text' );
?>
<div <?php Brook::top_bar_class(); ?>>
	<div class="container">
		<div class="row row-eq-height">
			<div class="col-md-6">
				<div class="top-bar-wrap top-bar-left">
					<?php echo '<div class="top-bar-text-wrap"><div class="top-bar-text">' . $text . '</div></div>' ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="top-bar-wrap top-bar-right">
					<?php Brook_Templates::top_bar_social_networks(); ?>

					<?php if ( '1' === Brook::setting( 'top_bar_style_01_widget_enable' ) ) : ?>
						<div class="top-bar-widgets">
							<?php Brook_Templates::generated_sidebar( 'top_bar_widgets' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$footer_page = Brook_Global::instance()->get_footer_type();

if ( $footer_page === '' ) {
	return;
}

$_brook_args = array(
	'post_type'   => 'ic_footer',
	'name'        => $footer_page,
	'post_status' => 'publish',
);

$_brook_query = new WP_Query( $_brook_args );
?>
<?php if ( $_brook_query->have_posts() ) { ?>
	<?php while ( $_brook_query->have_posts() ) : $_brook_query->the_post(); ?>
		<?php
		$footer_options      = unserialize( get_post_meta( get_the_ID(), 'insight_footer_options', true ) );
		$_effect             = Brook_Helper::get_the_post_meta( $footer_options, 'effect', '' );
		$_style              = Brook_Helper::get_the_post_meta( $footer_options, 'style', '01' );
		$footer_wrap_classes = "page-footer-wrapper $footer_page footer-style-$_style";

		if ( $_effect !== '' ) {
			$footer_wrap_classes .= " {$_effect}";
		}
		?>
		<div id="page-footer-wrapper" class="<?php echo esc_attr( $footer_wrap_classes ); ?>">
			<div id="page-footer" <?php Brook::footer_class(); ?>>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-footer-inner">
								<?php
								// bbPress plugin remove all filters for the_content. then shortcodes won't rendering properly.
								if ( class_exists( 'bbPress' ) ) :
									echo do_shortcode( get_the_content() );
								else:
									the_content();
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	endwhile;
} else {
	?>
	<div class="page-footer simple-footer" id="page-footer">
		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<div class="footer-text">
						<?php $copyright_text = Brook::setting( 'footer_simple_text' ); ?>
						<?php echo wp_kses( $copyright_text, 'brook-default' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
wp_reset_postdata();

<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
$quote_text   = Brook_Helper::get_the_post_meta( $post_options, 'post_quote_text', '' );

if ( $post_options !== false && $quote_text !== '' ) {

	$quote_name = Brook_Helper::get_the_post_meta( $post_options, 'post_quote_name', '' );
	$quote_url  = Brook_Helper::get_the_post_meta( $post_options, 'post_quote_url', '' );
	?>
	<div class="post-feature post-quote">
		<h3 class="post-quote-text">
			<a href="<?php the_permalink(); ?>">
				<?php echo esc_html( '&ldquo;' . $quote_text . '&rdquo;' ); ?>
			</a>
		</h3>
		<?php if ( $quote_name !== '' ) { ?>
			<h6 class="post-quote-name">
				<?php if ( $quote_url !== '' ) { ?>
					<a href="<?php echo esc_url( $quote_url ); ?>"
					   target="_blank"><?php echo esc_html( $quote_name ); ?></a>
				<?php } else { ?>
					<?php echo esc_html( '- ' . $quote_name ); ?>
				<?php } ?>
			</h6>
		<?php } ?>
	</div>
<?php } ?>

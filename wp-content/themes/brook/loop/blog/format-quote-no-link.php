<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
$quote_text   = Brook_Helper::get_the_post_meta( $post_options, 'post_quote_text', '' );
if ( $post_options !== false && $quote_text !== '' ) {
	$quote_name = Brook_Helper::get_the_post_meta( $post_options, 'post_quote_name', '' );
	?>

	<div class="post-quote">
		<h3 class="post-quote-text">
			<?php echo esc_html( '&ldquo;' . $quote_text . '&rdquo;' ); ?>
		</h3>
		<?php if ( $quote_name !== '' ) { ?>
			<h6 class="post-quote-name">
				<?php echo esc_html( '- ' . $quote_name ); ?>
			</h6>
		<?php } ?>
	</div>

<?php }

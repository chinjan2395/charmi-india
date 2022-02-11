<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
$quote_text   = Brook_Helper::get_the_post_meta( $post_options, 'post_quote_text', '' );

if ( $post_options !== false && $quote_text !== '' ) {

	$quote_name = Brook_Helper::get_the_post_meta( $post_options, 'post_quote_name', '' );
	?>
	<a href="<?php the_permalink(); ?>">
		<div class="post-quote">

			<div class="post-overlay"
				<?php if ( has_post_thumbnail() ) { ?>
					<?php
					$feature_url = Brook_Image::get_the_post_thumbnail_url( array(
						'size'   => 'custom',
						'width'  => 370,
						'height' => 490,
					) );
					?>
					style="<?php echo esc_attr( "background-image: url( {$feature_url} );" ); ?>"
				<?php } ?>
			>

			</div>

			<h3 class="post-quote-text">
				<?php echo esc_html( $quote_text ); ?>
			</h3>
			<?php if ( $quote_name !== '' ) { ?>
				<h6 class="post-quote-name">
					<?php echo esc_html( '- ' . $quote_name ); ?>
				</h6>
			<?php } ?>

			<div class="post-quote-icon">
				<span class="fa fa-quote-right"></span>
			</div>
		</div>
	</a>
<?php } ?>

<div class="post-overlay primary-background-color"></div>
<div class="post-overlay-content">
	<div class="post-overlay-content-inner">
		<div class="post-overlay-info">
			<h3 class="post-overlay-title"><?php the_title(); ?></h3>

			<?php
			$terms = get_the_terms( $post->ID, 'portfolio_category' );
			if ( is_array( $terms ) ) { ?>
				<div class="post-overlay-categories">
					<?php
					$separator = ', ';
					$_c        = 0;
					$tem       = '';
					foreach ( $terms as $term ) {
						if ( $_c > 0 ) {
							$tem .= $separator;
						}

						$tem .= $term->name;

						$_c++;
					}

					echo esc_html( $tem );
					?>
				</div>
			<?php } ?>

		</div>
	</div>
</div>

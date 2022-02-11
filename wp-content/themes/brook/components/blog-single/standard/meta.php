<div class="post-meta">
	<?php if ( Brook::setting( 'single_post_date_enable' ) === '1' ) : ?>
		<div class="post-date">
			<?php echo get_the_date(); ?></div>
	<?php endif; ?>

	<?php if ( Brook::setting( 'single_post_categories_enable' ) === '1' && has_category() ) : ?>
		<div class="post-categories">
			<?php the_category( ', ' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( Brook::setting( 'single_post_author_enable' ) === '1' ) : ?>
		<div class="post-author-meta">
			<span class="fa fa-user-alt meta-icon"></span>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
		</div>
	<?php endif; ?>

	<?php if ( Brook::setting( 'single_post_comment_count_enable' ) ) : ?>
		<div class="post-comments-number">
			<span class="fa fa-comment meta-icon"></span>
			<?php
			$comment_count = get_comments_number();
			if ( $comment_count > 0 ) {
				$comment_count = str_pad( get_comments_number(), 2, '0', STR_PAD_LEFT );
			}

			$comment_count .= $comment_count > 1 ? esc_html__( ' Comments', 'brook' ) : esc_html__( ' Comment', 'brook' );
			?>
			<a href="#comments" class="smooth-scroll-link"><?php echo esc_html( $comment_count ); ?></a>
		</div>
	<?php endif; ?>
</div>

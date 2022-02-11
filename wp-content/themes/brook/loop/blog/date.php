<?php
$title = get_the_title();
?>

<div class="post-date">

	<?php if ( $title === '' ) : ?>
	<a href="<?php the_permalink(); ?>">
		<?php endif; ?>

		<?php echo get_the_date(); ?>

		<?php if ( $title === '' ) : ?>
	</a>
<?php endif; ?>

</div>

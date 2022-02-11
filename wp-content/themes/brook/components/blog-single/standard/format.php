<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-feature post-thumbnail">
		<?php
		Brook_Image::the_post_thumbnail( array(
			'size'   => 'custom',
			'width'  => 770,
			'height' => 510,
		) );
		?>
	</div>
<?php } ?>


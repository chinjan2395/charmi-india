<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-feature post-thumbnail">
		<?php
		Brook_Image::the_post_thumbnail( array(
			'size' => '1170x600',
		) );
		?>
	</div>
<?php } ?>

<?php if ( has_category() ) : ?>
	<div class="post-categories">
		<?php
		$categories = get_the_category();
		$c          = 0;
		$separator  = ', ';

		foreach ( $categories as $category ) {
			if ( $c > 0 ) {
				echo "{$separator}<span>{$category->name}</span>";
			} else {
				echo "<span>{$category->name}</span>";
			}

			$c ++;
		}
		?>
	</div>
<?php endif; ?>

<?php
if ( ! class_exists( 'TM_Posts_Widget' ) ) {
	class TM_Posts_Widget extends Brook_Widget {

		public function __construct() {

			$cat_options = array(
				'recent_posts' => esc_html__( 'Recent Posts', 'brook' ),
				'sticky_posts' => esc_html__( 'Sticky Posts', 'brook' ),
			);
			$categories  = get_categories( 'hide_empty=0' );
			if ( $categories ) {
				foreach ( $categories as $category ) {
					$cat_options[ $category->term_id ] = esc_html__( 'Category: ', 'brook' ) . $category->name;
				}
			}

			$this->widget_cssclass    = 'tm-posts-widget';
			$this->widget_description = esc_html__( 'Get list blog post.', 'brook' );
			$this->widget_id          = 'tm-posts-widget';
			$this->widget_name        = esc_html__( '[Brook] Posts', 'brook' );
			$this->settings           = array(
				'title'           => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title', 'brook' ),
				),
				'cat'             => array(
					'type'    => 'select',
					'std'     => 'recent_posts',
					'label'   => esc_html__( 'Category', 'brook' ),
					'options' => $cat_options,
				),
				'show_thumbnail'  => array(
					'type'  => 'checkbox',
					'std'   => 1,
					'label' => esc_html__( 'Show Thumbnail', 'brook' ),
				),
				'show_categories' => array(
					'type'  => 'checkbox',
					'std'   => 1,
					'label' => esc_html__( 'Show Categories', 'brook' ),
				),
				'show_date'       => array(
					'type'  => 'checkbox',
					'std'   => 0,
					'label' => esc_html__( 'Show Date', 'brook' ),
				),
				'num'             => array(
					'type'  => 'number',
					'step'  => 1,
					'min'   => 1,
					'max'   => 40,
					'std'   => 5,
					'label' => esc_html__( 'Number Posts', 'brook' ),
				),
			);

			parent::__construct();
		}

		public function widget( $args, $instance ) {
			$cat             = isset( $instance['cat'] ) ? $instance['cat'] : $this->settings['cat']['std'];
			$num             = isset( $instance['num'] ) ? $instance['num'] : $this->settings['num']['std'];
			$show_thumbnail  = isset( $instance['show_thumbnail'] ) && $instance['show_thumbnail'] === 1 ? 'true' : 'false';
			$show_categories = isset( $instance['show_categories'] ) && $instance['show_categories'] === 1 ? 'true' : 'false';
			$show_date       = isset( $instance['show_date'] ) && $instance['show_date'] === 1 ? 'true' : 'false';

			$this->widget_start( $args, $instance );

			if ( $cat === 'recent_posts' ) {
				$query_args = array(
					'post_type'           => 'post',
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $num,
					'orderby'             => 'date',
					'order'               => 'DESC',
					'no_found_rows'       => true,
				);
			} elseif ( $cat === 'sticky_posts' ) {
				$sticky     = get_option( 'sticky_posts' );
				$query_args = array(
					'post_type'      => 'post',
					'post__in'       => $sticky,
					'posts_per_page' => $num,
					'no_found_rows'  => true,
				);
			} else {
				$query_args = array(
					'post_type'           => 'post',
					'cat'                 => $cat,
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $num,
					'no_found_rows'       => true,
				);
			}

			$brook_query = new WP_Query( $query_args );
			if ( $brook_query->have_posts() ) {
				$count = $brook_query->post_count;
				$i     = 0;
				?>
				<div class="tm-posts-widget-wrapper">
					<?php
					while ( $brook_query->have_posts() ) {
						$brook_query->the_post();
						$i++;
						$classes = array( 'post-item' );
						if ( $i === 1 ) {
							$classes[] = 'first-post';
						} elseif ( $i === $count ) {
							$classes[] = 'last-post';
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?> >
							<?php if ( $show_thumbnail === 'true' ) : ?>
								<div class="post-widget-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail() ) { ?>
											<?php Brook_Image::the_post_thumbnail( array( 'size' => '80x80' ) ); ?>
											<?php
										} else {
											Brook_Templates::image_placeholder( 80, 80 );
										}
										?>
										<div class="post-widget-overlay">
											<span class="post-overlay-icon fa fa-search"></span>
										</div>
									</a>
								</div>
							<?php endif; ?>
							<div class="post-widget-info">
								<?php if ( $show_categories === 'true' ) : ?>
									<div class="post-widget-categories">
										<?php the_category( ', ' ); ?>
									</div>
								<?php endif; ?>
								<h5 class="post-widget-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h5>
								<?php if ( $show_date === 'true' ) : ?>
									<span class="post-date style-1"><?php echo get_the_date( 'F d, Y' ); ?></span>
								<?php endif; ?>
							</div>
						</div>
						<?php
					} ?>
				</div>
				<?php
			}
			wp_reset_postdata();

			$this->widget_end( $args );
		}
	}
}

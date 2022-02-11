<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Brook_Portfolio' ) ) {
	class Brook_Portfolio {

		public function __construct() {
			add_action( 'wp_ajax_portfolio_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_portfolio_infinite_load', array( $this, 'infinite_load' ) );
		}

		public static function get_categories( $args = array() ) {
			$defaults = array(
				'all' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			$terms    = get_terms( array(
				'taxonomy' => 'portfolio_category',
			) );
			$results  = array();

			if ( $args['all'] === true ) {
				$results['-1'] = esc_html__( 'All', 'brook' );
			}

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$results[ $term->slug ] = $term->name;
				}
			}

			return $results;
		}

		public static function get_tags( $args = array() ) {
			$defaults = array(
				'all' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			$terms    = get_terms( array(
				'taxonomy' => 'portfolio_tags',
			) );
			$results  = array();

			if ( $args['all'] === true ) {
				$results['-1'] = esc_html__( 'All', 'brook' );
			}

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$results[ $term->slug ] = $term->name;
				}
			}

			return $results;
		}

		public static function get_related_items( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}
			$query_args              = array(
				'post_type'      => 'portfolio',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true,
			);
			$related_by              = Brook::setting( 'portfolio_related_by' );
			$query_args['tax_query'] = array();
			if ( ! empty( $related_by ) ) {
				foreach ( $related_by as $tax ) {
					$terms = get_the_terms( $args['post_id'], $tax );
					if ( $terms && ! is_wp_error( $terms ) ) {
						$term_ids = array();
						foreach ( $terms as $term ) {
							$term_ids[] = $term->term_id;
						}
						$query_args['tax_query'][] = array(
							'terms'    => $term_ids,
							'taxonomy' => $tax,
						);
					}
				}
				if ( count( $query_args['tax_query'] ) > 1 ) {
					$query_args['tax_query']['relation'] = 'OR';
				}
			}

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		public static function get_latest_items( $args ) {
			$defaults = array(
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 ) {
				return false;
			}

			$query_args = array(
				'post_type'           => 'portfolio',
				'orderby'             => 'date',
				'order'               => 'DESC',
				'ignore_sticky_posts' => 0,
				'meta_key'            => '_thumbnail_id',
				'posts_per_page'      => $args['number_posts'],
				'no_found_rows'       => true,
			);

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		public function infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Brook_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			if ( ! empty( $_POST['extra_taxonomy'] ) ) {
				$args = Brook_VC::get_tax_query_of_taxonomies( $args, $_POST['extra_taxonomy'] );
			}

			$style                    = isset( $_POST['style'] ) ? $_POST['style'] : 'grid';
			$image_size               = isset( $_POST['image_size'] ) ? $_POST['image_size'] : '';
			$masonry_image_size_width = isset( $_POST['masonry_image_size_width'] ) ? $_POST['masonry_image_size_width'] : '';
			$overlay_style            = isset( $_POST['overlay_style'] ) ? $_POST['overlay_style'] : '';
			$metro_layout             = isset( $_POST['metro_layout'] ) ? $_POST['metro_layout'] : '';

			$brook_query = new WP_Query( $args );
			$count       = $brook_query->post_count;

			$response = array(
				'max_num_pages' => $brook_query->max_num_pages,
				'found_posts'   => $brook_query->found_posts,
				'count'         => $brook_query->post_count,
				'test'          => $args,
			);

			ob_start();

			if ( $brook_query->have_posts() ) :

				set_query_var( 'brook_query', $brook_query );
				set_query_var( 'count', $count );
				set_query_var( 'image_size', $image_size );
				set_query_var( 'masonry_image_size_width', $masonry_image_size_width );
				set_query_var( 'overlay_style', $overlay_style );
				set_query_var( 'metro_layout', $metro_layout );

				get_template_part( 'loop/shortcodes/portfolio/style', $style );

			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public static function is_taxonomy() {
			return is_tax( get_object_taxonomies( 'portfolio' ) );
		}

		public static function has_tag() {
			if ( has_term( '', 'portfolio_tags' ) ) {
				return true;
			}

			return false;
		}

		public static function has_category() {
			if ( has_term( '', 'portfolio_category' ) ) {
				return true;
			}

			return false;
		}

		public static function nav_page_links() {
			$args = array(
				'prev_text' => esc_html__( 'Prev', 'brook' ),
				'next_text' => esc_html__( 'Next', 'brook' ),
			);

			$args = apply_filters( 'brook_portfolio_nav_page_links_args', $args );

			?>
			<div class="portfolio-nav-links">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="nav-list">
								<div class="nav-item prev">
									<div class="inner">
										<?php previous_post_link( '%link', '<div>' . $args['prev_text'] . '</div><h6>%title</h6>' ); ?>
									</div>
								</div>

								<div class="nav-item next">
									<div class="inner">
										<?php next_post_link( '%link', '<div>' . $args['next_text'] . '</div><h6>%title</h6>' ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
		}

		public static function get_the_post_meta( $name = '', $default = '' ) {
			$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_portfolio_options', true ) );

			if ( $post_options !== false && isset( $post_options[ $name ] ) ) {
				return $post_options[ $name ];
			}

			return $default;
		}

		public static function the_categories() {
			?>
			<div class="post-categories">
				<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
			</div>
			<?php
		}

		public static function the_categories_no_link() {
			$terms = get_the_terms( get_the_ID(), 'portfolio_category' );

			if ( is_array( $terms ) ) { ?>
				<div class="post-categories">
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
				<?php
			}
		}

		public static function portfolio_video( $args = array() ) {
			$defaults = array(
				'position' => 'above',
			);
			$args     = wp_parse_args( $args, $defaults );

			$show_video = Brook::setting( 'single_portfolio_video_enable' );

			if ( $show_video === 'none' || $show_video !== $args['position'] ) {
				return;
			}

			$url = Brook_Helper::get_post_meta( 'portfolio_video_url', '' );
			if ( $url === '' ) {
				return;
			}

			$embed = wp_oembed_get( $url );

			if ( $embed === false ) {
				return;
			}

			$wrap_classes = 'portfolio-details-video embed-responsive-16by9 embed-responsive';
			$wrap_classes .= " {$args['position']}";
			?>
			<div class="<?php echo esc_attr( $wrap_classes ); ?>">
				<?php echo $embed; ?>
			</div>
			<?php
		}

		public static function get_the_permalink() {
			$external = Brook::setting( 'archive_portfolio_external_url' );

			$url = get_the_permalink();

			if ( $external === '1' ) {
				$_url = self::get_the_post_meta( 'portfolio_url', '' );

				if ( $_url !== '' ) {
					$url = $_url;
				}
			}

			return $url;
		}

		public static function the_permalink() {
			$url = self::get_the_permalink();

			echo esc_url( $url );
		}

		public static function entry_about_project_label() {
			$label = Brook::setting( 'single_portfolio_about_title' );

			if ( $label !== '' ) {
				?>
				<h6 class="portfolio-about-project-label"><?php echo esc_html( $label ); ?></h6>
				<?php
			}
		}
	}

	new Brook_Portfolio();
}

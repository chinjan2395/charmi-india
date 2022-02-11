<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Brook_Post' ) ) {
	class Brook_Post {

		public function __construct() {
			add_action( 'wp_ajax_post_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_post_infinite_load', array( $this, 'infinite_load' ) );

			add_filter( 'post_class', array( $this, 'post_class' ) );
		}

		public function post_class( $classes ) {
			global $post;

			if ( ! has_post_thumbnail() ) {
				$classes[] = 'post-no-thumbnail';
			}

			return $classes;
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

			$style        = isset( $_POST['style'] ) ? $_POST['style'] : 'grid_classic_01';
			$metro_layout = isset( $_POST['metro_layout'] ) ? $_POST['metro_layout'] : '';

			$brook_query = new WP_Query( $args );
			$count       = $brook_query->post_count;

			$response = array(
				'max_num_pages' => $brook_query->max_num_pages,
				'found_posts'   => $brook_query->found_posts,
				'count'         => $brook_query->post_count,
			);

			ob_start();

			if ( $brook_query->have_posts() ) :

				set_query_var( 'brook_query', $brook_query );
				set_query_var( 'count', $count );
				set_query_var( 'metro_layout', $metro_layout );

				get_template_part( 'loop/shortcodes/blog/style', $style );

			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public static function get_related_posts( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}

			$categories = get_the_category( $args['post_id'] );

			if ( ! $categories ) {
				return false;
			}

			foreach ( $categories as $category ) {
				if ( $category->parent === 0 ) {
					$term_ids[] = $category->term_id;
				} else {
					$term_ids[] = $category->parent;
					$term_ids[] = $category->term_id;
				}
			}

			// Remove duplicate values from the array.
			$unique_array = array_unique( $term_ids );

			$query_args = array(
				'post_type'      => 'post',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true,
				'tax_query'      => array(
					array(
						'taxonomy'         => 'category',
						'terms'            => $unique_array,
						'include_children' => false,
					),
				),
			);

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		public static function get_the_post_format() {
			$format = '';
			if ( get_post_format() !== false ) {
				$format = get_post_format();
			}

			return $format;
		}
	}

	new Brook_Post();
}

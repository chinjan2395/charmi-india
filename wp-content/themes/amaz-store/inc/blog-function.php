<?php 
/**
 * Blog Function
 * @package     Amaz Store
 * @author      ThemeHunk
 * @copyright   Copyright (c) 2018, ThemeHunk
 * @since       ThemeHunk 1.0.0
 */

        /**
		 * Excerpt count.
		 *
		 * @param int $length default count of words.
		 * @return int count of words
		 */
		function amaz_store_excerpt_length( $length ){
			if(is_admin()){
             	return $length;
             }
			 $excerpt_length = (string) get_theme_mod( 'amaz_store_blog_expt_length' );

			if ( '' != $excerpt_length ) {
			   $length = $excerpt_length;
			}
			return $length;
		}
		add_filter( 'excerpt_length','amaz_store_excerpt_length', 999 );
/**
 * Display Blog Post Excerpt
 */
if ( ! function_exists( 'amaz_store_the_excerpt' ) ){
	/**
	 * Display Blog Post Excerpt
	 *
	 * @since 1.0.0
	 */
	function amaz_store_the_excerpt(){?>
		<div class="entry-content">
		<?php  $excerpt_type = get_theme_mod( 'amaz_store_blog_post_content','excerpt');
		if ( 'full' == $excerpt_type ){
			the_content();
		} elseif('excerpt' == $excerpt_type ){
			the_excerpt();
		} else {
          return false;
		}?>
		</div>	
	<?php }
}

/**
		 * Read more text.
		 *
		 * @param string $text default read more text.
		 * @return string read more text
		 */
		function amaz_store_read_more_text( $text ) {

			$read_more = esc_html(get_theme_mod( 'amaz_store_blog_read_more_txt' ));

			if ( '' != $read_more ) {
				$text = $read_more;
			}

			return $text;
		}
      add_filter( 'open_post_read_more', 'amaz_store_read_more_text');
/**
 * Function to get Read More Link of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'amaz_store_post_link' ) ){
	/**
	 * Function to get Read More Link of Post
	 *
	 * @param  string $output_filter Filter string.
	 * @return html                Markup.
	 */
	function amaz_store_post_link( $output_filter = '' ){

		$enabled = apply_filters( 'open_post_link_enabled', '__return_true' );
		if ( ( is_admin() && ! wp_doing_ajax() ) || ! $enabled ){
			return $output_filter;
		}
		$amaz_store_read_more_text = apply_filters( 'open_post_read_more', __( 'Read More', 'amaz-store' ) );
		$read_more_classes        = apply_filters( 'open_post_read_more_class', array() );
		$post_link = sprintf(
			esc_html( '%s' ),
			'<a class="' . implode( ' ', $read_more_classes ) . ' thunk-readmore button " href="' . esc_url( get_permalink() ) . '"> ' . the_title( '<span class="screen-reader-text">', '</span>', false ) . $amaz_store_read_more_text . '</a>'
		);
		$output = ' &hellip;<p class="read-more"> ' . $post_link . '</p>';
		return apply_filters( 'amaz_store_post_link', $output, $output_filter );
	}
}
add_filter( 'excerpt_more', 'amaz_store_post_link', 1 );
/*******************/
// loader function
/*******************/
if ( ! function_exists( 'amaz_store_post_loader' ) ):
function amaz_store_post_loader(){
$amaz_store_blog_post_pagination = get_theme_mod( 'amaz_store_blog_post_pagination','num');
if($amaz_store_blog_post_pagination=='num'){
the_posts_pagination(array(
    'mid_size'  => 2,
    'prev_text' => __( '&nbsp;', 'amaz-store' ),
    'next_text' => __( '&nbsp;', 'amaz-store' ),
));
}
elseif($amaz_store_blog_post_pagination=='click'){	
//amaz_store_load_more_button();
}
elseif($amaz_store_blog_post_pagination=='scroll'){
//amaz_store_scrolling_ajax();
}
}
endif;
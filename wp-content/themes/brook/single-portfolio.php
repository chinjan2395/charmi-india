<?php
/**
 * The template for displaying all single portfolio posts.
 *
 * @package Brook
 * @since   1.0
 */
$style = Brook_Helper::get_post_meta( 'portfolio_layout_style', '' );
if ( $style === '' ) {
	$style = Brook::setting( 'single_portfolio_style' );
}

if ( $style === 'blank' ) {
	get_template_part( 'components/portfolio/content-single', 'blank' );
} else {
	get_template_part( 'components/portfolio/content-single' );
}



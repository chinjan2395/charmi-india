/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Feature Posts height
	wp.customize( 'feature_posts_height', function( value ) {
	    value.bind( function( to ) {
	        $( ".feature-posts-content-wrap .feature-posts-image" ).css( "height", to + 'px' );
	    } );
	} );

	// Header image height
	wp.customize( 'header_image_height', function( value ) {
	    value.bind( function( to ) {
	        $( ".header-image-wrap" ).css( "height", to + 'px' );
	    } );
	} );

} )( jQuery );
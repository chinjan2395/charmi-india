jQuery( document ).ready( function( $ ) {
	'use strict';

	var $pageWrapper = $( '#page' );

	var scrollOffset = window.innerHeight / 2;

	$( '.vc_container-scrolling' ).scrollie( {
		scrollOffset: - scrollOffset,
		scrollingInView: function( elem ) {

			var bgColor = elem.data( 'scrolling-background' );

			$pageWrapper.css( 'background', bgColor );
		}
	} );

	$( window ).scroll();
} );

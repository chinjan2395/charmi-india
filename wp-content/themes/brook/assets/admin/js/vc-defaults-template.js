jQuery( function( $ ) {
	'use strict';

	$( document ).ready( function() {

		var trigger = true;

		$( '.vc_edit-form-tab[data-tab="default_templates"]' ).on( 'click', '.vc_ui-list-bar-item', function() {
			if ( trigger === true ) {
				$( this ).find( '.vc_ui-list-bar-item-trigger' ).trigger( 'click' );
			} else {
				trigger = true;
			}
		} );

		$( '.vc_ui-list-bar-item-trigger' ).on( 'click', function() {
			trigger = false;
		} );

		[].forEach.call( document.querySelectorAll( '.vc_ui-template img[data-src]' ), function( img ) {
			img.setAttribute( 'src', img.getAttribute( 'data-src' ) );
			img.onload = function() {
				img.removeAttribute( 'data-src' );
			};
		} );

		// Set counts.
		$( '.vc_edit-form-tab[data-tab="default_templates"] .library_categories ul > li' ).each( function() {
			if ( $( this ).attr( 'data-sort' ) === 'all' ) {
				$( this ).find( '.count' ).html( $( '.vc_edit-form-tab[data-tab="default_templates"] .vc_ui-template-list > .vc_ui-template' ).length );
			} else {
				$( this ).find( '.count' ).html( $( '.vc_edit-form-tab[data-tab="default_templates"] .vc_ui-template-list > .vc_ui-template.' + $( this ).attr( 'data-sort' ) ).length );
			}
		} );

		// Filtering.
		$( '.vc_edit-form-tab[data-tab="default_templates"] .library_categories li[data-sort="all"]' ).addClass( 'active' ).trigger( 'click' );

		$( '.vc_edit-form-tab[data-tab="default_templates"] .library_categories li' ).on( 'click', function() {
			$( '.vc_edit-form-tab[data-tab="default_templates"] .library_categories li' ).removeClass( 'active' );
			$( this ).addClass( 'active' );

			var $selectedCat = $( this ).attr( 'data-sort' );

			$( '.vc_edit-form-tab[data-tab="default_templates"] .vc_ui-template-list > .vc_ui-template' ).removeClass( 'hidden' );

			if ( $selectedCat !== 'all' ) {
				$( '.vc_edit-form-tab[data-tab="default_templates"] .vc_ui-template-list > .vc_ui-template:not(.' + $selectedCat + ')' ).addClass( 'hidden' );
			}
		} );
	} );
} );

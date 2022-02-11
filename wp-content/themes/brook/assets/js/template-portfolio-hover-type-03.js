jQuery( document ).ready( function( $ ) {
	'use strict';

	var $pageHeader = $( '#page-header' );
	var list = $( '#portfolio-list' );
	var imager = $( '#portfolio-feature-bg' );

	handlerTitleHover();
	handlerImagerHeight();

	$( window ).resize( function() {
		handlerImagerHeight();
	} );

	function handlerImagerHeight() {
		var usedHeight = 0;

		if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) ) {
			usedHeight += $pageHeader.outerHeight()
		}

		var adminBar = $( '#wpadminbar' );

		if ( adminBar.length > 0 ) {
			usedHeight += adminBar.outerHeight();
		}

		usedHeight += list.outerHeight();

		var wHeight = window.innerHeight;

		var availabelH = wHeight - usedHeight;

		imager.css( 'height', availabelH );
	}

	function handlerTitleHover() {
		list.find( '.post-permalink' ).hoverIntent( function() {
			var _parent = $( this ).parent( '.portfolio' );

			handlerHoverType( _parent );
		}, function() {
		} );

		var _first = list.find( '.swiper-slide-active' ).children( '.portfolio' );

		handlerHoverType( _first );

		var mySwiper = document.querySelector( '.swiper-container' ).swiper;

		mySwiper.on( 'slideChange', function() {
			var index = mySwiper.activeIndex;

			var activeSlide = $( mySwiper.wrapperEl ).children( '.swiper-slide' ).eq( index );
			var post = activeSlide.children( '.portfolio' );

			handlerHoverType( post );
		} );

		function handlerHoverType( _parent ) {
			if ( _parent.hasClass( 'active' ) ) {
				return;
			}

			var id = _parent.data( 'id' );
			var currentImage = imager.find( '.post-' + id );

			_parent.parent( '.swiper-slide' ).siblings( '.swiper-slide' ).children( '.portfolio' ).removeClass( 'active' );
			_parent.addClass( 'active' );

			currentImage.siblings().removeClass( 'active' );
			currentImage.addClass( 'active' );
		}
	}
} );

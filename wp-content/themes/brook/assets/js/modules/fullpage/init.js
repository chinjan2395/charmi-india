(
	function( $ ) {
		'use strict';

		var $body = $( 'body' );
		var $container = $( '#one-page-scroll' );
		var dots = $container.data( 'enable-dots' ) && $container.data( 'enable-dots' ) == '1' ? true : false;
		var insightInitOnePage = function() {
			$container.fullpage( {
				navigation: dots,
				navigationPosition: 'right',
				lazyLoading: true,
				scrollBar: false,
				css3: true,
				scrollingSpeed: 900,
				scrollOverflow: true,
				scrollOverflowOptions: {
					click: true
				},
				verticalCentered: true,
				afterLoad: function( anchorLink, index ) {
					var $currentRow = $container.children( '.active' );
					var skin = $currentRow.attr( 'data-skin' );
					var logoSkin = $currentRow.attr( 'data-logo-skin' );

					if ( logoSkin == '' ) {
						logoSkin = skin;
					}

					$body.attr( 'data-row-skin', skin );
					$body.attr( 'data-logo-skin', logoSkin );

					if ( ! $currentRow.hasClass( 'section-loaded' ) ) {
						$currentRow.find( '.tm-animation' ).addClass( 'animate' );
						$currentRow.find( '.has-animation' ).children( '.grid-item' ).addClass( 'animate' );

						$currentRow.find( '.vc_single_bar' ).each( function( barIndex ) {
							var bar = $( this ).find( '.vc_bar' ),
							    val = bar.data( 'percentage-value' );

							setTimeout( function() {
								bar.css( { width: val + '%' } );

							}, 200 * barIndex );
						} );
					}

					$container.find( '> div' ).css( {
						'will-change': 'auto',
						'-webkit-transform': 'translate3d(0,0,0)',
						'-moz-transform': 'translate3d(0,0,0)',
						'-ms-transform': 'translate3d(0,0,0)',
						'-o-transform': 'translate3d(0,0,0)',
						'transform': 'translate3d(0,0,0)',
						'-webkit-transition': 'none',
						'-moz-transition': 'none',
						'-ms-transition': 'none',
						'-o-transition': 'none',
						'transition': 'none'
					} );

					$currentRow.addClass( 'section-loaded' );
				}
			} );
		};

		if ( $container.length > 0 ) {
			dots = $container.data( 'enable-dots' );

			insightInitOnePage();
		}
	}
)( jQuery );

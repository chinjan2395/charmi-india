(
	function( $ ) {
		'use strict';

		var $countDown = $( '#countdown' );

		$( window ).on( 'resize', function() {
			if ( $countDown.length > 0 ) {
				$countDown.TimeCircles().rebuild();
			}

			maintenanceFullHeight();
		} );

		$( document ).ready( function() {
			maintenanceFullHeight();
			maintenanceCountdown();
		} );

		function maintenanceCountdown() {
			if ( $countDown.length > 0 ) {
				$countDown.TimeCircles( {
					circle_bg_color: 'rgba(255, 255, 255, 0.3)',
					fg_width: 0.03,
					bg_width: 1,
					direction: 'Counter-clockwise',
					time: {
						Days: { color: '#00D2DD' },
						Hours: { color: '#00D2DD' },
						Minutes: { color: '#00D2DD' },
						Seconds: { color: '#00D2DD' }
					}
				} );
			}
		}

		function maintenanceFullHeight() {
			var page = $( '#maintenance-wrap' );
			var height = $( window ).height();
			var adminBar = $( '#wpadminbar' );
			if ( adminBar ) {
				height -= adminBar.outerHeight();
			}

			var $header = $( '#page-header' );
			var $footer = $( '#page-footer' )

			if ( ! $header.hasClass( 'header-layout-fixed' ) ) {
				height -= $header.outerHeight();
			}

			if ( $footer ) {
				height -= $footer.outerHeight();
			}

			page.css( {
				'minHeight': height
			} );
		}
	}( window.jQuery )
);

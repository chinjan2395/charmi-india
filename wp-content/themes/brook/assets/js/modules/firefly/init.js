(
	function( $ ) {
		'use strict';

		$( window ).load( function() {
			$( '.tm-effect-firefly' ).each( function() {
				var $_wrap = $( this ).children( '.firefly-wrapper' ),
				    _color = $( this ).data( 'firefly-color' ) ? $( this ).data( 'firefly-color' ) : '#fff',
				    _min   = $( this ).data( 'firefly-min' ) ? $( this ).data( 'firefly-min' ) : 1,
				    _max   = $( this ).data( 'firefly-max' ) ? $( this ).data( 'firefly-max' ) : 3,
				    _total = $( this ).data( 'firefly-total' ) ? $( this ).data( 'firefly-total' ) : 30;

				$.firefly( {
					color: _color,
					minPixel: _min,
					maxPixel: _max,
					total: _total,
					on: $_wrap,
					borderRadius: '50%'
				} );
			} );
		} );
	}( jQuery )
);


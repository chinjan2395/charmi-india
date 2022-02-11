(
    function ( $ ) {
        'use strict';

        $( window ).on( 'load', function () {
            $( '.constellation-wrapper' ).each( function () {

                var lineColor = $( this ).data( 'line-color' ) ? $( this )
                        .data( 'line-color' ) : 'rgba(255, 255, 255, 0.5)',
                    starColor = $( this ).data( 'star-color' ) ? $( this )
                        .data( 'star-color' ) : 'rgba(255, 255, 255, 0.5)';

                $( this ).children( 'canvas' ).constellation( {
                    star: {
                        color: starColor,
                        width: 4
                    },
                    line: {
                        color: lineColor
                    },
                    length: (
                        window.innerWidth / 20
                    ),
                    radius: (
                        window.innerWidth / 20
                    )
                } );
            } );
        } );
    }( window.jQuery )
);

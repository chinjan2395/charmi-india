(
	function( $ ) {
		'use strict';

		$.fn.insightSwiper = function() {

			this.each( function() {

				var $slider = $( this );
				var _settings = $slider.data();

				if ( _settings.queueInit == '0' ) {
					return;
				}

				var $sliderContainer = $slider.children( '.swiper-container' ).first(),
				    lgItems          = _settings.lgItems ? _settings.lgItems : 1,
				    mdItems          = _settings.mdItems ? _settings.mdItems : lgItems,
				    smItems          = _settings.smItems ? _settings.smItems : mdItems,
				    xsItems          = _settings.xsItems ? _settings.xsItems : smItems,
				    lgGutter         = _settings.lgGutter ? _settings.lgGutter : 0,
				    mdGutter         = _settings.mdGutter ? _settings.mdGutter : lgGutter,
				    smGutter         = _settings.smGutter ? _settings.smGutter : mdGutter,
				    xsGutter         = _settings.xsGutter ? _settings.xsGutter : smGutter,
				    speed            = _settings.speed ? _settings.speed : 1000;

				if ( _settings.slideWrap ) {
					$slider.children( '.swiper-container' )
					       .children( '.swiper-wrapper' )
					       .children( 'div' )
					       .wrap( "<div class='swiper-slide'><div class='swiper-slide-inner'></div></div>" );
				}

				if ( lgItems == 'auto' ) {
					var _options = {
						slidesPerView: 'auto',
						spaceBetween: lgGutter,
						breakpoints: {
							767: {
								spaceBetween: xsGutter
							},
							990: {
								spaceBetween: smGutter
							},
							1199: {
								spaceBetween: mdGutter
							}
						}
					};
				} else {
					var _options = {
						slidesPerView: lgItems, //slidesPerGroup: lgItems,
						spaceBetween: lgGutter,
						breakpoints: {
							// when window width is <=
							767: {
								slidesPerView: xsItems,
								spaceBetween: xsGutter
							},
							990: {
								slidesPerView: smItems,
								spaceBetween: smGutter
							},
							1199: {
								slidesPerView: mdItems,
								spaceBetween: mdGutter
							}
						}
					};

					if ( _settings.slidesPerGroup == 'inherit' ) {
						_options.slidesPerGroup = lgItems;

						_options.breakpoints[ 767 ].slidesPerGroup = xsItems;
						_options.breakpoints[ 990 ].slidesPerGroup = smItems;
						_options.breakpoints[ 1199 ].slidesPerGroup = mdItems;
					}
				}

				_options.el = $sliderContainer;

				_options.watchOverflow = true;

				if ( _settings.slideColumns ) {
					_options.slidesPerColumn = _settings.slideColumns;
				}

				if ( _settings.initialSlide ) {
					_options.initialSlide = _settings.initialSlide;
				}

				if ( _settings.autoHeight ) {
					_options.autoHeight = true;
				}

				if ( speed ) {
					_options.speed = speed;
				}

				// Maybe: fade, flip
				if ( _settings.effect ) {
					_options.effect = _settings.effect;
					/*_options.fadeEffect = {
						crossFade: true
					};*/
				}

				if ( _settings.loop ) {
					_options.loop = true;
				}

				if ( _settings.centered ) {
					_options.centeredSlides = true;
				}

				if ( _settings.autoplay ) {
					_options.autoplay = {
						delay: _settings.autoplay,
						disableOnInteraction: false
					};
				}

				if ( _settings.freemode ) {
					_options.freeMode = true;
				}

				var $wrapTools;

				if ( _settings.wrapTools ) {
					$wrapTools = $( '<div class="swiper-tools"></div>' );

					$slider.append( $wrapTools );
				}

				if ( _settings.nav ) {

					if ( _settings.customNav && _settings.customNav !== '' ) {
						$customBtn = $( '#' + _settings.customNav );
						var $swiperPrev = $customBtn.find( '.slider-prev-btn' );
						var $swiperNext = $customBtn.find( '.slider-next-btn' );
					} else {
						var $swiperPrev = $( '<div class="swiper-nav-button swiper-button-prev"><i class="nav-button-icon"></i></div>' );
						var $swiperNext = $( '<div class="swiper-nav-button swiper-button-next"><i class="nav-button-icon"></i></div>' );

						var $swiperNavButtons = $( '<div class="swiper-nav-buttons"></div>' );
						$swiperNavButtons.append( $swiperPrev ).append( $swiperNext );

						if ( $wrapTools ) {
							$wrapTools.append( $swiperNavButtons );
						} else {
							$slider.append( $swiperNavButtons );
						}
					}

					_options.navigation = {
						nextEl: $swiperNext,
						prevEl: $swiperPrev
					};
				}

				if ( _settings.pagination ) {
					var $swiperPagination = $( '<div class="swiper-pagination"></div>' );
					$slider.addClass( 'has-pagination' );

					if ( $wrapTools ) {
						$wrapTools.append( $swiperPagination );
					} else {
						$slider.append( $swiperPagination );
					}

					_options.pagination = {
						el: $swiperPagination,
						clickable: true
					};

					// Custom pagination 07 (Special pagination).
					if ( $slider.hasClass( 'pagination-style-07' ) ) {
						_options.pagination.type = 'custom';
						_options.pagination.renderCustom = function( swiper, current, total ) {
							var width = (
								            100 / total
							            ) * current;

							width = width.toFixed( 6 );

							if ( swiper.prevProgressBarWidth === undefined ) {
								swiper.prevProgressBarWidth = width + '%';
							}

							return '<div class="progressbar"><div class="filled" data-width="' + width + '" style="width: ' + swiper.prevProgressBarWidth + '"></div></div>';
						};
					} else if ( $slider.hasClass( 'pagination-style-08' ) ) {
						_options.pagination.type = 'custom';
						_options.pagination.renderCustom = function( swiper, current, total ) {
							var width = (
								            100 / total
							            ) * current;

							width = width.toFixed( 6 );

							if ( swiper.prevProgressBarWidth === undefined ) {
								swiper.prevProgressBarWidth = width + '%';
							}

							// Convert to string.
							var _current = current.toString();
							var _total = total.toString();

							// Add leading 0.
							_current = _current.padStart( 2, '0' );
							_total = _total.padStart( 2, '0' );

							var fraction_template = '<div class="fraction"><span class="current">' + _current + '</span>' + '<span class="separator"> / </span>' + '<span class="total">' + _total + '</span></div>';

							return fraction_template + '<div class="progressbar"><div class="filled" data-width="' + width + '" style="width: ' + swiper.prevProgressBarWidth + '"></div></div>';
						};
					}
				}

				if ( _settings.scrollbar ) {
					var $scrollbar = $( '<div class="swiper-scrollbar"></div>' );
					$sliderContainer.prepend( $scrollbar );

					_options.scrollbar = {
						el: $scrollbar,
						draggable: true,
					};

					_options.loop = false;
				}

				if ( _settings.mousewheel ) {
					_options.mousewheel = {
						enabled: true
					};
				}

				if ( _settings.vertical ) {
					_options.direction = 'vertical'
				}

				var $swiper = new Swiper( _options );

				if ( _settings.reinitOnResize ) {
					var _timer;
					$( window ).on( 'resize', function() {
						clearTimeout( _timer );

						_timer = setTimeout( function() {
							$swiper.destroy( true, true );

							$swiper = new Swiper( $sliderContainer, _options );
						}, 300 );
					} );
				}

				// Disabled auto play when focus.
				if ( _settings.autoplay ) {
					$sliderContainer.hoverIntent( function() {
						$swiper.autoplay.stop();
					}, function() {
						$swiper.autoplay.start();
					} );
				}

				// Custom pagination 07
				if ( $swiperPagination && (
					$slider.hasClass( 'pagination-style-07' ) || $slider.hasClass( 'pagination-style-08' )
				) ) {
					$swiper.on( 'slideChangeTransitionStart', function( swiper ) {
						var $filled = $swiperPagination.find( '.filled' );
						var w = $filled.data( 'width' ) + '%';

						$filled.animate( {
							width: w
						}, 300 );

						this.prevProgressBarWidth = w;

					} );
				}

				$( document ).trigger( 'insightSwiperInit', [ $swiper, $slider, _options ] );

				return this;
			} );
		};
	}( jQuery )
);

(
	function( $ ) {
		'use strict';

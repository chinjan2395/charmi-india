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

var $window            = $( window ),
    $html              = $( 'html' ),
    $body              = $( 'body' ),
    $pageWrapper       = $( '#page' ),
    $pageHeader        = $( '#page-header' ),
    $headerInner       = $( '#page-header-inner' ),
    $pageContent       = $( '#page-content' ),
    headerStickyEnable = $insight.header_sticky_enable,
    headerStickyHeight = parseInt( $insight.header_sticky_height ),
    queueResetDelay,
    animateQueueDelay  = 200,
    wWidth             = window.innerWidth;
/**
 * Global ajaxBusy = false
 * Desc: Status of ajax
 */
var ajaxBusy = false;
$( document ).ajaxStart( function() {
	ajaxBusy = true;
} ).ajaxStop( function() {
	ajaxBusy = false;
} );

$( window ).on( 'resize', function() {
	$body.addClass( 'window-resized' );
	wWidth = window.innerWidth;

	calMobileMenuBreakpoint();
	reCalculateVcRowFullHeight();
	boxedFixVcRow();
	calculateLeftHeaderSize();
	initStickyHeader();
	initFooterParallax();
	initFooterFixed();
} );

$( window ).on( 'load', function() {
	initPreLoader();
	initStickyHeader();

	window.dispatchEvent( new Event( 'resize' ) );
} );

$( document ).on( 'vc-full-width-row', calculateLeftHeaderSize );

$( document ).ready( function() {
	// Call functions in load event to make header sticky working properly.
	initQueueAnimationForElements();
	initAnimationForElements();

	calMobileMenuBreakpoint();
	reCalculateVcRowFullHeight();
	boxedFixVcRow();

	marqueBackground();
	scrollToTop();

	// Remove empty p tags form wpautop.
	$( 'p:empty' ).each( function() {
		if ( 0 >= this.attributes.length ) {
			$( this ).remove();
		}
	} );

	insightInitGrid();
	$( '.tm-swiper' ).insightSwiper();

	setTimeout( function() {
		navOnePage();
	}, 100 );

	$body.on( 'click', '.vc_tta-tab, .vc_tta-panel', function() {
		var resizeEvent = window.document.createEvent( 'UIEvents' );
		resizeEvent.initUIEvent( 'resize', true, false, window, 0 );
		window.dispatchEvent( resizeEvent );

		setTimeout( function() {
			var resizeEvent = window.document.createEvent( 'UIEvents' );
			resizeEvent.initUIEvent( 'resize', true, false, window, 0 );
			window.dispatchEvent( resizeEvent );
		}, 300 )
	} );

	initFooterParallax();
	initFooterFixed();
	initSmoothScrollLinks();
	initLightGalleryPopups();
	initVideoPopups();
	initSearchPopup();

	insightInitSmartmenu();
	initOffCanvasMenu();
	initMobileMenu();
	handlerPageNotFound();
	handlerTestimonials();
	handlerSliderModern();
	handlerPortfolioFullscreenHoverType();
} );

function initPreLoader() {
	setTimeout( function() {
		$body.addClass( 'loaded' );
	}, 200 );

	var $loader = $( '#page-preloader' );

	setTimeout( function() {
		$loader.remove();
	}, 2000 );
}

function initLightGalleryPopups() {
	$( '.tm-light-gallery' ).each( function() {
		insightInitLightGallery( $( this ) );
	} );
}

function initVideoPopups() {
	$( '.tm-popup-video' ).each( function() {
		var options = {
			selector: 'a',
			fullScreen: false,
			zoom: false
		};
		$( this ).lightGallery( options );
	} );
}

function marqueBackground() {
	$( '.background-marque' ).each( function() {
		var $el = $( this );
		var x = 0;
		var step = 1;
		var speed = 10;

		if ( $el.hasClass( 'to-left' ) ) {
			step = - 1;
		}

		$el.css( 'background-repeat', 'repeat-x' );

		var loop = setInterval( function() {
			x += step;
			$el.css( 'background-position-x', x + 'px' );
		}, speed );

		if ( $el.data( 'marque-pause-on-hover' ) == true ) {
			$( this ).hoverIntent( function() {
				clearInterval( loop );
			}, function() {
				loop = setInterval( function() {
					x += step;
					$el.css( 'background-position-x', x + 'px' );
				}, speed );
			} );
		}
	} );
}

function initSmoothScrollLinks() {
	// Allows for easy implementation of smooth scrolling for buttons.
	$( '.smooth-scroll-link' ).on( 'click', function( e ) {
		var href = $( this ).attr( 'href' );

		if ( ! href ) {
			href = $( this ).data( 'href' );
		}

		var _wWidth = window.innerWidth;
		if ( href.match( /^([.#])(.+)/ ) ) {
			e.preventDefault();
			var offset = 0;
			if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {

				if ( $headerInner.data( 'header-position' ) === 'left' ) {
					if ( _wWidth < $insight.mobile_menu_breakpoint ) {
						offset += headerStickyHeight;
					}
				} else {
					offset += headerStickyHeight;
				}
			}

			// Add offset of admin bar when viewport min-width 600.
			if ( _wWidth > 600 ) {
				var adminBarHeight = $( '#wpadminbar' ).height();
				offset += adminBarHeight;
			}

			$.smoothScroll( {
				offset: - offset,
				scrollTarget: $( href ),
				speed: 600,
				easing: 'linear'
			} );
		}
	} );
}

function initAnimationForElements() {
	if ( ! $body.hasClass( 'page-has-animation' ) ) {
		return;
	}

	var $animations = $pageContent.find( '.tm-animation' );

	$animations.vcwaypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );
		$( _self ).addClass( 'animate' );
	}, {
		offset: '100%' // triggerOnce: true
	} );
}

function initQueueAnimationForElements() {
	$( '.tm-animation-queue' ).each( function() {
		var itemQueue  = [],
		    queueTimer,
		    queueDelay = $( this ).data( 'animation-delay' ) ? $( this ).data( 'animation-delay' ) : animateQueueDelay;

		$( this ).children( '.item' ).vcwaypoint( function() {
			// Fix for different ver of waypoints plugin.
			var _self = this.element ? this.element : $( this );

			queueResetDelay = setTimeout( function() {
				queueDelay = animateQueueDelay;
			}, animateQueueDelay );

			itemQueue.push( _self );
			processItemQueue( itemQueue, queueDelay, queueTimer );
			queueDelay += animateQueueDelay;
		}, {
			offset: '90%',
			triggerOnce: true
		} );
	} );
}

function processItemQueue( itemQueue, queueDelay, queueTimer, queueResetDelay ) {
	clearTimeout( queueResetDelay );
	queueTimer = window.setInterval( function() {
		if ( itemQueue !== undefined && itemQueue.length ) {
			$( itemQueue.shift() ).addClass( 'animate' );
			processItemQueue();
		} else {
			window.clearInterval( queueTimer );
		}
	}, queueDelay );
}

function insightInitSmartmenu() {
	var $primaryMenu = $pageHeader.find( '#page-navigation' ).find( 'ul' ).first();

	if ( ! $primaryMenu.hasClass( 'sm' ) ) {
		return;
	}

	$primaryMenu.smartmenus( {
		subMenusSubOffsetX: - 1,
		subMenusSubOffsetY: - 17
	} );

	// Add animation for sub menu.
	$primaryMenu.on( {
		'show.smapi': function( e, menu ) {
			$( menu ).removeClass( 'hide-animation' ).addClass( 'show-animation' );
		},
		'hide.smapi': function( e, menu ) {
			$( menu ).removeClass( 'show-animation' ).addClass( 'hide-animation' );
		}
	} ).on( 'animationend webkitAnimationEnd oanimationend MSAnimationEnd', 'ul', function( e ) {
		$( this ).removeClass( 'show-animation hide-animation' );
		e.stopPropagation();
	} );
}

function insightInitLightGallery( $gallery ) {
	var _download   = (
		    $insight.light_gallery_download === '1'
	    ),
	    _autoPlay   = (
		    $insight.light_gallery_auto_play === '1'
	    ),
	    _zoom       = (
		    $insight.light_gallery_zoom === '1'
	    ),
	    _fullScreen = (
		    $insight.light_gallery_full_screen === '1'
	    ),
	    _share      = (
		    $insight.light_gallery_share === '1'
	    ),
	    _thumbnail  = (
		    $insight.light_gallery_thumbnail === '1'
	    );

	var options = {
		selector: '.zoom',
		thumbnail: _thumbnail,
		download: _download,
		autoplay: _autoPlay,
		zoom: _zoom,
		share: _share,
		fullScreen: _fullScreen,
		hash: false,
		animateThumb: false,
		showThumbByDefault: false,
		getCaptionFromTitleOrAlt: false
	};

	$gallery.lightGallery( options );
}

function animateMagicLineOnScroll( $li, onScroll ) {
	if ( onScroll == false ) {
		$li.siblings( 'li' ).removeClass( 'current-menu-item' );
		$li.addClass( 'current-menu-item' );
	}
}

function navOnePage() {
	if ( ! $body.hasClass( 'one-page' ) ) {
		return;
	}
	var $header = $( '#page-header' );
	var $headerInner = $header.children( '#page-header-inner' );
	var $mainNav = $( '#page-navigation' ).find( '.menu__container' ).first();
	var $li = $mainNav.children( '.menu-item' );
	var $links = $li.children( 'a[href*="#"]:not([href="#"])' );
	var onScroll = false;

	var offset = 0;

	if ( $body.hasClass( 'admin-bar' ) ) {
		offset += 32;
	}

	if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
		offset += headerStickyHeight;
		offset = - offset;
	}

	$li.each( function() {
		if ( $( this ).hasClass( 'current-menu-item' ) ) {
			var _link = $( this ).children( 'a' );

			if ( _link[ 0 ].hash !== '' ) {
				$( this ).removeClass( 'current-menu-item' );
			}
		}
	} );

	$links.each( function() {
		var $this = $( this );
		var id = this.hash;
		var parent = $this.parent();

		if ( $( id ).length > 0 ) {
			$( id ).vcwaypoint( function( direction ) {
				if ( direction === 'down' ) {
					animateMagicLineOnScroll( parent, onScroll );
				}
			}, {
				offset: '25%'
			} );

			$( id ).vcwaypoint( function( direction ) {
				if ( direction === 'up' ) {
					animateMagicLineOnScroll( parent, onScroll );
				}
			}, {
				offset: '-25%'
			} );
		}
	} );

	// Allows for easy implementation of smooth scrolling for navigation links.
	$links.on( 'click', function() {
		var $this = $( this );
		var href = this.hash;
		var parent = $this.parent( 'li' );

		parent.siblings( 'li' ).removeClass( 'current-menu-item' );
		parent.addClass( 'current-menu-item' );

		if ( $( href ).length > 0 ) {
			$.smoothScroll( {
				offset: offset,
				scrollTarget: $( href ),
				speed: 600,
				easing: 'linear',
				beforeScroll: function() {
					onScroll = true;
				},
				afterScroll: function() {
					onScroll = false;
				}
			} );
		}

		return false;
	} );

	// Smooth scroll to section if url has hash tag when page loaded.
	var hashTag = window.location.hash;
	if ( hashTag && $( hashTag ).length > 0 ) {
		$.smoothScroll( {
			offset: offset,
			scrollTarget: $( hashTag ),
			speed: 600,
			easing: 'linear',
			beforeScroll: function() {
				onScroll = true;
			},
			afterScroll: function() {
				onScroll = false;
			}
		} );
	}
}

function initFooterParallax() {
	var footerWrap = $( '#page-footer-wrapper' );

	if ( ! footerWrap.hasClass( 'parallax' ) || $body.hasClass( 'page-template-one-page-scroll' ) ) {
		return;
	}

	if ( footerWrap.length > 0 ) {
		var contentWrap = $pageWrapper.children( '.content-wrapper' );
		if ( wWidth >= 1024 ) {
			var fwHeight = footerWrap.height();
			$body.addClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: fwHeight
			} );
		} else {
			$body.removeClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: 0
			} );
		}
	}
}

function initFooterFixed() {
	var footerWrap = $( '#page-footer-wrapper' );

	if ( ! footerWrap.hasClass( 'fixed' ) || $body.hasClass( 'page-template-one-page-scroll' ) ) {
		return;
	}

	if ( footerWrap.length > 0 ) {
		var contentWrap = $pageWrapper.children( '.content-wrapper' );

		var fwHeight = footerWrap.height();
		$body.addClass( 'page-footer-fixed' );
		contentWrap.css( {
			marginBottom: fwHeight
		} );
	}
}

function scrollToTop() {
	if ( $insight.scroll_top_enable != 1 ) {
		return;
	}
	var $scrollUp = $( '#page-scroll-up' );
	var lastScrollTop = 0;

	$window.on( 'scroll', function() {
		var st = $( this ).scrollTop();
		if ( st > lastScrollTop ) {
			$scrollUp.removeClass( 'show' );
		} else {
			if ( $window.scrollTop() > 200 ) {
				$scrollUp.addClass( 'show' );
			} else {
				$scrollUp.removeClass( 'show' );
			}
		}
		lastScrollTop = st;
	} );

	$scrollUp.on( 'click', function( evt ) {
		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
		evt.preventDefault();
	} );
}

function openMobileMenu() {
	$body.addClass( 'page-mobile-menu-opened' );

	$( document ).trigger( 'mobileMenuOpen' );
}

function closeMobileMenu() {
	$body.removeClass( 'page-mobile-menu-opened' );

	$( document ).trigger( 'mobileMenuClose' );
}

function calMobileMenuBreakpoint() {
	var _breakpoint = $insight.mobile_menu_breakpoint;
	if ( wWidth <= _breakpoint ) {
		$body.removeClass( 'desktop-menu' ).addClass( 'mobile-menu' );
	} else {
		$body.addClass( 'desktop-menu' ).removeClass( 'mobile-menu' );
	}
}

function initMobileMenu() {
	$( '#page-open-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		e.stopPropagation();

		openMobileMenu();
	} );

	$( '#page-close-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		e.stopPropagation();

		closeMobileMenu();
	} );

	$( '#page-mobile-main-menu' ).on( 'click', function( e ) {
		if ( e.target !== this ) {
			return;
		}

		closeMobileMenu();
	} );

	$( document ).on( 'mobileMenuOpen', function() {
		$html.css( {
			'overflow': 'hidden'
		} );
	} );

	$( document ).on( 'mobileMenuClose', function() {
		$html.css( {
			'overflow': ''
		} );
	} );

	var menu = $( '#mobile-menu-primary' );

	menu.on( 'click', 'a', function( e ) {
		var $this = $( this );
		var _li = $( this ).parent( 'li' );
		var href = $this.attr( 'href' );

		if ( $body.hasClass( 'one-page' ) && href && href.match( /^([.#])(.+)/ ) ) {
			closeMobileMenu();
			var offset = 0;

			if ( $body.hasClass( 'admin-bar' ) ) {
				offset += 32;
			}

			if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
				offset += headerStickyHeight;
			}

			if ( offset > 0 ) {
				offset = - offset;
			}

			_li.siblings( 'li' ).removeClass( 'current-menu-item' );
			_li.addClass( 'current-menu-item' );

			setTimeout( function() {
				$.smoothScroll( {
					offset: offset,
					scrollTarget: $( href ),
					speed: 600,
					easing: 'linear'
				} );
			}, 300 );

			return false;
		}
	} );

	menu.on( 'click', '.toggle-sub-menu', function( e ) {
		var _li = $( this ).parents( 'li' ).first();

		e.preventDefault();
		e.stopPropagation();

		var _friends = _li.siblings( '.opened' );
		_friends.removeClass( 'opened' );
		_friends.find( '.opened' ).removeClass( 'opened' );
		_friends.find( '.sub-menu' ).stop().slideUp();

		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu' ).stop().slideUp();
		} else {
			_li.addClass( 'opened' );
			_li.children( '.sub-menu' ).stop().slideDown();
		}
	} );
}

function initOffCanvasMenu() {
	$( '#page-open-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();

		$body.addClass( 'page-off-canvas-menu-opened' );
	} );

	$( '#page-close-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();

		$body.removeClass( 'page-off-canvas-menu-opened' );
	} );
}

function initStickyHeader() {
	var $headerHolder = $pageHeader.children( '.page-header-place-holder' );
	if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {
		if ( $headerInner.data( 'header-position' ) != 'left' ) {
			var _hOffset = $headerInner.offset().top;
			var _hHeight = $headerInner.outerHeight();
			var offset = _hOffset + _hHeight;

			if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) ) {
				var _hHeight = $headerInner.outerHeight();

				$headerHolder.height( _hHeight );
				$headerInner.addClass( 'held' );
			}

			$pageHeader.headroom( {
				offset: offset,

				onTop: function() {
					if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) ) {

						setTimeout( function() {
							var _hHeight = $headerInner.outerHeight();

							$headerHolder.height( _hHeight );
						}, 300 );
					}
				},
			} );
		} else {
			if ( wWidth <= $insight.mobile_menu_breakpoint ) {
				if ( ! $pageHeader.data( 'headroom' ) ) {
					var _hOffset = $headerInner.offset().top;
					var _hHeight = $headerInner.outerHeight();
					var offset = _hOffset + _hHeight;

					$pageHeader.headroom( {
						offset: offset
					} );
				}
			} else {
				if ( $pageHeader.data( 'headroom' ) ) {
					$pageHeader.data( 'headroom' ).destroy();
					$pageHeader.removeData( 'headroom' );
				}
			}
		}
	}
}

function openSearchPopup() {
	$body.addClass( 'page-search-popup-opened' );

	$html.css( {
		'overflow': 'hidden'
	} );

	var popupSearch = $( '#page-search-popup' );
	var searchField = popupSearch.find( '.search-field' );

	setTimeout( function() {
		searchField.focus();
	}, 500 );
}

function closeSearchPopup() {
	$body.removeClass( 'page-search-popup-opened' );

	$html.css( {
		'overflow': ''
	} );
}

function initSearchPopup() {
	$( '#btn-open-popup-search' ).on( 'click', function( e ) {
		e.preventDefault();
		openSearchPopup();
	} );

	$( '#search-popup-close' ).on( 'click', function( e ) {
		e.preventDefault();
		closeSearchPopup();
	} );

	var popupSearch = $( '#page-search-popup' );

	popupSearch.on( 'click', function( e ) {
		if ( e.target !== this ) {
			return;
		}

		closeSearchPopup();
	} );
}

function calculateLeftHeaderSize() {
	if ( $headerInner.data( 'header-position' ) != 'left' ) {
		return;
	}

	var _wWidth = window.innerWidth;
	var _containerWidth = parseInt( $body.data( 'site-width' ) );
	var $footer = $( '#page-footer-wrapper' );

	if ( _wWidth <= $insight.mobile_menu_breakpoint ) {
		$html.css( {
			marginLeft: 0
		} );

		if ( $footer.hasClass( 'parallax' ) || $footer.hasClass( 'fixed' ) || $footer.hasClass( 'overlay' ) ) {
			$footer.css( {
				left: 0
			} );
		}
	} else {
		var headerWidth = $headerInner.outerWidth();

		if ( $insight.isRTL ) {
			$html.css( {
				marginRight: headerWidth + 'px'
			} );
		} else {
			$html.css( {
				marginLeft: headerWidth + 'px'
			} );
		}

		if ( $footer.hasClass( 'parallax' ) || $footer.hasClass( 'fixed' ) || $footer.hasClass( 'overlay' ) ) {
			if ( $insight.isRTL ) {
				$footer.css( {
					right: headerWidth + 'px'
				} );
			} else {
				$footer.css( {
					left: headerWidth + 'px'
				} );
			}
		}

		var rows = $( '#page-main-content' ).find( '.vc_row, .vc_section' );
		var footerRows = $footer.find( '.page-footer-inner' ).first().find( '.vc_row, .vc_section' );
		rows = rows.add( footerRows );

		var $contentWidth = $( '#page' ).width();
		rows.each( function() {
			if ( $( this ).attr( 'data-vc-full-width' ) ) {
				var left = 0;

				if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
					left = - (
						(
							$contentWidth - _containerWidth
						) / 2
					) + 'px';
				}

				var width = $contentWidth + 'px';
				$( this ).css( {
					width: width
				} );

				if ( $insight.isRTL ) {
					$( this ).css( {
						right: left,
						left: 'auto'
					} );
				} else {
					$( this ).css( {
						left: left
					} );
				}

				var stretch = $( this ).attr( 'data-vc-stretch-content' );
				if ( typeof stretch === typeof undefined || stretch === false ) {
					var _padding = 0;
					if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
						_padding = (
							(
								$contentWidth - _containerWidth
							) / 2
						);
					}
					$( this ).css( {
						paddingLeft: _padding,
						paddingRight: _padding
					} );
				}
			}
		} );
	}
}

function boxedFixVcRow() {
	if ( ! $body.hasClass( 'boxed' ) ) {
		return;
	}

	if ( wWidth < 1200 ) {
		return;
	}

	var siteWidth    = $pageWrapper.outerWidth(),
	    contentWidth = $body.data( 'content-width' ),
	    space        = (
		                   siteWidth - contentWidth
	                   ) / 2;

	var breakpoint = Math.min( siteWidth, contentWidth );

	$pageWrapper.find( '[data-vc-full-width=true]' ).each( function() {
		$( this ).css( {
			left: - space,
			width: siteWidth + 'px'
		} );

		if ( $( this ).data( 'vc-stretch-content' ) != true ) {
			$( this ).css( {
				paddingLeft: space,
				paddingRight: space
			} );
		}
	} );
}

function reCalculateVcRowFullHeight() {
	var fullHeight = window.innerHeight,
	    fullHeightCal,
	    offset     = 0,
	    $adminBar  = $( '#wpadminbar' ),
	    $vcRows    = $( '.vc_row-o-full-height' );

	if ( $adminBar.length ) {
		offset += $adminBar.outerHeight();
	}

	$headerInner = $pageHeader.children( '.page-header-inner' );

	if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) &&
	     (
		     $body.hasClass( 'handheld' ) || $headerInner.data( 'header-position' ) === undefined
	     ) ) {
		var hHeight = $headerInner.outerHeight();

		offset += hHeight;
	}

	fullHeightCal = fullHeight - offset;

	$vcRows.each( function() {
		var excludeHeight = 0;
		var exclude = $( this ).data( 'exclude-height' );
		if ( exclude !== '' && $( exclude ).length > 0 ) {
			excludeHeight = $( exclude ).outerHeight();
		}

		if ( $( this ).hasClass( 'calculated-height' ) ) {
			$vcRows.css( 'min-height', (
				                           fullHeightCal - excludeHeight
			                           ) + 'px' );
		} else {
			$vcRows.css( 'min-height', (
				                           fullHeight - excludeHeight
			                           ) + 'px' );
		}
	} );

	$( document ).trigger( 'vc-full-height-row', $vcRows );
}

function handlerPageNotFound() {
	if ( ! $body.hasClass( 'error404' ) ) {
		return;
	}

	$( '#tm-btn-go-back' ).on( 'click', function( e ) {
		e.preventDefault();

		window.history.back();
	} );
}

function handlerTestimonials() {
	$( '.tm-testimonial' ).each( function() {
		if ( ! $( this ).hasClass( 'style-modern-slider' ) && ! $( this ).hasClass( 'style-modern-slider-02' ) ) {
			return;
		}

		var $slider = $( this ).children( '.tm-swiper' );

		var $sliderContainer = $slider.children( '.swiper-container' ).first();
		var lgItems = $slider.data( 'lg-items' ) ? $slider.data( 'lg-items' ) : 1;
		var mdItems = $slider.data( 'md-items' ) ? $slider.data( 'md-items' ) : lgItems;
		var smItems = $slider.data( 'sm-items' ) ? $slider.data( 'sm-items' ) : mdItems;
		var xsItems = $slider.data( 'xs-items' ) ? $slider.data( 'xs-items' ) : smItems;

		var lgGutter = $slider.data( 'lg-gutter' ) ? $slider.data( 'lg-gutter' ) : 0;
		var mdGutter = $slider.data( 'md-gutter' ) ? $slider.data( 'md-gutter' ) : lgGutter;
		var smGutter = $slider.data( 'sm-gutter' ) ? $slider.data( 'sm-gutter' ) : mdGutter;
		var xsGutter = $slider.data( 'xs-gutter' ) ? $slider.data( 'xs-gutter' ) : smGutter;

		var autoPlay = $slider.data( 'autoplay' );
		var speed = $slider.data( 'speed' ) ? $slider.data( 'speed' ) : 1000;
		var nav = $slider.data( 'nav' );
		var pagination = $slider.data( 'pagination' );
		var paginationType = $slider.data( 'pagination-type' ) ? $slider.data( 'pagination-type' ) : 'bullets';

		var options = {
			loop: true,
			slidesPerView: lgItems,
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

		if ( speed ) {
			options.speed = speed;
		}

		if ( autoPlay ) {
			options.autoplay = {
				delay: autoPlay,
				disableOnInteraction: false
			};
		}

		if ( nav ) {
			var $swiperPrev = $( '<div class="swiper-nav-button swiper-button-prev"><i class="nav-button-icon"></i></div>' );
			var $swiperNext = $( '<div class="swiper-nav-button swiper-button-next"><i class="nav-button-icon"></i></div>' );

			$slider.append( $swiperPrev ).append( $swiperNext );

			options.navigation = {
				nextEl: $swiperNext,
				prevEl: $swiperPrev,
			};
		}

		if ( pagination ) {
			var $swiperPagination = $( '<div class="swiper-pagination"></div>' );
			$slider.addClass( 'has-pagination' );

			$slider.append( $swiperPagination );

			options.pagination = {
				el: $swiperPagination,
				clickable: true,
				type: paginationType
			};
		}

		var $swiper = new Swiper( $sliderContainer, options );

		var $thumbSlider = $slider.children( '.tm-testimonial-pagination' );
		var $thumbContainer = $thumbSlider.children( '.swiper-container' ).first();

		var thumbSlides = $thumbSlider.data( 'lg-items' );
		var thumbGutter = $thumbSlider.data( 'lg-gutter' );
		var centered = $thumbSlider.data( 'centered' ) && $thumbSlider.data( 'centered' ) == '1' ? true : false;

		var thumbOptions = {
			slidesPerView: thumbSlides,
			spaceBetween: thumbGutter,
			centeredSlides: centered,
			loop: true
		};

		var $swiperThumbs = new Swiper( $thumbContainer, thumbOptions );

		$swiper.on( 'slideChange', function() {
			var $_slides = $thumbContainer.children( '.swiper-wrapper' )
			                              .children( '.swiper-slide' );
			$_slides.each( function( i, o ) {

				if ( $( this ).hasClass( 'swiper-slide-duplicate' ) ) {
					return true;
				}

				if ( $( this ).data( 'swiper-slide-index' ) === $swiper.realIndex ) {
					$swiperThumbs.slideTo( i );
				}
			} );
		} );

		$swiperThumbs.on( 'slideChange', function() {
			var $_slides = $sliderContainer.children( '.swiper-wrapper' ).children( '.swiper-slide' );
			$_slides.each( function( i, o ) {

				if ( $( this ).hasClass( 'swiper-slide-duplicate' ) ) {
					return true;
				}

				if ( $( this ).data( 'swiper-slide-index' ) === $swiperThumbs.realIndex ) {
					$swiper.slideTo( i );
				}
			} );
		} );

		$swiperThumbs.on( 'click', function() {
			$swiperThumbs.slideTo( $swiperThumbs.clickedIndex );
		} );
	} );
}

function handlerSliderModern() {
	$( '.tm-slider-modern' ).each( function() {
		var $self = $( this );

		var bgList = $self.find( '.slider-bg-list' );
		var bgItems = bgList.children( '.slide-bg' );

		$self.find( '.swiper-slide' ).hoverIntent( function() {
			if ( $( this ).hasClass( 'slider-modern-current' ) ) {
				return;
			}

			var index = $( this ).index();

			$( this ).siblings().removeClass( 'slider-modern-current' );
			$( this ).addClass( 'slider-modern-current' );

			handlerSliderModernBG( index );
		}, function() {
		} );

		handlerSliderModernBG( 0 );

		function handlerSliderModernBG( index ) {
			$self.find( '.swiper-slide' ).eq( index ).addClass( 'slider-modern-current' );

			var current = bgList.children().eq( index );

			current.siblings().removeClass( 'current' );
			current.addClass( 'current' );
		}
	} );
}

function handlerPortfolioFullscreenHoverType() {
	if ( ! $body.hasClass( 'page-template-portfolio-fullscreen-type-hover' ) && ! $body.hasClass( 'page-template-portfolio-fullscreen-type-hover-02' ) ) {
		return;
	}

	var list = $( '#portfolio-list' );
	var imager = $( '#portfolio-feature-bg' );

	list.find( '.post-permalink' ).hoverIntent( function() {
		var _parent = $( this ).parent( '.portfolio' );

		handlerHoverType( _parent );
	}, function() {
	} );

	var _first = list.children( '.portfolio' ).first();

	handlerHoverType( _first );

	function handlerHoverType( _parent ) {
		if ( _parent.hasClass( 'active' ) ) {
			return;
		}

		var id = _parent.data( 'id' );
		var currentImage = imager.find( '.post-' + id );

		_parent.siblings( '.portfolio' ).removeClass( 'active' );
		_parent.addClass( 'active' );

		currentImage.siblings().removeClass( 'active' );
		currentImage.addClass( 'active' );
	}
}

var resizeTimer;

if ( typeof Isotope != 'undefined' ) {
	// Add isotope-hidden class for filtered items.
	var itemReveal = Isotope.Item.prototype.reveal,
	    itemHide   = Isotope.Item.prototype.hide;

	Isotope.Item.prototype.reveal = function() {
		itemReveal.apply( this, arguments );
		$( this.element )
			.removeClass( 'isotope-hidden' );
	};

	Isotope.Item.prototype.hide = function() {
		itemHide.apply( this, arguments );
		$( this.element )
			.addClass( 'isotope-hidden' );
	};
}

function insightInitGrid() {
	$( '.tm-grid-wrapper' ).each( function() {
		var $el      = $( this ),
		    $grid    = $el.find( '.tm-grid' ),
		    $gridData,
		    gutter   = $el.data( 'gutter' ) ? $el.data( 'gutter' ) : 0,
		    itemWrap = $el.data( 'item-wrap' );

		if ( itemWrap == '1' ) {
			$grid.children().not( '.grid-sizer' )
			     .wrap( '<div class="grid-item"></div>' );
		}

		var $items = $grid.children( '.grid-item' );

		$( document ).trigger( 'insightGridBeforeInit', [ $el, $grid ] );

		if ( $el.data( 'type' ) == 'masonry' ) {
			var $isotopeOptions = {
				itemSelector: '.grid-item',
				percentPosition: true
			};

			if( $insight.isRTL ) {
				$isotopeOptions.originLeft = false;
			}

			if ( $el.data( 'grid-fitrows' ) ) {
				$isotopeOptions.layoutMode = 'fitRows';
			} else {
				$isotopeOptions.layoutMode = 'packery';
				$isotopeOptions.packery = {
					// Use outer width of grid-sizer for columnWidth.
					columnWidth: '.grid-sizer'
				}
			}

			if ( $isotopeOptions.layoutMode === 'fitRows' ) {
				// Set gutter for fit rows layout.
				$isotopeOptions.fitRows = {};
				$isotopeOptions.fitRows.gutter = gutter;
			} else if ( $isotopeOptions.layoutMode === 'packery' ) {
				$isotopeOptions.packery.gutter = gutter;
			} else {
				// Set gutter for masonry layout.
				$isotopeOptions.masonry.gutter = gutter;
			}

			// Remove default transition if grid has custom animation.
			if ( $grid.hasClass( 'has-animation' ) ) {
				$isotopeOptions.transitionDuration = 0;
			}

			$( window ).on( 'resize', function() {
				insightGridMasonryCalculateSize( $el, $grid, $isotopeOptions );
				clearTimeout( resizeTimer );
				resizeTimer = setTimeout( function() {
					// Run code here, resizing has "stopped"
					insightGridMasonryCalculateSize( $el, $grid, $isotopeOptions );
				}, 300 );
			} );

			insightGridMasonryCalculateSize( $el, $grid );

			$gridData = $grid.imagesLoaded( function() {
				// init Isotope after all images have loaded
				$grid.isotope( $isotopeOptions );

				if ( $el.data( 'match-height' ) ) {
					$items.matchHeight();
				}

				$( document ).trigger( 'insightGridInit', [ $el, $grid, $isotopeOptions ] );
			} );

			$gridData.one( 'arrangeComplete', function() {
				insightInitGridAnimation( $grid, $items );
				insightGridFilterCount( $el, $grid );
				initGridTiltEffect( $el, $items );
			} );
		} else if ( $el.data( 'type' ) == 'justified' ) {
			var jRowHeight        = $el.data( 'justified-height' ) ? $el.data( 'justified-height' ) : 300,
			    jMaxRowHeight     = $el.data( 'justified-max-height' ) ? $el.data( 'justified-max-height' ) : 0,
			    jLastRow          = $el.data( 'justified-last-row' ) ? $el.data( 'justified-last-row' ) : 'justify',
			    $justifiedOptions = {
				    rowHeight: jRowHeight,
				    margins: gutter,
				    border: 0,
				    lastRow: jLastRow
			    };

			if ( jMaxRowHeight && jMaxRowHeight > 0 ) {
				$justifiedOptions.maxRowHeight = jMaxRowHeight;
			}

			$grid.justifiedGallery( $justifiedOptions );
			insightGridFilterCount( $el, $grid );
			insightInitGridAnimation( $grid, $items );
			initGridTiltEffect( $el, $items );
		} else {
			insightGridFilterCount( $el, $grid );
			insightInitGridAnimation( $grid, $items );
			initGridTiltEffect( $el, $items );
		}

		insightGridFilterHandler( $el, $grid );

		if ( $el.data( 'hover' ) == 'tilt' ) {
			var zIndex = 1;

			$grid.on( 'mouseenter', '.grid-item', function() {
				zIndex ++;

				$( this ).css( 'z-index', zIndex );
			} );
		}

		if ( $el.data( 'pagination' ) == 'loadmore' ) {
			$el.children( '.tm-grid-pagination' )
			   .find( '.tm-grid-loadmore-btn' )
			   .on( 'click', function( e ) {
				   e.preventDefault();
				   if ( ! ajaxBusy ) {
					   $( this ).hide();
					   var $queryInput = $el.find( '.tm-grid-query' )
					                        .first();
					   var query = jQuery.parseJSON( $queryInput.val() );

					   query.paged ++;
					   $queryInput.val( JSON.stringify( query ) );
					   insightInfiniteQuery( $el, $grid );
				   }
			   } );
		} else if ( $el.data( 'pagination' ) == 'loadmore_alt' ) {
			var _loadmoreBtn = $( $el.data( 'pagination-custom-button-id' ) );

			_loadmoreBtn.on( 'click', function( e ) {
				e.preventDefault();
				if ( ! ajaxBusy ) {
					$( this )
						.hide();
					var $queryInput = $el.find( '.tm-grid-query' )
					                     .first();
					var query = jQuery.parseJSON( $queryInput.val() );

					query.paged ++;
					$queryInput.val( JSON.stringify( query ) );
					insightInfiniteQuery( $el, $grid );
				}
			} );
		} else if ( $el.data( 'pagination' ) == 'infinite' ) {
			$( '.tm-grid-pagination', $el ).vcwaypoint( function( direction ) {
				if ( direction === 'down' && ! ajaxBusy ) {
					var $queryInput = $el.find( '.tm-grid-query' )
					                     .first();
					var query = jQuery.parseJSON( $queryInput.val() );

					query.paged ++;
					$queryInput.val( JSON.stringify( query ) );

					insightInfiniteQuery( $el, $grid );
				}
			}, {
				offset: '100%'
			} )
		}
	} );

	$( document ).on( 'insightGridInfinityLoad', function( e, $wrapper ) {
		var $el = $( $wrapper );
		var $grid = $el.find( '.tm-grid' )
		var $queryInput = $el.find( '.tm-grid-query' )
		                     .first();
		var query = jQuery.parseJSON( $queryInput.val() );

		query.paged = 1;
		$queryInput.val( JSON.stringify( query ) );

		insightInfiniteQuery( $el, $grid, true );
	} );
}

/**
 * Calculate size for grid items
 */
function insightGridMasonryCalculateSize( $el, $grid, $isotopeOptions ) {
	var windowWidth = window.innerWidth,
	    $gridWidth  = $grid[ 0 ].getBoundingClientRect().width,
	    $gutter     = $el.data( 'gutter' ) ? $el.data( 'gutter' ) : 0,
	    $column     = 1,
	    lgColumns   = $el.data( 'lg-columns' ) ? $el.data( 'lg-columns' ) : 1,
	    mdColumns   = $el.data( 'md-columns' ) ? $el.data( 'md-columns' ) : lgColumns,
	    smColumns   = $el.data( 'sm-columns' ) ? $el.data( 'sm-columns' ) : mdColumns,
	    xsColumns   = $el.data( 'xs-columns' ) ? $el.data( 'xs-columns' ) : smColumns;

	if ( windowWidth >= 1200 ) {
		$column = lgColumns;
	} else if ( windowWidth >= 992 ) {
		$column = mdColumns;
	} else if ( windowWidth >= 641 ) {
		$column = smColumns;
	} else {
		$column = xsColumns;
	}

	var $totalGutter = (
		                   $column - 1
	                   ) * $gutter;

	var $columnWidth = (
		                   $gridWidth - $totalGutter
	                   ) / $column;

	$columnWidth = Math.floor( $columnWidth );

	var $columnWidth2 = $columnWidth;
	if ( $column > 1 ) {
		$columnWidth2 = $columnWidth * 2 + $gutter;
	}

	$grid.children( '.grid-sizer' )
	     .css( {
		     'width': $columnWidth + 'px'
	     } );

	var $columnHeight  = $columnWidth,
	    $columnHeight2 = $columnHeight,
	    ratio          = $el.data( 'grid-ratio' );

	if ( ratio ) {
		var res    = ratio.split( ':' ),
		    ratioW = parseFloat( res[ 0 ] ),
		    ratioH = parseFloat( res[ 1 ] );

		$columnHeight = (
			                $columnWidth * ratioH
		                ) / ratioW;

		$columnHeight = Math.floor( $columnHeight );

		if ( $column > 1 ) {
			$columnHeight2 = $columnHeight * 2 + $gutter;
		} else {
			$columnHeight2 = $columnHeight;
		}
	}

	$grid.children( '.grid-item' ).each( function() {
		if ( $( this ).data( 'width' ) == '2' ) {
			$( this ).css( {
				'width': $columnWidth2 + 'px'
			} );
		} else {
			$( this ).css( {
				'width': $columnWidth + 'px'
			} );
		}
		if ( ratio ) {
			if ( $( this ).data( 'height' ) == '2' ) {
				$( this ).css( {
					'height': $columnHeight2 + 'px'
				} );
			} else {
				$( this ).css( {
					'height': $columnHeight + 'px'
				} );
			}
		}
	} );

	if ( $isotopeOptions ) {
		$grid.isotope( 'layout', $isotopeOptions );
	}
}

/**
 * Load post infinity from db.
 */
function insightInfiniteQuery( $wrapper, $grid, reset ) {
	var loader = $wrapper.children( '.tm-grid-pagination' )
	                     .find( '.tm-grid-loader' );
	loader.css( {
		'display': 'inline-block'
	} );

	setTimeout( function() {
		var $queryInput = $wrapper.find( '.tm-grid-query' )
		                          .first(),
		    query       = jQuery.parseJSON( $queryInput.val() ),
		    _data       = $.param( query );

		$.ajax( {
			url: $insight.ajaxurl,
			type: 'POST',
			data: _data,
			dataType: 'json',
			success: function( results ) {

				if ( results.max_num_pages ) {
					query.max_num_pages = results.max_num_pages;
				}

				if ( results.count ) {
					query.count = results.count;
				}

				$queryInput.val( JSON.stringify( query ) );

				var html = results.template;
				var $items = $( html );

				if ( reset == true ) {
					$grid.children( '.grid-item' ).remove();
				}

				if ( $wrapper.data( 'type' ) == 'masonry' ) {

					$grid.isotope()
					     .append( $items )
					     .isotope( 'appended', $items )
					     .imagesLoaded()
					     .always( function() {
						     $grid.isotope( 'layout' );
						     // Re run match height for all items.
						     if ( $wrapper.data( 'match-height' ) ) {
							     $grid.children( '.grid-item' ).matchHeight();
						     }
						     $( document ).trigger( 'insightGridUpdate', [ $wrapper, $grid, $items ] );
					     } );

					insightGridFilterCount( $wrapper, $grid );
					insightGridMasonryCalculateSize( $wrapper, $grid );
				} else if ( $wrapper.data( 'type' ) == 'swiper' ) {
					var $slider = $wrapper.find( '.swiper-container' )[ 0 ].swiper;
					$slider.appendSlide( $items );
					$slider.update();
				} else if ( $wrapper.data( 'type' ) == 'justified' ) {
					$grid.append( html );
					$grid.justifiedGallery( 'norewind' );
				} else {
					$grid.append( $items );
					insightGridFilterCount( $wrapper, $grid );
				}

				insightInitGridAnimation( $grid, $items );
				insightInitGalleryForNewItems( $grid, $items );
				insightHidePaginationIfEnd( $wrapper, query );

				if ( $wrapper.hasClass( 'portfolio-overlay-parallax' ) ) {
					initGridTiltEffect( $wrapper, $items );
				}

				loader.hide();
			}
		} );
	}, 500 );
}

/**
 * Init slider if grid item has post gallery format
 *
 * @param $grid
 * @param $items
 */
function insightInitGalleryForNewItems( $grid, $items ) {
	if ( $grid.data( 'grid-has-gallery' ) == true ) {
		$items.each( function() {
			if ( $( this )
				.hasClass( 'format-gallery' ) ) {
				var $slider = $( this )
					.children( '.post-gallery' );
				insightInitSwiper( $slider );
			}
		} );
	}
}

/**
 * Remove pagination if has no posts anymore
 *
 * @param $el
 * @param query
 *
 */
function insightHidePaginationIfEnd( $el, query ) {
	if ( query.found_posts <= (
		query.paged * query.posts_per_page
	) ) {

		if ( $el.data( 'pagination' ) === 'loadmore_alt' ) {
			var _loadmoreBtn = $( $el.data( 'pagination-custom-button-id' ) );

			_loadmoreBtn.hide();
		} else {
			$el.children( '.tm-grid-pagination' ).hide();
		}

		$el.children( '.tm-grid-messages' ).show( 1 );
		setTimeout( function() {
			$el.children( '.tm-grid-messages' ).remove();
		}, 5000 );
	} else {
		if ( $el.data( 'pagination' ) === 'loadmore_alt' ) {
			var _loadmoreBtn = $( $el.data( 'pagination-custom-button-id' ) );

			_loadmoreBtn.show();
		} else {
			$el.children( '.tm-grid-pagination' ).show();
			$el.children( '.tm-grid-pagination' ).find( '.tm-grid-loadmore-btn' ).show();
		}

	}
}

/**
 * Update counter for grid filters
 *
 * @param $el
 * @param $grid
 */
function insightGridFilterCount( $el, $grid ) {
	if ( $el.children( '.tm-filter-button-group' ).data( 'filter-counter' ) != true ) {
		return;
	}

	var $gridItems = $grid.children( '.grid-item' );
	var $gridTotal = $gridItems.length;
	var filterType = $el.data( 'filter-type' );

	if ( filterType === 'ajax' ) {
		$el.find( '.btn-filter' ).each( function() {
			var count = $( this ).data( 'filter-count' );

			if ( $( this ).children( '.filter-counter' ).length > 0 ) {
				$( this ).children( '.filter-counter' ).text( count );
			} else {
				$( this ).append( '<span class="filter-counter">' + count + '</span>' );
			}
		} );
	} else {
		$el.find( '.btn-filter' ).each( function() {
			var filter = $( this ).data( 'filter' );
			var count = 0;
			if ( filter == '*' ) {
				if ( $( this ).children( '.filter-counter' ).length > 0 ) {
					$( this ).children( '.filter-counter' ).text( $gridTotal );
				} else {
					$( this ).append( '<span class="filter-counter">' + $gridTotal + '</span>' );
				}
			} else {
				filter = filter.replace( '.', '' );
				$gridItems.each( function() {
					if ( $( this ).hasClass( filter ) ) {
						count ++;
					}
				} );
				if ( $( this ).children( '.filter-counter' ).length > 0 ) {
					$( this ).children( '.filter-counter' ).text( count );
				} else {
					$( this ).append( '<span class="filter-counter">' + count + '</span>' );
				}
			}
		} );
	}
}

function insightGridFilterHandler( $el, $grid ) {
	$el.children( '.tm-filter-button-group' ).on( 'click', '.btn-filter', function() {
		if ( $( this ).hasClass( 'current' ) ) {
			return;
		}

		if ( $el.data( 'filter-type' ) == 'ajax' ) {
			var filterValue = $( this ).attr( 'data-filter' );

			var $queryInput = $el.find( '.tm-grid-query' ).first();
			var query = jQuery.parseJSON( $queryInput.val() );
			if ( filterValue === '*' ) {
				query.extra_taxonomy = '';
			} else {
				query.extra_taxonomy = $( this ).attr( 'data-ajax-filter' );
			}

			$queryInput.val( JSON.stringify( query ) );

			$( document ).trigger( 'insightGridInfinityLoad', $el );

			$( this ).siblings().removeClass( 'current' );
			$( this ).addClass( 'current' );
		} else {
			var filterValue = $( this ).attr( 'data-filter' );
			if ( $el.data( 'type' ) == 'masonry' ) {
				$grid.children( '.grid-item' ).each( function() {
					$( this ).removeClass( 'animate' );
				} );

				$grid.isotope( {
					filter: filterValue
				} );

				if ( $grid.hasClass( 'has-animation' ) ) {
					$grid.children( '.grid-item:not(.isotope-hidden)' )
					     .each( function() {
						     $( this ).addClass( 'animate' );
					     } );
				}
			} else if ( $el.data( 'type' ) == 'swiper' ) {
				filterValue = filterValue.replace( '.', '' );
				$grid.children( '.grid-item' ).each( function() {
					if ( filterValue == '*' ) {
						$( this ).show();
						$( this ).addClass( 'animate' );
					} else {
						if ( ! $( this ).hasClass( filterValue ) ) {
							$( this ).hide();
						} else {
							$( this ).show();
							$( this ).addClass( 'animate' );
						}
					}
				} );
				var $slider = $el.children( '.tm-swiper' )
				                 .children( '.swiper-container' )[ 0 ].swiper;
				$slider.update();
				$slider.slideTo( 0 );
			} else if ( $el.data( 'type' ) == 'justified' ) {
				if ( filterValue == '*' ) {
					$grid.justifiedGallery( { filter: false } );
				} else {
					$grid.justifiedGallery( { filter: filterValue } );
				}
			} else {
				$grid.children( '.grid-item' ).hide().removeClass( 'animate' );

				var $filterItems;

				if ( filterValue == '*' ) {
					$filterItems = $grid.children( '.grid-item' );
				} else {
					$filterItems = $grid.children( filterValue );
				}

				$filterItems.show();

				$filterItems.each( function( i, o ) {
					var self = $( this );

					setTimeout( function() {
						self.addClass( 'animate' );
					}, i * 200 );
				} );
			}

			$( this ).siblings().removeClass( 'current' );
			$( this ).addClass( 'current' );
		}
	} );
}

function insightInitGridAnimation( $grid, $items ) {
	if ( ! $body.hasClass( 'page-has-animation' ) || ! $grid.hasClass( 'has-animation' ) ) {
		return;
	}

	var itemQueue  = [],
	    queueDelay = 250,
	    queueTimer;

	$items.vcwaypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );

		itemQueue.push( _self );
		processItemQueue( itemQueue, queueDelay, queueTimer );
		queueDelay += 250;

		queueResetDelay = setTimeout( function() {
			queueDelay = animateQueueDelay;
		}, animateQueueDelay );
	}, {
		offset: '90%',
		triggerOnce: true
	} );
}

function initGridTiltEffect( $el, $items ) {
	if ( $el.data( 'hover' ) !== 'tilt' ) {
		return;
	}

	$items.find( '.post-thumbnail' ).tilt( {
		perspective: 1440,
		scale: 1.06,
		easing: 'cubic-bezier(.03,.98,.52,.99)',
	} );
}

	}( jQuery )
);

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

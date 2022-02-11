initMiniCart();
initQuantityButtons();
initCookieNotice();
initProductImagesSlider();

function initCookieNotice() {
	if ( $insight.noticeCookieEnable == 1 && $insight.noticeCookieConfirm != 'yes' && $insight.noticeCookieMessages != '' ) {

		$.growl( {
			location: 'br',
			fixed: true,
			duration: 3600000,
			title: '',
			message: $insight.noticeCookieMessages
		} );

		$( '#tm-button-cookie-notice-ok' ).on( 'click', function() {
			$( this ).parents( '.growl-message' ).first().siblings( '.growl-close' ).trigger( 'click' );

			var _data = {
				action: 'notice_cookie_confirm'
			};

			_data = $.param( _data );

			$.ajax( {
				url: $insight.ajaxurl,
				type: 'POST',
				data: _data,
				dataType: 'json',
				success: function( results ) {

					$.growl.notice( {
						location: 'br',
						duration: 5000,
						title: '',
						message: $insight.noticeCookieOKMessages
					} );

				},
				error: function( errorThrown ) {
					alert( errorThrown );
				}
			} );
		} );
	}
}

function initMiniCart() {
	var $miniCart = $( '#mini-cart' );
	$miniCart.on( 'click', function() {
		if ( $body.hasClass( 'desktop' ) ) {
			$( this ).addClass( 'open' );
		} else {
			window.location.href = $( this ).data( 'url' );
		}
	} );

	$( document ).on( 'click', function( e ) {
		if ( $( e.target ).closest( $miniCart ).length == 0 ) {
			$miniCart.removeClass( 'open' );
		}
	} );
}

function initQuantityButtons() {
	$( document ).on( 'click', '.increase, .decrease', function() {

		// Get values
		var $qty       = $( this ).siblings( '.qty' ),
		    currentVal = parseFloat( $qty.val() ),
		    max        = parseFloat( $qty.attr( 'max' ) ),
		    min        = parseFloat( $qty.attr( 'min' ) ),
		    step       = $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) {
			currentVal = 0;
		}
		if ( max === '' || max === 'NaN' ) {
			max = '';
		}
		if ( min === '' || min === 'NaN' ) {
			min = 0;
		}
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
			step = 1;
		}

		// Change the value
		if ( $( this ).is( '.increase' ) ) {

			if ( max && (
				max == currentVal || currentVal > max
			) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && (
				min == currentVal || currentVal < min
			) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event.
		$qty.trigger( 'change' );
	} );
}

function initProductImagesSlider() {
	if ( $insight.isProduct === '1' && $insight.productFeatureStyle === 'slider' ) {
		var $slider = $( '#woo-single-gallery' ).lightSlider( {
			gallery: true,
			item: 1,
			loop: true,
			thumbItem: 4,
			slideMargin: 0,
			enableDrag: false,
			currentPagerPosition: 'left',
			adaptiveHeight: true,

			onSliderLoad: function( el ) {
				el.lightGallery( {
					selector: '#woo-single-gallery .lslide'
				} );
			}
		} );

		var $form = $( '.variations_form' );
		var variations = $form.data( 'product_variations' );

		$form.find( 'select' ).on( 'change', function() {
			var test = true;
			var globalAttrs = {};

			var formValues = $form.serializeArray();
			for ( var i = 0; i < formValues.length; i ++ ) {

				var _name = formValues[ i ].name;
				if ( _name.substring( 0, 10 ) === 'attribute_' ) {

					globalAttrs[ _name ] = formValues[ i ].value;

					if ( formValues[ i ].value === '' ) {
						test = false;

						break;
					}
				}
			}

			// When all variations selected.
			if ( test === true ) {
				var url = '';

				for ( var i = 0; i < variations.length; i ++ ) {
					var currentAttrs = variations[ i ].attributes;

					var valid = true;
					var pass = true;

					for ( var globalKey in globalAttrs ) {
						for ( var currentKey in currentAttrs ) {
							var globalVal = globalAttrs[ globalKey ];
							var currentVal = currentAttrs[ currentKey ];

							if ( currentKey === globalKey ) {
								if ( currentVal === '' ) {
									pass = false;
									continue;
								}

								if ( currentVal !== globalVal ) {
									valid = false;
								}
							}
						}
					}

					if ( valid === true ) {
						url = variations[ i ].image.url;
					}

					if ( valid === true && pass === true ) {
						break;
					}
				}

				if ( url !== '' ) {
					$slider.find( 'li' ).each( function( index ) {
						// Skip if clone slide.
						if ( $( this ).hasClass( 'clone' ) ) {
							return true;
						}

						// Get product image src.
						var fullImage = $( this ).attr( 'data-src' );

						// If equal with variations image & not slide active.
						if ( fullImage === url && ! $( this ).hasClass( 'active' ) ) {
							$slider.goToSlide( index );

							return false;
						}
					} );
				}
			} else {
				// Reset to main image.
				var $mainImage = $slider.find( '.woocommerce-main-image' );
				var index = $mainImage.index();
				$slider.goToSlide( index );
			}
		} );
	}
}

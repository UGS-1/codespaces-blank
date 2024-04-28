! function( $ ) {
	"use strict";

	Codevz_Plus.woocommerce = function( quantity, timeout ) {

		var body = $( document.body );

		// Product quantity field
		if ( $( '.quantity' ).length ) {

			$( '.quantity input' ).each( function() {

				var $this = $( this );

				if ( ! $this.next( '.quantity-up' ).length ) {

					$( '<div class="quantity-down">-</div>' ).insertBefore( $this );
					$( '<div class="quantity-up">+</div>' ).insertAfter( $this );

					$this.parent().on( 'click', '.quantity-up, .quantity-down', function() {

						var en 		 = $( this ),
							input 	 = en.closest( '.quantity' ).find( 'input' ),
							oldValue = parseInt( input.val() ),
							oldValue = en.hasClass( 'quantity-down' ) && oldValue <= 1 ? 2 : oldValue;

						input.val( en.hasClass( 'quantity-up' ) ? oldValue + 1 : oldValue - 1 ).trigger( 'change' );

					});

				}

			});

			// Update cart fix quantity script.
			body.on( 'updated_cart_totals', function( e ) {

				Codevz_Plus.woocommerce( 2 );

			// Auto update cart.
			}).on( 'change', '.woocommerce-cart-form input.qty', function() {

				clearTimeout( timeout );

				timeout = setTimeout( function() {
					$( '[name="update_cart"]' ).trigger( 'click' );
				}, 1000 );

			});

		}

		// Only quantity
		if ( quantity ) {
			return;
		}

		// Auto x-position shop cart in header.
		if ( $( '.elms_shop_cart' ).length ) {

			body.on( 'mouseenter', '.elms_shop_cart', function() {

				var cartX 		= $( this ),
					iconX 		= cartX.find( '.shop_icon i' ),
					iconWidth 	= iconX.outerWidth(),
					dropdown  	= cartX.find( '.cz_cart_items' );

				if ( ( $( window ).width() / 2 ) > ( cartX.offset().left + 300 ) ) {

					cartX.addClass( 'inview_right' );

					var iconMl = parseFloat( iconX.css( 'marginLeft' ) );

					if ( body.hasClass( 'rtl' ) ) {
						dropdown.css( 'left', ( ( iconWidth / 2 ) - 38 + iconMl ) );
					} else {
						dropdown.css( 'left', -( ( iconWidth / 2 ) - 36 + iconMl ) );
					}

				} else {

					dropdown.css( 'right', ( ( iconWidth / 2 ) - 36 + parseFloat( iconX.css( 'marginRight' ) ) ) );

				}

			});

		}

		// Current wishlist items
		if ( $( '.xtra-add-to-wishlist' ).length || $( '.xtra-wishlist' ).length || $( '.cz_wishlist_count' ).length ) {

			var wishlist = localStorage.getItem( 'xtraWishlist' ),
				wishlistDiv = $( '.xtra-wishlist' ),
				noWishlist = '<h3 class="xtra-wishlist-empty tac">' + wishlistDiv.data( 'empty' ) + '</h3>';

			// Wishlist shortcode
			wishlistDiv.length && wishlistDiv.each( function() {

				var en = $( this ),
					nonce = en.data( 'nonce' );

				if ( wishlist ) {

					$.post( body.data( 'ajax' ), 'action=xtra_wishlist_content&ids=' + wishlist + '&nonce=' + nonce, function( msg ) {

						en.removeClass( 'xtra-icon-loading' ).html( msg );

						$.each( wishlist, function( index, id ) {

							var product = $( '.post-' + id ),
								heart 	= product.find( '.xtra-add-to-wishlist' );

							if ( heart.length ) {
								heart.removeClass( 'fa-heart-o' ).addClass( 'fa-heart' ).attr( 'data-title', xtra_strings.added_wishlist );
							}

							product.prepend( '<i class="xtra-remove-from-wishlist fas fa-times"></i>' );

						});

						var count = localStorage.getItem( 'xtraWishlist' ).replace( /\d+/g,'' ).length;

						// Count
						if ( count ) {
							$( '.cz_wishlist_count' ).show().html( count || '' );
						} else {
							$( '.cz_wishlist_count' ).hide();
							en.removeClass( 'xtra-icon-loading' ).html( noWishlist );
						}

						if ( ! en.find( 'li' ).length ) {
							en.removeClass( 'xtra-icon-loading' ).html( noWishlist );
						}

					});

				} else {

					en.removeClass( 'xtra-icon-loading' ).html( noWishlist );

				}

			});

			// Set wishlist products
			if ( wishlist ) {
				wishlist = wishlist.split( ',' );

				$.each( wishlist, function( index, id ) {
					var product = $( '[data-id="' + id + '"] .xtra-add-to-wishlist' );

					if ( product.length ) {
						product.removeClass( 'fa-heart-o' ).addClass( 'fa-heart' ).attr( 'data-title', xtra_strings.added_wishlist );
					}
				});

				var count = localStorage.getItem( 'xtraWishlist' ).replace( /\d+/g,'' ).length;

				// Count
				if ( count ) {
					$( '.cz_wishlist_count' ).show().html( count || '' );
				} else {
					$( '.cz_wishlist_count' ).hide();
					wishlistDiv.removeClass( 'xtra-icon-loading' ).html( noWishlist );
				}
			}

			// Wishlist
			body.on( 'click', '.xtra-add-to-wishlist,.xtra-remove-from-wishlist', function(e) {

				var en = $( this ),
					id = en.closest( 'li' ).find( '[data-id]' ).data( 'id' ) + ',',
					ls = localStorage.getItem( 'xtraWishlist' ) || '',
					tt = en.attr( 'data-title' );

				if ( en.hasClass( 'fa-heart' ) && ! en.closest( '.xtra-wishlist' ).length ) {

					window.location.replace( xtra_strings.wishlist_url );

				} else {

					en.addClass( 'xtra-icon-loading' ).removeAttr( 'data-title' );

					setTimeout(function() {

						if ( en.hasClass( 'fa-heart' ) || en.hasClass( 'fa-times' ) ) {

							ls = ls.replace( id, '' );

							localStorage.setItem( 'xtraWishlist', ls );

							tt = xtra_strings.add_wishlist;

						} else if ( ls.indexOf( id ) < 0 ) {

							localStorage.setItem( 'xtraWishlist', ls + id );

							tt = xtra_strings.added_wishlist;

						}

						en.removeClass( 'xtra-icon-loading' ).toggleClass( 'fa-heart-o fa-heart' );

						setTimeout( function() {
							en.attr( 'data-title', tt );
						}, 250 );

						// Wishlist page.
						if ( en.closest( '.xtra-wishlist' ).length ) {
							en.closest( 'li' ).fadeOut(function() {

								$( this ).remove();

								if ( ! wishlistDiv.find( 'li' ).length ) {
									wishlistDiv.removeClass( 'xtra-icon-loading' ).html( noWishlist );
								}

							});
						}

						var count = localStorage.getItem( 'xtraWishlist' ).replace( /\d+/g,'' ).length;

						// Count
						if ( count ) {
							$( '.cz_wishlist_count' ).show().html( count || '' );
						} else {
							$( '.cz_wishlist_count' ).hide();
							wishlistDiv.removeClass( 'xtra-icon-loading' ).html( noWishlist );
						}

					}, 1000 );

				}

				e.preventDefault();
			});
		
		}

		// Product quick view.
		if ( $( '.xtra-product-quick-view' ).length ) {

			body.on( 'click', '.xtra-product-quick-view', function( e ) {

				e.preventDefault();

				var x = $( this ),
					id = x.parent().data( 'id' ),
					nonce = x.data( 'nonce' ),
					popup = $( '#xtra_quick_view' ),
					content = $( '#cz_xtra_quick_view .cz_popup_in > div' ),
					tt = x.attr( 'data-title' );

				x.addClass( 'xtra-icon-loading' ).removeAttr( 'data-title' );

				content.addClass( 'xtra-qv-loading' ).html( '' );

				popup.fadeIn( 'fast' ).delay( 1000 ).addClass( 'cz_show_popup' );

				$( 'html, body' ).addClass( 'no-scroll' );

				$.post( body.data( 'ajax' ), 'action=xtra_quick_view&id=' + id + '&nonce=' + nonce, function( msg ) {

					x.removeClass( 'xtra-icon-loading' ).attr( 'data-title', tt );
					content.removeClass().html( msg );

					// Fix flex slider.
					setTimeout(function() {
						$( window ).trigger( 'resize' );
					}, 1000 );

					Codevz_Plus.woocommerce( 1 );

				});

				return false;

			});

		}

		// Remove item from cart ajax.
		if ( $( '.cart_list .remove' ).length ) {
			
			body.on( 'click', '.cart_list .remove', function( e ) {

				var x = $( this );

				x.css( 'background', 'none' ).addClass( 'xtra-icon-loading' ).removeAttr( 'data-title' );

				$.post( body.data( 'ajax' ), 'action=xtra_remove_item_from_cart&id=' + x.data( 'product_id' ), function( msg ) {

					if ( $( '.cz_cart' ).find( '.woocommerce-Price-amount' ).text() == $( msg['fragments']['.cz_cart'] ).find( '.woocommerce-Price-amount' ).text() ) {

						window.location = x.attr( 'href' );

					} else {

						$( '.cz_cart' ).html( msg['fragments']['.cz_cart'] );

					}

				});

				e.preventDefault();

			});

		}

		// Prevent submit login and register with empty inputs
		if ( $( '.woocommerce-form-login button, .woocommerce-form-register button' ).length ) {

			body.on( 'click', '.woocommerce-form-login button, .woocommerce-form-register button', function() {

				var x = $( this ), check;

				x.closest( 'form' ).find( 'input' ).css( 'animation', 'none' ).each(function() {

					if ( ! x.val() ) {

						check = false;
						x.select();

						return false;

					} else {

						check = true;

					}

				});

				if ( ! check ) {

					return false;

				}

			});

		}

		// Append onsale badge to parent.
		$( '.products .onsale' ).codevzPlus( 'onsale', function( x ) {

			x.appendTo( x.closest( 'a' ) );

		});

		// Fix City and state for RTL websites.
		if ( body.hasClass( 'woocommerce-checkout' ) && body.hasClass( 'rtl' ) ) {

			setTimeout( function() {

				$( '#billing_state_field' ).insertBefore( '#billing_city_field' );

			}, 500 );

		}

		// Tabs scroll to.
		if ( body.hasClass( 'single-product' ) ) {

			setTimeout( function() {

				body.on( 'click', '.wc-tabs a', function() {

					var $page = $( 'html, body' ),
						sticky = $( '.header_is_sticky' ).not( '.smart_sticky,.header_4' );

					$page.animate({

						scrollTop: $( '.woocommerce-tabs' ).offset().top - 50 - ( sticky.outerHeight() || 0 )

					}, 1000, 'easeInOutCodevz', function() {

						$page.stop();

					});

				});

			}, 250 );

			// Product tabs in mobile.
			var $tabs = $( '.wc-tabs' );

			if ( $tabs.find( 'li' ).length >= 3 ) {

				$tabs.addClass( 'hide_on_mobile' ).before( '<select class="xtra-woo-tabs" />' );

				$tabs.find( 'li' ).each( function() {

					var $this = $( this );
					$( '.xtra-woo-tabs' ).append( '<option value="' + $this.attr( 'id' ) + '">' + $this.text() + '</option>' );

				});

				$( '.xtra-woo-tabs' ).on( 'change', function() {
					$tabs.find( '#' + this.value + ' > a' ).trigger( 'click' );
				});

			}

			// Disable product page lightbox
			$( '.woo-disable-lightbox .woocommerce-product-gallery__wrapper > div:first-child a' ).removeAttr( 'href' ).css( 'cursor', 'default' );

			// Woo sticky column.
			$( '.woocommerce-product-gallery' ).addClass( 'cz_sticky_col' );

		} // Single product page.

	};

	Codevz_Plus.woocommerce();

}( jQuery );
jQuery( function( $ ) {
	"use strict";

	Codevz_Plus.mobileFixedNav = function() {

		if ( $( window ).width() <= 768 ) {

			var mobileNav = $( '.xtra-fixed-mobile-nav' ),
				currentURL = location.pathname.replace( /\/$/, "" );

			if ( mobileNav.length ) {

				$( 'footer' ).css( 'margin-bottom', mobileNav.outerHeight() );

				mobileNav.find( 'a' ).each( function() {

					var $this = $( this );

					if ( $this.attr( 'href' ).replace( /\/$/, "" ).indexOf( currentURL ) !== -1 ) {

						$this.addClass( 'xtra-active' );

					}

				});

				var mobileNavHeight = mobileNav.outerHeight();
				
				$( '.backtotop' ).css( 'margin-bottom', mobileNavHeight ).next( '.fixed_contact' ).css( 'margin-bottom', mobileNavHeight );


			}

		}

	};

	Codevz_Plus.mobileFixedNav();

});
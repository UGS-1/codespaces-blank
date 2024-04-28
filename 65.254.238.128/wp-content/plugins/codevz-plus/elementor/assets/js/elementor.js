jQuery( window ).on( 'elementor/frontend/init', function() {

	// Extend elementor frontend handlers base.
	class XtraElementor extends elementorModules.frontend.handlers.Base {

		// On element changes.
		onElementChange( propertyName, event ) {

			// Get widget.
			var name = event._parent.model.attributes.widgetType.replace( 'cz_', '' );

			// re-init codevz function.
			setTimeout( function() {

				typeof Codevz_Plus[ name ] != 'undefined' && Codevz_Plus[ name ]();

			}, 50 );

		}

	}

	// Enable live changes on elements.
	elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $element ) {

		elementorFrontend.elementsHandler.addHandler( XtraElementor, { $element } );

	} );

});
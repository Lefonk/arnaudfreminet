( function( $ ) {
	$.fn.classList = function() {
		return this[ 0 ].className.split( /\s+/ );
	};

	elementor.on( 'document:loaded', function() {
		elementor.hooks.addAction( 'panel/open_editor/widget/kit-switcher', ( panel, model, view ) => {
			const settingsModel = model.get( 'settings' );

			settingsModel.on( 'change', ( changedModel ) => {
				if ( changedModel.changed.hasOwnProperty( 'switcher_style' ) ) {
					if ( 'toggle' === changedModel.changed.switcher_style ) {
						setTimeout( function() {
							replaceKit( view.$el.closest( 'body' ), view.$el.find( '.toggle_a' ).attr( 'data-kit' ) );
						}, 250 );
					} else if ( 'dropdown' === changedModel.changed.switcher_style ) {
						renderStyleKit();
					}
				} else if ( changedModel.changed.hasOwnProperty( 'kits' ) ) {
					renderStyleKit();
				} else if ( changedModel.changed.hasOwnProperty( 'toggle_b_kit' ) ) {
					replaceKit(
						view.$el.closest( 'body' ),
						changedModel.changed.toggle_b_kit
					);

					setTimeout( function() {
						if (
							view.$el
								.find( '.ang-widget--kit-toggle' )
								.hasClass( 'kit_a' )
						) {
							view.$el.find( '.ang-widget--kit-toggle' )
								.removeClass( 'kit_a' )
								.addClass( 'kit_b' )
								.attr( 'data-current_kit', 'kit_b' );
						}
					}, 250 );
				}
			} );

			function renderStyleKit() {
				setTimeout( function() {
					let defaultKit = view.$el.find( '.ang-widget--kit-dropdown li.selected' ).attr( 'data-value' );

					if ( 'undefined' === typeof defaultKit ) {
						defaultKit = view.$el.find( '.ang-widget--kit-dropdown li:first' ).attr( 'data-value' );
					}

					replaceKit( view.$el.closest( 'body' ), defaultKit );
				}, 250 );
			}

			function replaceKit( body, kitID ) {
				const classes = body.classList().filter( word => word.startsWith( 'elementor-kit-' ) );
				classes.forEach( className => {
					body.removeClass( className );
				} );

				body.addClass( 'elementor-kit-' + kitID );
			}
		} );
	} );
}( jQuery ) );

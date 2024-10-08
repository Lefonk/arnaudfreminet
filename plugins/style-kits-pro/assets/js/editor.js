// eslint-disable-next-line no-redeclare
/* global analogPro, elementor, elementorCommon, elementorFrontend */
( function( $ ) {
	// Check for analog instance.
	const analog = window.analog = window.analog || {};

	/**
	 * Returns a list of all keys that generate CSS variables.
	 *
	 * @since 1.0.0
	 * @returns {array} Color Variables.
	 */
	analog.getColorControlsVariables = function() {
		const controls = elementor.documents.documents[ elementor.config.kit_id ].config.settings.controls;
		const variables = [];

		_.forEach( controls, function( control ) {
			if ( control.name.startsWith( 'ang_color' ) || control.name.startsWith( 'ang_background' ) ) {
				if ( 'variable' in control ) {
					variables.push( { name: control.name, variable: control.variable } );
				}
			}
		} );

		return variables;
	};

	/**
	 * Creates a modal with list and preview of all CSS variables.
	 *
	 * @since 1.0.0
	 * @returns {*} Modal instance.
	 */
	analog.CSSVariablesModal = function() {
		const modal = elementorCommon.dialogsManager.createWidget( 'lightbox', {
			id: 'ang-css-variables',
			className: 'ang-css-variables',
			headerMessage: `<span class="icon"><img src="${ AGWP.pluginURL }/assets/img/triangle.svg" /></span> ${ ANG_Action.translate.cssVariables }`,
			closeButton: true,
			closeButtonClass: 'eicon-close',
			hide: {
				onOutsideClick: true,
				onBackgroundClick: true,
				onEscKeyPress: true,
			},
		} );

		modal.onShow = function() {
			const content = modal.getElements( 'content' );
			let html = '<div class="ang-css-variables__list"><ul>';

			const header = modal.getElements( 'header' );
			modal.getElements( 'closeButton' ).appendTo( header );

			const variables = analog.getColorControlsVariables();
			const attributes = elementor.documents.documents[ elementor.config.kit_id ].config.settings.settings;

			_.map( variables, function( key ) {
				html += `
					<li>
						<code>var(--${ key.variable })</code>
						<span class="swatch" style="background-color:${ attributes[ key.name ] }"></span>
					</li>`;
			} );

			html += '</ul></div>';

			content.html( html );
		};

		modal.getElements( 'message' ).append( modal.addElement( 'content' ) );

		return modal;
	};

	analog.highlightItemsWithClasses = function() {
		function applyHighlightStyle( element ) {
			try {
				const attributes = element.attributes.settings.attributes;

				let apply = false;

				if ( 'custom_css' in attributes && '' !== attributes.custom_css ) {
					apply = true;
				}

				$( elementorFrontend.elements.$body ).find( '[data-id="' + element.id + '"]' )[ apply ? 'addClass' : 'removeClass' ]( 'ang-highlight--with-css' );
			} catch ( err ) {
				return false;
			}
		}

		function good( object ) {
			try {
				return ( 'custom_css' in object.attributes.settings.attributes );
			} catch ( err ) {
				return false;
			}
		}

		function traverseModels( model ) {
			if ( model === null ) {
				return false;
			}

			if ( typeof model === 'object' ) {
				applyHighlightStyle( model );
				return model.attributes.elements.models.filter( good ).map( traverseModels );
			}
		}

		traverseModels( elementor.elementsModel );
	};

	const toggleCSSVisibility = ( show = true ) => {
		if ( show ) {
			analog.highlightItemsWithClasses();
			elementor.channels.editor.on( 'change', analog.highlightItemsWithClasses );
			analog.isHighlightVisible = true;
		} else {
			$( elementorFrontend.elements.$body ).find( '.ang-highlight--with-css' ).removeClass( 'ang-highlight--with-css' );
			elementor.channels.editor.off( 'change', analog.highlightItemsWithClasses );
			analog.isHighlightVisible = false;
		}
	};

	analog.highlightCSSClasses = function() {
		function applyHighlightStyle( element ) {
			try {
				const attributes = element.attributes.settings.attributes;

				let cssClasses = '';

				if ( 'css_classes' in attributes && '' !== attributes.css_classes ) {
					cssClasses = attributes.css_classes;
				}
				if ( '_css_classes' in attributes && '' !== attributes._css_classes ) {
					cssClasses = attributes._css_classes;
				}

				const target = $( elementorFrontend.elements.$body ).find( '[data-id="' + element.id + '"]' );
				let html = '';

				if ( '' !== cssClasses ) {
					target.find( '.ang-highlight--classes-list' ).remove(); // Remove parent item if already added.
					target.removeClass( 'ang-highlight--with-class' );

					html += '<div class="ang-highlight--classes-list">';

					cssClasses.split( ' ' ).forEach( function( customClass ) {
						if ( customClass.length > 0 ) { // check for null values, or extra spaces.
							html += `<span>${ customClass }</span>`;
						}
					} );

					html += '</div>';

					target.css( 'position', 'relative' );
					target.append( html );
					target.addClass( 'ang-highlight--with-class' );
				}
			} catch ( err ) {
				return false;
			}
		}

		function good( object ) {
			try {
				return ( 'css_classes' in object.attributes.settings.attributes || '_css_classes' in object.attributes.settings.attributes );
			} catch ( err ) {
				return false;
			}
		}

		function traverseModels( model ) {
			if ( model === null ) {
				return false;
			}

			if ( typeof model === 'object' ) {
				applyHighlightStyle( model );
				return model.attributes.elements.models.filter( good ).map( traverseModels );
			}
		}

		traverseModels( elementor.elementsModel );
	};

	const toggleClassesVisibility = ( show = true ) => {
		if ( show ) {
			analog.highlightCSSClasses();
			elementor.channels.editor.on( 'change', analog.highlightCSSClasses );
			analog.isClassVisible = true;
		} else {
			$( elementorFrontend.elements.$body ).find( '.ang-highlight--classes-list' ).remove();
			$( elementorFrontend.elements.$body ).find( '.ang-highlight--with-class' ).removeClass( 'ang-highlight--with-class' );
			elementor.channels.editor.off( 'change', analog.highlightCSSClasses );
			analog.isClassVisible = false;
		}
	};

	elementor.on( 'preview:loaded', () => {
		if ( ! analog.isClassVisible && elementor.settings.page.model.attributes.ang_highlight_classes === 'yes' ) {
			toggleClassesVisibility();
		}
		if ( ! analog.isHighlightVisible && elementor.settings.page.model.attributes.ang_highlight_css === 'yes' ) {
			toggleCSSVisibility();
		}

		/**
		 * Register shortcut to display CSS variables modal.
		 *
		 * @since 1.0.0
		 */
		if ( undefined !== typeof ( $e ) ) {
			const modal = analog.CSSVariablesModal();
			$e.shortcuts.register( 'ctrl+shift+7', {
				callback: function() {
					modal.show();
				},
				dependency: () => ! modal.isVisible(),
			} );
		}

		analog.isHighlightVisible = false;
		if ( undefined !== typeof ( $e ) ) {
			$e.shortcuts.register( 'ctrl+shift+1', {
				callback: function() {
					if ( ! analog.isHighlightVisible ) {
						elementor.settings.page.model.setExternalChange( 'ang_highlight_css', 'yes' );
						toggleCSSVisibility();
					} else {
						elementor.settings.page.model.setExternalChange( 'ang_highlight_css', '' );
						toggleCSSVisibility( false );
					}
				},
			} );
		}

		analog.isClassVisible = false;
		if ( undefined !== typeof ( $e ) ) {
			$e.shortcuts.register( 'ctrl+shift+2', {
				callback: function() {
					if ( ! analog.isClassVisible ) {
						elementor.settings.page.model.setExternalChange( 'ang_highlight_classes', 'yes' );
						toggleClassesVisibility();
					} else {
						elementor.settings.page.model.setExternalChange( 'ang_highlight_classes', '' );
						toggleClassesVisibility( false );
					}
				},
			} );
		}

		elementor.settings.page.addChangeCallback( 'ang_highlight_classes', function( value ) {
			if ( ! analog.isClassVisible && value === 'yes' ) {
				toggleClassesVisibility();
			} else {
				toggleClassesVisibility( false );
			}
		} );

		elementor.settings.page.addChangeCallback( 'ang_highlight_css', function( value ) {
			if ( ! analog.isHighlightVisible && value === 'yes' ) {
				toggleCSSVisibility();
			} else {
				toggleCSSVisibility( false );
			}
		} );
	} );

	const Pro = analog.pro = analog.pro || {};

	Pro.getAllPageContainers = () => {
		// Get all the containers of the document.
		const allContainers = Object.values( elementor.getPreviewView()._getNestedViews() ).map( ( view ) => {
			// Remove the empty views.
			if ( view.el.className !== 'elementor-empty-view' && ! view.isDestroyed ) {
				const container = view.getContainer();
				container.view.allowRender = false;
				return container;
			}
		} );

		// Clean-up the array of containers
		const filteredContainers = allContainers.filter( ( container ) => {
			return container;
		} );

		filteredContainers.reverse();

		// return the containners
		return filteredContainers;
	};

	Pro.resetAllStyles = () => {
		const containers = Pro.getAllPageContainers();

		// Remove the styling of all containers.
		$e.run( 'document/elements/reset-style', { containers } );

		// Render the document
		containers.forEach( ( container ) => {
			container.view.allowRender = true;
		} );

		elementor.getPreviewView().render();
	};

	Pro.resetTypoColors = () => {
		// Get all the containers of the document
		const containers = Pro.getAllPageContainers();

		// For each container
		containers.forEach( ( container ) => {
			// Get the controls of the container
			const controls = container.settings.controls;
			const defaultValues = {};

			// Stop the rendering to avoid container issues
			container.view.allowRender = false;

			// For each control of the container
			Object.entries( controls ).forEach( ( [ controlName, control ] ) => {
				// From the Elementor code, not too sure what it does. Probably check to be sure the element has controls.
				if ( ! container.view.isStyleTransferControl( control ) ) {
					return;
				}

				// Reset all the settings ending with either color or typography, the method could be combined with the manual list if needed
				if ( controlName.endsWith( 'color' ) || controlName.endsWith( 'typography' ) ) {
					defaultValues[ controlName ] = control.default;
				}
			} );

			// Reset the selected settings to their default values
			$e.run( 'document/elements/settings', {
				container,
				settings: defaultValues,
				options: {
					external: true,
				},
			} );

			// Allow the container to be rendered
			container.view.allowRender = true;
		} );

		// Render all the page
		elementor.getPreviewView().render();
	};

	Pro.handleResetAllStyles = () => {
		elementorCommon.dialogsManager.createWidget( 'confirm', {
			message: analogPro.translate.resetAllStylesDesc,
			headerMessage: ANG_Action.translate.resetHeader,
			strings: {
				confirm: elementor.translate( 'yes' ),
				cancel: elementor.translate( 'cancel' ),
			},
			defaultOption: 'cancel',
			onConfirm: analog.pro.resetAllStyles,
		} ).show();
	};

	Pro.handleResetColorTypography = () => {
		elementorCommon.dialogsManager.createWidget( 'confirm', {
			message: analogPro.translate.resetTypoColorDesc,
			headerMessage: ANG_Action.translate.resetHeader,
			strings: {
				confirm: elementor.translate( 'yes' ),
				cancel: elementor.translate( 'cancel' ),
			},
			defaultOption: 'cancel',
			onConfirm: function() {
				let historyId;
				if ( undefined !== $e.internal ) {
					historyId = $e.internal( 'document/history/start-log', {
						type: 'reset_settings',
						title: analogPro.translate.resetTypoColorTitle,
					} );
				}

				analog.pro.resetTypoColors();

				if ( undefined !== $e.internal ) {
					$e.internal( 'document/history/end-log', { id: historyId } );
				}
			},
		} ).show();
	};

	elementor.channels.editor.on( 'analog:resetAllStyles', Pro.handleResetAllStyles );
	elementor.channels.editor.on( 'analog:resetColorTypography', Pro.handleResetColorTypography );
}( jQuery ) );

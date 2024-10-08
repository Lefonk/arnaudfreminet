// eslint-disable-next-line no-redeclare
/* global elementorModules, elementorFrontend */

jQuery.fn.classList = function() {
	return this[ 0 ].className.split( /\s+/ );
};

class KitSwitcher extends elementorModules.frontend.handlers.Base {
	getDefaultSettings() {
		return {
			selectors: {
				mainContainer: '.ang-widget--kit-switcher',
				toggleContainer: '.ang-widget--kit-toggle',
				dropdown: '.ang-widget--kit-dropdown',
			},
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings( 'selectors' );
		return {
			$mainContainer: this.$element.find( selectors.mainContainer ),
			$toggleContainer: this.$element.find( selectors.toggleContainer ),
			$dropdown: this.$element.find( selectors.dropdown ),
			$document: jQuery( document ),
		};
	}

	bindEvents() {
		this.elements.$toggleContainer.on( 'click', this.onToggleClick.bind( this ) );
		this.$element.on( 'change', this.elements.$dropdown, this.onDropdownChange.bind( this ) );

		this.elements.$document.on( 'click', '.dropdown', function() {
			jQuery( '.dropdown' ).not( jQuery( this ) ).removeClass( 'open' );
			jQuery( this ).toggleClass( 'open' );
			if ( jQuery( this ).hasClass( 'open' ) ) {
				jQuery( this ).find( '.option' ).attr( 'tabindex', 0 );
				jQuery( this ).find( '.selected' ).focus();
			} else {
				jQuery( this ).find( '.option' ).removeAttr( 'tabindex' );
				jQuery( this ).focus();
			}
		} );

		this.elements.$document.on( 'click', '.dropdown .option', function() {
			jQuery( this ).closest( '.list' ).find( '.selected' ).removeClass( 'selected' );
			jQuery( this ).addClass( 'selected' );
			const text = jQuery( this ).data( 'display-text' ) || jQuery( this ).text();

			const iconClasses = jQuery( this ).closest( '.dropdown' ).find( '.current i' ).prop( 'class' );

			const selectedOptionText = `${ text }  <i class="${ iconClasses }" aria-hidden="true"></i>`;

			jQuery( this ).closest( '.dropdown' ).find( '.current' ).html( selectedOptionText );
			jQuery( this ).closest( '.dropdown' ).prev( 'select' ).val( jQuery( this ).data( 'value' ) ).trigger( 'change' );
		} );
	}

	onToggleClick( event ) {
		event.preventDefault();
		let kitID;

		if ( 'kit_a' === this.elements.$toggleContainer.attr( 'data-current_kit' ) ) {
			this.elements.$toggleContainer.attr( 'data-current_kit', 'kit_b' );
			kitID = this.elements.$toggleContainer.find( '.toggle_b' ).data( 'kit' );
		} else {
			this.elements.$toggleContainer.attr( 'data-current_kit', 'kit_a' );
			kitID = this.elements.$toggleContainer.find( '.toggle_a' ).data( 'kit' );
		}

		this.elements.$toggleContainer.toggleClass( 'kit_a kit_b' );

		replaceKit( kitID );
	}

	onDropdownChange( event ) {
		event.preventDefault();
		const kitID = this.elements.$dropdown.find( '.list li.selected' ).attr( 'data-value' );

		if ( 'undefined' !== typeof kitID ) {
			replaceKit( kitID );
		}
	}
}

jQuery( window ).on( 'elementor/frontend/init', () => {
	if ( elementorFrontend.hasOwnProperty( 'elementsHandler' ) &&
		elementorFrontend.elementsHandler.hasOwnProperty( 'attachHandler' ) ) {
		elementorFrontend.elementsHandler.attachHandler( 'kit-switcher', KitSwitcher );
	} else {
		const addHandler = ( $element ) => {
			elementorFrontend.elementsHandler.addHandler( KitSwitcher, {
				$element,
			} );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/kit-switcher.default', addHandler );
	}

	elementorFrontend.hooks.addAction( 'frontend/element_ready/kit-switcher.default', function( $element ) {
		const toggleContainer = jQuery( '.ang-widget--kit-toggle' );
		let defaultKit = toggleContainer.find( '.toggle_a' ).data( 'kit' );

		if ( ! defaultKit ) {
			defaultKit = elementorFrontend.config.post.id;
		}

		const userSelectedKitID = localStorage.getItem( 'selectedKitID_' + defaultKit );

		if ( isValidKitID( userSelectedKitID, $element ) ) {
			replaceKit( userSelectedKitID );
		} else {
			const dropdownSelectedKitSelector = '.ang-widget--kit-dropdown .dropdown .list li.selected';
			const dropdownSelectedKitSelectorObj = $element.find( dropdownSelectedKitSelector );

			const dropdownFirstKitSelector = '.ang-widget--kit-dropdown .dropdown .list li:first';
			const dropdownFirstKitObj = $element.find( dropdownFirstKitSelector );

			if ( 0 === dropdownSelectedKitSelectorObj.length && 0 !== dropdownFirstKitObj.length ) {
				replaceKit( dropdownFirstKitObj.attr( 'data-value' ) );
			}
		}
	} );
} );

function replaceKit( kitID ) {
	const classes = jQuery( 'body' ).classList().filter( word => word.startsWith( 'elementor-kit-' ) );
	classes.forEach( className => {
		jQuery( 'body' ).removeClass( className );
	} );

	jQuery( 'body' ).addClass( 'elementor-kit-' + kitID );

	setKit( kitID );
}

function setKit( kitID ) {
	const toggleContainer = jQuery( '.ang-widget--kit-toggle' );
	let defaultKit = toggleContainer.find( '.toggle_a' ).data( 'kit' );

	if ( ! defaultKit ) {
		defaultKit = elementorFrontend.config.post.id;
	}

	localStorage.setItem( 'selectedKitID_' + defaultKit, kitID );
}

function isValidKitID( kitID, $element ) {
	const switcherElement = $element.find( '#ang-kit-switcher' );

	if ( switcherElement.length ) { // Dropdown.
		const switcherOption = switcherElement.find( `option[value=${ kitID }]` );

		if ( switcherOption.length ) {
			updateDropdownUI( switcherElement, kitID );

			return true;
		}
	} else { // Toggle.
		const iconElement = $element.find( `[data-kit=${ kitID }]` );

		if ( iconElement.length ) {
			updateToggleUI( iconElement );

			return true;
		}
	}
}

function updateToggleUI( iconElement ) {
	let removeKit,
		updateKit;

	if ( iconElement.hasClass( 'toggle_a' ) ) {
		removeKit = 'kit_b';
		updateKit = 'kit_a';
	} else if ( iconElement.hasClass( 'toggle_b' ) ) {
		removeKit = 'kit_a';
		updateKit = 'kit_b';
	}

	iconElement.parent().removeClass( removeKit ).addClass( updateKit )
		.attr( 'data-current_kit', updateKit );
}

function updateDropdownUI( switcherElement, kitID ) {
	switcherElement.next( '.dropdown' )
		.find( `[data-value=${ kitID }]` )
		.trigger( 'click' ).trigger( 'click' ); // Triggering click twice to open then select and close the dropdown.
}

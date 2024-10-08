/* global ang_pro_settings_data, wp */
( function( $, data, wp ) {
	$( function() {
		const { __ } = wp.i18n;
		const { addQueryArgs } = wp.url;

		// Process Plugin Rollback.
		function processProPluginRollback( e ) {
			if ( e.preventDefault ) {
				e.preventDefault();
			}

			const version = $( '#ang_pro_rollback_version_select_option' ).val();
			const rollbackUrl = addQueryArgs( data.rollback_url, { version: version } );

			window.location.href = rollbackUrl;
			return false;
		}
		$( '#ang_pro_rollback_version_button' ).on( 'click', processProPluginRollback );

		$( 'input#ang_unsplash' ).click( function() {
			const keyField = $( '#ang_unsplash_key' ).parent().parent();
			const unameField = $( '#ang_default_username' ).parent().parent();
			if ( $( this ).prop('checked') === true ) {
				$( keyField ).show();
				$( unameField ).show();
			} else {
				$( keyField ).hide();
				$( unameField ).hide();
			}
		} );

	} );
}( jQuery, ang_pro_settings_data, wp ) );

jQuery( document ).ready( function( $ ) {
	function plg_twofactorauth_trust_untrust( e ) {
		var d = new Date();
		document.cookie = plg_twofactorauth_trust_cookie + "=;expires=" + d.toUTCString() + ";path=/";

		// both
		$( 'a.2fa-untrust' ).closest( 'div' ).remove();

		$( 'input[name=secretkey]' )
			.removeAttr( 'readonly' )
			.attr( 'placeholder', Joomla.JText._( 'JGLOBAL_SECRETKEY' ) );
		$( 'input[name=trust]' )
			.removeAttr( 'readonly' )
			.attr( 'onclick', '').unbind( 'click' );

		// mod_login - labels: icons
		$( '.2fa-untrust.Icon-check' ).after( '<svg class="u-text-r-m Icon Icon-star-full" style="margin-right: 0.25em;"><use xlink:href="#Icon-star-full"></use></svg>' ).remove();
	}

	$( '.2fa-untrust' ).click( function() { plg_twofactorauth_trust_untrust( this ) } );
} );

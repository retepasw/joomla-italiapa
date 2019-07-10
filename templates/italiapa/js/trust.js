function plg_twofactorauth_trust_untrust(e) {
	var d = new Date();
	document.cookie = plg_twofactorauth_trust_cookie + "=;expires=" + d.toUTCString() + ";path=/";
	
	jQuery( 'input[name=trust]' ).remove();

	jQuery( 'input[name=secretkey]' ).each( function( index ) {
		secretkey = jQuery( this );

		secretkey.removeAttr( 'readonly' );

		secretkey.attr( 'placeholder', Joomla.JText._( 'JGLOBAL_SECRETKEY' ) );

		// display labels: text
		secretkey.siblings( 'div:has(svg.Icon-unlink)' ).remove();

		// display labels: icons
		icon = secretkey.siblings( 'span:has(span.Icon-check)' );
		icon.attr( 'data-tooltip', Joomla.JText._( 'JGLOBAL_SECRETKEY' ) );
		tooltip = jQuery( '#' + icon.attr( 'aria-describedby' ) )
		tooltip.attr( 'data-tooltip', Joomla.JText._( 'JGLOBAL_SECRETKEY' ) );
		tooltip.text( Joomla.JText._( 'JGLOBAL_SECRETKEY' ) );	
		icon.children( 'span.Icon-check' ).replaceWith( '<svg class="u-text-r-m Icon Icon-star-full" style="margin-right: 0.25em;"><use xlink:href="#Icon-star-full"></use></svg>' );
		icon.children( 'span.u-hiddenVisually' ).text( Joomla.JText._( 'JGLOBAL_SECRETKEY' ) );
			
		// component
		secretkey.closest( 'div:has(div svg.Icon-unlink)' ).find( 'a:has(svg.Icon-unlink)' ).closest( 'div' ).remove();

		secretkey.closest( 'div.Form-field' ).after(
			'<fieldset id="form-login-trust" class="Form-field Form-field--choose Grid-cell">' +
				'<label class="Form-label" for="modlgn-trust">' +
				'<input type="checkbox" class="Form-input" id="modlgn-trust" name="trust">' +
				'<span class="Form-fieldIcon" role="presentation"></span>' + Joomla.JText._( 'PLG_TWOFACTORAUTH_TRUST_TRUST_THIS_DEVICE' ) + '</label>' +
			'</fieldset>');
	} );
}
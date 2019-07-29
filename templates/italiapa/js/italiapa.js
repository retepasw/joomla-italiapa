/**
 * @version		3.8
 *
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License
 * or other free or open source software licenses.
 */

(function($) {
	$(document).ready(function() {
		// Version
	    if (typeof (eshiol) === 'undefined') {
			eshiol = {};
		}

	    if (typeof (eshiol.italiapa) === 'undefined') {
			eshiol.italiapa = {};
		}
		eshiol.italiapa.version = '3.8.0.13';

		// Banner
		console.log("  _____ _        _ _       _____\n |_   _| |      | (_)     |  __ \\ /\\\n   | | | |_ __ _| |_  __ _| |__) /  \\\n   | | | __/ _` | | |/ _` |  ___/ /\\ \\\n  _| |_| || (_| | | | (_| | |  / ____ \\\n |_____|\\__\\__,_|_|_|\\__,_|_| /_/    \\_\\ " + eshiol.italiapa.version + "\n\nbased on Web Toolkit (https://italia.github.io/design-web-toolkit/)\nCopyright (c) 2017-2019, Helios Ciancio (https://www.eshiol.it)");

//	    hostname = document.location.hostname.split('.');
//	    const n = hostname.length;
//	    if (hostname[n - 2] + "." + hostname[n - 1] != 'eshiol.it') {
			$('<a href="http://paswjoomla.net/joomla/" title="Porte Aperte sul Web" target="_blank" rel="external">' +
				'<span title="Porte Aperte sul Web" style="background: url(&quot;data:image/png;base64,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&quot;) left center no-repeat; width: 124px; height: 32px; display: inline-block;">&nbsp;</span></a>')
				.insertBefore($('.ipa-copyright>span').last());
//	    }


			
		// Share
		if (typeof (eshiol.location) === 'undefined') {
			eshiol.location = {};
		}
		if ($('link[rel=shortlink]').eq(0).attr('href')) {
			eshiol.location.href = $('link[rel=shortlink]').eq(
					0).attr('href');
		} else if ($('link[rel=canonical]').eq(0).attr('href')) {
			eshiol.location.href = $('link[rel=canonical]').eq(
					0).attr('href');
		} else {
			eshiol.location.href = $(location).attr('href');
		}

		// right aside
		if ($( '#right' ).length) {
			// pagebreak
			$( 'article div div aside.ipa-Right' ).closest( 'div' ).children().each( function( index ) {
				x = $( this );
				$( this )
					.attr( 'class' ).split( ' ' ).each( function( element ) {
						if ( element.includes( '-size' ) ) {
							x.removeClass( element );
						}
					} );
			} );
			if ($( '#right > img:first' ).length) {
				$( '.ipa-Right:not(aside)' ).prependTo( '#right' );
				$( 'aside.ipa-Right' ).insertAfter( '#right > img:first' );
			} else {
				$( '.ipa-Right' ).prependTo( '#right' );
			}
			// icons
			$( '.ipa-Right nav' ).removeClass( 'u-floatRight' ).addClass( 'u-padding-bottom-s' );
		}

		// theme
		eshiol.italiapa.setTheme = function(theme) {
			if (theme == 'default') {
				$.removeCookie('theme');
			    document.getElementById("theme").setAttribute("href", __PUBLIC_PATH__ + "build." + __DEFAULT_THEME__ + ".css");
			    theme = 'italia';
			} else {
				$.cookie('theme', theme);
			    document.getElementById("theme").setAttribute("href", __PUBLIC_PATH__ + "build." + theme + ".css");			    
			}
		    $('html').attr('class').split(' ').each(function(element) {
		    	if (element.substring(0, 6) == 'theme-') {
		    		$('html').removeClass(element);
		    	}
		    });
    		$('html').addClass('theme-' + theme);
		}
		
		// merge footer menus
		$('footer ul.Footer-links:gt(0)').remove().children('li').appendTo('footer ul.Footer-links:eq(0)');

		// megamenu multi-column
		$( 'ul.columns[data-columns]' ).each( function() {
			columns = $( this ).attr( 'data-columns' );
			colWidth = $( this ).width();
			$( this ).width( columns * colWidth );

			$( this ).find( 'li' ).eq( 0 ).children().not( 'ul' ).wrapAll( '<div></div>' );

			// split the first ul
			var ul = $( this ).find( 'ul' ).eq( 0 );
			var colSize = Math.ceil( ul.find( 'li' ).size() / columns);

			ul.find( 'li' ).each( function( i ) {
				j = Math.floor( i / colSize );
				if ( j > 0 ) {
					$( this ).addClass( 'column-' + j );
				}
			} );

			for (j = columns - 1; j > 0; j--) {
				ul.find( '.column-' + j ).removeClass( 'column-' + j ).insertAfter( ul ).wrapAll( '<ul></ul>' );
			}

			// fix style
			$( this ).find( 'li' ).eq( 0 ).width( columns * colWidth );
			$( this ).find( 'li ul' ).width( colWidth );
			// $( this ).find( 'li ul' ).wrapAll( '<div></div>' );
		} );
	});
})(jQuery);

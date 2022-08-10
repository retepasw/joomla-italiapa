/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License
 * or other free or open source software licenses.
 */

( function( $ ) {
	$( document ).ready( function( ) {
		// Version
	    if ( typeof ( eshiol ) === 'undefined' ) {
			eshiol = {};
		}

	    if ( typeof ( eshiol.italiapa ) === 'undefined' ) {
			eshiol.italiapa = {};
		}
		eshiol.italiapa.version = '__DEPLOY_VERSION__';

		// Banner
		console.log( "  _____ _        _ _       _____\n |_   _| |      | (_)     |  __ \\ /\\\n   | | | |_ __ _| |_  __ _| |__) /  \\\n   | | | __/ _` | | |/ _` |  ___/ /\\ \\\n  _| |_| || (_| | | | (_| | |  / ____ \\\n |_____|\\__\\__,_|_|_|\\__,_|_| /_/    \\_\\ " + eshiol.italiapa.version + "\n\nbased on Web Toolkit (https://italia.github.io/design-web-toolkit/)\nCopyright (c) 2017 - 2022, Helios Ciancio (https://www.eshiol.it)" );

		// Share
		if ( typeof ( eshiol.location ) === 'undefined' ) {
			eshiol.location = {};
		}
		if ( $( 'link[rel=shortlink]' ).eq( 0 ).attr( 'href' ) ) {
			eshiol.location.href = $( 'link[rel=shortlink]' ).eq( 0 ).attr( 'href' );
		} else if ( $( 'link[rel=canonical]' ).eq( 0 ).attr( 'href' ) ) {
			eshiol.location.href = $( 'link[rel=canonical]' ).eq( 0 ).attr( 'href' );
		} else {
			eshiol.location.href = $( location ).attr( 'href' );
		}

		// right aside
		if ( $( '#right' ).length ) {
			// full image
			$( '.item-image.ipa-Right' ).prependTo( '#right' );

			// pagebreak
			$( 'article aside.ipa-Right' ).closest( 'div' ).children().each( function( i, el ) {
				$.each( $( el ).attr( 'class' ).split( ' ' ), function( index, element ) {
					if ( element.includes( '-size' ) ) {
						$( el ).removeClass( element );
					}
				} );
			});

			if ( $( '#right > img:first' ).length ) {
				$( '.ipa-Right:not(aside)' ).prependTo( '#right' );
				$( 'aside.ipa-Right' ).insertAfter( '#right > img:first' );
			} else {
				$( '.ipa-Right' ).prependTo( '#right' );
			}

			// icons
			$( '.ipa-Right nav' ).removeClass( 'u-floatRight' );

			// fix padding
			$( '#right' ).children().each( function( i, el ) {
				$.each( $( el ).attr( 'class' ).split( ' ' ), function( index, element ) {
					if ( element.includes( '-padding-' ) || element.includes( 'Grid' ) ) {
						$( el ).removeClass( element );
					}
				} );
				$( el ).addClass( 'u-padding-bottom-s' );
			} );
		}

		// fields
		$( 'article dl.fields-container dd.field-entry.ipa-Right' ).each( function( index, element ) {
			$( element ).prependTo( 'div.icons nav>ul:first-of-type' ).replaceWith( $( '<li class="u-padding-right-xs">' + element.innerHTML + '</li>' ) );
		} );

		// theme
		eshiol.italiapa.setTheme = eshiol.italiapa.setTheme || function( theme ) {
			if ( theme == 'default' ) {
				$.removeCookie( 'theme' );
			    document.getElementById( 'theme' ).setAttribute( 'href', __PUBLIC_PATH__ + 'build.' + __DEFAULT_THEME__ + '.css' );
			    theme = 'italia';
			} else {
				url = __PUBLIC_PATH__ + 'build.' + theme + '.css';
			    var http = new XMLHttpRequest();
			    http.open( 'HEAD', url, false );
			    http.send();
			    if ( http.status != 404 ) {
					$.cookie( 'theme', theme, { path: '/' } );
				    document.getElementById( 'theme' ).setAttribute( 'href', __PUBLIC_PATH__ + 'build.' + theme + '.css' );
				}
			}
			$.each(	$( 'html' ).attr( 'class' ).split( ' ' ), function( index, element ) {
		    	if ( element.substring( 0, 6 ) == 'theme-' ) {
		    		$( 'html' ).removeClass( element );
		    	}
		    });
    		$( 'html' ).addClass( 'theme-' + theme );
		}

		// cookie consent
		eshiol.italiapa.removeCookiesConsent = function( ) {
			console.log( 'removing cookies_consent cookie' );
			$.removeCookie( 'cookies_consent' );
		}

		// merge footer menus
		$( 'footer ul.Footer-links:gt(0)' ).remove( ).children( 'li' ).appendTo( 'footer ul.Footer-links:eq(0)' );

		// megamenu multi-column
		$( '.js-megamenu ul.columns[data-columns]' ).each( function( ) {
			columns = $( this ).attr( 'data-columns' );
			colWidth = $( this ).width();
			$( this ).width( columns * colWidth );

			// split the first ul
			var ul = $( this ).find( 'ul' ).eq( 0 );

			if ( ul.find( '>li.column-break' ).length == columns - 1 ) {
				j = 0;
				ul.find( '>li' ).each( function( i ) {
					if ( $( this ).hasClass( 'column-break' ) ) {
						j++;
						$( this ).remove();
					} else if ( j > 0 ) {
						$( this ).addClass( 'column-' + j );
					}
				} );
			} else {
				var colSize = Math.ceil( ul.find( 'li' ).size( ) / columns);
				i = 0; j = 0;
				ul.find( '>li' ).each( function( ) {
					if ( j > 0 ) {
						$( this ).addClass( 'column-' + j );
					}
					i = i + 1 + $( this ).find( '>ul>li' ).length;
					if (i >= colSize) {
						j = j + 1;
						i = 0;
					}
				} );
			}

			for ( j = columns - 1; j > 0; j-- ) {
				ul.find( '.column-' + j ).removeClass( 'column-' + j ).insertAfter( ul ).wrapAll( '<ul></ul>' );
			}

			// fix style
			$( this ).find( 'li' ).eq( 0 ).width( columns * colWidth );
			$( this ).find( 'li ul' ).width( colWidth );
			// $( this ).find( 'li ul' ).wrapAll( '<div></div>' );
		} );

		// clipboard
	    if ( typeof ( eshiol.italiapa.clipboard ) === 'undefined' ) {
			eshiol.italiapa.clipboard = {};
		}

		eshiol.italiapa.clipboard.write = function( str, msg ) {
			navigator.permissions.query( {name: 'clipboard-write'} ).then( function( result) {
				if ( result.state === 'granted' ) {
					if ( navigator.clipboard ) {
						// Safe to use Async Clipboard API!
						navigator.clipboard.write( [
							new ClipboardItem( {
								'text/plain': new Blob( [str], {type: 'text/plain'} )
							} 
						)] ).then( function() {
							console.log( 'Copied to clipboard successfully!' );
							if (msg !== undefined) {
								alert(msg);
							}
						}, function( error ) {
							console.error( 'unable to write to clipboard. Error:' );
							console.log( error );
						});
					} else {
						// Use document.execCommand() instead
						// Create new element
						var el = document.createElement("textarea");
						// Set value (string to be copied)
						el.value = str;
						// Set non-editable to avoid focus and move outside of view
						el.setAttribute("readonly", "");
						el.style = {position: "absolute", left: "-9999px"};
						document.body.appendChild(el);
						// Select text inside element
						el.select();
						// Copy text to clipboard
						document.execCommand("copy");
						if (msg !== undefined) {
							alert(msg);
						}
						// Remove temporary element
						document.body.removeChild(el);
					}
				} else {
					console.log( 'clipboard-permissoin not granted: ' + result );
				}
		    } );
		}

		// external
		$.expr[':'].external = function(obj){
			return !obj.href.match(/^mailto\:/)
				&& (obj.hostname != location.hostname)
				&& !obj.href.match(/^javascript\:/)
				&& !obj.href.match(/^$/)
		};
		$('a:external').attr('target', '_blank');

	} );

	/**
	 * Render messages send via JSON
	 * Used by some javascripts such as validate.js
	 *
	 * @param   {object}  messages    JavaScript object containing the messages to render. Example:
	 *                              var messages = {
	 *                                  "message": ["Message one", "Message two"],
	 *                                  "error": ["Error one", "Error two"]
	 *                              };
	 * @return  {void}
	 */
	Joomla.renderMessages = function( messages ) {
		Joomla.removeMessages();

		var messageContainer = document.getElementById( 'system-message-container' ),
		    type, typeMessages, messagesBox, title, titleWrapper, i, messageWrapper, alertClass;

		for ( type in messages ) {
			if ( !messages.hasOwnProperty( type ) ) { continue; }
			// Array of messages of this type
			typeMessages = messages[ type ];

			// Create the alert box
			messagesBox = document.createElement( 'div' );

			// Message class
			alertClass = (type === 'notice') ? 'Alert-info' : 'alert-' + type;
			alertClass = (type === 'message') ? 'Alert-success' : alertClass;
			alertClass = (type === 'error') ? 'Alert-error Alert-danger' : alertClass;

			messagesBox.className = 'Prose Alert ' + alertClass + ' Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom';

			// Close button
			var buttonWrapper = document.createElement( 'a' );
			buttonWrapper.setAttribute('data-dismiss', 'alert');
			buttonWrapper.className = 'Button u-border-none u-floatRight';
			buttonWrapper.innerHTML = '<span class="u-text-r-m Icon Icon-close"></span>';
			messagesBox.appendChild( buttonWrapper );

			// Title
			title = Joomla.JText._( type );

			// Skip titles with untranslated strings
			if ( typeof title != 'undefined' ) {
				titleWrapper = document.createElement( 'h2' );
				titleWrapper.className = 'u-text-h';
				titleWrapper.innerHTML = Joomla.JText._( type );
				messagesBox.appendChild( titleWrapper );
			}

			// Add messages to the message box
			for ( i = typeMessages.length - 1; i >= 0; i-- ) {
				messageWrapper = document.createElement( 'p' );
				messageWrapper.className = 'u-text-p';
				messageWrapper.innerHTML = typeMessages[ i ];
				messagesBox.appendChild( messageWrapper );
			}

			messageContainer.appendChild( messagesBox );
		}
	};

} )( jQuery );

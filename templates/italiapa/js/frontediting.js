/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 * 
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2023 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

/**
 * JavaScript fix behavior to add front-end hover edit icons with tooltips for modules and menu items.
 *
 */
( function( exports, d ) {
	function domReady( fn, context ) {
		function onReady( event ) {
			d.removeEventListener( "DOMContentLoaded", onReady );
			fn.call( context || exports, event );
		}
		function onReadyIe( event ) {
			if ( d.readyState === "complete" ) {
				d.detachEvent( "onreadystatechange", onReadyIe );
				fn.call( context || exports, event );
			}
		}
		if ( d.addEventListener ) {
			d.addEventListener( "DOMContentLoaded", onReady );
		} else if ( d.attachEvent ) {
			d.attachEvent( "onreadystatechange", onReadyIe );
		}
	}
	exports.domReady = domReady;
} )( window, document );

domReady( function( event ) {
	[].forEach.call( document.querySelectorAll( ".jmoddiv" ), function( el ) {
	    el.addEventListener( "mouseenter", e => {
	        [].forEach.call( document.querySelectorAll( ".btn.jmodedit>span.icon-edit" ), function( btn ) {
                fc = string2rgb( getColor( btn ) );
                bc = getComputerBackgroundColor( btn );
                if ( isTransparent( bc ) ) {
                    bc = getBackgroundColor( el );
                }
                bc = string2rgb( bc );
                if ( deltaE( rgb2lab( bc ), rgb2lab( fc ) ) < 50 ) {
                    btn.style.color = '#fff';
                }
            } );
        } );
    } );
} );

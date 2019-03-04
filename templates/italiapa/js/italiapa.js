/**
 * @package Template ItaliaPA
 * @subpackage tpl_italiapa
 * 
 * @author Helios Ciancio <info@eshiol.it>
 * @link https://www.eshiol.it
 * @copyright Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3 Template
 *          ItaliaPA is free software. This version may have been modified
 *          pursuant to the GNU General Public License, and as distributed it
 *          includes or is derivative of works licensed under the GNU General
 *          Public License or other free or open source software licenses.
 */

(function($) {
	$(document)
			.ready(
					function() {
						// Copyright
						console
								.log("  _____ _        _ _       _____\n |_   _| |      | (_)     |  __ \\ /\\\n   | | | |_ __ _| |_  __ _| |__) /  \\\n   | | | __/ _` | | |/ _` |  ___/ /\\ \\\n  _| |_| || (_| | | | (_| | |  / ____ \\\n |_____|\\__\\__,_|_|_|\\__,_|_| /_/    \\_\\\n\nbased on Web Toolkit (https://italia.github.io/design-web-toolkit/)\nCopyright (c) 2017-2019, Helios Ciancio (https://www.eshiol.it)");

						if (typeof (eshiol) === 'undefined') {
							eshiol = {};
						}

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

					});
})(jQuery);

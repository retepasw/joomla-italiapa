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

var $ = jQuery.noConflict();

$('dl.Timeline').replaceWith(function() {
	$(this).find('dt').each(function() {
		$(this).add($(this).next('dd'))
			.wrapAll('<div class="Timeline u-layout-prose u-layoutCenter"></div>');
	});

 	$(this).find('dt').replaceWith(function() {
		return $('<div/>')
			.addClass('Timeline-point')
			.append($('<div/>')
				.addClass('Timeline-point-content u-background-95 u-color-white')
				.addClass('u-textWeight-700')
				.append($(this).contents()));
	});

 	$(this).find('dd').replaceWith(function() {
		return $('<div/>')
			.addClass('Timeline-content u-color-black')
			.append($('<div/>')
				.addClass('Timeline-arrow Icon-drop-down u-color-white'))
				.append($('<div/>')
					.addClass('u-borderShadow-xs u-padding-r-all u-background-white u-borderRadius-xs')
					.append($(this).contents()));
	});

 	return $(this).contents();
});
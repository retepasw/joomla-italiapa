/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License
 * or other free or open source software licenses.
 */

var $ = jQuery.noConflict();

$('dl.Accordion').replaceWith(function(){
	if ("undefined" == typeof $(this).attr('id'))
	{
		$(this).attr('id', 'accordion-'+uuid.v4());
	}
	var i = 0;
	$(this).find('dd').replaceWith(function(){
		// trasformazione dd in div
		$x = $('<div/>')
			.addClass('Accordion-panel fr-accordion__panel js-fr-accordion__panel')
			;
		// impostazione class p
		$x.find('p')
			.addClass('u-layout-prose u-color-grey-90 u-text-p u-padding-r-all')
			;
		// trasformazione dd in div aggiunta p
		if ($x.find('p').length == 0)
		{
			$x.append(
				$('<p/>')
//				.addClass('u-layout-prose u-color-grey-90 u-text-p u-padding-r-all')
				.append($(this).contents())
			)
			;
		}
		// impostazione attributi
		$.each(this.attributes, function(i, attribute){
			$x.attr(attribute.name, attribute.value);
		});
		$x.attr('id','accordion-panel-'+$(this).parent().attr('id')+i)
		i++;
		return $x;
	});

	var i = 0;
	$(this).find('dt').replaceWith(function(){
		console.log($(this).parent().attr('id'));
		// trasforma dt in h2
		$x = $('<h2/>')
			.addClass('Accordion-header js-fr-accordion__header fr-accordion__header')
			// aggiunta span
			.append(
				$('<span/>')
				.addClass('Accordion-link')
//				.addClass('u-text-r-s')
				.append($(this).contents())
			)
			;
		// impostazione attributi
		$.each(this.attributes, function(i, attribute){
			$x.attr(attribute.name, attribute.value);
		});
		$x.attr('id','accordion-header-'+$(this).parent().attr('id')+i)
		i++;
		return $x;
	});

	$x = $('<div/>')
    	.append($(this).contents());
	$.each(this.attributes, function(i, attribute){
		$x.attr(attribute.name, attribute.value);
	});
	$x.addClass('fr-accordion js-fr-accordion')
	return $x;
});

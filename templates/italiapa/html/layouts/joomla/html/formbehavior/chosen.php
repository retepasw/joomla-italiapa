<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

/**
 * Layout variables
 * ---------------------
 *
 * @var  string   $selector       The id of the field
 * @var  array    $options        The options array
 * @var  boolean  $debug          Are we in debug mode?
 */

extract($displayData);

// Include jQuery
JHtml::_('jquery.framework');
JHtml::_('script', 'jui/chosen.jquery.min.js', array('version' => 'auto', 'relative' => true, 'detectDebug' => $debug));
JHtml::_('stylesheet', 'jui/chosen.css', array('version' => 'auto', 'relative' => true));

// Options array to json options string
$options_str = json_encode($options, ($debug && defined('JSON_PRETTY_PRINT') ? JSON_PRETTY_PRINT : false));

JFactory::getDocument()->addScriptDeclaration(
	'
	jQuery(function ($) {
		initChosen();
		$("body").on("subform-row-add", initChosen);

		function initChosen(event, container)
		{
			container = container || document;

			$(container).find(' . json_encode($selector) . ').chosen(' . $options_str . ')
				.each(function(index){
					$("#"+$(this).attr("id")+"_chzn").addClass($(this).attr("class"));
				});
		}
	});
	'
);

<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 * 
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
$positions = $this->model->getPositions();

// Add custom position to options
$customGroupText = JText::_('COM_MODULES_CUSTOM_POSITION');

// Build field
$attr = array(
	'id'          => 'jform_position',
	'list.select' => $this->item['position'],
	'list.attr'   => 'class="Form-input chzn-custom-value" '
		. 'data-custom_group_text="' . $customGroupText . '" '
		. 'data-no_results_text="' . JText::_('COM_MODULES_ADD_CUSTOM_POSITION') . '" '
		. 'data-placeholder="' . JText::_('COM_MODULES_TYPE_OR_SELECT_POSITION') . '" '
);

echo JHtml::_('select.groupedlist', $positions, 'jform[position]', $attr);

<?php
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
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die('Restricted access.');

JHtml::_('behavior.framework');
JHtml::_('jquery.framework');
//JFactory::getDocument()->addScript(rtrim(JURI::base(true), '/') . '/'.'media/com_buttons/js/ajax.js');

foreach($displayData->buttons as $id => $item)
{
	if ($item->value != ' null')
	{
		echo '<div class="button-'.$id.' com_buttons'.$item->value.'" data-tooltip="'.JHtml::tooltipText($item->title, 0).'"></div>';
	}
}

<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

//JHtml::_('bootstrap.tooltip');

$article = $displayData['article'];
$overlib = $displayData['overlib'];

$icon = $article->state ? 'more-actions' : 'lock';

if (strtotime($article->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($article->publish_down) < strtotime(JFactory::getDate())) && $article->publish_down != JFactory::getDbo()->getNullDate()))
{
	$icon = 'lock';
}
?>
<span data-tooltip="<?php echo JHtml::tooltipText(JText::_('COM_CONTENT_EDIT_ITEM'), $overlib, 0, 0); ?>" data-tooltip-position="bottom right">
	<span class="u-text-r-m Icon Icon-<?php echo $icon; ?>"></span>
	<span class="u-hidden"><?php echo JText::_('JGLOBAL_EDIT'); ?></span>
</span>
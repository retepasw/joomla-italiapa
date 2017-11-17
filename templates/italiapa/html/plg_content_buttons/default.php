<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$config = JFactory::getConfig();
$offset = $config->get('offset');

?>
<table class="buttonsreport-report Table Table--withBorder js-TableResponsive tablesaw tablesaw-stack" data-tablesaw-mode="stack">
<?php foreach($items as $item): ?>
	<tr>
		<td class="buttonsreport-name"><?php echo $item->editor_name; ?></td>
		<td class="buttonsreport-date"><?php echo $item->modified ? JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC2'), $offset) : ''; ?></td>
		<td class="buttonsreport-value u-textRight"><?php echo $item->toolbar; ?></td>
	</tr>
<?php endforeach; ?>
</table>
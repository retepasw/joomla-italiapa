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

defined('JPATH_BASE') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$params = $displayData['params'];

?>
<span data-tooltip="<?php echo JHtml::tooltipText(JText::_('JGLOBAL_PRINT'), 0); ?>" data-tooltip-position="bottom center">
	<?php if ($params->get('show_icons')) : ?>
		<span class="u-text-r-m Icon Icon-print"></span>
	<?php else : ?>
		<?php echo JText::_('JGLOBAL_PRINT'); ?>
	<?php endif; ?>
</span>

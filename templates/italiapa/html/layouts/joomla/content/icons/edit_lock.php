<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$tooltip = $displayData['tooltip'];
?>
<span data-tooltip="<?php echo JHtml::tooltipText($tooltip . '', 0); ?>" data-tooltip-position="bottom center">
	<span class="u-text-r-m Icon Icon-lock"></span>
	<?php //echo JText::_('JLIB_HTML_CHECKED_OUT'); ?>
</span>

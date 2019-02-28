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
defined('_JEXEC') or die();
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
?>
<div
	class="Prose Alert Alert--success Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom"
	role="alert">
	<a class="Button u-border-none u-floatRight" href="#"
		onclick="window.close();return false;"><span
		class="u-text-r-m Icon Icon-close"></span></a>
	<h2 class="u-text-h3"><?php echo JText::_('TPL_ITALIAPA_OPERATION_SUCCESS'); ?></h2>
	<p class="u-text-p"><?php echo JText::_('COM_MAILTO_EMAIL_SENT'); ?></p>
</div>
<div class="Grid Grid--fit Grid--withGutter u-padding-all-l">
	<div class="Grid-cell">
		<button type="button" class="Button Button--danger u-text-r-xs"
			onclick="window.close();return false;">
			<span class="icon-cancel"></span><?php echo JText::_('COM_MAILTO_CLOSE_WINDOW') ?>
		</button>
	</div>
</div>

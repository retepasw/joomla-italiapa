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

/**
 * Layout variables
 * ---------------------
 *
 * @var  string   $item The item id number
 * @var  string   $link The link text
 * @var  string   $label The label text
 */
extract($displayData);

JHtml::_('behavior.modal', 'button.modal_' . $item);
?>
<button type="button" class="Button Button--info u-text-r-xs modal_<?php echo $item; ?>" title="<?php echo $label; ?>" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 800, y: 500}}">
	<span class="icon-archive" aria-hidden="true"></span><?php echo $label; ?>
</button>

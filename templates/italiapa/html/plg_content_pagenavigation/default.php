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

$lang = JFactory::getLanguage(); ?>

<ul class="Grid Grid--fit Grid--alignMiddle u-text-r-xxs">
<?php if ($row->prev) :
	$direction = $lang->isRtl() ? 'right' : 'left'; ?>
	<li class="Grid-cell u-textCenter">
		<a href="<?php echo $row->prev; ?>" rel="prev" class="u-color-50 u-textClean u-block">
			<span class="Icon-chevron-<?php echo $direction; ?> u-text-r-m" role="presentation"></span>
			<span class="u-hiddenVisually"><?php echo $row->prev_label; ?></span>
		</a>
	</li>
<?php endif; ?>
<?php if ($row->next) :
	$direction = $lang->isRtl() ? 'left' : 'right'; ?>
	<li class="Grid-cell u-textCenter">
		<a href="<?php echo $row->next; ?>" rel="next" class="u-color-50 u-textClean u-block">
			<span class="Icon-chevron-<?php echo $direction; ?> u-text-r-m" role="presentation"></span>
			<span class="u-hiddenVisually"><?php echo $row->next_label; ?></span>
		</a>
	</li>
<?php endif; ?>
</ul>

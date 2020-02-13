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

defined('_JEXEC') or die;

$lang = JFactory::getLanguage(); ?>

<nav role="navigation" aria-label="<?php echo JText::_('TPL_ITALIAPA_PAGINGBAR'); ?>" class="Grid Grid--fit Grid--alignCenter u-layoutCenter">
	<ul class="Grid Grid--fit Grid--alignMiddle u-text-r-xxs">
	<?php if ($row->prev) : ?>
		<li class="Grid-cell u-textCenter">
			<a href="<?php echo $row->prev; ?>" rel="prev" class="u-color-50 u-textClean u-block">
				<span class="Icon-chevron-<?php echo $lang->isRtl() ? 'right' : 'left'; ?> u-text-r-m" role="presentation"></span>
				<span class="u-hiddenVisually"><?php echo $row->prev_label; ?></span>
			</a>
		</li>
	<?php endif; ?>
	<?php if ($row->next) : ?>
		<li class="Grid-cell u-textCenter">
			<a href="<?php echo $row->next; ?>" rel="next" class="u-color-50 u-textClean u-block">
				<span class="Icon-chevron-<?php echo $lang->isRtl() ? 'left' : 'right'; ?> u-text-r-m" role="presentation"></span>
				<span class="u-hiddenVisually"><?php echo $row->next_label; ?></span>
			</a>
		</li>
	<?php endif; ?>
	</ul>
</nav>

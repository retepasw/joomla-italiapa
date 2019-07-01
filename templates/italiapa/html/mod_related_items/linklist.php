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

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
?>
<?php if (!empty($list)) : ?>
	<ul class="Linklist Prose u-text-r-xs relateditems<?php echo $moduleclass_sfx; ?> mod-list" itemscope itemtype="http://schema.org/ItemList">
		<?php $i = 1; ?>
		<?php foreach ($list as $item) : ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<meta itemprop="position" content="<?php echo $i++; ?>"/>
				<a href="<?php echo $item->route; ?>" itemprop="url">
					<?php if ($showDate) : ?>
						<time datetime="<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>" itemprop="dateCreated">
							<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); ?>
						</time> -
					<?php endif; ?>	
					<span itemprop="name" class="u-text-r-xs">
						<?php echo $item->title; ?>
					</span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

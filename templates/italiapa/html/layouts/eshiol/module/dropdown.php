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

defined('_JEXEC') or die;

$module          = $displayData['module'];
$list            = $displayData['list'];
$params          = $displayData['params'];
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
?>
<div class="<?php echo $moduleclass_sfx; ?> mod-list">
	<a href="#module_<?php echo $module->id; ?>" data-menu-trigger="module_<?php echo $module->id; ?>" class="Header-language u-border-none u-zindex-max u-inlineBlock" aria-controls="module_<?php echo $module->id; ?>" aria-haspopup="true" role="button">
		<?php if ($module->showtitle) : ?>
			<?php echo $module->title; ?>
		<?php endif; ?>
		<span class="Icon Icon-expand u-padding-left-xs"></span>
	</a>
	<div id="module_<?php echo $module->id; ?>" data-menu="" class="Dropdown-menu Header-language-other u-jsVisibilityHidden u-nojsDisplayNone" x-placement="bottom" role="menu" aria-hidden="true" style="position: absolute; transform: translate3d(1323px, -245px, 0px); top: 0px; left: 0px; will-change: transform;">
		<span class="Icon-drop-down Dropdown-arrow u-color-white" style="left: 58px;"></span>
		<ul class="<?php echo $moduleclass_sfx; ?> mod-list" itemscope itemtype="http://schema.org/ItemList">
			<?php $i = 1; ?>
			<?php foreach ($list as $item) : ?>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<meta itemprop="position" content="<?php echo $i++; ?>"/>
					<?php if ($params->get('showDate', 0)) : ?>
						<time datetime="<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>" itemprop="dateCreated">
							<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); ?>
						</time> -
					<?php endif; ?>
					<?php // mod_related_items uses route instead of link ?>
					<a href="<?php echo isset($item->link) ? $item->link : $item->route; ?>" itemprop="url">
						<span itemprop="name">
							<?php // mod_articles_archive uses text instead of title ?>
							<?php echo isset($item->title) ? $item->title : $item->text; ?>
						</span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

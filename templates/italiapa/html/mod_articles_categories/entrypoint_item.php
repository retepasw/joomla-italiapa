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
?>
<div class="Entrypoint-item u-background-50<?php echo $itemClass; ?><?php if ($_SERVER['REQUEST_URI'] === JRoute::_(ContentHelperRoute::getCategoryRoute($item->id))) echo ' active'; ?>">
	<?php $levelup = $item->level - $startLevel - 1; ?>
	<!-- <h<?php echo $params->get('item_heading') + $levelup; ?>> -->
	<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id)); ?>" class="u-textClean u-text-h<?php echo $params->get('item_heading') + $levelup; ?> u-color-white" itemprop="url">
	<?php echo $item->title; ?>
		<?php if ($params->get('numitems')) : ?>
			(<?php echo $item->numitems; ?>)
		<?php endif; ?>
		</a>
   		<!-- </h<?php echo $params->get('item_heading') + $levelup; ?>> -->

	<?php if ($params->get('show_description', 0)) : ?>
		<?php echo JHtml::_('content.prepare', $item->description, $item->getParams(), 'mod_articles_categories.content'); ?>
	<?php endif; ?>
</div>

<?php if ($params->get('show_children', 0) && (($params->get('maxlevel', 0) == 0)
	|| ($params->get('maxlevel') >= ($item->level - $startLevel)))
	&& count($item->getChildren())) : ?>
	<?php $temp = $list; ?>
	<?php $list = $item->getChildren(); ?>
	<?php foreach ($list as $item) : ?>
		<?php require JModuleHelper::getLayoutPath('mod_articles_categories', 'entrypoint_item'); ?>
	<?php endforeach; ?>
	<?php $list = $temp; ?>
<?php endif; ?>

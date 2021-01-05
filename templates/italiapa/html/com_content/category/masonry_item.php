<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params  = &$this->item->params;
$images  = json_decode($this->item->images);
$canEdit = $this->item->params->get('access-edit');
$info    = $this->item->params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
?>
<div class="u-nbfc u-borderShadow-xxs u-borderRadius-m u-color-grey-30 u-background-white u-sizeFull">
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
	<div class="u-text-r-l u-padding-r-all u-layout-prose">
		<?php // Todo Not that elegant would be nice to group the params ?>
		<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
			|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

		<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
			<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($params->get('show_title')) : ?>
		<h3 class="u-text-h4 u-margin-r-bottom" itemprop="headline">
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a class="u-text-r-m u-color-black u-textWeight-400 u-textClean" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)); ?>" itemprop="url">
				<?php echo $this->escape($this->item->title); ?>
			</a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
		</h3>
		<?php endif; ?> 
		<div class="u-text-p u-textSecondary" itemprop="articleBody">
			<?php if (!$params->get('show_intro')) : ?>
				<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
				<?php echo $this->item->event->afterDisplayTitle; ?>
			<?php endif; ?>
			<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
			<?php echo $this->item->event->beforeDisplayContent; ?>

			<?php echo $this->item->introtext; ?>

			<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
				<?php echo JLayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
				<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
					<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($params->get('show_readmore') && $this->item->readmore) :
				if ($params->get('access-view')) :
					$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
				else :
					$menu = JFactory::getApplication()->getMenu();
					$active = $menu->getActive();
					$itemId = $active->id;
					$link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
					$link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
				endif; ?>

				<?php echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>
			<?php endif; ?>
		</div>
	</div>
</div>

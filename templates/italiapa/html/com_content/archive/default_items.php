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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$params  = $this->params;
$app	= JFactory::getApplication();
$tparams = $app->getTemplate(true)->params;

$columns = max(1, $tparams->def('num_columns', 1));

$size = 'size' . (int) (12 / $columns) . 'of12';
?>

<div class="Grid Grid--withGutter" id="archive-items">
	<?php foreach ($this->items as $i => $item) : ?>
		<?php $info = $item->params->get('info_block_position', 0); ?>
		<div class="Grid-cell u-md-<?php echo $size; ?> u-lg-<?php echo $size; ?>" itemscope itemtype="https://schema.org/Article">
			<div class="page-header u-color-grey-30 u-border-top-xxs u-padding-right-xxl u-padding-r-all">
			<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
				|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category')); ?>

			<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
				<?php echo JLayoutHelper::render('joomla.content.info_block', array('item' => $item, 'params' => $item->params, 'position' => 'above')); ?>
			<?php endif; ?>

			<h3 class="u-padding-r-top u-padding-r-bottom" itemprop="headline">
				<?php if ($params->get('link_titles')) : ?>
					<a class="u-text-h4 u-textClean u-color-black" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>" itemprop="url">
						<?php echo $this->escape($item->title); ?>
					</a>
				<?php else : ?>
					<span class="u-text-h4 u-linkClean u-color-black">
						<?php echo $this->escape($item->title); ?>
					</span>
				<?php endif; ?>
			</h3>

			<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
			<?php echo $item->event->afterDisplayTitle; ?>

			<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
			<?php echo $item->event->beforeDisplayContent; ?>
			<?php if ($params->get('show_intro')) : ?>
				<div class="intro u-lineHeight-l u-text-r-xs u-textSecondary u-padding-r-right" itemprop="articleBody"> <?php echo JHtml::_('string.truncateComplex', $item->introtext, $params->get('introtext_limit')); ?> </div>
			<?php endif; ?>

			<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
				<?php echo JLayoutHelper::render('joomla.content.info_block', array('item' => $item, 'params' => $item->params, 'position' => 'below')); ?>
			<?php endif; ?>

			<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
			<?php echo $item->event->afterDisplayContent; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>

<?php if ($params->get('show_pagination', 2)) : ?>
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>

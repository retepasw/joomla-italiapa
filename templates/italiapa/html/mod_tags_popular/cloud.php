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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';
?>
<?php JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php'); ?>
<div class="tagspopular">
<?php if (!count($list)) : ?>
	<div class="Prose Alert Alert--warning Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
	    <h2 class="u-text-h3"><?php echo JText::_('WARNING'); ?></h2>
	    <p class="u-text-p"><?php echo JText::_('MOD_TAGS_POPULAR_NO_ITEMS_FOUND'); ?></p>
	</div>
<?php else : ?>
	<?php $db = JFactory::getDbo(); ?>
	<div class="Grid Grid--withGutter">
		<?php foreach (array_slice($list, 0, 3) as $item) : ?>
			<div class="Grid-cell u-md-size1of3 u-lg-size1of3 u-flex u-margin-r-bottom u-flexJustifyCenter">
				<div class="u-nbfc u-borderShadow-m u-borderRadius-m u-color-grey-30 u-background-white Arrange-sizeFill">
					<div class="u-text-r-l u-padding-r-all u-layout-prose">
						<h3 class="u-text-h4 u-margin-r-bottom">
							<a class="u-text-r-m u-color-95 u-textWeight-400 u-textClean" href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($item->tag_id . ':' . $item->alias)); ?>"
								<?php JHtml::_('iwt.tag', $item); ?>
								class="<?php echo $item->link_class; ?>" itemprop="keywords" rel="tag">
								<?php echo $item->icon . htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?></a>
						</h3>
						<?php
							$query = $db->getQuery(true)
								->select('description')
								->from($db->quoteName('#__tags'))
								->where($db->quoteName('id') . ' = ' . $item->tag_id);
							$description = $db->setQuery($query)->loadResult();
						?>
						<?php if ($description) : ?>
							<div class="u-text-p u-textSecondary">
								<?php echo $description; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<ul role="presentation" class="tags">
	<?php foreach (array_slice($list, 3) as $item) : ?>
		<li class="u-inlineBlock u-padding-top-xxs u-padding-right-xs u-padding-bottom-xxs u-padding-left-xs u-borderRadius-m u-background-50 u-margin-right-xs u-margin-bottom-xs">
			<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($item->tag_id . ':' . $item->alias)); ?>"
				<?php JHtml::_('iwt.tag', $item); ?>
				class="<?php echo $item->link_class; ?>" itemprop="keywords" rel="tag">
				<?php echo $item->icon . htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?></a>
			<?php if ($display_count) : ?>
				<span class="tag-count Button--default u-padding-left-xxs u-padding-right-xxs u-text-r-xxs u-borderRadius-m u-textWeight-700"><?php echo $item->count; ?></span>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
</div>

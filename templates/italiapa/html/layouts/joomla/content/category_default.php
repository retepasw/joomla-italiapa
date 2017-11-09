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
 * Note that this layout opens a div with the page class suffix. If you do not use the category children
 * layout you need to close this div either by overriding this file or in your main layout.
 */
$params	= $displayData->params;
$category  = $displayData->get('category');
$extension = $category->extension;
$canEdit   = $params->get('access-edit');
$className = substr($extension, 4);

$dispatcher = JEventDispatcher::getInstance();

$category->text = $category->description;
$dispatcher->trigger('onContentPrepare', array($extension . '.categories', &$category, &$params, 0));
$category->description = $category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($extension . '.categories', &$category, &$params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($extension . '.categories', &$category, &$params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($extension . '.categories', &$category, &$params, 0));
$afterDisplayContent = trim(implode("\n", $results));

/**
 * This will work for the core components but not necessarily for other components
 * that may have different pluralisation rules.
 */
if (substr($className, -1) === 's')
{
	$className = rtrim($className, 's');
}
$tagsData = $category->tags->itemTags;
?>
<div class="u-layout-wide u-layoutCenter u-layout-withGutter u-padding-r-top u-padding-bottom-xxl">
<?php if ($params->get('show_page_heading')) : ?>
	<h1 class="u-text-h2">
		<?php echo $displayData->escape($params->get('page_heading')); ?>
	</h1>
<?php endif; ?>
<?php if ($params->get('show_category_title', 1)) : ?>
	<h2 class="u-text-h3">
		<?php echo JHtml::_('content.prepare', $category->title, '', $extension . '.category.title'); ?>
	</h2>
<?php endif; ?>
<?php echo $afterDisplayTitle; ?>

<?php if ($params->get('show_cat_tags', 1)) : ?>
	<?php echo JLayoutHelper::render('joomla.content.tags', $tagsData); ?>
<?php endif; ?>
<!--
	<div class="Grid Grid--withGutter">
-->
		<?php if ($beforeDisplayContent || $afterDisplayContent || $params->get('show_description', 1) || $params->def('show_description_image', 1)) : ?>
<!--
		<div class="Grid-cell u-md-size8of12 u-lg-size8of12">
			<article class="Prose u-layout-prose">
-->
			<article class="Prose">
				<?php if ($params->get('show_description_image') && $category->getParams()->get('image')) : ?>
					<img width="100%" src="<?php echo $category->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($category->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8'); ?>"/>
				<?php endif; ?>
				<?php echo $beforeDisplayContent; ?>
				<?php if ($params->get('show_description') && $category->description) : ?>
					<?php echo JHtml::_('content.prepare', $category->description, '', $extension . '.category.description'); ?>
				<?php endif; ?>
				<?php echo $afterDisplayContent; ?>
			</article>
<!--
		</div>
-->
		<?php endif; ?>
		<?php echo $displayData->loadTemplate($displayData->subtemplatename); ?>
<!--
	</div>
-->
		<?php if ($displayData->maxLevel != 0 && $displayData->get('children')) : ?>
			<div class="cat-children">
				<?php if ($params->get('show_category_heading_title_text', 1) == 1) : ?>
					<h3>
						<?php echo JText::_('JGLOBAL_SUBCATEGORIES'); ?>
					</h3>
				<?php endif; ?>
				<?php echo $displayData->loadTemplate('children'); ?>
			</div>
		<?php endif; ?>
</div>


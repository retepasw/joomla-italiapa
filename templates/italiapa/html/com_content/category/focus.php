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

JHtml::_('behavior.caption');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space

$params  = $this->params;
$canEdit = $params->get('access-edit');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));
?>

<div class="Grid<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
	<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2 u-text-r-s u-padding-r-all">
		<img class="u-sizeFull item-image" src="<?php echo $this->category->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8'); ?>" itemprop="image">
	</div>
	<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2 u-text-r-s u-padding-r-all">
<?php else : ?>
	<div class="Grid-cell u-sizeFull u-text-r-s u-padding-r-all">
<?php endif; ?>
		<div class="u-text-p">
			<?php if ($this->params->get('show_page_heading')) : ?>
					<div class="page-header">
						<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
					</div>
				<?php endif; ?>

				<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
					<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->category, 'print' => false)); ?>
				<?php endif; ?>

				<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
					<h2 class="u-text-h2 u-margin-r-bottom" itemprop="headline"> <?php echo $this->escape($this->params->get('page_subheading')); ?>
						<?php if ($this->params->get('show_category_title')) : ?>
							<?php echo $this->category->title; ?>
						<?php endif; ?>
					</h2>
				<?php endif; ?>
				<?php echo $afterDisplayTitle; ?>

				<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
					<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
					<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
				<?php endif; ?>

				<?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
					<div class="category-desc clearfix">
						<?php echo $beforeDisplayContent; ?>
						<?php if ($this->params->get('show_description') && $this->category->description) : ?>
							<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
						<?php endif; ?>
						<?php echo $afterDisplayContent; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class=" u-background-compl-10 u-layout-centerContent u-padding-r-top">
		<section class="u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
			<?php if ($this->params->get('show_page_heading') != 0) : ?>
			<h2 id="news" class="u-layout-centerLeft u-text-r-s">
				<span class="u-color-50 u-textClean u-text-h3"><?php echo $this->escape($this->params->get('page_heading')); ?></span>
			</h2>
			<?php endif; ?>

			<div class="Grid Grid--withGutterM">
			<?php $i = 0; ?>
			<?php foreach(array_merge($this->lead_items, $this->intro_items) as $item) : ?>
				<?php $i++; ?>
				<?php if ($i > (int) $this->columns) : ?>
			</div>
			<div class="Grid Grid--withGutterM">
					<?php $i = 0; ?>
				<?php endif; ?>
				<div class="Grid-cell u-md-size1of<?php echo (int) $this->columns; ?> u-lg-size1of<?php echo (int) $this->columns; ?> u-flex u-margin-r-bottom u-flexJustifyCenter
					<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
					itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
					<?php $this->item = &$item; ?>
					<?php echo $this->loadTemplate('simple'); ?>
				</div>
				<?php ?>
			<?php endforeach; ?>
			</div>

		<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) : ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		<?php endif; ?>
		</section>
	</div>
</div>

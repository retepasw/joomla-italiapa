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

// Note that there are certain parts of this layout used only when there is exactly one tag.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

?>
<section class="Grid tag-category<?php echo $this->pageclass_sfx; ?>">
	<?php $img = null;?>
	<?php if (count($this->item) === 1 && ($this->params->get('tag_list_show_tag_image', 1))) : ?>
		<?php $images = json_decode($this->item[0]->images); ?>
		<?php if ($this->params->get('tag_list_show_tag_image', 1) == 1 && !empty($images->image_fulltext)) : ?>
			<?php $img = '<img src="' . htmlspecialchars($images->image_fulltext, ENT_COMPAT, 'UTF-8') . '" alt="' . htmlspecialchars($images->image_fulltext_alt). '" class="u-sizeFull" />'; ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (!$img && $this->params->get('show_description_image', 1)) : ?>
		<?php if ($this->params->get('show_description_image', 1) == 1 && $this->params->get('tag_list_image')) : ?>
			<?php $img = '<img src="' . $this->params->get('tag_list_image') . '" class="u-sizeFull" />'; ?>
		<?php endif; ?>
	<?php endif; ?>
    <div class="Grid-cell u-sizeFull <?php echo ($img ? 'u-md-size1of2 u-lg-size1of2 ' : ''); ?> u-text-r-s u-padding-r-all">
        <div class="u-text-r-l u-layout-prose">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	<?php endif; ?>
	<?php if ($this->params->get('show_tag_title', 1)) : ?>
		<h2 class="u-text-h2 u-margin-r-bottom u-color-black">
			<?php echo JHtml::_('content.prepare', $this->tags_title, '', 'com_tag.tag'); ?>
		</h2>
	<?php endif; ?>

	<?php $desc = false; ?>
	<?php if (count($this->item) === 1 && $this->params->get('tag_list_show_tag_description', 1)) : ?>
			<?php if ($this->params->get('tag_list_show_tag_description') == 1 && $this->item[0]->description) : ?>
				<?php $desc = true; ?>
			<div class="category-desc u-textSecondary u-lineHeight-l">
				<?php echo JHtml::_('content.prepare', $this->item[0]->description, '', 'com_tags.tag'); ?>
			</div>
			<?php endif; ?>
	<?php endif; ?>

	<?php if (!$desc && $this->params->get('tag_list_show_tag_description', 1)) : ?>
		<?php if ($this->params->get('tag_list_description', '') > '') : ?>
			<div class="u-textSecondary u-lineHeight-l">
			<?php echo JHtml::_('content.prepare', $this->params->get('tag_list_description'), '', 'com_tags.tag'); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

		</div>
	</div>

	<?php if ($img) : ?>
    	<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2 u-text-r-s u-padding-r-all">
		<?php echo $img; ?>
	    </div>
	<?php endif; ?>

	<div class="Grid-cell u-sizeFull u-text-r-s u-padding-r-all">
	<?php echo $this->loadTemplate('items'); ?>
	</div>
	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter pull-right">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</section>

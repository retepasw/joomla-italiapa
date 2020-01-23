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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>

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

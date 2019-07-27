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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>

<?php if (JFactory::getApplication()->getTemplate(true)->params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
see <a href="https://italia.github.io/design-web-toolkit/components/detail/layout--news.html">https://italia.github.io/design-web-toolkit/components/detail/layout--default.html</a>
</div>
<?php endif; ?>

<section class="u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
	<?php if ($this->params->get('show_page_heading') != 0) : ?>
	<div class="page-header">
		<h2 class="u-layout-centerLeft u-text-r-s">
			<span class="u-color-50 u-textClean u-text-h3"><?php echo $this->escape($this->params->get('page_heading')); ?></span>
		</h2>
	</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
		<h3 class="u-layout-centerLeft u-text-r-s"> <?php echo $this->escape($this->params->get('page_subheading')); ?>
			<?php if ($this->params->get('show_category_title')) : ?>
				<span class="subheading-category u-color-50 u-textClean u-text-h4"><?php echo $this->category->title; ?></span>
			<?php endif; ?>
		</h3>
	<?php endif; ?>
	<?php echo $afterDisplayTitle; ?>

	<?php $app = JFactory::getApplication(); ?>
	<?php $limitstart = $app->input->get('limitstart', 0, 'uint'); ?>

	<?php if ($limitstart == 0) : ?>
	<div class="owl-carousel news-theme" role="region" id="carousel-main" data-carousel-options='{"items":1,"responsive":false,"autoplay":true,"loop":true,"dots":true,"nav":true}'>
		<?php foreach($this->lead_items as $item) : ?>
		<div<?php echo $item->state == 0 ? ' class=\"system-unpublished\"' : null; ?> itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
			<?php $this->item = &$item; ?>
			<?php echo $this->loadTemplate('item'); ?>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<?php $items = ($limitstart == 0) ? $this->intro_items : array_merge($this->lead_items, $this->intro_items); ?>
	<?php if (count($items)) : ?>
		<div class="u-layout-centerContent u-background-grey-20">
			<div class="Grid Grid--withGutter">
				<?php $c = (int) $this->columns; ?>
				<?php foreach ($items as $item) : ?>
					<div class="Grid-cell u-md-size1of<?php echo $c; ?> u-lg-size1of<?php echo $c; ?> u-padding-r-left<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
						itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
						<?php $this->item = &$item; ?>
						<?php echo $this->loadTemplate('tile'); ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if (!empty($this->link_items)) : ?>
	<div class="u-layout-wide u-layoutCenter u-layout-withGutter u-padding-r-top u-padding-bottom-xxl">
	<?php echo $this->loadTemplate('links'); ?>
	</div>
	<?php endif; ?>

	<?php 
	if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) :
		echo $this->pagination->getPagesLinks();
	endif; 
	?>
</section>

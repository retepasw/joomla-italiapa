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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>

<?php if (JFactory::getApplication()->getTemplate(true)->params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
see <a href="https://italia.github.io/design-web-toolkit/components/detail/layout--default.html">https://italia.github.io/design-web-toolkit/components/detail/layout--default.html</a>
</div>
<?php endif; ?>

<div class="u-layout-centerContent u-background-grey-20">
	<section class="u-layout-wide u-padding-top-xxl u-padding-bottom-xxl <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
		<?php if ($this->params->get('show_page_heading') != 0) : ?>
		<h2 class="u-text-r-l u-padding-r-bottom">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h2>
		<?php endif; ?>
	
		<div class="Grid Grid--withGutter">
		<?php $i = 0; ?>
		<?php foreach(array_merge($this->lead_items, $this->intro_items) as $item) : ?>
			<?php $i++; ?>
			<?php if ($i > (int) $this->columns) : ?>
		</div>
		<div class="Grid Grid--withGutter">
				<?php $i = 0; ?>
			<?php endif; ?>			 
			<div class="Grid-cell u-md-size1of<?php echo (int) $this->columns; ?> u-lg-size1of<?php echo (int) $this->columns; ?>
				<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
				itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
				<?php
					$this->item = &$item;
					echo $this->loadTemplate('tile');
				?>
			</div>
			<?php ?>
		<?php endforeach; ?>
		</div>
	
	<?php 
	if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) :
		echo $this->pagination->getPagesLinks();
	endif; 
	?>

	</section>
</div>
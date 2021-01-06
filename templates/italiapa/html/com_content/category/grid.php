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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>

<div class="u-layout-centerContent u-background-grey-20 u-padding-r-bottom">
	<section class="u-layout-wide">
		<?php if ($this->params->get('show_page_heading') != 0) : ?>
			<h2 class="u-padding-r-bottom u-padding-r-top u-text-r-l">
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h2>
		<?php endif; ?>

		<div class="Grid Grid--withGutter">
			<?php foreach($this->lead_items as $item) : ?>
				<div class="Grid-cell u-nbfc u-md-size<?php echo (int) $this->columns - 1; ?>of<?php echo (int) $this->columns; ?> u-lg-size<?php echo (int) $this->columns - 1; ?>of<?php echo (int) $this->columns; ?>
					<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
					itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
					<?php $this->item = &$item; ?>
					<?php echo $this->loadTemplate('lead'); ?>
				</div>

				<?php if (!empty($this->intro_items)) : ?>
					<div class="Grid-cell u-md-size1of4 u-lg-size1of4 u-padding-r-left">
						<?php $this->item = array_shift($this->intro_items); ?>
						<?php echo $this->loadTemplate('tile'); ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>

			<?php foreach($this->intro_items as $item) : ?>
				<div class="Grid-cell u-md-size1of4 u-lg-size1of4 u-padding-r-left">
					<?php $this->item = &$item; ?>
					<?php echo $this->loadTemplate('tile'); ?>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) : ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		<?php endif; ?>
	</section>
</div>
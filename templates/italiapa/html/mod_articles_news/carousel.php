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
?>

<section class="u-text-r-s u-padding-r-top u-padding-r-bottom blog" itemscope itemtype="https://schema.org/Blog">
	<div class="owl-carousel news-theme" role="region" id="carousel-<?php echo $module->id; ?>"
		aria-label="carousel-<?php echo $module->title; ?>"
		data-carousel-options='{"items":<?php echo $params->get('carousel_count', 1);
		echo $params->get('carousel_auto_sliding', 1) ? ',"autoplay":true,"autoplaySpeed":' . $params->get('carousel_speed', 1000) . ',"autoplayTimeout":' . $params->get('carousel_interval', 5000) : '';
		echo $params->get('carousel_lazy', 1) ? ',"lazyLoad":true' : '';
		echo $params->get('carousel_loop', 1) ? ',"loop":true' : '';
		echo $params->get('carousel_show_controls', 1) ? ',"nav":true' : '';
		echo $params->get('carousel_show_indicators', 1) ? ',"dots":true' : ''; ?>,"responsive":false}'>
		<?php foreach ($list as $item) : ?>
			<div<?php echo $item->state == 0 ? ' class=\"system-unpublished\"' : null; ?> itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
				<?php require JModuleHelper::getLayoutPath('mod_articles_news', $params->get('carousel_layout', ($module->position == 'right' || $params->get('carousel_count', 1) > 1) ? '_card' : '_hcell')); ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>

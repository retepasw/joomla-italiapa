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
?>

<section class="u-text-r-s u-padding-r-top u-padding-r-bottom blog" itemscope itemtype="https://schema.org/Blog">
	<div class="owl-carousel news-theme" role="region" id="carousel-main" data-carousel-options='{"items":1,"responsive":false,"autoplay":true,"loop":true,"dots":true,"nav":true}'>
		<?php foreach ($list as $item) : ?>
			<div<?php echo $item->state == 0 ? ' class=\"system-unpublished\"' : null; ?> itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
				<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_hcell'); ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>

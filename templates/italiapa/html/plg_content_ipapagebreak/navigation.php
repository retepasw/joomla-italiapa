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

$app = JFactory::getApplication();
$baseurl = rtrim(JUri::root(), '/');
$template = $app->getTemplate();
?>

<!-- 
<li class="Grid-cell u-textCenter"><a href="/joomla/italiapa/index.php/it/accordion?showall=&amp;start=1" class="u-color-50 u-textClean u-block"><span class="Icon-chevron-right u-text-r-s" role="presentation"></span><span class="u-hiddenVisually">Avanti</span></a></li></ul></nav>
-->

<!-- <nav class="pagination-wrapper justify-content-center"> -->
<nav aria-label="Navigazione paginata" class="u-padding-top-xxl">
	<!-- <ul class="pagination"> -->
	<ul class="Grid Grid--fit Grid--alignMiddle u-text-r-xxs">
		<!-- <li class="page-item"> -->
		<li class="Grid-cell u-textCenter">
			<?php if ($links['previous']) : ?>
				<!-- <a class="page-link" href="<?php echo $links['previous']; ?>">
					<svg class="icon icon-primary">
						<use xlink:href="<?php echo $baseurl; ?>/media/tpl_italiapa4/svg/sprite.svg#it-chevron-left"></use>
					</svg>
					<span class="sr-only"><?php echo trim(str_repeat(JText::_('JGLOBAL_LT'), 2) . ' ' . JText::_('JPREV')); ?></span>
				</a> -->
				<a class="u-color-50 u-textClean u-block" href="<?php echo $links['previous']; ?>">
					<span class="Icon-chevron-left u-text-r-s" role="presentation"></span>
					<span class="u-hiddenVisually"><?php echo JText::_('JPREV'); ?></span>
				</a>
			<?php else: ?>
				<!-- <span class="page-link">
					<svg class="icon icon-primary">
						<use xlink:href="<?php echo $baseurl; ?>/media/tpl_italiapa4/svg/sprite.svg#it-chevron-left"></use>
					</svg>
					<span class="sr-only"><?php echo JText::_('JPREV'); ?></span>
				</span> -->
				<span class="u-color-50 u-textClean u-block">
					<span class="Icon-chevron-left u-text-r-s" role="presentation"></span>
					<span class="u-hiddenVisually"><?php echo JText::_('JPREV'); ?></span>
				</span>
			<?php endif; ?>
		</li>
		<?php if ($pageNav->pagesTotal > 1) : ?>
			<!-- <li class="page-item"><p class="page-link"><?php echo \JText::sprintf('JLIB_HTML_PAGE_CURRENT_OF_TOTAL', $pageNav->pagesCurrent, $pageNav->pagesTotal); ?></p></li> -->
			<li class="Grid-cell u-textCenter"><div class="pagenavcounter"><?php echo \JText::sprintf('JLIB_HTML_PAGE_CURRENT_OF_TOTAL', $pageNav->pagesCurrent, $pageNav->pagesTotal); ?></div></li>
		<?php endif; ?>
		<!-- <li class="page-item"> -->
		<li class="Grid-cell u-textCenter">
			<?php if ($links['next']) : ?>
				<!-- <a class="page-link" href="<?php echo $links['next']; ?>">
					<span class="sr-only"><?php echo trim(JText::_('JNEXT') . ' ' . str_repeat(JText::_('JGLOBAL_GT'), 2)); ?></span>
					<svg class="icon icon-primary">
						<use xlink:href="<?php echo $baseurl; ?>/media/tpl_italiapa4/svg/sprite.svg#it-chevron-right"></use>
					</svg>
				</a> -->
				<a class="u-color-50 u-textClean u-block" href="<?php echo $links['next']; ?>">
					<span class="Icon-chevron-right u-text-r-s" role="presentation"></span>
					<span class="u-hiddenVisually"><?php echo JText::_('JNEXT'); ?></span>
				</a>
			<?php else: ?>
				<!-- <span class="page-link">
					<span class="sr-only"><?php echo JText::_('JNEXT'); ?></span>
					<svg class="icon icon-primary">
						<use xlink:href="<?php echo $baseurl; ?>/media/tpl_italiapa4/svg/sprite.svg#it-chevron-right"></use>
					</svg>
				</span> -->
				<span class="u-color-50 u-textClean u-block">
					<span class="Icon-chevron-right u-text-r-s" role="presentation"></span>
					<span class="u-hiddenVisually"><?php echo JText::_('JNEXT'); ?></span>
				</span>				
			<?php endif; ?>
		</li>
	</ul>
</nav>

<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
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

$app      = JFactory::getApplication();
$baseurl  = rtrim(JUri::root(), '/');
$template = $app->getTemplate();
$lang     = JFactory::getLanguage();
?>

<nav role="navigation" aria-label="<?php echo JText::_('TPL_ITALIAPA_PAGINGBAR'); ?>" class="u-padding-top-xxl">
	<ul class="Grid Grid--fit Grid--alignMiddle u-text-r-xxs">
		<li class="Grid-cell u-textCenter">
			<?php if ($links['previous']) : ?>
				<a class="u-color-50 u-textClean u-block" href="<?php echo $links['previous']; ?>">
					<span class="Icon-chevron-<?php echo $lang->isRtl() ? 'right' : 'left'; ?> u-text-r-s" role="presentation"></span>
					<span class="u-hiddenVisually"><?php echo JText::_('JPREV'); ?></span>
				</a>
			<?php else: ?>
				<span class="u-color-50 u-textClean u-block">
					<span class="Icon-chevron-<?php echo $lang->isRtl() ? 'right' : 'left'; ?> u-text-r-s" role="presentation"></span>
					<span class="u-hiddenVisually"><?php echo JText::_('JPREV'); ?></span>
				</span>
			<?php endif; ?>
		</li>
		<?php if ($pageNav->pagesTotal > 1) : ?>
			<li class="Grid-cell u-textCenter"><div class="pagenavcounter"><?php echo \JText::sprintf('JLIB_HTML_PAGE_CURRENT_OF_TOTAL', $pageNav->pagesCurrent, $pageNav->pagesTotal); ?></div></li>
		<?php endif; ?>
		<li class="Grid-cell u-textCenter">
			<?php if ($links['next']) : ?>
				<a class="u-color-50 u-textClean u-block" href="<?php echo $links['next']; ?>">
					<span class="Icon-chevron-<?php echo $lang->isRtl() ? 'left' : 'right'; ?> u-text-r-s" role="presentation"></span>
					<span class="u-hiddenVisually"><?php echo JText::_('JNEXT'); ?></span>
				</a>
			<?php else: ?>
				<span class="u-color-50 u-textClean u-block">
					<span class="Icon-chevron-<?php echo $lang->isRtl() ? 'left' : 'right'; ?> u-text-r-s" role="presentation"></span>
					<span class="u-hiddenVisually"><?php echo JText::_('JNEXT'); ?></span>
				</span>
			<?php endif; ?>
		</li>
	</ul>
</nav>

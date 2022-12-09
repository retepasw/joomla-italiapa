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

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

JHtml::_('bootstrap.tooltip');

if (JComponentHelper::getComponent('com_buttons', true)->enabled)
{
	require_once JPATH_ADMINISTRATOR.'/components/com_buttons/helpers/buttons.php';
}

$canEdit = $displayData['params']->get('access-edit');
$class = 'Button Button--default u-text-r-xs u-linkClean';
?>

<div class="icons u-cf ipa-Right">
	<?php if (empty($displayData['print'])) : ?>

		<?php if ($canEdit || $displayData['params']->get('show_print_icon') || $displayData['params']->get('show_email_icon')) : ?>
		<nav class="Navscroll u-floatRight">
			<ul>

			<?php $option = JFactory::getApplication()->input->getString('option'); ?>
			<?php $view   = JFactory::getApplication()->input->getString('view'); ?>
			<?php if (JComponentHelper::getComponent('com_buttons', true)->enabled && ($option === 'com_content') && ($view == 'article')) :				
			<?php
				$item = $displayData['item'];
				$authorisedViewLevels = JFactory::getUser()->getAuthorisedViewLevels();
				$report_access = false;
				$toolbars = ButtonsHelper::getToolbars($item);
				foreach($toolbars as $catid)
				{
					$toolbar = JTable::getInstance('Category');
					$toolbar->load($catid);
					$tparams = new Registry;
					$tparams->loadString($toolbar->params);
					$report_access = $report_access ||
					in_array($tparams->get('report_access', 3), $authorisedViewLevels);
				}
				$params = new JRegistry();
				$params->loadString($item->attribs);
				?>
				<?php if ($displayData['params']->get('show_print_icon')) : ?>
					<?php $button = JHtml::_('icon.print_popup', $displayData['item'], $displayData['params'], array('class' => $class)); ?>
					<?php if (JFactory::getApplication()->input->getString('buttons') == 'report') : ?>
						<?php $button = str_replace('&amp;tmpl=component&amp;print=1&amp;layout=default', '&amp;tmpl=component&amp;print=1&amp;layout=default&amp;buttons=report', $button); ?>
					<?php endif; ?>
					<li class="u-padding-right-xs"><?php echo preg_replace("/title=\"[\\s\\S]*?\"/", '', $button); ?></li>
				<?php endif; ?>
				<?php if ($displayData['params']->get('show_email_icon')) : ?>
					<li class="u-padding-right-xs"><?php echo JLayoutHelper::render('eshiol.content.share', $displayData); ?></li>
				<?php endif; ?>
				<?php
				if (JFactory::getApplication()->input->getString('buttons') != 'report')
				{
					if ($report_access)
					{
						$url  = ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language);
						$url .= '&buttons=report';
						$text = '<span data-tooltip="' . JHtml::tooltipText(JText::_('TPL_ITALIAPA_BUTTONS_REPORT')) . '" data-tooltip-position="bottom center"><span class="u-text-r-m Icon Icon-list"></span></span>';
						$attribs['rel']     = 'nofollow';
						$attribs['class']   = $class;
						echo '<li class="u-padding-right-xs">' . JHtml::_('link', JRoute::_($url), $text, $attribs) . '</li>';
					}
				}
				else
				{
					$url  = 'index.php?option=com_buttons&view=extras&id=' . $item->id . '&buttons=report&format=csv';
					$text = '<span data-tooltip="' . JHtml::tooltipText(JText::_('TPL_ITALIAPA_BUTTONS_CSV')) . '" data-tooltip-position="bottom center"><span class="u-text-r-m Icon Icon-download"></span></span>';
					$attribs['rel']     = 'nofollow';
					$attribs['class']   = $class;
					echo '<li class="u-padding-right-xs">' . JHtml::_('link', JRoute::_($url), $text, $attribs) . '</li>';

					$url  = ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language);
					$text = '<span data-tooltip="' . JHtml::tooltipText(JText::_('TPL_ITALIAPA_BUTTONS_CLOSE')) . '" data-tooltip-position="bottom center"><span class="u-text-r-m Icon Icon-close"></span></span>';
					$attribs['rel']     = 'nofollow';
					$attribs['class']   = $class;
					echo '<li class="u-padding-right-xs">' . JHtml::_('link', JRoute::_($url), $text, $attribs) . '</li>';
				}
			?>
			<?php else: ?>
				<?php if ($displayData['params']->get('show_print_icon')) : ?>
					<li class="u-padding-right-xs"><?php echo preg_replace("/title=\"[\\s\\S]*?\"/", '', JHtml::_('icon.print_popup', $displayData['item'], $displayData['params'], array('class' => $class))); ?></li>
				<?php endif; ?>
				<?php if ($displayData['params']->get('show_email_icon')) : ?>
					<li class="u-padding-right-xs"><?php echo JLayoutHelper::render('eshiol.content.share', $displayData); ?></li>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($canEdit) : ?>
				<li class="u-padding-right-xs"><?php echo preg_replace("/title=\"[\\s\\S]*?\"/", '', JHtml::_('icon.edit', $displayData['item'], $displayData['params'], array('class' => $class))); ?></li>
			<?php endif; ?>
			</ul>
		</nav>
		<?php endif; ?>

	<?php else : ?>

		<div class="u-floatRight">
			<li class="u-padding-right-xs"><?php echo JHtml::_('icon.print_screen', $displayData['item'], $displayData['params'], array('class' => $class)); ?></li>
		</div>

	<?php endif; ?>
</div>

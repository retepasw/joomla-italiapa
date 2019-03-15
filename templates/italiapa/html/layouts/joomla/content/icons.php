<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

use Joomla\Registry\Registry;

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
			<?php // Note the actions class is deprecated. Use dropdown-menu instead. ?>
			<?php if ($displayData['params']->get('show_print_icon')) : ?>
				<li class="u-padding-right-l"><?php echo JHtml::_('icon.print_popup', $displayData['item'], $displayData['params'], array('class' => $class)); ?></li>
			<?php endif; ?>
			<?php if ($displayData['params']->get('show_email_icon')) : ?>
				<li class="u-padding-right-l"><?php echo JLayoutHelper::render('eshiol.content.share', $displayData); ?></li>
			<?php endif; ?>
			
			<?php
			if (JComponentHelper::getComponent('com_buttons', true)->enabled)
			{
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

				if (JFactory::getApplication()->input->getString('buttons') != 'report')
				{
					if ($report_access)
					{
						$url  = ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language);
						$url .= '&buttons=report';
						$text = '<span class="u-text-r-m Icon Icon-list"></span>';
						$attribs['title']   = JText::_('TPL_ITALIAPA_BUTTONS_REPORT');
						$attribs['rel']     = 'nofollow';
						$attribs['class']   = $class;
						echo '<li class="u-padding-right-l">' . JHtml::_('link', JRoute::_($url), $text, $attribs) . '</li>';
					}
				}
				else 
				{
					$url  = 'index.php?option=com_buttons&view=extras&id=' . $item->id . '&buttons=report&format=csv';
					$text = '<span class="u-text-r-m Icon Icon-download"></span>';
					$attribs['title']   = JText::_('TPL_ITALIAPA_BUTTONS_CSV');
					$attribs['rel']     = 'nofollow';
					$attribs['class']   = $class;
					echo '<li class="u-padding-right-l">' . JHtml::_('link', JRoute::_($url), $text, $attribs) . '</li>';

					$url  = ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language);
					$text = '<span class="u-text-r-m Icon Icon-close"></span>';
					$attribs['title']   = JText::_('TPL_ITALIAPA_BUTTONS_CLOSE');
					$attribs['rel']     = 'nofollow';
					$attribs['class']   = $class;
					echo '<li class="u-padding-right-l">' . JHtml::_('link', JRoute::_($url), $text, $attribs) . '</li>';
				}
			}
			?>

			<?php if ($canEdit) : ?>
				<li class="u-padding-right-l"><?php echo JHtml::_('icon.edit', $displayData['item'], $displayData['params'], array('class' => $class)); ?></li>
			<?php endif; ?>
			</ul>
		</nav>
		<?php endif; ?>

	<?php else : ?>

		<div class="u-floatRight">
			<li class="u-padding-right-l"><?php echo JHtml::_('icon.print_screen', $displayData['item'], $displayData['params'], array('class' => $class)); ?></li>
		</div>

	<?php endif; ?>
</div>

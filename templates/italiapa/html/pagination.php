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

defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to pagination rendering.
 *
 * pagination_list_footer
 * 	Input variable $list is an array with offsets:
 * 		$list[limit]		: int
 * 		$list[limitstart]	: int
 * 		$list[total]		: int
 * 		$list[limitfield]	: string
 * 		$list[pagescounter]	: string
 * 		$list[pageslinks]	: string
 *
 * pagination_list_render
 * 	Input variable $list is an array with offsets:
 * 		$list[all]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[start]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[previous]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[next]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[end]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[pages]
 * 			[{PAGE}][data]		: string
 * 			[{PAGE}][active]	: boolean
 *
 * pagination_item_active
 * 	Input variable $item is an object with fields:
 * 		$item->base	: integer
 * 		$item->link	: string
 * 		$item->text	: string
 *
 * pagination_item_inactive
 * 	Input variable $item is an object with fields:
 * 		$item->base	: integer
 * 		$item->link	: string
 * 		$item->text	: string
 *
 * This gives template designers ultimate control over how pagination is rendered.
 *
 * NOTE: If you override pagination_item_active OR pagination_item_inactive you MUST override them both
 */

/**
 * Renders the pagination footer
 *
 * @param   array   $list  Array containing pagination footer
 *
 * @return  string		 HTML markup for the full pagination footer
 *
 * @since   3.0
 */
function pagination_list_footer($list)
{
	$html = "<div class=\"pagination\">\n";
	$html .= $list['pageslinks'];
	$html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"" . $list['limitstart'] . "\" />";
	$html .= "\n</div>";

	return $html;
}

/**
 * Renders the pagination list
 *
 * @param   array   $list  Array containing pagination information
 *
 * @return  string		 HTML markup for the full pagination object
 *
 * @since   3.0
 */
function pagination_list_render($list)
{
	// Calculate to display range of pages
	$currentPage = 1;
	$range = 1;
	$step = 5;
	foreach ($list['pages'] as $k => $page)
	{
		if (!$page['active'])
		{
			$currentPage = $k;
		}
	}
	if ($currentPage >= $step)
	{
		if ($currentPage % $step == 0)
		{
			$range = ceil($currentPage / $step) + 1;
		}
		else
		{
			$range = ceil($currentPage / $step);
		}
	}

	$html = '<nav role="navigation" aria-label="' . JText::_('TPL_ITALIAPA_PAGINGBAR') . '" class="Grid Grid--fit Grid--alignCenter u-layoutCenter">';
	$html .= '<ul class="Grid Grid--fit Grid--alignMiddle u-text-r-xxs">';
	$html .= $list['start']['data'];
	$html .= $list['previous']['data'];

	foreach ($list['pages'] as $k => $page)
	{
		/**
		if (in_array($k, range($range * $step - ($step + 1), $range * $step)))
		{
			if (($k % $step == 0 || $k == $range * $step - ($step + 1)) && $k != $currentPage && $k != $range * $step - $step)
			{
				$page['data'] = preg_replace('#(<a.*?>).*?(</a>)#', '$1...$2', $page['data']);
			}
		}
		*/
		$html .= $page['data'];
	}

	$html .= $list['next']['data'];
	$html .= $list['end']['data'];

	$html .= '</ul>';
	$html .= '</nav>';
	return $html;
}

/**
 * Renders an active item in the pagination block
 *
 * @param   JPaginationObject  $item  The current pagination object
 *
 * @return  string					HTML markup for active item
 *
 * @since   3.0
 */
function pagination_item_active(&$item)
{
	$lang = JFactory::getLanguage();
	$class = '';
	$liclass = 'Grid-cell u-textCenter u-margin-left-xs u-margin-right-xs';

	// Check for "Start" item
	if ($item->text == JText::_('JLIB_HTML_START'))
	{
		$display = '<svg class="u-text-r-xs Icon"><use xlink:href="#Icon-chevron-'.($lang->isRtl() ? 'last' : 'first').'"></use></svg><span class="u-hiddenVisually">'.JText::_('JLIB_HTML_START').'</span>';
	}

	// Check for "Prev" item
	if ($item->text == JText::_('JPREV'))
	{
		$display = '<span class="u-text-r-xs Icon Icon-chevron-'.($lang->isRtl() ? 'right' : 'left').'"></span><span class="u-hiddenVisually">'.JText::_('JPREV').'</span>';
	}

	// Check for "Next" item
	if ($item->text == JText::_('JNEXT'))
	{
		$display = '<span class="u-text-r-xs Icon Icon-chevron-'.($lang->isRtl() ? 'left' : 'right').'"></span><span class="u-hiddenVisually">'.JText::_('JNEXT').'</span>';
	}

	// Check for "End" item
	if ($item->text == JText::_('JLIB_HTML_END'))
	{
		$display = '<svg class="u-text-r-xs Icon"><use xlink:href="#Icon-chevron-'.($lang->isRtl() ? 'first' : 'last').'"></use></svg><span class="u-hiddenVisually">'.JText::_('JLIB_HTML_START').'</span>';
	}

	// If the display object isn't set already, just render the item with its text
	if (!isset($display))
	{
		$liclass .= ' u-hidden u-md-inlineBlock u-lg-inlineBlock';
		$display  = $item->text;
		$class	= '';
	}

	$Itemid = JFactory::getApplication()->input->getInt('Itemid');
	if ($Itemid)
	{
		$item->link .= (strpos($item->link, '?') ? '&' : '?') . 'Itemid=' . $Itemid;
	}

	return '<li class="' . $liclass . '"><a title="' . $item->text . '" href="' . $item->link . '" class="u-color-50 u-linkClean u-block u-padding-r-all' . $class . '"><span class="u-text-r-m u-textWeight-600">' . $display . '</span></a></li>';
}

/**
 * Renders an inactive item in the pagination block
 *
 * @param   JPaginationObject  $item  The current pagination object
 *
 * @return  string  HTML markup for inactive item
 *
 * @since   3.0
 */
function pagination_item_inactive(&$item)
{
	// Check for "Start" item
	if ($item->text == JText::_('JLIB_HTML_START'))
	{
		return ''; //<li class="disabled"><a><span class="icon-first"></span></a></li>';
	}

	// Check for "Prev" item
	if ($item->text == JText::_('JPREV'))
	{
		return ''; //'<li class="disabled"><a><span class="icon-previous"></span></a></li>';
	}

	// Check for "Next" item
	if ($item->text == JText::_('JNEXT'))
	{
		return ''; //'<li class="disabled"><a><span class="icon-next"></span></a></li>';
	}

	// Check for "End" item
	if ($item->text == JText::_('JLIB_HTML_END'))
	{
		return ''; //'<li class="disabled"><a><span class="icon-last"></span></a></li>';
	}

	// Check if the item is the active page
	if (isset($item->active) && $item->active)
	{
		return '<li class="Grid-cell u-textCenter u-margin-left-xs u-margin-right-xs active">'
				. '<span class="u-background-50 u-color-white u-linkClean u-block u-padding-r-all">'
				. '<span class="u-text-r-m u-textWeight-600"><span class="u-md-hidden u-lg-hidden">' . JText::_('TPL_ITALIAPA_PAGE') . ' </span>'
				. $item->text . '</span></span></li>';
	}

	// Doesn't match any other condition, render a normal item
	return ''; //'<li class="disabled hidden-phone"><a>' . $item->text . '</a></li>';
}
?>

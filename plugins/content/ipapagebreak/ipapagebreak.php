<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	plg_content_ipapagebreak
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die('Restricted access.');

use Joomla\String\StringHelper;

jimport('joomla.utilities.utility');

/**
 * Page break plugin
 *
 * <b>Usage:</b>
 * <code><hr class="system-pagebreak" /></code>
 * <code><hr class="system-pagebreak" title="The page title" /></code>
 * or
 * <code><hr class="system-pagebreak" alt="The first page" /></code>
 * or
 * <code><hr class="system-pagebreak" title="The page title" alt="The first page" /></code>
 * or
 * <code><hr class="system-pagebreak" alt="The first page" title="The page title" /></code>
 *
 * @since  1.6
 */
class PlgContentIpapagebreak extends JPlugin
{
	/**
	 * Plugin that adds a pagebreak into the text and truncates text at that point
	 *
	 * @param   string   $context  The context of the content being passed to the plugin.
	 * @param   object   &$row     The article object.  Note $article->text is also available
	 * @param   mixed    &$params  The article params
	 * @param   integer  $page     The 'page' number
	 *
	 * @return  mixed  Always returns void or true
	 *
	 * @since   1.6
	 */
	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		$canProceed = $context === 'com_content.article';

		if (!$canProceed)
		{
			return;
		}

		// Expression to search for.
		$regex = '#<hr(.*)class="system-pagebreak"(.*)\/>#iU';

		$input = JFactory::getApplication()->input;

		$print = $input->getBool('print');
		$showall = $input->getBool('showall');

		if (!$this->params->get('enabled', 1))
		{
			$print = true;
		}

		if ($print)
		{
			$row->text = preg_replace($regex, '<br />', $row->text);

			return true;
		}

		// Simple performance check to determine whether bot should process further.
		if (StringHelper::strpos($row->text, 'class="system-pagebreak') === false)
		{
			if ($page > 0)
			{
				throw new Exception(JText::_('JERROR_PAGE_NOT_FOUND'), 404);
			}
			
			return true;
		}

		$view = $input->getString('view');
		$full = $input->getBool('fullview');

		if (!$page)
		{
			$page = 0;
		}

		if ($full || $view !== 'article' || $params->get('intro_only') || $params->get('popup'))
		{
			$row->text = preg_replace($regex, '', $row->text);

			return;
		}

		// Load plugin language files only when needed (ex: not needed if no system-pagebreak class exists).
		$this->loadLanguage();

		// Find all instances of plugin and put in $matches.
		$matches = array();
		preg_match_all($regex, $row->text, $matches, PREG_SET_ORDER);

		if ($showall && $this->params->get('showall', 1))
		{
			$hasToc = $this->params->get('multipage_toc', 1);

			if ($hasToc)
			{
				// Display TOC.
				$page = 1;
				$this->_createToc($row, $matches, $page);
			}
			else
			{
				$row->toc = '';
			}

			$row->text = preg_replace($regex, '<br />', $row->text);

			return true;
		}

		// Split the text around the plugin.
		$text = preg_split($regex, $row->text);

		if (!isset($text[$page]))
		{
			throw new Exception(JText::_('JERROR_PAGE_NOT_FOUND'), 404);
		}

		// Count the number of pages.
		$n = count($text);

		// We have found at least one plugin, therefore at least 2 pages.
		if ($n > 1)
		{
			$title  = $this->params->get('title', 1);
			$hasToc = $this->params->get('multipage_toc', 1);
/**
			// Adds heading or title to <site> Title.
			if ($title && $page && isset($matches[$page - 1], $matches[$page - 1][2]))
			{
				$attrs = JUtility::parseAttributes($matches[$page - 1][1]);

				if (isset($attrs['title']))
				{
					$row->page_title = $attrs['title'];
				}
			}
*/
			// Reset the text, we already hold it in the $text array.
			$row->text = '';

			// Display TOC.
			if ($hasToc)
			{
				$this->_createToc($row, $matches, $page);
			}
			else
			{
				$row->toc = '';
			}

			// Page text.
			$text[$page] = str_replace('<hr id="system-readmore" />', '', $text[$page]);
			$row->text .= $text[$page];
			
			// $row->text .= '<br />';
			$row->text .= '<div class="pager">';
			
			// Adds navigation between pages to bottom of text.
			if ($hasToc)
			{
				$this->_createNavigation($row, $page, $n);
			}

			// Page links shown at bottom of page if TOC disabled.
			if (!$hasToc)
			{
				$row->text .= $pageNav->getPagesLinks();
			}

			$row->text .= '</div>';
		}

		return true;
	}

	/**
	 * Creates a Table of Contents for the pagebreak
	 *
	 * @param   object   &$row      The article object.  Note $article->text is also available
	 * @param   array    &$matches  Array of matches of a regex in onContentPrepare
	 * @param   integer  &$page     The 'page' number
	 *
	 * @return  void
	 *
	 * @since  1.6
	 */
	protected function _createToc(&$row, &$matches, &$page)
	{
		$heading = isset($row->title) ? $row->title : JText::_('PLG_CONTENT_IPAPAGEBREAK_NO_TITLE');
		$input = JFactory::getApplication()->input;
		$limitstart = $input->getUInt('limitstart', 0);
		$showall = $input->getInt('showall', 0);

		// TOC header.
		$row->toc = '<div class="u-sizeFull u-text-r-s u-color-70">';

		if ($this->params->get('article_index') == 1)
		{
			$headingtext = JText::_('PLG_CONTENT_IPAPAGEBREAK_ARTICLE_INDEX');

			if ($this->params->get('article_index_text'))
			{
				$headingtext = htmlspecialchars($this->params->get('article_index_text'), ENT_QUOTES, 'UTF-8');
			}

			$row->toc .= '<h3 class="u-border-bottom-m"><span class="u-block u-text-h3 u-textClean u-color-60">' . $headingtext . '</span></h3>';
		}

		// TOC first Page link.
		$row->toc .= '<ul class="Linklist Prose u-text-r-xs">
		<li>
			<a href="'
			. JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&showall=&limitstart=')
			. '">' . $heading . '</a>
		</li>
		';

		$i = 2;

		foreach ($matches as $bot)
		{
			$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&showall=&limitstart=' . ($i - 1));

			if (@$bot[0])
			{
				$attrs2 = JUtility::parseAttributes($bot[0]);

				if (@$attrs2['alt'])
				{
					$title = stripslashes($attrs2['alt']);
				}
				elseif (@$attrs2['title'])
				{
					$title = stripslashes($attrs2['title']);
				}
				else
				{
					$title = JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_PAGE_NUM', $i);
				}
			}
			else
			{
				$title = JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_PAGE_NUM', $i);
			}

			$row->toc .= '<li><a href="' . $link . '">' . $title . '</a></li>';
			$i++;
		}

		if ($this->params->get('showall'))
		{
			$link      = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&showall=1&limitstart=');
			$row->toc .= '<li><a href="' . $link . '">'
				. JText::_('PLG_CONTENT_IPAPAGEBREAK_ALL_PAGES') . ' <span class="Icon Icon-chevron-right"></span></a></li>';
		}

		$row->toc .= '</ul></div>';
	}

	/**
	 * Creates the navigation for the item
	 *
	 * @param   object  &$row  The article object.  Note $article->text is also available
	 * @param   int     $page  The total number of pages
	 * @param   int     $n     The page number
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function _createNavigation(&$row, $page, $n)
	{
		$pnSpace = '';

		if (JText::_('JGLOBAL_LT') || JText::_('JGLOBAL_LT'))
		{
			$pnSpace = ' ';
		}

		if ($page < $n - 1)
		{
			$page_next = $page + 1;

			$link_next = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&showall=&limitstart=' . $page_next);

			// Next >>
			$next = '<a href="' . $link_next . '" class="u-color-50 u-textClean u-block"><span class="Icon-chevron-right u-text-r-s" role="presentation"></span><span class="u-hiddenVisually">' . JText::_('JNEXT') . '</span></a>';
		}
		else
		{
		    $next = '<span class="u-color-50 u-textClean u-block"><span class="Icon-chevron-right u-text-r-s" role="presentation"></span><span class="u-hiddenVisually">' . JText::_('JNEXT') . '</span></span>';
		}

		if ($page > 0)
		{
			$page_prev = $page - 1 === 0 ? '' : $page - 1;

			$link_prev = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&showall=&limitstart=' . $page_prev);

			// << Prev
			$prev = '<a href="' . $link_prev . '" class="u-color-50 u-textClean u-block"><span class="Icon-chevron-left u-text-r-s" role="presentation"></span><span class="u-hiddenVisually">' . JText::_('JPREV') . '</span></a>';
		}
		else
		{
		    $prev = '<span class="u-color-50 u-textClean u-block"><span class="Icon-chevron-left u-text-r-s" role="presentation"></span><span class="u-hiddenVisually">' . JText::_('JPREV') . '</span></span>';
		}

		$row->text .= '<nav role="navigation" aria-label="Navigazione paginata" class="u-padding-top-xxl"><ul class="Grid Grid--fit Grid--alignMiddle u-text-r-xxs">';
		
		$row->text .= '<li class="Grid-cell u-textCenter">' . $prev . ' </li>';
		
		// Traditional mos page navigation
		$pageNav = new JPagination($n, $page, 1);
		
		// Page counter.
		$row->text .= '<li class="Grid-cell u-textCenter"><div class="pagenavcounter">';
		$row->text .= $pageNav->getPagesCounter();
		$row->text .= '</div></li>';
		
		$row->text .= '<li class="Grid-cell u-textCenter">' . $next . '</li>';
		
		$row->text .= '</ul></nav>';
	}
}

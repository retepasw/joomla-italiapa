<?php
/**
 * @package		Joomla.Plugins
 * @subpackage	Content.Ipapagebreak
 * 
 * @version		__DEPLOY_VERSION__
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2020 Helios Ciancio. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or or
 * other free or open source software licenses.
 */
defined('_JEXEC') or die();

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
 * <code><hr class="system-pagebreak" title="The page title" alt="The first
 * page" /></code>
 * or
 * <code><hr class="system-pagebreak" alt="The first page" title="The page
 * title" /></code>
 *
 * @since 1.6
 */
class PlgContentIpapagebreak extends JPlugin
{

	/**
	 * Load the language file on instantiation.
	 *
	 * @var boolean
	 * @since 3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Constructor.
	 *
	 * @param
	 *        	object &$subject The object to observe.
	 * @param array $config
	 *        	An optional associative array of configuration settings.
	 *        	
	 * @since 3.8.0.9
	 */
	public function __construct (&$subject, $config)
	{
		parent::__construct($subject, $config);
		
		if ($this->params->get('debug') || defined('JDEBUG') && JDEBUG)
		{
			JLog::addLogger(array(
					'text_file' => $this->params->get('log', 'eshiol.log.php'),
					'extension' => 'plg_content_ipapagebreak_file'
			), JLog::ALL, array(
					'plg_content_ipapagebreak'
			));
		}
		JLog::addLogger(
				array(
						'logger' => (null !== $this->params->get('logger')) ? $this->params->get('logger') : 'messagequeue',
						'extension' => 'plg_content_ipapagebreak'
				), JLOG::ALL & ~ JLOG::DEBUG, array(
						'plg_content_ipapagebreak'
				));
		if ($this->params->get('phpconsole') && class_exists('JLogLoggerPhpconsole'))
		{
			JLog::addLogger(array(
					'logger' => 'phpconsole',
					'extension' => 'plg_content_ipapagebreak_phpconsole'
			), JLOG::DEBUG, array(
					'plg_content_ipapagebreak'
			));
		}
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipapagebreak'));
		
		JFactory::getLanguage()->load('plg_content_pagebreak', JPATH_ADMINISTRATOR);
	}

	/**
	 * Plugin that adds a pagebreak into the text and truncates text at that
	 * point
	 *
	 * @param string $context
	 *        	The context of the content being passed to the plugin.
	 * @param
	 *        	object &$row The article object. Note $article->text is also
	 *        	available
	 * @param
	 *        	mixed &$params The article params
	 * @param integer $page
	 *        	The 'page' number
	 *        	
	 * @return mixed Always returns void or true
	 *        
	 * @since 1.6
	 */
	public function onContentPrepare ($context, &$row, &$params, $page = 0)
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipapagebreak'));
		
		$canProceed = $context === 'com_content.article';
		
		if (! $canProceed)
		{
			return;
		}
		
		$style = $this->params->get('style', 'pages');
		$fields = FieldsHelper::getFields('com_content.article', $row);
		foreach ($fields as $field)
		{
			if (($field->name == 'plg-content-ipapagebreak-style') && $field->rawvalue)
			{
				$style = $field->rawvalue;
				break;
			}
		}
		
		// Expression to search for.
		$regex = '#<hr(.*)class="system-pagebreak"(.*)\/>#iU';
		
		$input = JFactory::getApplication()->input;
		
		$print = $input->getBool('print');
		$showall = $input->getBool('showall');
		
		if (! $this->params->get('enabled', 1))
		{
			$print = true;
		}
		
		if ($print)
		{
			$row->text = preg_replace($regex, '<br />', $row->text);
			
			return true;
		}
		
		// Simple performance check to determine whether bot should process
		// further.
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
		
		if (! $page)
		{
			$page = 0;
		}
		
		if ($full || $view !== 'article' || $params->get('intro_only') || $params->get('popup'))
		{
			$row->text = preg_replace($regex, '', $row->text);
			
			return;
		}
		
		// Load plugin language files only when needed (ex: not needed if no
		// system-pagebreak class exists).
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
		
		if (! isset($text[$page]))
		{
			throw new Exception(JText::_('JERROR_PAGE_NOT_FOUND'), 404);
		}
		
		// Count the number of pages.
		$n = count($text);
		
		// We have found at least one plugin, therefore at least 2 pages.
		if ($n > 1)
		{
			$title = $this->params->get('title', 1);
			$hasToc = $this->params->get('multipage_toc', 1);
			
			// Adds heading or title to <site> Title.
			if ($title && $page && isset($matches[$page - 1], $matches[$page - 1][2]))
			{
				$attrs = JUtility::parseAttributes($matches[$page - 1][1]);
				
				if (isset($attrs['title']))
				{
					$row->page_title = $attrs['title'];
				}
			}
			
			// Reset the text, we already hold it in the $text array.
			$row->text = '';
			
			if ($style === 'pages')
			{
				// Display TOC.
				if ($hasToc)
				{
					$this->_createToc($row, $matches, $page);
				}
				else
				{
					$row->toc = '';
				}
				
				// Traditional mos page navigation
				$pageNav = new JPagination($n, $page, 1);
				
				// Flag indicates to not add limitstart=0 to URL
				$pageNav->hideEmptyLimitstart = true;
				
				// Page counter.
				$path = JPluginHelper::getLayoutPath('content', 'ipapagebreak', 'navcounter');
				ob_start();
				include $path;
				$row->text .= ob_get_clean();
				
				// Page text.
				$text[$page] = str_replace('<hr id="system-readmore" />', '', $text[$page]);
				$row->text .= $text[$page];
				
				// $row->text .= '<br />';
				
				// Adds navigation between pages to bottom of text.
				if ($hasToc)
				{
					$links = array(
							'next' => '',
							'previous' => ''
					);
					
					if ($page < $n - 1)
					{
						$links['next'] = JRoute::_(
								ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&limitstart=' . ($page + 1));
					}
					
					if ($page > 0)
					{
						$links['previous'] = ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language);
						
						if ($page > 1)
						{
							$links['previous'] .= '&limitstart=' . ($page - 1);
						}
						
						$links['previous'] = JRoute::_($links['previous']);
					}
					
					$path = JPluginHelper::getLayoutPath('content', 'ipapagebreak', 'navigation');
					ob_start();
					include $path;
					$navigation = ob_get_clean();
					// $navigation = $this->_createNavigation($row, $page, $n);
				}
				
				// Page links shown at bottom of page if TOC disabled.
				if (! $hasToc)
				{
					$navigation = $pageNav->getPagesLinks();
				}
			}
			$path = JPluginHelper::getLayoutPath('content', 'ipapagebreak', $style);
			ob_start();
			include $path;
			$row->text .= ob_get_clean();
		}
		
		return true;
	}

	/**
	 * Creates a Table of Contents for the pagebreak
	 *
	 * @param
	 *        	object &$row The article object. Note $article->text is also
	 *        	available
	 * @param
	 *        	array &$matches Array of matches of a regex in
	 *        	onContentPrepare
	 * @param
	 *        	integer &$page The 'page' number
	 *        	
	 * @return void
	 *
	 * @since 1.6
	 */
	protected function _createToc (&$row, &$matches, &$page)
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipapagebreak'));
		
		$heading = isset($row->title) ? $row->title : JText::_('PLG_CONTENT_PAGEBREAK_NO_TITLE');
		$input = JFactory::getApplication()->input;
		$limitstart = $input->getUInt('limitstart', 0);
		$showall = $input->getInt('showall', 0);
		$headingtext = '';
		$list = array();
		
		if ($this->params->get('article_index', 1) == 1)
		{
			$headingtext = JText::_('PLG_CONTENT_PAGEBREAK_ARTICLE_INDEX');
			
			if ($this->params->get('article_index_text'))
			{
				$headingtext = htmlspecialchars($this->params->get('article_index_text'), ENT_QUOTES, 'UTF-8');
			}
		}
		
		// TOC first Page link.
		$list[1] = new stdClass();
		$list[1]->liClass = ($limitstart === 0 && $showall === 0) ? 'toclink active' : 'toclink';
		$list[1]->class = $list[1]->liClass;
		$list[1]->link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language));
		$list[1]->title = $heading;
		
		$i = 2;
		
		foreach ($matches as $bot)
		{
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
					$title = JText::sprintf('PLG_CONTENT_PAGEBREAK_PAGE_NUM', $i);
				}
			}
			else
			{
				$title = JText::sprintf('PLG_CONTENT_PAGEBREAK_PAGE_NUM', $i);
			}
			
			$list[$i] = new stdClass();
			$list[$i]->link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&limitstart=' . ($i - 1));
			$list[$i]->title = $title;
			$list[$i]->liClass = ($limitstart === $i - 1) ? 'active' : '';
			$list[$i]->class = ($limitstart === $i - 1) ? 'toclink active' : 'toclink';
			
			$i ++;
		}
		
		if ($this->params->get('showall'))
		{
			$list[$i] = new stdClass();
			$list[$i]->link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&showall=1');
			$list[$i]->liClass = ($showall === 1) ? 'active' : '';
			$list[$i]->class = ($showall === 1) ? 'toclink active' : 'toclink';
			$list[$i]->title = JText::_('PLG_CONTENT_PAGEBREAK_ALL_PAGES');
		}
		
		$path = JPluginHelper::getLayoutPath('content', 'ipapagebreak', 'toc');
		ob_start();
		include $path;
		$row->toc = ob_get_clean();
	}

	/**
	 * Creates the navigation for the item
	 *
	 * @param
	 *        	object &$row The article object. Note $article->text is also
	 *        	available
	 * @param int $page
	 *        	The total number of pages
	 * @param int $n
	 *        	The page number
	 *        	
	 * @return void
	 *
	 * @since 1.6
	 */
	protected function _createNavigation (&$row, $page, $n)
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipapagebreak'));
		
		$links = array(
				'next' => '',
				'previous' => ''
		);
		
		if ($page < $n - 1)
		{
			$links['next'] = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language) . '&limitstart=' . ($page + 1));
		}
		
		if ($page > 0)
		{
			$links['previous'] = ContentHelperRoute::getArticleRoute($row->slug, $row->catid, $row->language);
			
			if ($page > 1)
			{
				$links['previous'] .= '&limitstart=' . ($page - 1);
			}
			
			$links['previous'] = JRoute::_($links['previous']);
		}
		
		$path = JPluginHelper::getLayoutPath('content', 'ipapagebreak', 'navigation');
		ob_start();
		include $path;
		return ob_get_clean();
	}
}

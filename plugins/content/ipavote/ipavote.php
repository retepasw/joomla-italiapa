<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.IpaVote
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2020 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugin.Content.IpaVote is a free software. This version may have been
 * modified  pursuant to the GNU General Public License,  and as distributed it
 * includes  or  is  derivative  of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */
defined('_JEXEC') or die();

/**
 * Ipavote plugin.
 *
 * @version __DEPLOY_VERSION__
 */
class PlgContentIpavote extends JPlugin
{

	/**
	 * Load the language file on instantiation.
	 *
	 * @var boolean
	 */
	protected $autoloadLanguage = true;

	/**
	 * Application object
	 *
	 * @var JApplicationCms
	 */
	protected $app;

	/**
	 * The position the voting data is displayed in relative to the article.
	 *
	 * @var string
	 */
	protected $votingPosition;

	/**
	 * Constructor.
	 *
	 * @param
	 *        	object &$subject The object to observe
	 * @param array $config
	 *        	An optional associative array of configuration settings.
	 */
	public function __construct (&$subject, $config)
	{
		parent::__construct($subject, $config);

		if ($this->params->get('debug') || defined('JDEBUG') && JDEBUG)
		{
			JLog::addLogger(array(
					'text_file' => $this->params->get('log', 'eshiol.log.php'),
					'extension' => 'plg_content_ipavote_file'
			), JLog::ALL, array(
					'plg_content_ipavote'
			));
		}
		JLog::addLogger(
				array(
						'logger' => (null !== $this->params->get('logger')) ? $this->params->get('logger') : 'messagequeue',
						'extension' => 'plg_content_ipavote'
				), JLOG::ALL & ~ JLOG::DEBUG, array(
						'plg_content_ipavote'
				));
		if ($this->params->get('phpconsole') && class_exists('JLogLoggerPhpconsole'))
		{
			JLog::addLogger(array(
					'logger' => 'phpconsole',
					'extension' => 'plg_content_ipavote_phpconsole'
			), JLOG::DEBUG, array(
					'plg_content_ipavote'
			));
		}
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipavote'));

		$this->votingPosition = $this->params->get('position', 'top');
	}

	/**
	 * Displays the voting area when viewing an article and the voting section
	 * is displayed before the article
	 *
	 * @param string $context
	 *        	The context of the content being passed to the plugin
	 * @param
	 *        	object &$row The article object
	 * @param
	 *        	object &$params The article params
	 * @param integer $page
	 *        	The 'page' number
	 *
	 * @return string|boolean HTML string containing code for the votes if in
	 *         com_content else boolean false
	 */
	public function onContentBeforeDisplay ($context, &$row, &$params, $page = 0)
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipavote'));

		if (empty($params))
		{
			$params = new \JRegistry();
		}

		if (isset($row->jcfields))
		{
			foreach ($row->jcfields as $jcField)
			{
				if (($jcField->name == 'plg-content-ipavote-position') && $jcField->rawvalue[0])
				{
					$params->set('vote_position', $jcField->rawvalue[0]);
				}
			}
		}

		JLog::add(new JLogEntry('position: ' . $params->get('vote_position', $this->votingPosition), JLog::DEBUG, 'plg_content_ipavote'));

		if ($params->get('vote_position', $this->votingPosition) !== 'top')
		{
			return '';
		}

		return $this->displayVotingData($context, $row, $params, $page);
	}

	/**
	 * Displays the voting area when viewing an article and the voting section
	 * is displayed after the article
	 *
	 * @param string $context
	 *        	The context of the content being passed to the plugin
	 * @param
	 *        	object &$row The article object
	 * @param
	 *        	object &$params The article params
	 * @param integer $page
	 *        	The 'page' number
	 *        	
	 * @return string|boolean HTML string containing code for the votes if in
	 *         com_content else boolean false
	 */
	public function onContentAfterDisplay ($context, &$row, &$params, $page = 0)
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipavote'));

		if ($params->get('vote_position', $this->votingPosition) !== 'bottom')
		{
			return '';
		}

		return $this->displayVotingData($context, $row, $params, $page);
	}

	/**
	 * Displays the voting area
	 *
	 * @param string $context
	 *        	The context of the content being passed to the plugin
	 * @param
	 *        	object &$row The article object
	 * @param
	 *        	object &$params The article params
	 * @param integer $page
	 *        	The 'page' number
	 *        	
	 * @return string|boolean HTML string containing code for the votes if in
	 *         com_content else boolean false
	 */
	private function displayVotingData ($context, &$row, &$params, $page)
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipavote'));

		$parts = explode('.', $context);

		if ($parts[0] !== 'com_content')
		{
			return false;
		}
		JLog::add(new JLogEntry('show vote: ' . $params->get('show_vote', null), JLog::DEBUG, 'plg_content_ipavote'));

		if (empty($params) || ! $params->get('show_vote', null))
		{
			return '';
		}

		$style = $this->params->get('style', 'default');

		if (isset($row->jcfields))
		{
			foreach ($row->jcfields as $jcField)
			{
				if (($jcField->name == 'plg-content-ipavote-style') && $jcField->rawvalue[0])
				{
					$style = $jcField->rawvalue[0];
					break;
				}
			}
		}
		JLog::add(new JLogEntry('style: ' . $style, JLog::DEBUG, 'plg_content_ipavote'));

		if ($style == 'default')
		{
			$style = '';
			$plugin = 'vote';
			JFactory::getLanguage()->load('plg_content_vote', JPATH_ADMINISTRATOR);
		}
		else
		{
			$style .= '_';
			$plugin = 'ipavote';
		}

		// Get the path for the rating summary layout file
		$path = JPluginHelper::getLayoutPath('content', $plugin, $style . 'rating');

		// Render the layout
		ob_start();
		include $path;
		$html = ob_get_clean();

		if ($this->app->input->getString('view', '') === 'article' && $row->state == 1)
		{
			// Get the path for the voting form layout file
			$path = JPluginHelper::getLayoutPath('content', $plugin, $style . 'vote');

			// Render the layout
			ob_start();
			include $path;
			$html .= ob_get_clean();
		}

		return $html;
	}
}

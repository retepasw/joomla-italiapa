<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	plg_system_ipatinymce
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
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

class PlgSystemIpatinymce extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 */
	protected $autoloadLanguage = true;
	
	/**
	 * Constructor
	 *
	 * @param  object  $subject  The object to observe
	 * @param  array   $config   An array that holds the plugin configuration
	 */
	function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
		
		if ($this->params->get('debug') || defined('JDEBUG') && JDEBUG)
		{
			JLog::addLogger(array('text_file' => $this->params->get('log', 'eshiol.log.php'), 'extension' => 'plg_system_ipatinymce_file'), JLog::ALL, array('plg_system_ipatinymce'));
		}
		JLog::addLogger(array('logger' => (null !== $this->params->get('logger')) ? $this->params->get('logger') : 'messagequeue', 'extension' => 'plg_system_ipatinymce'), JLOG::ALL & ~JLOG::DEBUG, array('plg_system_ipatinymce'));
		if ($this->params->get('phpconsole') && class_exists('JLogLoggerPhpconsole'))
		{
			JLog::addLogger(array('logger' => 'phpconsole', 'extension' => 'plg_system_ipatinymce_phpconsole'),  JLOG::DEBUG, array('plg_system_ipatinymce'));
		}
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_system_ipatinymce'));
	}

	function onBeforeCompileHead()
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_system_ipatinymce'));

		JHtml::_('script', 'plg_system_ipatinymce/plugin' . (($this->params->get('debug') || defined('JDEBUG') && JDEBUG) ? '' : '.min') . '.js', array('version' => 'auto', 'relative' => true));

		$options['jsurl'] = rtrim(JURI::root(true), '/') . '/media/plg_system_ipatinymce/js';
		$options['cssurl'] = rtrim(JURI::root(true), '/') . '/media/plg_system_ipatinymce/css';
		JFactory::getDocument()->addScriptOptions('plg_system_ipatinymce', $options, false);
	}
}
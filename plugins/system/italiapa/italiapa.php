<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  System.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2023 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugins.System.ItaliaPA  is  a  free  software. This version may have
 * been modified pursuant to the GNU General Public License, and as distributed
 * it includes  or is derivative of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Registry\Registry;
use Joomla\Utilities\ArrayHelper;

/**
 * Joomla! ItaliaPA Plugin.
 *
 * @since  3.9.0
 */
class PlgSystemItaliaPA extends JPlugin
{
	/**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 * @since  3.9.0
	 */
	protected $app;

	/**
	 * Database object.
	 *
	 * @var    JDatabaseDriver
	 * @since  3.9.0
	 */
	protected $db;

	/**
	 * Load plugin language file automatically so that it can be used inside component
	 *
	 * @var    boolean
	 * @since  3.9.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * Constructor.
	 *
	 * @param   object  &$subject  The object to observe.
	 * @param   array   $config    An optional associative array of configuration settings.
	 *
	 * @since   3.9.0
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}

	/**
	 * Adds additional fields to the Newsflash module
	 *
	 * @param   JForm  $form  The form to be altered.
	 * @param   mixed  $data  The associated data for the form.
	 *
	 * @return  boolean
	 *
	 * @since   3.9.0
	 */
	public function onContentPrepareForm($form, $data)
	{
		if (!$form instanceof Form)
		{
			$this->subject->setError('JERROR_NOT_A_FORM');

			return false;
		}

		$formName = $form->getName();

		if ($formName == 'com_modules.module')
		{
			// If we are on the save command, no data is passed to $data variable, we need to get it directly from request
			$jformData = $this->app->input->get('jform', array(), 'array');

			if ($jformData && !$data)
			{
				$data = $jformData;
			}

			if (is_array($data))
			{
				$data = (object) $data;
			}

			Form::addFormPath(dirname(__FILE__) . '/forms');

			$form->loadFile($data->module, false);

			if ($data->module == 'mod_articles_news')
			{
				$form->loadFile('carousel', false);
			}
		}
		elseif ($formName == 'com_config.modules')
		{
			if (JFactory::getApplication()->isAdmin())
			{
				return;
			}

			// fix modal_menu field
			foreach ($form->getFieldsets() as $fieldset)
			{
				$fields = $form->getFieldset($fieldset->name);
				foreach ($fields as $field)
				{
					if ($field->getAttribute('type') == 'modal_menu')
					{
						$form->setFieldAttribute($field->getAttribute('name'), 'type', 'menuitem', 'params');
					}
				}
			}
		}
		elseif ($formName == 'com_menus.item')
		{
			// If we are on the save command, no data is passed to $data variable, we need to get it directly from request
			$jformData = $this->app->input->get('jform', array(), 'array');

			if ($jformData && !$data)
			{
				$data = $jformData;
			}

			if (is_array($data))
			{
				$data = (object) $data;
			}

			Form::addFormPath(dirname(__FILE__) . '/forms');
			$form->loadFile(
					(isset($data->request['option']) ? $data->request['option'] : ''). '_' .
					(isset($data->request['view']) ? $data->request['view'] : '') . '_' .
					(isset($data->request['layout']) ? str_replace('italiapa:', '', $data->request['layout']) : 'default'));
		}
	}

	/**
	 * After Route Event.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function onAfterRoute()
	{
		JLoader::registerNamespace('Italiapa', __DIR__ . '/src/italiapa', false, false, 'psr4');
		
		$template = \JFactory::getApplication()->getTemplate();
		if ($template == 'italiapa')
		{
			// overwrite original Joomla
			$loader = require JPATH_LIBRARIES . '/vendor/autoload.php';
			// update class maps
			$classMap = $loader->getClassMap();
			$classMap['Joomla\CMS\Form\Form'] = __DIR__ . '/src/joomla/src/Form/Form.php';
			$classMap['Joomla\CMS\MVC\Controller\FormController'] = __DIR__ . '/src/joomla/src/MVC/Controller/FormController.php';
			$classMap['JFormFieldCheckbox'] = __DIR__ . '/src/joomla/joomla/form/fields/checkbox.php';

			// for overwrite html class
			\JLoader::registerPrefix('J', __DIR__ . '/src/joomla3/cms', false, true);
			
			$loader->addClassMap($classMap);
		}

		+
		$userId = Factory::getUser()->id;

		// Run this in frontend only
		if ($this->app->isClient('site'))
		{

			// Check to see whether user already consented, if not, redirect to user profile page
			if ($userId > 0)
			{
				// If user consented before, no need to check it further
				if (!$this->isUserConsented($userId))
				{
					$option = $this->app->input->getCmd('option');
					$task   = $this->app->input->get('task');
					$view   = $this->app->input->getString('view', '');
					$layout = $this->app->input->getString('layout', '');
					$id     = $this->app->input->getInt('id');

					$privacyArticleId = $this->getPrivacyArticleId();

					/*
					* If user is already on edit profile screen or view privacy article
					* or press update/apply button, or logout, do nothing to avoid infinite redirect
					*/
					if ($option == 'com_users' && in_array($task, array('profile.save', 'profile.apply', 'user.logout', 'user.menulogout'))
						|| ($option == 'com_content' && $view == 'article' && $id == $privacyArticleId)
						|| ($option == 'com_users' && $view == 'profile' && $layout == 'edit'))
					{
						return;
					}

					Factory::getApplication()->setUserState('com_users.edit.profile.redirect', base64_decode($this->app->input->get('return', base64_encode(Uri::getInstance()->toString()), 'base64')));
				}
			}
		}
		else
		{
			if ($userId > 0)
			{
				if (PluginHelper::isEnabled('system', 'privacyconsent'))
				{
					$query = $this->db->getQuery(true);
					$query->select($this->db->quoteName('name'))
						->from('#__extensions')
						->where($this->db->quoteName('type') . ' = ' . $this->db->quote('plugin'))
						->where($this->db->quoteName('folder') . ' = ' . $this->db->quote('system'))
						->where($this->db->quoteName('element') . ' IN (' . $this->db->quote('italiapa') . ', ' . $this->db->quote('privacyconsent') . ')')
						->order('ordering');
					$query->setLimit(1);
					$this->db->setQuery($query);
		
					$name = $this->db->loadResult();

					if ($name != 'plg_system_italiapa')
					{
						$this->app->enqueueMessage('Il plugin System - ItaliaPA deve essere posizionato prima del plugin System - Privacy Content');
					}
				}
				if (PluginHelper::isEnabled('system', 'languagefilter'))
				{
					$plugin = PluginHelper::getPlugin('system', 'languagefilter');
					$params = new Registry($plugin->params);
					if ($params->get('automatic_change') == 1)
					{
						// $this->app->enqueueMessage('Il plugin System - Language Filter deve avere l\'opzione Cambio lingua automatico disabilitata');
						$query = $this->db->getQuery(true);
						$query->select($this->db->quoteName('name'))
							->from('#__extensions')
							->where($this->db->quoteName('type') . ' = ' . $this->db->quote('plugin'))
							->where($this->db->quoteName('folder') . ' = ' . $this->db->quote('system'))
							->where($this->db->quoteName('element') . ' IN (' . $this->db->quote('italiapa') . ', ' . $this->db->quote('languagefilter') . ')')
							->order('ordering');
						$query->setLimit(1);
						$this->db->setQuery($query);
			
						$name = $this->db->loadResult();

						if ($name != 'plg_system_languagefilter')
						{
							$this->app->enqueueMessage('Il plugin System - ItaliaPA deve essere posizionato dopo il plugin System - Language Filter');
						}
					}
				}
			}
		}
	}

	/**
	 * Method to check if the given user has consented yet
	 *
	 * @param   integer  $userId  ID of uer to check
	 *
	 * @return  boolean
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private function isUserConsented($userId)
	{
		if (PluginHelper::isEnabled('system', 'privacyconsent'))
		{
			$query = $this->db->getQuery(true);
			$query->select('COUNT(*)')
				->from('#__privacy_consents')
				->where('user_id = ' . (int) $userId)
				->where('subject = ' . $this->db->quote('PLG_SYSTEM_PRIVACYCONSENT_SUBJECT'))
				->where('state = 1');
			$this->db->setQuery($query);

			return (int) $this->db->loadResult() > 0;
		}
		else
		{	
			return true;
		}
	}

	/**
	 * Get privacy article ID. If the site is a multilingual website and there is associated article for the
	 * current language, ID of the associated article will be returned
	 *
	 * @return  integer
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	private function getPrivacyArticleId()
	{
		$plugin = PluginHelper::getPlugin('system', 'privacyconsent');
		$params = new Registry($plugin->params);

		$privacyArticleId = $params->get('privacy_article');

		if ($privacyArticleId > 0 && Associations::isEnabled())
		{
			$privacyAssociated = Associations::getAssociations('com_content', '#__content', 'com_content.item', $privacyArticleId);
			$currentLang = Factory::getLanguage()->getTag();

			if (isset($privacyAssociated[$currentLang]))
			{
				$privacyArticleId = $privacyAssociated[$currentLang]->id;
			}
		}

		return $privacyArticleId;
	}


	/**
	 * After store user method.
	 *
	 * Method is called after user data is stored in the database.
	 *
	 * @param   array    $user     Holds the new user data.
	 * @param   boolean  $isnew    True if a new user is stored.
	 * @param   boolean  $success  True if user was succesfully stored in the database.
	 * @param   string   $msg      Message.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function onUserAfterSave($user, $isnew, $success, $msg)
	{
		if (empty(Factory::getApplication()->getUserState('com_users.edit.profile.redirect')))
		{
			if ($return = $this->app->input->get('return', null, 'base64'))
			{
				Factory::getApplication()->setUserState('com_users.edit.profile.redirect', base64_decode($return));
			}
			elseif ($return = $this->app->input->post->get('return', null, 'base64'))
			{
				Factory::getApplication()->setUserState('com_users.edit.profile.redirect', base64_decode($return));
			}
		}
	}
}
<?php  
/**
 * Script file of templateName template.
 *
 * The name of this class is dependent on the template being installed.
 * The class name should have the template's name, directly followed by
 * the text InstallerScript (ex:. templateNameInstallerScript).
 *
 * This class will be called by Joomla!'s installer, if specified in your template's
 * manifest file, and is used for custom automation actions in its installation process.
 *
 * In order to use this automation script, you should reference it in your template's
 * manifest file as follows:
 * script.php
 *
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2023 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class italiapaInstallerScript
{
	/**
	 * This method is called after a template is installed.
	 *
	 * @param  \stdClass $parent - Parent object calling this method.
	 *
	 * @return void
	 */
	public function install($parent)
	{
	}
 
	/**
	 * This method is called after a template is uninstalled.
	 *
	 * @param  \stdClass $parent - Parent object calling this method.
	 *
	 * @return void
	 */
	public function uninstall($parent) 
	{
	}

	/**
	 * This method is called after a template is updated.
	 *
	 * @param  \stdClass $parent - Parent object calling object.
	 *
	 * @return void
	 */
	public function update($parent) 
	{
		$this->deleteUnexistingFiles();
	}

	/**
	 * Runs just before any installation action is preformed on the template.
	 * Verifications and pre-requisites should run in this function.
	 *
	 * @param  string	$type	 - Type of PreFlight action. Possible values are:
	 *							 - * install
	 *							 - * update
	 *							 - * discover_install
	 * @param  \stdClass $parent - Parent object calling object.
	 *
	 * @return void
	 */
	public function preflight($type, $parent) 
	{
	} 
 
	/**
	 * Runs right after any installation action is preformed on the template.
	 *
	 * @param  string	$type	 - Type of PostFlight action. Possible values are:
	 *							 - * install
	 *							 - * update
	 *							 - * discover_install
	 * @param  \stdClass $parent - Parent object calling object.
	 *
	 * @return void
	 */
	function postflight($type, $parent)
	{
	    if (($type === 'install') or ($type === 'update'))
		{
			JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_fields/tables');

			// Initialize a new field
			/** @type  FieldsTableField  $field  */
			$field = JTable::getInstance('Field', 'FieldsTable');

			// Check if the field archive_up exists before adding it
			if (!$field->load(array('context' => 'com_content.article', 'name' => 'articleicon')))
			{
				$field->context = 'com_content.article';
				$field->group_id = 0;
				$field->title = 'Icon';
				$field->name = 'articleicon';
				$field->label = 'Icon';
				$field->default_value = '';
				$field->type = 'text';
				$field->note = '';
				$field->description = '';
				$field->state = 1;
				$field->required = 0;
				$field->params = '{"hint":"","class":"","label_class":"","show_on":"","render_class":"","showlabel":"1","label_render_class":"","display":"0","layout":"","display_readonly":"2"}';
				$field->fieldparams = '{"filter":"","maxlength":""}';
				$field->language = '*';
				$field->created_user_id = Factory::getUser()->id;
				$field->access = 1;

				// Check to make sure our data is valid
				$field->check() && $field->store(true);
			}

			$field = JTable::getInstance('Field', 'FieldsTable');

			// Check if the field archive_up exists before adding it
			if (!$field->load(array('context' => 'com_content.categories', 'name' => 'categoryicon')))
			{
				$field->context = 'com_content.categories';
				$field->group_id = 0;
				$field->title = 'Icon';
				$field->name = 'categoryicon';
				$field->label = 'Icon';
				$field->default_value = '';
				$field->type = 'text';
				$field->note = '';
				$field->description = '';
				$field->state = 1;
				$field->required = 0;
				$field->params = '{"hint":"","class":"","label_class":"","show_on":"","render_class":"","showlabel":"1","label_render_class":"","display":"0","layout":"","display_readonly":"2"}';
				$field->fieldparams = '{"filter":"","maxlength":""}';
				$field->language = '*';
				$field->created_user_id = Factory::getUser()->id;
				$field->access = 1;

				// Check to make sure our data is valid
				$field->check() && $field->store(true);
			}

			$field = JTable::getInstance('Field', 'FieldsTable');

			// Check if the field archive_up exists before adding it
			if (!$field->load(array('context' => 'com_content.article', 'name' => 'image-heronews')))
			{
				$field->context = 'com_content.article';
				$field->group_id = 0;
				$field->title = 'Immagine Hero news';
				$field->name = 'image-heronews';
				$field->label = 'Immagine Hero news';
				$field->default_value = '';
				$field->type = 'media';
				$field->note = '';
				$field->description = 'Seleziona o carica un\'immagine per gli articoli visualizzati in stile articoli in evidenza (layout: Hero news)';
				$field->state = 1;
				$field->required = 0;
				$field->params = '{"hint":"","class":"","label_class":"","show_on":"","render_class":"","showlabel":"1","label_render_class":"","display":"0","layout":"","display_readonly":"2"}';
				$field->fieldparams = '{"directory":"","preview":"","image_class":""}';
				$field->language = '*';
				$field->created_user_id = Factory::getUser()->id;
				$field->access = 1;

				// Check to make sure our data is valid
				$field->check() && $field->store(true);
			}
			$imageHeronewsId = $field->id;
		}

		if ($type == 'update')
		{
			$this->updateModules(
				array('position'=>'socials'),
				array(),
				array('moduleclass_sfx'=>' Header-social'),
				array('header_tag'=>'p', 'style'=>'System-xhtml'));
			$this->updateModules(
				array('position'=>'news'),
				array('layout'=>'italiapa:focus'),
				array('moduleclass_sfx'=>' u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom',
					'header_class'=>'u-text-h3 u-color-50'),
				array('module_tag'=>'section', 'header_tag'=>'p', 'style'=>'System-xhtml'));
			$this->updateModules(
				"`position` = 'news' and `module` != 'mod_custom' and `module` != 'mod_carousel'",
				array('layout'=>'_:default'),
				array('moduleclass_sfx'=>' u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom',
					'header_class'=>'u-text-h3 u-color-50'),
				array('module_tag'=>'section', 'header_tag'=>'p', 'style'=>'System-xhtml'));
			$this->updateModules(
				"`position` = 'news' and `module` = 'mod_custom'",
				array('layout'=>'_:default'),
				array(),
				array('module_tag'=>'section', 'header_tag'=>'p', 'style'=>'System-xhtml'),
				array('showtitle'=>'0'));
			$this->updateModules(
				"`position` = 'news' and `module` = 'mod_carousel'",
				array('layout'=>'_:default'),
				array(),
				array('module_tag'=>'section', 'header_tag'=>'h3', 'style'=>'0'));

			/* copy image_intro to image-heronews for featured articles */
			$db = Factory::getDbo();
			$query = $db->getQuery(true);

			$query->select('a.id, a.images')
				->from('#__content AS a')
				->join('INNER', '#__content_frontpage AS fp ON fp.content_id = a.id');

			$db->setQuery($query);

			if ($items = $db->loadObjectList())
			{
				JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_fields/models', 'FieldsModel');

				/** @var FieldsModelField $model */
				$model = BaseDatabaseModel::getInstance('Field', 'FieldsModel', array('ignore_request' => true));

				foreach ($items as &$item)
				{
					$obj = json_decode($item->images);
					if ($obj->image_intro)
					{
						$imageHeronews = $model->getFieldValue($imageHeronewsId, $item->id);
						if (empty($imageHeronews))
						{
							$model->setFieldValue($imageHeronewsId, $item->id, $obj->image_intro);
						}
					}
				}
			}
		}
	}

	/**
	 *
	 * @param	mixed	$where	WHERE clause
	 * @param	array	$wherep
	 * @param	array	$add
	 * @param	array	$replace
	 * @param	array	$columns
	 *
	 * @since   3.8.0.15
	 */
	private function updateModules($where, $wherep, $add, $replace, $columns = array())
	{
		$db    = Factory::getDbo();
		$query = $db->getQuery(true)
			->select($db->quoteName('id'))
			->select($db->quoteName('params'))
			->from('#__modules');

		if (is_array($where))
		{
			foreach($where as $field => $value)
			{
				if (substr($value, 0, 1) != '!')
				{
					$query->where($db->quoteName($field) . ' = ' . $db->quote($value));
				}
				else
				{
					$query->where($db->quoteName($field) . ' != ' . $db->quote(substr($value, 1)));
				}
			}
		}
		else
		{
			$query->where($where);
		}
		$db->setQuery($query);

		try
		{
			$rows = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			$rows = array();
		}

		if (empty($rows))
		{
			return;
		}

		foreach ($rows as $row)
		{
			$params = json_decode($row->params, true);

			$skip = false;
			foreach($wherep as $k => $v)
			{
				if (!isset($params[$k]))
				{
					$skip = true;
					continue;
				}
				if (substr($v, 0, 1) != '!')
				{
				    if ($params[$k] != $v)
				    {
				        $skip = true;
				        continue;
				    }
				}
				elseif ($params[$k] == substr($v, 1))
				{
				    $skip = true;
				    continue;
				}
			}
			if ($skip) continue;

			foreach($add as $k => $v)
			{
				$params[$k] = empty($params[$k]) ? $v :
					(substr($params[$k], 0, 1) == ' ' ? ' ' : '') .
					implode(' ', array_unique(array_merge(isset($params[$k]) ? explode(' ' , $params[$k]) : array(), explode(' ' , $v))));
			}

			foreach($replace as $k => $v)
			{
				$params[$k] = $v;
			}
			$params = json_encode($params);

			$query = $db->getQuery(true)
				->update($db->quoteName('#__modules'))
				->set($db->quoteName('params') . ' = ' . $db->quote($params))
				->where($db->quoteName('id') . ' = ' . $row->id);

			foreach ($columns as $k => $v)
			{
				$query->set($db->quoteName($k) . ' = ' . $db->quote($v));
			}

			try
			{
				$db->setQuery($query)->execute();
			}
			catch (Exception $e)
			{
			}
		}
	}

	/**
	 * Delete files that should not exist
	 *
	 * @return  void
	 */
	public function deleteUnexistingFiles()
	{
	    $base = JPATH_ROOT . '/templates/italiapa';

		$files = array(
			/*
			 * ItaliaPA 3.9 beta 1
			 */
			'/html/com_content/featured/default.xml',
			'/html/layout/com_contact/field/render.php',
			'/html/layout/com_contact/fields/render.php',
			/*
			 * ItaliaPA 3.9 beta 2
			 */
			'/css/ita.css',
		    /*
		     * ItaliaPA 3.9 stable
		     */
		    '/css/custom.css',
			'/html/com_content/category/news.php',
		    '/html/com_content/category/news.xml',
			'/html/com_content/category/news_item.php',
		    '/html/mod_menu/socials_url.php',

		    '/fonts/ita.eot',
		    '/fonts/ita.svg',
		    '/fonts/ita.ttf',
		    '/fonts/ita.woff',

		    /*
		     * ItaliaPA 3.10.1
		     */
			'/fonts/Iceland/Iceland-Regular.ttf',
			'/fonts/Iceland/Iceland-Regular.woff',
			'/fonts/Iceland/Iceland-Regular.woff2',

		    /*
		     * ItaliaPA 3.10.2 beta 3
		     */
			'/html/com_users/login/nocredentials.php',
			'/html/com_users/login/nocredentials.xml',
			'/html/com_users/login/nocredentials_login.php',
			'/html/com_users/login/spid.php',
			'/html/com_users/login/spid.xml',
			'/html/com_users/login/spid_login.php',
		);

		// TODO There is an issue while deleting folders using the ftp mode
		$folders = array(
			/*
			 * ItaliaPA 3.9 beta 1
			 */
			'/build/assets',
			'/html/layout/com_contact/field',
			'/html/layout/com_contact/fields',
		);

		Factory::getLanguage()->load('tpl_italiapa', JPATH_SITE);

		jimport('joomla.filesystem.file');
		foreach ($files as $file)
		{
		    if (JFile::exists($base . $file))
			{
				if (JFile::delete($base . $file))
				{
					Factory::getApplication()->enqueueMessage(JText::sprintf('TPL_ITALIAPA_FILE_DELETED', $file));
				}
				else
				{
					Factory::getApplication()->enqueueMessage(JText::sprintf('FILES_JOOMLA_ERROR_FILE_FOLDER', $file));
				}
			}
		}

		jimport('joomla.filesystem.folder');
		foreach ($folders as $folder)
		{
		    if (JFolder::exists($base . $folder))
			{
				if (JFolder::delete($base . $folder))
				{
					Factory::getApplication()->enqueueMessage(JText::sprintf('TPL_ITALIAPA_FOLDER_DELETED', $folder));
				}
				else
			    {
			        Factory::getApplication()->enqueueMessage(JText::sprintf('FILES_JOOMLA_ERROR_FILE_FOLDER', $folder));
				}
		    }
		}
	}
}

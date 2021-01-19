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

use Joomla\CMS\Factory;

/**
 * Script file of Vote for ItaliaPA
 *
 * @version __DEPLOY_VERSION__
 */
class PlgContentIpavoteInstallerScript
{

	/**
	 * Called after any type of action
	 *
	 * @param string $action
	 *        	Which action is happening
	 *        	(install|uninstall|discover_install|update)
	 * @param JInstaller $installer
	 *        	The class calling this method
	 *        	
	 * @return boolean True on success
	 */
	public function postflight ($action, $installer)
	{
		if (($action === 'install') or ($action === 'update'))
		{
			$field = null;
			
			if ((new JVersion())->isCompatible('4'))
			{
				$db = Factory::getDbo();
				
				/**
				 * @type FieldTable $field
				 */
				$field = new \Joomla\Component\Fields\Administrator\Table\FieldTable($db);
			}
			elseif ((new JVersion())->isCompatible('3.7'))
			{
				JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_fields/tables');
				
				// Initialize a new field
				/**
				 * @type FieldsTableField $field
				 */
				$field = JTable::getInstance('Field', 'FieldsTable');
			}
			
			// Check if the field archive_up exists before adding it
			if ($field && ! $field->load(array(
				'context' => 'com_content.article',
				'name' => 'plg-content-ipavote-position'
			)))
			{
				$field->context = 'com_content.article';
				$field->group_id = 0;
				$field->title = 'Vote Position';
				$field->name = 'plg-content-ipavote-position';
				$field->label = 'PLG_CONTENT_IPAVOTE_POSITION_LABEL';
				$field->default_value = '';
				$field->type = 'list';
				$field->note = '';
				$field->description = '';
				$field->state = 1;
				$field->required = 0;
				$field->params = '{"class":"","label_class":"","show_on":"","render_class":"","showlabel":"1","label_render_class":"","display":"0","layout":"","display_readonly":"2"}';
				$field->fieldparams = '{"multiple":"","options":{"options0":{"name":"JGLOBAL_USE_GLOBAL","value":""},"options1":{"name":"PLG_CONTENT_IPAVOTE_TOP","value":"top"},"options2":{"name":"PLG_CONTENT_IPAVOTE_BOTTOM","value":"bottom"}}}';
				$field->language = '*';
				$field->created_user_id = JFactory::getUser()->id;
				$field->access = 1;
				
				// Check to make sure our data is valid
				if (! $field->check())
				{
					JFactory::getApplication()->enqueueMessage(
						'<pre>' . JText::sprintf('PLG_CONTENT_IPAVOTE_CREATE_FIELD_ERROR', $field->getError()) . '</pre>');
					
					return false;
				}
				// Now store the category
				if (! $field->store(true))
				{
					JFactory::getApplication()->enqueueMessage(
						'<pre>' . JText::sprintf('PLG_CONTENT_IPAVOTE_CREATE_FIELD_ERROR', $field->getError()) . '</pre>');
					
					return false;
				}
			}
			
			if ((new JVersion())->isCompatible('4'))
			{
				/**
				 * @type FieldTable $field
				 */
				$field = new \Joomla\Component\Fields\Administrator\Table\FieldTable($db);
			}
			elseif ((new JVersion())->isCompatible('3.7'))
			{
				// Initialize a new field
				/**
				 * @type FieldsTableField $field
				 */
				$field = JTable::getInstance('Field', 'FieldsTable');
			}
			
			// Check if the field archive_up exists before adding it
			if ($field && ! $field->load(array(
				'context' => 'com_content.article',
				'name' => 'plg-content-ipavote-style'
			)))
			{
				$field->context = 'com_content.article';
				$field->group_id = 0;
				$field->title = 'Vote Style';
				$field->name = 'plg-content-ipavote-style';
				$field->label = 'PLG_CONTENT_IPAVOTE_STYLE_LABEL';
				$field->default_value = '';
				$field->type = 'list';
				$field->note = '';
				$field->description = '';
				$field->state = 1;
				$field->required = 0;
				$field->params = '{"class":"","label_class":"","show_on":"","render_class":"","showlabel":"1","label_render_class":"","display":"0","layout":"","display_readonly":"2"}';
				$field->fieldparams = '{"multiple":"","options":{"options0":{"name":"JGLOBAL_USE_GLOBAL","value":""},"options1":{"name":"JDEFAULT","value":"default"},"options2":{"name":"PLG_CONTENT_IPAVOTE_HELPFUL","value":"helpful"}}}';
				$field->language = '*';
				$field->created_user_id = JFactory::getUser()->id;
				$field->access = 1;
				
				// Check to make sure our data is valid
				if (! $field->check())
				{
					JFactory::getApplication()->enqueueMessage(
						'<pre>' . JText::sprintf('PLG_CONTENT_IPAVOTE_CREATE_FIELD_ERROR', $field->getError()) . '</pre>');
					
					return false;
				}
				// Now store the category
				if (! $field->store(true))
				{
					JFactory::getApplication()->enqueueMessage(
						'<pre>' . JText::sprintf('PLG_CONTENT_IPAVOTE_CREATE_FIELD_ERROR', $field->getError()) . '</pre>');
					
					return false;
				}
			}
			
			if ($action == 'install')
			{
				// Enable plugin
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				/*$query->update($db->quoteName('#__extensions'))
					->set($db->quoteName('enabled') . ' = 0')
					->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
					->where($db->quoteName('folder') . ' = ' . $db->quote('content'))
					->where($db->quoteName('element') . ' = ' . $db->quote('vote'));
				$db->setQuery($query)->execute();*/
				$query->clear()
					->update($db->quoteName('#__extensions'))
					->set($db->quoteName('enabled') . ' = 1')
					->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
					->where($db->quoteName('folder') . ' = ' . $db->quote('content'))
					->where($db->quoteName('element') . ' = ' . $db->quote('ipavote'));
				$db->setQuery($query)->execute();
			}
		}
	}
}
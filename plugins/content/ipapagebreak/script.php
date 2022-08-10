<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  Content.IpaPageBreak
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugins.Content.Ipapagebreak  is  a  free  software. This version may
 * have  been  modified  pursuant  to  the  GNU  General Public License, and as
 * distributed  it  includes  or  is derivative of works licensed under the GNU 
 * General Public License or other free or open source software licenses.
 */

defined('_JEXEC') or die();

use Joomla\CMS\Factory;

class PlgContentIpapagebreakInstallerScript
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
	 *        
	 * @since 3.7
	 */
	public function postflight ($action, $installer)
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipapagebreak'));

		if (($action === 'install') or ($action === 'update'))
		{
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
			if (! $field->load(array(
					'context' => 'com_content.article',
					'name' => 'plg-content-ipapagebreak-style'
			)))
			{
				$field->context = 'com_content.article';
				$field->group_id = 0;
				$field->title = 'Page Break Style';
				$field->name = 'plg-content-ipapagebreak-style';
				$field->label = 'PLG_CONTENT_IPAPAGEBREAK_STYLE_LABEL';
				$field->default_value = '';
				$field->type = 'list';
				$field->note = '';
				$field->description = '';
				$field->state = 1;
				$field->required = 0;
				$field->params = '{"class":"","label_class":"","show_on":"","render_class":"","showlabel":"1","label_render_class":"","display":"0","layout":"","display_readonly":"2"}';
				$field->fieldparams = '{"multiple":"","options":{"options0":{"name":"JGLOBAL_USE_GLOBAL","value":""},"options1":{"name":"PLG_CONTENT_PAGEBREAK_PAGES","value":"pages"},"options2":{"name":"PLG_CONTENT_PAGEBREAK_SLIDERS","value":"sliders"},"options3":{"name":"Tabs","value":"tabs"}}}';
				$field->language = '*';
				$field->created_user_id = JFactory::getUser()->id;
				$field->access = 1;

				// Check to make sure our data is valid
				if (! $field->check())
				{
					JLog::add(
							new JLogEntry(JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_CREATE_FIELD_ERROR', $field->getError()), JLog::DEBUG,
									'plg_content_ipapagebreak'));
					JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_CREATE_FIELD_ERROR', $field->getError()));

					return false;
				}
				// Now store the category
				if (! $field->store(true))
				{
					JLog::add(
							new JLogEntry(JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_CREATE_FIELD_ERROR', $field->getError()), JLog::DEBUG,
									'plg_content_ipapagebreak'));
					JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_CREATE_FIELD_ERROR', $field->getError()));

					return false;
				}
				JLog::add(
						new JLogEntry(JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_CREATE_FIELD_OK', $field->title), JLog::DEBUG,
								'plg_content_ipapagebreak'));
			}

			if ($action == 'install')
			{
				// Enable plugin
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->update($db->quoteName('#__extensions'))
					->set($db->quoteName('enabled') . ' = 0')
					->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
					->where($db->quoteName('folder') . ' = ' . $db->quote('content'))
					->where($db->quoteName('element') . ' = ' . $db->quote('pagebreak'));
				JLog::add(new JLogEntry($query, JLog::DEBUG, 'plg_content_ipapagebreak'));
				$db->setQuery($query)->execute();
				$query->clear()
					->update($db->quoteName('#__extensions'))
					->set($db->quoteName('enabled') . ' = 1')
					->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
					->where($db->quoteName('folder') . ' = ' . $db->quote('content'))
					->where($db->quoteName('element') . ' = ' . $db->quote('ipapagebreak'));
				JLog::add(new JLogEntry($query, JLog::DEBUG, 'plg_content_ipapagebreak'));
				$db->setQuery($query)->execute();
			}
		}
	}
}
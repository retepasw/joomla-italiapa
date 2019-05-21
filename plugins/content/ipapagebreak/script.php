<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	plg_content_ipapagebreak
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2019 Helios Ciancio. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die('Restricted access.');

class PlgContentIpapagebreakInstallerScript
{
	/**
	 * Called after any type of action
	 *
	 * @param   string      $action     Which action is happening (install|uninstall|discover_install|update)
	 * @param   JInstaller  $installer  The class calling this method
	 *
	 * @return  boolean  True on success
	 *
	 * @since   3.7
	 */
	public function postflight($action, $installer)
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'plg_content_ipapagebreak'));
	
		if (($action === 'install') or ($action === 'update'))
		{
			JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_fields/tables');

			// Initialize a new field
			/** @type  FieldsTableField  $field  */
			$field = JTable::getInstance('Field', 'FieldsTable');

			// Check if the field archive_up exists before adding it
			if (!$field->load(array('context' => 'com_content.article', 'name' => 'plg-content-ipapagebreak-style')))
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
				if (!$field->check())
				{
					JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_CREATE_FIELD_ERROR', $field->getError()));
					return false;
				}
				// Now store the category
				if (!$field->store(true))
				{
					JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_CREATE_FIELD_ERROR', $field->getError()));
					return false;
				}
				JLog::add(new JLogEntry(JText::sprintf('PLG_CONTENT_IPAPAGEBREAK_CREATE_FIELD_OK', $field->title), JLog::DEBUG, 'plg_content_ipapagebreak'));
			}

			if ($action == 'install')
			{
				// Enable plugin
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->update('#__extensions')
					->set($db->qn('enabled') . ' = 0')
					->where($db->qn('type') . ' = ' . $db->q('plugin'))
					->where($db->qn('folder') . ' = ' . $db->q('content'))
					->where($db->qn('element') . ' = ' . $db->q('pagebreak'));
				$db->setQuery($query)->execute();
				$query->clear()
					->set($db->qn('enabled') . ' = 1')
					->where($db->qn('type') . ' = ' . $db->q('plugin'))
					->where($db->qn('folder') . ' = ' . $db->q('content'))
					->where($db->qn('element') . ' = ' . $db->q('ipapagebreak'));
				$db->setQuery($query)->execute();
			}
		}
	}
}
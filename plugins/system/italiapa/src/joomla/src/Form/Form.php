<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  System.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugins.System.ItaliaPA  is  a  free  software. This version may have
 * been modified pursuant to the GNU General Public License, and as distributed
 * it includes  or is derivative of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */

namespace Joomla\CMS\Form;

defined('JPATH_PLATFORM') or die;

// Make alias of original Form 
\Italiapa\Helper\Joomla::makeAlias(JPATH_LIBRARIES . '/src/Form/Form.php', 'Form', '_JForm');

class Form extends _JForm 
{
	/**
	 * Method to load the form description from an XML string or object.
	 *
	 * The replace option works per field.  If a field being loaded already exists in the current
	 * form definition then the behavior or load will vary depending upon the replace flag.  If it
	 * is set to true, then the existing field will be replaced in its exact location by the new
	 * field being loaded.  If it is false, then the new field being loaded will be ignored and the
	 * method will move on to the next field to load.
	 *
	 * @param   string  $data     The name of an XML string or object.
	 * @param   string  $replace  Flag to toggle whether form fields should be replaced if a field
	 *                            already exists with the same group/name.
	 * @param   string  $xpath    An optional xpath to search for the fields.
	 *
	 * @return  boolean  True on success, false otherwise.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function load($data, $replace = true, $xpath = false)
	{
		if (in_array($this->name, array('com_privacy.request', 'com_contact.contact')))
		{
			$template = \JFactory::getApplication()->getTemplate();
			if (file_exists(JPATH_THEMES . '/' . $template . '/html/fields/consentbox.php'))
			{
				if (gettype($data) == 'object')
				{
					if ($data->xpath('//form/fieldset[@name="default"]')[0])
					{
						$data->xpath('//form/fieldset[@name="default"]')[0]->attributes()['addfilepath'] = 'addfieldpath="/templates/italiapa/html/fields"';
					}
				}
				elseif (gettype($data) == 'string')
				{
					$data = str_replace('addfieldpath="/plugins/content/confirmconsent/fields"', 'addfieldpath="/templates/' . $template . '/html/fields"', $data);
				}
			}
		}
		return parent::load($data, $replace, $xpath);
	}
}
?>

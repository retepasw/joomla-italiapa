<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  System.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugins.System.ItaliaPA  is  a  free  software. This version may have
 * been modified pursuant to the GNU General Public License, and as distributed
 * it includes  or is derivative of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */

defined('JPATH_PLATFORM') or die;

// Make alias of original JFormFieldCheckbox
\Italiapa\Helper\Joomla::makeAlias(JPATH_LIBRARIES . '/joomla/form/fields/checkbox.php', 'JFormFieldCheckbox', '_JFormFieldCheckbox');

/**
 * Form Field class for the Joomla Platform.
 * Single checkbox field.
 * This is a boolean field with null for false and the specified option for true
 *
 * @link   http://www.w3.org/TR/html-markup/input.checkbox.html#input.checkbox
 * @see    JFormFieldCheckbox
 */
class JFormFieldCheckbox extends _JFormFieldCheckbox
{
	/**
	 * Name of the layout being used to render the field
	 *
	 * @var    string
	 */
	protected $layout = 'joomla.form.field.checkbox';

	/**
	 * Method to get the field input markup.
	 * The checked element sets the field to selected.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		if (empty($this->layout))
		{
			throw new UnexpectedValueException(sprintf('%s has no layout assigned.', $this->name));
		}

		return $this->getRenderer($this->layout)->render($this->getLayoutData());
	}

	/**
	 * Method to get the field label markup for a spacer.
	 * Use the label text or name from the XML element as the spacer or
	 * Use a hr="true" to automatically generate plain hr markup
	 *
	 * @return  string  The field label markup.
	 */
	protected function getLabel()
	{
		return '';
	}

	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     JFormField::setup()
	 */
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$attributes = $element->attributes();
		if (isset($attributes['hiddenLabel']))
		{
			if (!empty($attributes['hiddenLabel']))
			{
				$element['label'] = "";
			}
			$attributes->hiddenLabel = true;
		}
		else
		{
			$element->addAttribute('hiddenLabel', true);
		}

		return parent::setup($element, $value, $group);
	}
}

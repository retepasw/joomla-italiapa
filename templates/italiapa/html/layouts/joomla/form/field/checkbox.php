<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION_
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   string              $autocomplete    Autocomplete attribute for the field.
 * @var   boolean             $autofocus       Is autofocus enabled?
 * @var   string              $class           Classes for the input.
 * @var   string              $description     Description of the field.
 * @var   boolean             $disabled        Is this field disabled?
 * @var   \JFormFieldCheckbox $field           The field object
 * @var   string              $group           Group the field belongs to. <fields> section in form XML.
 * @var   boolean             $hidden          Is this field hidden in the form?
 * @var   string              $hint            Placeholder for the field.
 * @var   string              $id              DOM id of the field.
 * @var   string              $label           Label of the field.
 * @var   string              $labelclass      Classes to apply to the label.
 * @var   boolean             $multiple        Does this field support multiple values?
 * @var   string              $name            Name of the input field.
 * @var   string              $onchange        Onchange attribute for the field.
 * @var   string              $onclick         Onclick attribute for the field.
 * @var   string              $pattern         Pattern (Reg Ex) of value of the form field.
 * @var   string              $validationtext  The validation text of invalid value of the form field.
 * @var   boolean             $readonly        Is this field read only?
 * @var   boolean             $repeat          Allows extensions to duplicate elements.
 * @var   boolean             $required        Is this field required?
 * @var   integer             $size            Size attribute of the input.
 * @var   boolean             $spellcheck      Spellcheck state for the form field.
 * @var   string              $validate        Validation rules to apply.
 * @var   string              $value           Value attribute of the field.
 */

// Including fallback code for HTML5 non supported browsers.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Initialize some option attributes.
$checked		= $field->checked ? 'checked' : '';
$optionClass	= 'class="' . trim($class . ' Form-input ' . $disabled) . '"';
$optionDisabled = $disabled;


// Initialize some JavaScript option attributes.
$onclick        = !empty($onclick) ? 'onclick="' . $onclick . '"' : '';
$onchange       = !empty($onchange) ? 'onchange="' . $onchange . '"' : '';

$oid		    = $id . '0';
$value	        = htmlspecialchars(empty($field->value) ?: $field->value, ENT_COMPAT, 'UTF-8');
$attributes     = array_filter(array($checked, $optionClass, $optionDisabled, $onchange, $onclick));

/**
 * The format of the input tag to be filled in using sprintf.
 *    %1 - id
 *    %2 - name
 *    %3 - value
 *    %4 = any other attributes
 */
$format         = '<input type="checkbox" id="%1$s" name="%2$s" value="%3$s" %4$s /><span class="Form-fieldIcon" role="presentation"></span>';

// The alt option for JText::alt
$alt            = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);
?>

<fieldset class="Form-fieldset">
	<fieldset id="<?php echo $id; ?>" class="Form-field Form-field--choose Grid-cell checkboxes">
		<label for="<?php echo $oid; ?>" class="Form-label Form-label--block">
			<?php echo sprintf($format, $oid, $name, $value, implode(' ', $attributes)); ?>
		<?php echo $label; ?></label>
	</fieldset>
</fieldset>

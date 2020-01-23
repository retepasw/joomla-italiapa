<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

$app       = JFactory::getApplication();
$form      = $displayData->getForm();
$fieldSets = $form->getFieldsets();

if (empty($fieldSets))
{
	return;
}

$ignoreFieldsets = $displayData->get('ignore_fieldsets') ?: array();
$ignoreFields    = $displayData->get('ignore_fields') ?: array();
$extraFields     = $displayData->get('extra_fields') ?: array();
$tabName         = $displayData->get('tab_name') ?: 'myTab';

if (!empty($displayData->hiddenFieldsets))
{
	// These are required to preserve data on save when fields are not displayed.
	$hiddenFieldsets = $displayData->hiddenFieldsets ?: array();
}

if (!empty($displayData->configFieldsets))
{
	// These are required to configure showing and hiding fields in the editor.
	$configFieldsets = $displayData->configFieldsets ?: array();
}

// Handle the hidden fieldsets when show_options is set false
if (!$displayData->get('show_options', 1))
{
	// The HTML buffer
	$html   = array();

	// Hide the whole buffer
	$html[] = '<div style="display:none;">';

	// Loop over the fieldsets
	foreach ($fieldSets as $name => $fieldSet)
	{
		// Check if the fieldset should be ignored
		if (in_array($name, $ignoreFieldsets, true))
		{
			continue;
		}

		// If it is a hidden fieldset, render the inputs
		if (in_array($name, $hiddenFieldsets))
		{
			// Loop over the fields
			foreach ($form->getFieldset($name) as $field)
			{
				// Add only the input on the buffer
				$html[] = $field->input;
			}

			// Make sure the fieldset is not rendered twice
			$ignoreFieldsets[] = $name;
		}

		// Check if it is the correct fieldset to ignore
		if (strpos($name, 'basic') === 0)
		{
			// Ignore only the fieldsets which are defined by the options not the custom fields ones
			$ignoreFieldsets[] = $name;
		}
	}

	// Close the container
	$html[] = '</div>';

	// Echo the hidden fieldsets
	echo implode('', $html);
}

// Loop again over the fieldsets
foreach ($fieldSets as $name => $fieldSet)
{
	// Ensure any fieldsets we don't want to show are skipped (including repeating formfield fieldsets)
	if ((isset($fieldSet->repeat) && $fieldSet->repeat === true)
		|| in_array($name, $ignoreFieldsets)
		|| (!empty($configFieldsets) && in_array($name, $configFieldsets, true))
		|| (!empty($hiddenFieldsets) && in_array($name, $hiddenFieldsets, true))
	)
	{
		continue;
	}

	// Determine the label
	if (!empty($fieldSet->label))
	{
		$label = JText::_($fieldSet->label);
	}
	else
	{
		$label = strtoupper('JGLOBAL_FIELDSET_' . $name);
		if (JText::_($label) === $label)
		{
			$label = strtoupper($app->input->get('option') . '_' . $name . '_FIELDSET_LABEL');
		}
		$label = JText::_($label);
	}

	// Start the tab
	?>
	<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-<?php echo $tabName . '-attrib-' . $name; ?>">
		<span class="Accordion-link"><?php echo $label; ?></span>
	</h2>
	<div id="accordion-panel-<?php echo $tabName . '-attrib-' . $name; ?>" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
	<?php

	// Include the description when available
	if (isset($fieldSet->description) && trim($fieldSet->description))
	{
		echo '<p class="alert alert-info">' . $this->escape(JText::_($fieldSet->description)) . '</p>';
	}

	// The name of the fieldset to render
	$displayData->fieldset = $name;

	// Force to show the options
	$displayData->showOptions = true;

	// Render the fieldset
	echo JLayoutHelper::render('joomla.edit.fieldset', $displayData);

	// End the tab
	echo '</div>';
}


<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

$form = $displayData['form'];

// Iterate through the form fieldsets and display each one.
foreach ($form->getFieldsets() as $fieldset)
{
	$fields = $form->getFieldset($fieldset->name);
	if (count($fields))
	{
		echo '<fieldset class="Form-fieldset">';
		// If the fieldset has a label set, display it as the legend.
		if (isset($fieldset->label))
		{
			echo '<legend class="Form-legend">' . JText::_($fieldset->label) . '</legend>';
		}
		// Iterate through the fields in the set and display them.
		foreach ($fields as $field)
		{
			// If the field is hidden, just display the input.
			if ($field->hidden)
			{
				echo $field->input;
			}
			else
			{
				if (!in_array($field->type, ['Spacer', 'Captcha']))
				{
					$field->class = 'Form-input ' . $field->class;
				}

				if (in_array($field->type, ['Helpsite']))
				{
					if ($field->hidden)
					{
						return $field->getInput();
					}

					if (!isset($options['class']))
					{
						$options['class'] = '';
					}

					$options['rel'] = '';

					if (empty($options['hiddenLabel']) && $field->getAttribute('hiddenLabel'))
					{
						$options['hiddenLabel'] = true;
					}

					if ($field->showon)
					{
						$options['rel']		   = ' data-showon=\'' .
								json_encode(JFormHelper::parseShowOnConditions($field->showon, $field->formControl, $field->group)) . '\'';
								$options['showonEnabled'] = true;
					}

					$data = array(
						'input'   => $field->input,
						'label'   => $field->label,
						'options' => $options,
					);

					// Instantiate a new JLayoutFile instance and render the batch button
					$layout = new JLayoutFile('eshiol.form.field.helpsite');
					echo $layout->render($data);
				}
				else
				{
					echo $field->renderField();
				}
			}
		}
		echo '</fieldset>';
	}
}
?>
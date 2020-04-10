<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
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

// Check if we have all the data
if (!key_exists('item', $displayData) || !key_exists('context', $displayData))
{
	return;
}

// Setting up for display
$item = $displayData['item'];

if (!$item)
{
	return;
}

$context = $displayData['context'];

if (!$context)
{
	return;
}

JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

$parts     = explode('.', $context);
$component = $parts[0];
$fields    = null;

if (key_exists('fields', $displayData))
{
	$fields = $displayData['fields'];
}
else
{
	$fields = $item->jcfields ?: FieldsHelper::getFields($context, $item, true);
}

if (!$fields)
{
	return;
}

// Check if we have mail context in first element
$isMail = (reset($fields)->context == 'com_contact.mail');

if (!$isMail)
{
	// Print the container tag
	echo '<dl class="fields-container contact-fields dl-horizontal">';
}

// Loop through the fields and print them
foreach ($fields as $field)
{
	// If the value is empty do nothing
	if (empty($field->value) && !$isMail)
	{
		continue;
	}

	echo FieldsHelper::render($context, 'field.render', array('field' => $field));
}

if (!$isMail)
{
	// Close the container
	echo '</dl>';
}

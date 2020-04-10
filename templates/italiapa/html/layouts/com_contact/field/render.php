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

if (!key_exists('field', $displayData))
{
	return;
}

$field     = $displayData['field'];
$label     = JText::_($field->label);
$value     = $field->value;
$class     = $field->params->get('render_class');
$showLabel = $field->params->get('showlabel');

if ($field->context == 'com_contact.mail')
{
	// Prepare the value for the contact form mail
	$value = html_entity_decode($value);

	echo ($showLabel ? $label . ': ' : '') . $value . "\r\n";
	return;
}

if (!$value)
{
	return;
}

?>
<dt class="contact-field-entry <?php echo $class; ?>">
	<?php if ($showLabel == 1) : ?>
		<span class="field-label"><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?>: </span>
	<?php endif; ?>
</dt>
<dd class="contact-field-entry <?php echo $class; ?>">
	<span class="field-value"><?php echo $value; ?></span>
</dd>

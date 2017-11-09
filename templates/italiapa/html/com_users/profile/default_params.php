<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
?>

<?php $fields = $this->form->getFieldset('params'); ?>
<?php if (count($fields)) : ?>
	<fieldset id="users-profile-custom" class="Form-fieldset">
		<legend class="Form-legend"><?php echo JText::_('COM_USERS_SETTINGS_FIELDSET_LABEL'); ?></legend>
	<?php foreach ($fields as $field) :
		if (!$field->hidden) : ?>
		<div class="Form-field">
			<label class="Form-label"><?php echo $field->title; ?></label>
			<label class="Form-input">
			<?php if (JHtml::isRegistered('users.' . $field->id)) : ?>
				<?php echo JHtml::_('users.' . $field->id, $field->value); ?>
			<?php elseif (JHtml::isRegistered('users.' . $field->fieldname)) : ?>
				<?php echo JHtml::_('users.' . $field->fieldname, $field->value); ?>
			<?php elseif (JHtml::isRegistered('users.' . $field->type)) : ?>
				<?php echo JHtml::_('users.' . $field->type, $field->value); ?>
			<?php else : ?>
				<?php echo JHtml::_('users.value', $field->value); ?>
			<?php endif; ?>
			</label>
		<?php endif; ?>
		</div>
	<?php endforeach; ?>
</fieldset>
<?php endif; ?>

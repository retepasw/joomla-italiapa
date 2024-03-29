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

defined('_JEXEC') or die;


JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::register('users.spacer', array('JHtmlUsers', 'spacer'));

$fieldsets = $this->form->getFieldsets();

if (isset($fieldsets['core']))
{
	unset($fieldsets['core']);
}

if (isset($fieldsets['params']))
{
	unset($fieldsets['params']);
}

$tmp		  = isset($this->data->fields) ? $this->data->fields : array();
$customFields = array();

foreach ($tmp as $customField)
{
	$customFields[$customField->alias] = $customField;
}
?>

	<?php foreach ($customFields as $field) :
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

<?php foreach ($fieldsets as $group => $fieldset) : ?>
	<?php $fields = $this->form->getFieldset($group); ?>
	<?php if (count($fields)) : ?>
		<fieldset id="users-profile-custom-<?php echo $group; ?>" class="Form-fieldset users-profile-custom-<?php echo $group; ?>">
			<?php if (isset($fieldset->label) && strlen($legend = trim(JText::_($fieldset->label)))) : ?>
				<legend class="Form-legend"><?php echo $legend; ?></legend>
			<?php endif; ?>
				<?php foreach ($fields as $field) : ?>
					<?php if (!$field->hidden && $field->type !== 'Spacer') : ?>
				<div class="Form-field">
					<label class="Form-label"><?php echo $field->title; ?></label>
					<label class="Form-input">
							<?php if (key_exists($field->fieldname, $customFields)) : ?>
								<?php echo $customFields[$field->fieldname]->value ?: JText::_('COM_USERS_PROFILE_VALUE_NOT_FOUND'); ?>
							<?php elseif (JHtml::isRegistered('users.' . $field->id)) : ?>
								<?php echo JHtml::_('users.' . $field->id, $field->value); ?>
							<?php elseif (JHtml::isRegistered('users.' . $field->fieldname)) : ?>
								<?php echo JHtml::_('users.' . $field->fieldname, $field->value); ?>
							<?php elseif (JHtml::isRegistered('users.' . $field->type)) : ?>
								<?php echo JHtml::_('users.' . $field->type, $field->value); ?>
							<?php else : ?>
								<?php echo JHtml::_('users.value', $field->value); ?>
							<?php endif; ?>
					</label>
				</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</dl>
		</fieldset>
	<?php endif; ?>
<?php endforeach; ?>

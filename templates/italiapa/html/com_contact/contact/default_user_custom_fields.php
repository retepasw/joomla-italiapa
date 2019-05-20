<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$params             = $this->item->params;
$presentation_style = $params->get('presentation_style');

$displayGroups      = $params->get('show_user_custom_fields');
$userFieldGroups    = array();
?>

<?php if (!$displayGroups || !$this->contactUser) : ?>
	<?php return; ?>
<?php endif; ?>

<?php foreach ($this->contactUser->jcfields as $field) : ?>
	<?php if (!in_array('-1', $displayGroups) && (!$field->group_id || !in_array($field->group_id, $displayGroups))) : ?>
		<?php continue; ?>
	<?php endif; ?>
	<?php if (!key_exists($field->group_title, $userFieldGroups)) : ?>
		<?php $userFieldGroups[$field->group_title] = array(); ?>
	<?php endif; ?>
	<?php $userFieldGroups[$field->group_title][] = $field; ?>
<?php endforeach; ?>

<?php foreach ($userFieldGroups as $groupTitle => $fields) : ?>
	<?php $id = JApplicationHelper::stringURLSafe($groupTitle); ?>
	<?php if ($presentation_style == 'sliders') : ?>
		<?php echo JHtml::_('iwt.addSlide', 'slide-contact', $groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS'), 'display-profile-' . $id); ?>
	<?php elseif ($presentation_style == 'tabs') : ?>
		<?php echo JHtml::_('iwt.addTab', 'myTab', 'display-profile-' . $id, $groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS')); ?>
	<?php elseif ($presentation_style == 'plain') : ?>
		<?php echo '<h3 class="u-text-h3">' . ($groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS')) . '</h3>'; ?>
	<?php endif; ?>

	<div class="contact-profile" id="user-custom-fields-<?php echo $id; ?>">
		<dl class="dl-horizontal">
		<?php foreach ($fields as $field) : ?>
			<?php if (!$field->value) : ?>
				<?php continue; ?>
			<?php endif; ?>

			<?php if ($field->params->get('showlabel')) : ?>
				<?php echo '<dt>' . JText::_($field->label) . '</dt>'; ?>
			<?php endif; ?>

			<?php echo '<dd>' . $field->value . '</dd>'; ?>
		<?php endforeach; ?>
		</dl>
	</div>

	<?php if ($presentation_style == 'sliders') : ?>
		<?php echo JHtml::_('iwt.endSlide'); ?>
	<?php elseif ($presentation_style == 'tabs') : ?>
		<?php echo JHtml::_('iwt.endTab'); ?>
	<?php endif; ?>
<?php endforeach; ?>

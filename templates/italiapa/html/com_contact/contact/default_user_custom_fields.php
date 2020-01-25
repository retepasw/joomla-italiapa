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
		<?php echo JHtml::_('iwt.addTab', 'tab-contact', $groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS'), 'display-profile-' . $id); ?>
		<?php echo JHtml::_('iwt.startTabPanel', 'tab-contact', 'display-profile-' . $id); ?>
	<?php elseif ($presentation_style == 'plain') : ?>
		<div class="u-size1of2">
			<h3 class="u-text-h3"><?php echo ($groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS')); ?></h3>
	<?php endif; ?>

	<dl class="contact-profile dl-horizontal" id="user-custom-fields-<?php echo $id; ?>">
		<?php foreach ($fields as $field) : ?>
			<?php if ($field->value) : ?>
				<?php if ($field->params->get('showlabel')) : ?>
					<dt><?php echo JText::_($field->label); ?></dt>
				<?php endif; ?>

				<dd><?php echo $field->value; ?></dd>
			<?php endif; ?>
		<?php endforeach; ?>
	</dl>

	<?php if ($presentation_style == 'sliders') : ?>
		<?php echo JHtml::_('iwt.endSlide'); ?>
	<?php elseif ($presentation_style == 'tabs') : ?>
		<?php echo JHtml::_('iwt.endTabPanel'); ?>
	<?php elseif ($presentation_style == 'plain') : ?>
		</div>
	<?php endif; ?>
<?php endforeach; ?>

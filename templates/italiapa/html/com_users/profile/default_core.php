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
?>

<fieldset id="users-profile-core" class="Form-fieldset">
	<legend class="Form-legend">
		<?php echo JText::_('COM_USERS_PROFILE_CORE_LEGEND'); ?>
	</legend>

	<div class="Form-field">
		<label class="Form-label"><?php echo JText::_('COM_USERS_PROFILE_NAME_LABEL'); ?></label>
		<label class="Form-input"><?php echo $this->data->name; ?></label>
	</div>
	<div class="Form-field">
		<label class="Form-label"><?php echo JText::_('COM_USERS_PROFILE_NAME_LABEL'); ?></label>
		<label class="Form-input"><?php echo $this->data->name; ?></label>
	</div>

	<div class="Form-field">
		<label class="Form-label"><?php echo JText::_('COM_USERS_PROFILE_USERNAME_LABEL'); ?></label>
		<label class="Form-input"><?php echo htmlspecialchars($this->data->username, ENT_COMPAT, 'UTF-8'); ?></label>
	</div>
	<div class="Form-field">
		<label class="Form-label"><?php echo JText::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL'); ?></label>
		<label class="Form-input"><?php echo JHtml::_('date', $this->data->registerDate); ?></label>
	</div>
	<div class="Form-field">
		<label class="Form-label"><?php echo JText::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL'); ?></label>
		<?php if ($this->data->lastvisitDate != $this->db->getNullDate()) : ?>
		<label class="Form-input"><?php echo JHtml::_('date', $this->data->lastvisitDate); ?></label>
		<?php else : ?>
		<label class="Form-input"><?php echo JText::_('COM_USERS_PROFILE_NEVER_VISITED'); ?></label>
		<?php endif; ?>
	</div>
</fieldset>

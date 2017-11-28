<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" 
	class="form-validate form-horizontal well Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose">
	<?php if ($params->get('pretext')) : ?>
		<div class="Prose Alert Alert--info">
			<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<div class="userdata">
		<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>" class="u-floatRight">
		<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?>
		<span class="u-text-r-m Icon Icon-link"></span>
		</a>
		<div class="Form-field" id="form-login-username">
			<?php if (!$params->get('usetext')): ?>
			<label id="username-lbl" for="modlgn-username" class="Form-label required"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?><span class="star">&nbsp;*</span></label>
			<?php else: ?>
			<label id="username-lbl" for="modlgn-username" class="Form-label required"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?><span class="star">&nbsp;*</span></label>
			<?php endif; ?>
			<input type="text" name="username" id="modlgn-username" value="" class="Form-input validate-username required" size="25" required="required" aria-required="true" autofocus="" aria-invalid="false">
		</div>	

		<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>" class="u-floatRight">
		<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?>
		<span class="u-text-r-m Icon Icon-link"></span>
		</a>
		<div class="Form-field" id="form-login-password">
			<?php if (!$params->get('usetext')): ?>
			<label id="password-lbl" for="modlgn-passwd" class="Form-label required"><?php echo JText::_('JGLOBAL_PASSWORD'); ?><span class="star">&nbsp;*</span></label>
			<?php else: ?>
			<label id="password-lbl" for="modlgn-passwd" class="Form-label required"><?php echo JText::_('JGLOBAL_PASSWORD'); ?><span class="star">&nbsp;*</span></label>
			<?php endif; ?>
			<input type="password" name="password" id="modlgn-passwd" value="" class="Form-input validate-username required" size="25" required="required" aria-required="true" autofocus="" aria-invalid="false">
		</div>

		<?php if (count($twofactormethods) > 1) : ?>
		<div class="Form-field" id="form-login-secretkey">
			<?php if (!$params->get('usetext')): ?>
			<label id="secretkey-lbl" for="modlgn-secretkey" class="Form-label"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
			<?php else: ?>
			<label id="secretkey-lbl" for="modlgn-secretkey" class="Form-label"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
			<?php endif; ?>
			<input type="text" name="secretkey" id="modlgn-secretkey" value="" class="Form-input validate-secretkey required" size="25" autofocus="" aria-invalid="false" autocomplete="off">
		</div>	
		<?php endif; ?>

		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<fieldset id="form-login-remember" class="Form-field Form-field--choose Grid-cell">
			<label class="Form-label" for="modlgn-remember">
			<input type="checkbox" class="Form-input" id="modlgn-remember" name="remember">
			<span class="Form-fieldIcon" role="presentation"></span><?php echo JText::_('MOD_LOGIN_REMEMBER_ME'); ?></label>
		</fieldset>		
		<?php endif; ?>
		<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
		<?php if ($usersConfig->get('allowUserRegistration')) : ?>
		<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
		<?php echo JText::_('MOD_LOGIN_REGISTER'); ?> <span class="u-text-r-m Icon Icon-link"></span></a>
		<?php endif; ?>
		<div id="form-login-submit" class="Form-field Grid-cell u-textRight">
			<button type="submit" class="Button Button--default u-text-xs"><?php echo JText::_('JLOGIN'); ?></button>
		</div>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<?php if ($params->get('posttext')) : ?>
		<div class="Prose Alert Alert--info">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>

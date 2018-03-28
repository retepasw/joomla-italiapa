<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

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

	<?php if (!$params->get('usetext')): ?>
		<div class="Form-field" id="form-login-username">
		<svg class="u-text-r-m Icon Icon-User" style="margin-right: 0.25em;"><use xlink:href="#Icon-user"></use></svg><span class="u-hiddenVisually"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></span>
		<input type="text" name="username" id="modlgn-username" value="" class="Form-input validate-username required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>"
			style="display: unset!important; width:80%!important;"/>
		<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
			<svg class="u-text-r-m Icon Icon-question" style="margin-left: 0.25em;"><use xlink:href="#Icon-question"></use></svg>
			<span class="u-hiddenVisually"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></span>
		</a>
		</div>

		<div class="Form-field" id="form-login-password">
		<svg class="u-text-r-m Icon Icon-Lock" style="margin-right: 0.25em;"><use xlink:href="#Icon-lock"></use></svg><span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></span>
		<input type="password" name="password" id="modlgn-passwd" value="" class="Form-input validate-password required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"
			style="display: unset!important; width:80%!important;"/>
		<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
			<svg class="u-text-r-m Icon Icon-question" style="margin-left: 0.25em;"><use xlink:href="#Icon-question"></use></svg>
			<span class="u-hiddenVisually"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></span>
		</a>
		</div>

		<?php if (count($twofactormethods) > 1) : ?>
		<div class="Form-field" id="form-login-secretkey">
		<svg class="u-text-r-m Icon Icon-star-full" style="margin-right: 0.25em;"><use xlink:href="#Icon-star-full"></use></svg><span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></span>
		<input type="password" name="secretkey" id="modlgn-secretkey" value="" class="Form-input validate-secretkey required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>"
			style="display: unset!important; width:80%!important;"/>
		</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="Form-field" id="form-login-username">
			<label id="username-lbl" for="modlgn-username" class="Form-label required"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?><span class="star">&nbsp;*</span></label>
			<div class="u-floatRight">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
				<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>&nbsp;
				<span class="u-text-r-m Icon Icon-link"></span>
			</div>
			<input type="text" name="username" id="modlgn-username" value="" class="Form-input validate-username required" size="25" required="required" aria-required="true" aria-invalid="false">
		</div>	

		<div class="Form-field" id="form-login-password">
			<label id="password-lbl" for="modlgn-passwd" class="Form-label required"><?php echo JText::_('JGLOBAL_PASSWORD'); ?><span class="star">&nbsp;*</span></label>
			<div class="u-floatRight">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
				<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>&nbsp;
				<span class="u-text-r-m Icon Icon-link"></span>
			</div>
			<input type="password" name="password" id="modlgn-passwd" value="" class="Form-input validate-username required" size="25" required="required" aria-required="true" aria-invalid="false">
		</div>

		<?php if (count($twofactormethods) > 1) : ?>
		<div class="Form-field" id="form-login-secretkey">
			<label id="secretkey-lbl" for="modlgn-secretkey" class="Form-label"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
			<input type="text" name="secretkey" id="modlgn-secretkey" value="" class="Form-input validate-secretkey required" size="25" aria-invalid="false" autocomplete="off">
		</div>	
		<?php endif; ?>
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

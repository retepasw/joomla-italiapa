<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

$trusted = (JPluginHelper::isEnabled('twofactorauth', 'trust')
		&& PlgTwofactorauthTrust::isActive()
		&& PlgTwofactorauthTrust::checkCookie());

JText::script('TPL_ITALIAPA_UNTRUST_THIS_BROWSER');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form-<?php echo $module->id; ?>"
	class="form-validate form-horizontal well Form Form--spaced u-padding-all-xl u-text-r-xs u-layout-prose<?php echo ($module->position == 'footer') ? '' : '  u-background-grey-10'; ?>">
	<?php if ($params->get('pretext')) : ?>
		<div class="Prose Alert Alert--info">
			<p<?php echo ($module->position == 'footer') ? ' class="u-color-white"' : ''; ?>><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>

	<div class="userdata">
		<?php if (!$params->get('usetext')): ?>
			<div class="Form-field">
				<span data-tooltip="<?php echo JHtml::tooltipText(JText::_('MOD_LOGIN_VALUE_USERNAME'), 0); ?>" data-tooltip-position="bottom center">
					<svg class="u-text-r-m Icon Icon-User" style="margin-right: 0.25em;"><use xlink:href="#Icon-user"></use></svg><span class="u-hiddenVisually"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></span>
				</span>
				<input type="text" name="username" id="modlgn-username-<?php echo $module->id; ?>" value="" class="Form-input validate-username required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?>"
					style="display: unset!important; width: calc(100% - 66px);"/>
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>" data-tooltip="<?php echo JHtml::tooltipText(JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'), 0); ?>">
					<svg class="u-text-r-m Icon Icon-question" style="margin-left: 0.25em;"><use xlink:href="#Icon-question"></use></svg>
					<span class="u-hiddenVisually"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></span>
				</a>
			</div>

			<div class="Form-field">
				<span data-tooltip="<?php echo JHtml::tooltipText(JText::_('JGLOBAL_PASSWORD'), 0); ?>" data-tooltip-position="bottom center">
					<svg class="u-text-r-m Icon Icon-Lock" style="margin-right: 0.25em;"><use xlink:href="#Icon-lock"></use></svg><span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></span>
				</span>
				<input type="password" name="password" id="modlgn-passwd-<?php echo $module->id; ?>" value="" class="Form-input validate-password required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"
					style="display: unset!important; width: calc(100% - 66px);"/>
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>" data-tooltip="<?php echo JHtml::tooltipText(JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'), 0); ?>">
					<svg class="u-text-r-m Icon Icon-question" style="margin-left: 0.25em;"><use xlink:href="#Icon-question"></use></svg>
					<span class="u-hiddenVisually"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></span>
				</a>
			</div>

			<?php if (count($twofactormethods) > 1) : ?>
				<div class="Form-field">
					<span data-tooltip="<?php echo JHtml::tooltipText(JText::_($trusted ? 'TPL_ITALIAPA_UNTRUST_THIS_BROWSER' : 'JGLOBAL_SECRETKEY'), 0); ?>" data-tooltip-position="bottom center">
						<?php if ($trusted) : ?>
							<span class="u-text-r-l Icon Icon-check 2fa-untrust"></span>
						<?php else : ?>
							<svg class="u-text-r-m Icon Icon-star-full" style="margin-right: 0.25em;"><use xlink:href="#Icon-star-full"></use></svg>
						<?php endif; ?>
						<span class="u-hiddenVisually"><?php echo JText::_($trusted ? 'PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER' : 'JGLOBAL_SECRETKEY'); ?></span>
					</span>
					<input type="password" name="secretkey" id="modlgn-secretkey-<?php echo $module->id; ?>" value="" class="Form-input validate-secretkey required" size="25" required="required" aria-required="true" aria-invalid="false"
						<?php echo $trusted ? 'readonly' : ''; ?>
						placeholder="<?php echo JText::_($trusted ? 'PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER' : 'JGLOBAL_SECRETKEY'); ?>"
						style="display: unset!important; width: calc(100% - 66px);"/>
				</div>
			<?php endif; ?>
		<?php else: ?>
			<div class="Form-field">
				<label id="username-lbl" for="modlgn-username-<?php echo $module->id; ?>" class="Form-label required"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?><span class="star">&nbsp;*</span></label>
				<div class="u-floatRight">
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
					<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>&nbsp;
					<span class="u-text-r-m Icon Icon-link"></span>
				</div>
				<input type="text" name="username" id="modlgn-username-<?php echo $module->id; ?>" value="" class="Form-input validate-username required" size="25" required="required" aria-required="true" aria-invalid="false">
			</div>

			<div class="Form-field">
				<label id="password-lbl" for="modlgn-passwd-<?php echo $module->id; ?>" class="Form-label required"><?php echo JText::_('JGLOBAL_PASSWORD'); ?><span class="star">&nbsp;*</span></label>
				<div class="u-floatRight">
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
					<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>&nbsp;
					<span class="u-text-r-m Icon Icon-link"></span>
				</div>
				<input type="password" name="password" id="modlgn-passwd-<?php echo $module->id; ?>" value="" class="Form-input validate-username required" size="25" required="required" aria-required="true" aria-invalid="false">
			</div>

			<?php if (count($twofactormethods) > 1) : ?>
				<div class="Form-field">
					<label id="secretkey-lbl" for="modlgn-secretkey-<?php echo $module->id; ?>" class="Form-label"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
					<?php if ($trusted) : ?>
						<div class="u-floatRight">
							<a href="#" class="2fa-untrust">
							<?php echo JText::_('TPL_ITALIAPA_UNTRUST_THIS_BROWSER'); ?></a>&nbsp;
							<svg class="u-text-r-m Icon Icon-unlink" style="margin-right: 0.25em;"><use xlink:href="#Icon-unlink"></use></svg>
							<span class="u-hiddenVisually"><?php echo JText::_('TPL_ITALIAPA_UNTRUST_THIS_BROWSER'); ?></span>
						</div>
					<?php endif; ?>
					<input type="text" name="secretkey" id="modlgn-secretkey-<?php echo $module->id; ?>" value="" class="Form-input validate-secretkey required" size="25" aria-invalid="false" autocomplete="off"
					<?php echo $trusted ? 'readonly' : ''; ?>
					placeholder="<?php echo JText::_($trusted ? 'PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER' : 'JGLOBAL_SECRETKEY'); ?>"
					>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if (JPluginHelper::isEnabled('twofactorauth', 'trust') && PlgTwofactorauthTrust::isActive()) : ?>
			<fieldset class="Form-field Form-field--choose Grid-cell">
				<label class="Form-label" for="modlgn-trust-<?php echo $module->id; ?>">
				<input type="checkbox" class="Form-input" id="modlgn-trust-<?php echo $module->id; ?>" name="trust"<?php echo $trusted ? ' checked onclick="return false;"' : ''; ?>>
				<span class="Form-fieldIcon" role="presentation"></span><?php echo JText::_('PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER'); ?></label>
			</fieldset>
		<?php endif; ?>

		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
			<fieldset class="Form-field Form-field--choose Grid-cell">
				<label class="Form-label" for="modlgn-remember-<?php echo $module->id; ?>">
				<input type="checkbox" class="Form-input" id="modlgn-remember-<?php echo $module->id; ?>" name="remember">
				<span class="Form-fieldIcon" role="presentation"></span><?php echo JText::_('MOD_LOGIN_REMEMBER_ME'); ?></label>
			</fieldset>
		<?php endif; ?>

		<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
		<?php if ($usersConfig->get('allowUserRegistration')) : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
				<?php echo JText::_('MOD_LOGIN_REGISTER'); ?>
			</a>&nbsp;
			<span class="u-text-r-m Icon Icon-link"></span>
		<?php endif; ?>

		<div class="Form-field Grid-cell u-textRight">
			<button type="submit" class="Button Button--default u-text-xs"><?php echo JText::_('JLOGIN'); ?></button>
		</div>

		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>

	<?php if ($params->get('posttext')) : ?>
		<div class="Prose Alert Alert--info">
			<p<?php echo ($module->position == 'footer') ? ' class="u-color-white"' : ''; ?>><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>

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


JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

$trusted = (JPluginHelper::isEnabled('twofactorauth', 'trust')
		&& PlgTwofactorauthTrust::isActive()
		&& PlgTwofactorauthTrust::checkCookie());

JText::script('TPL_ITALIAPA_UNTRUST_THIS_BROWSER');
?>

<div class="login<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="u-text-r-l u-padding-r-bottom">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post"
		class="form-validate form-horizontal well Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose">

		<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
		<div class="Prose Alert Alert--info">
		<?php endif; ?>

			<?php if ($this->params->get('logindescription_show') == 1) : ?>
				<p><?php echo $this->params->get('login_description'); ?></p>
			<?php endif; ?>

			<?php if ($this->params->get('login_image') != '') : ?>
				<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT'); ?>"/>
			<?php endif; ?>

		<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
		</div>
		<?php endif; ?>

		<fieldset class="Form-fieldset">
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>" class="u-floatRight">
			<?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?>
			<span class="u-text-r-m Icon Icon-link"></span>
			</a>
			<?php
			$username = $this->form->getField('username');
			$username->class = 'Form-input ' . $username->class;
			echo $username->renderField();
			?>

			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>" class="u-floatRight">
			<?php echo JText::_('COM_USERS_LOGIN_RESET'); ?>
			<span class="u-text-r-m Icon Icon-link"></span>
			</a>
			<?php
			$password = $this->form->getField('password');
			$password->class = 'Form-input ' . $password->class;
			echo $password->renderField();

			if ($this->tfa) :
			/*
				$secretkey = $this->form->getField('secretkey');
				$secretkey->class = 'Form-input ' . $secretkey->class;
				$secretkey->readonly = 'readonly';
				$secretkey->placeholder = JText::_('PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER');
				JFactory::getApplication()->enqueueMessage('<pre>'.print_r($secretkey, true).'</pre>');
				echo '<div class="Form-field">' . $secretkey->renderField() . '</div>';
			*/
			?>
				<div class="Form-field">
					<div class="control-group">
						<div class="control-label">
							<?php if ($trusted) : ?>
								<div class="u-floatRight">
									<a href="#" class="2fa-untrust">
										<?php echo JText::_('TPL_ITALIAPA_UNTRUST_THIS_BROWSER'); ?>
										<svg class="u-text-r-m Icon Icon-unlink" style="margin-right: 0.25em;"><use xlink:href="#Icon-unlink"></use></svg>
										<span class="u-hiddenVisually"><?php echo JText::_('TPL_ITALIAPA_UNTRUST_THIS_BROWSER'); ?></span>
										</a>
								</div>
							<?php endif; ?>
							<label id="secretkey-lbl" for="secretkey" class="Form-label">Secret Key</label>
							<span class="optional">(optional)</span>
						</div>
						<div class="controls">
							<input type="text" name="secretkey" id="secretkey" value="" class="Form-input Form-input" size="25"
							<?php echo $trusted ? 'readonly' : ''; ?>
							placeholder="<?php echo $trusted ? JText::_('PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER') : ''; ?>"
							aria-invalid="false">
						</div>
					</div>
				</div>
			<?php endif; ?>
		</fieldset>

		<?php if (JPluginHelper::isEnabled('twofactorauth', 'trust') && PlgTwofactorauthTrust::isActive()) : ?>
			<fieldset id="form-login-trust" class="Form-field Form-field--choose Grid-cell">
				<label class="Form-label" for="trust">
				<input type="checkbox" class="Form-input" id="trust" name="trust" value="yes"<?php echo $trusted ? ' checked onclick="return false;"' : ''; ?>>
				<span class="Form-fieldIcon" role="presentation"></span><?php echo JText::_('PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER'); ?></label>
			</fieldset>
		<?php endif; ?>

		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
			<fieldset class="Form-field Form-field--choose Grid-cell">
				<label class="Form-label<?php // Form-label--block ?>" for="remember">
					<input type="checkbox" class="Form-input" id="remember" name="remember">
					<span class="Form-fieldIcon" role="presentation"></span> <?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME') ?>
				</label>
			</fieldset>
		<?php endif; ?>

		<?php
		$usersConfig = JComponentHelper::getParams('com_users');
		if ($usersConfig->get('allowUserRegistration')) : ?>
		<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
		<?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?>
		<span class="u-text-r-m Icon Icon-link"></span>
		</a>
		<?php endif; ?>

		<div class="Form-field Grid-cell u-textRight">
			<button type="submit" class="Button Button--default u-text-xs"><?php echo JText::_('JLOGIN'); ?></button>
		</div>
		<?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem'))); ?>
		<input type="hidden" name="clean_return" value="<?php echo $return; ?>" />
		<input type="hidden" name="return" value="<?php echo base64_encode($return); ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>

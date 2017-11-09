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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
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

			if ($this->tfa)
			{
				$secretkey = $this->form->getField('secretkey');
				$secretkey->class = 'Form-input ' . $secretkey->class;
				echo '<div class="Form-field">' . $secretkey->renderField() . '</div>';
			}
			?>
		</fieldset>

		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<fieldset class="Form-field Form-field--choose Grid-cell">
		<label class="Form-label<?php // Form-label--block ?>" for="remember">
		<input type="checkbox" class="Form-input" id="remember">
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
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>

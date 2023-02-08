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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('bootstrap.tooltip');
?>
<div class="profile-edit<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="u-text-r-l u-padding-r-bottom">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<script type="text/javascript">
		Joomla.twoFactorMethodChange = function(e)
		{
			var selectedPane = 'com_users_twofactor_' + jQuery('#jform_twofactor_method').val();

			jQuery.each(jQuery('#com_users_twofactor_forms_container>div'), function(i, el) {
				if (el.id != selectedPane)
				{
					jQuery('#' + el.id).hide(0);
				}
				else
				{
					jQuery('#' + el.id).show(0);
				}
			});
		}
	</script>

	<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save'); ?>" method="post" enctype="multipart/form-data"
		class="form-validate form-horizontal well Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose">
		<?php
		$layout = new JLayoutFile('eshiol.form.renderform', $basePath = null);
		echo $layout->render(['form' => $this->form]);
		?>

		<?php if (count($this->twofactormethods) > 1) : ?>
		<fieldset class="Form-fieldset">
			<legend class="Form-legend"><?php echo JText::_('COM_USERS_PROFILE_TWO_FACTOR_AUTH'); ?></legend>

			<div class="Form-field">
				<div class="control-label">
					<label id="jform_twofactor_method-lbl" for="jform_twofactor_method" class="Form-label hasTooltip"
						   title="<?php echo '<strong>' . JText::_('COM_USERS_PROFILE_TWOFACTOR_LABEL') . '</strong><br />' . JText::_('COM_USERS_PROFILE_TWOFACTOR_DESC'); ?>">
						<?php echo JText::_('COM_USERS_PROFILE_TWOFACTOR_LABEL'); ?>
					</label>
				</div>
				<div class="controls">
					<?php echo JHtml::_('select.genericlist', $this->twofactormethods, 'jform[twofactor][method]', array('onchange' => 'Joomla.twoFactorMethodChange()'), 'value', 'text', $this->otpConfig->method, 'jform_twofactor_method', false); ?>
				</div>
			</div>
			<!--
			<div id="com_users_twofactor_forms_container">
				<?php foreach ($this->twofactorform as $form) : ?>
				<?php $style = $form['method'] == $this->otpConfig->method ? 'display: block' : 'display: none'; ?>
				<div id="com_users_twofactor_<?php echo $form['method']; ?>" style="<?php echo $style; ?>">
					<?php echo $form['form']; ?>
				</div>
				<?php endforeach; ?>
			</div>
			-->
		</fieldset>

		<fieldset class="Form-fieldset">
			<legend class="Form-legend">
				<?php echo JText::_('COM_USERS_PROFILE_OTEPS'); ?>
			</legend>
			<div class="Prose Alert Alert--info Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
				<p class="u-text-p"><?php echo JText::_('COM_USERS_PROFILE_OTEPS_DESC'); ?></p>
			</div>
			<?php if (empty($this->otpConfig->otep)) : ?>
			<div class="Prose Alert Alert--warning Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
				<p class="u-text-p"><?php echo JText::_('COM_USERS_PROFILE_OTEPS_WAIT_DESC'); ?></p>
			</div>
			<?php else : ?>
			<div class="Grid Grid--fit Grid--withGutter u-padding-all-l">
			<?php foreach ($this->otpConfig->otep as $otep) : ?>
			<div class="Grid-cell u-size1of2">
				<div class="u-background-50 u-color-white u-margin-bottom-l u-borderRadius-m u-padding-all-s">
				<?php echo substr($otep, 0, 4); ?>-<?php echo substr($otep, 4, 4); ?>-<?php echo substr($otep, 8, 4); ?>-<?php echo substr($otep, 12, 4); ?>
				</div>
			</div>

			<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</fieldset>
	<?php endif; ?>

		<div class="Form-field Grid-cell u-textRight">
			<button type="submit" class="Button Button--default u-text-xs"><?php echo JText::_('JSUBMIT'); ?></button>
			<button type="button" class="Button Button--default u-text-xs" onclick="location.href='<?php echo JRoute::_(''); ?>';"><?php echo JText::_('JCANCEL'); ?></button>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="profile.save" />
			<input type="hidden" name="return" value="<?php echo base64_decode(JFactory::getApplication()->input->get('return', null, 'base64')); ?>" />
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>

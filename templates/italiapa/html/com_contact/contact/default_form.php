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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

$params             = $this->item->params;
$presentation_style = $params->get('presentation_style');

?>
<?php if ($presentation_style === 'sliders') : ?>
	<?php echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-form')); ?>
	<?php $accordionStarted = true; ?>
	<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('COM_CONTACT_EMAIL_FORM'), 'display-form'); ?>
<?php elseif ($presentation_style === 'tabs') : ?>
	<?php echo JHtml::_('iwt.startTabSet', 'tab-contact', array('active' => 'display-form')); ?>
	<?php $tabSetStarted = true; ?>
	<?php echo JHtml::_('iwt.addTab', 'tab-contact', JText::_('COM_CONTACT_EMAIL_FORM'), 'display-form'); ?>
	<?php echo JHtml::_('iwt.startTabPanel', 'tab-contact', 'display-form'); ?>
<?php elseif ($presentation_style === 'plain') : ?>
	<div class="u-sizeFull u-md-size1of2 u-lg-size1of2">
		<h3 class="u-text-h3"><?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?></h3>
<?php endif; ?>

<div class="contact-form">
	<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs form-validate form-horizontal well">
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<?php if ($fieldset->name === 'captcha' && !$this->captchaEnabled) : ?>
				<?php continue; ?>
			<?php endif; ?>
			<?php $fields = $this->form->getFieldset($fieldset->name); ?>
			<?php if (count($fields)) : ?>
				<fieldset class="Form-fieldset">
					<?php if (isset($fieldset->label) && ($legend = trim(JText::_($fieldset->label))) !== '') : ?>
						<legend class="Form-legend"><?php echo $legend; ?></legend>
					<?php endif; ?>
					<?php foreach ($fields as $field) : ?>
						<?php if (in_array($field->type, array('Spacer'))) : ?>
							<?php $field->class = 'Prose Alert Alert--info ' . $field->class; ?>
						<?php endif; ?>
						<?php echo $field->renderField(); ?>
					<?php endforeach; ?>
				</fieldset>
			<?php endif; ?>
		<?php endforeach; ?>
		<div class="Form-field Grid-cell u-textRight control-group">
			<div class="controls">
				<button class="Button Button--default u-text-xs btn btn-primary validate" type="submit"><?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?></button>
				<input type="hidden" name="option" value="com_contact" />
				<input type="hidden" name="task" value="contact.submit" />
				<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
				<input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
	</form>
</div>

<?php if ($presentation_style == 'sliders') : ?>
	<?php echo JHtml::_('iwt.endSlide'); ?>
<?php elseif ($presentation_style == 'tabs') : ?>
	<?php echo JHtml::_('iwt.endTabPanel'); ?>
<?php elseif ($presentation_style === 'plain') : ?>
	</div>
<?php endif;

<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die();

JFactory::getLanguage()->load('com_contact'/*, JPATH_SITE*/);

?>
<div class="contact-form">
	<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="Form Form--spaced u-padding-all-xl u-text-r-xs form-validate form-horizontal well">
		<?php foreach ($form->getFieldsets() as $fieldset) : ?>
			<?php if ($fieldset->name === 'captcha' && !$captchaEnabled) : ?>
				<?php continue; ?>
			<?php endif; ?>
			<?php $fields = $form->getFieldset($fieldset->name); ?>
			<?php if (count($fields)) : ?>
				<fieldset class="Form-fieldset">
					<?php if (isset($fieldset->label) && ($legend = trim(JText::_($fieldset->label))) !== '') : ?>
						<legend class="Form-legend"><?php echo $legend; ?></legend>
					<?php endif; ?>
					<?php foreach ($fields as $field) : ?>
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
				<input type="hidden" name="return" value="<?php echo $return_page; ?>" />
				<input type="hidden" name="id" value="<?php echo $contact->id; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
	</form>
</div>

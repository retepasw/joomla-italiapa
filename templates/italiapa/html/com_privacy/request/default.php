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

/** @var PrivacyViewRequest $this */

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');

JFactory::getDocument()->addScriptDeclaration("
	jQuery(function ($) {
      $('div.Form-field > select').each(function(i, item) {
          $(item).addClass('Form-input');
      });
	});
");
?>

<div class="request-form<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1 class="u-text-h1 u-margin-r-bottom">
			  	<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<?php if ($this->sendMailEnabled) : ?>
		<form action="<?php echo JRoute::_('index.php?option=com_privacy&task=request.submit'); ?>" method="post" class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose form-validate form-horizontal well">
			<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
				<fieldset class="Form-fieldset">
					<?php if (!empty($fieldset->label)) : ?>
						<legend class="Form-legend"><?php echo JText::_($fieldset->label); ?></legend>
					<?php endif; ?>
					<?php echo $this->form->renderFieldset($fieldset->name); ?>
				</fieldset>
			<?php endforeach; ?>
            <div class="Form-field Grid-cell u-textRight">
                <button type="submit" class="Button Button--default u-text-xs"><?php echo JText::_('JSUBMIT'); ?></button>
            </div>
			<?php echo JHtml::_('form.token'); ?>
		</form>
	<?php else : ?>
		<div class="Prose Alert Alert--warning Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
			<p><?php echo JText::_('COM_PRIVACY_WARNING_CANNOT_CREATE_REQUEST_WHEN_SENDMAIL_DISABLED'); ?></p>
		</div>
	<?php endif; ?>
</div>

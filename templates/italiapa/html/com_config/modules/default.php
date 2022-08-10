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

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.combobox');
JHtml::_('formbehavior.chosen', 'select');

jimport('joomla.filesystem.file');

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$editorText  = false;
$moduleXml   = JPATH_SITE . '/modules/' . $this->item['module'] . '/' . $this->item['module'] . '.xml';

if (JFile::exists($moduleXml))
{
	$xml = simplexml_load_file($moduleXml);

	if (isset($xml->customContent))
	{
		$editorText = true;
	}
}

// If multi-language site, make language read-only
if (JLanguageMultilang::isEnabled())
{
	$this->form->setFieldAttribute('language', 'readonly', 'true');
}

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'config.cancel.modules' || document.formvalidator.isValid(document.getElementById('modules-form')))
		{
			Joomla.submitform(task, document.getElementById('modules-form'));
		}
	}
");
?>

<form class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-size-full form-validate"
	action="<?php echo JRoute::_('index.php?option=com_config'); ?>" method="post" id="modules-form" name="adminForm">

	<fieldset class="Form-fieldset">
		<div class="Grid Grid--fit Grid--withGutter u-padding-all-l">
			<div class="Grid-cell">
				<div class="Form-field">
					<label class="Form-label"><?php echo JText::_('COM_CONFIG_MODULES_MODULE_NAME'); ?></label>
					<input type="text" value="<?php echo $this->item['title']; ?>" class="Form-input" readonly="true">
				</div>
			</div>
			<div class="Grid-cell">
				<div class="Form-field">
					<label class="Form-label"><?php echo JText::_('COM_CONFIG_MODULES_MODULE_TYPE'); ?></label>
					<input type="text" value="<?php echo $this->item['module']; ?>" class="Form-input" readonly="true">
				</div>
			</div>
		</div>

		<?php echo JHtml::_('iwt.startAccordion', 'modules', array('multiselectable'=>true)); ?>

			<?php echo JHtml::_('iwt.addSlide', 'modules', JText::_('COM_CONFIG_MODULES_SETTINGS_TITLE'), 'default'); ?>

				<?php echo $this->form->renderField('title'); ?>

				<div class="Form-field">
					<?php echo $this->form->getLabel('position'); ?>
					<?php echo $this->loadTemplate('positions'); ?>
				</div>

				<?php if (JFactory::getUser()->authorise('core.edit.state', 'com_modules.module.' . $this->item['id'])) : ?>
					<?php echo $this->form->renderField('published'); ?>
				<?php endif ?>

				<?php $field = $this->form->getField('publish_up'); ?>
				<?php $field->class = implode(' ', array_unique(array_merge(explode(' ', $field->class), array('Form-input')))); ?>
				<?php echo $field->renderField(); ?>
				<?php $field = $this->form->getField('publish_down'); ?>
				<?php $field->class = implode(' ', array_unique(array_merge(explode(' ', $field->class), array('Form-input')))); ?>
				<?php echo $field->renderField(); ?>


				<?php $field = $this->form->getField('access'); ?>
				<?php $field->class = implode(' ', array_unique(array_merge(explode(' ', $field->class), array('Form-input')))); ?>
				<?php echo $field->renderField(); ?>

				<?php echo $this->form->renderField('ordering'); ?>

				<?php $field = $this->form->getField('language'); ?>
				<?php $field->class = implode(' ', array_unique(array_merge(explode(' ', $field->class), array('Form-input')))); ?>
				<?php echo $field->renderField(); ?>

				<?php echo $this->form->renderField('note'); ?>
			<?php echo JHtml::_('iwt.endSlide'); ?>

<?php /**

						<?php if ($editorText) : ?>
							<div class="tab-pane" id="custom">
								<?php echo $this->form->getInput('content'); ?>
							</div>
						<?php endif; ?>
					</fieldset>
				</div>


			</div>

		</div>
		<!-- End Content -->
	</div>
**/ ?>

		<?php echo JHtml::_('iwt.startAccordion', 'modules', array('multiselectable'=>true)); ?>
			<?php echo $this->loadTemplate('options'); ?>
		<?php echo JHtml::_('iwt.endAccordion'); ?>
	</fieldset>

	<input type="hidden" name="id" value="<?php echo $this->item['id']; ?>" />
	<input type="hidden" name="return" value="<?php echo JFactory::getApplication()->input->get('return', null, 'base64'); ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>

	<div class="Grid Grid--fit Grid--withGutter u-padding-all-l" role="toolbar" aria-label="<?php echo JText::_('JTOOLBAR'); ?>">
		<div class="Grid-cell u-textCenter">
			<button type="button" class="Button Button--default u-text-r-xs" onclick="Joomla.submitbutton('config.save.modules.apply')">
				<span class="icon-ok"></span><?php echo JText::_('JAPPLY') ?>
			</button>
		</div>
		<div class="Grid-cell u-textCenter">
			<button type="button" class="Button Button--default u-text-r-xs" onclick="Joomla.submitbutton('config.save.modules.save')">
				<span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
			</button>
		</div>
		<div class="Grid-cell u-textCenter">
			<button type="button" class="Button Button--danger u-text-r-xs" onclick="Joomla.submitbutton('config.cancel.modules')">
				<span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
	</div>
</form>

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

JHtml::_('behavior.tabstate');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

JHtml::_('formbehavior.chosen', '#jform_catid', null, array('disable_search_threshold' => 1));
JHtml::_('formbehavior.chosen', '#jform_tags', null, array('placeholder_text_multiple' => JText::_('JGLOBAL_TYPE_OR_SELECT_SOME_TAGS')));
JHtml::_('formbehavior.chosen', 'select');

$this->tab_name = 'com-content-form';
$this->ignore_fieldsets = array('image-intro', 'image-full', 'jmetadata', 'item_associations');

// Create shortcut to parameters.
$params = $this->state->get('params');

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);

if (!$editoroptions)
{
	$params->show_urls_images_frontend = '0';
}

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'article.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
		{
			" . $this->form->getField('articletext')->save() . "
			Joomla.submitform(task);
		}
	}
");

// Iterate through the form fieldsets and display each one.
foreach ($this->form->getFieldsets() as $fieldset)
{
	$fields = $this->form->getFieldset($fieldset->name);
	if (count($fields))
	{
		// Iterate through the fields in the set and display them.
		foreach ($fields as &$field)
		{
			// If the field is hidden, just display the input.
			if (!in_array($field->type, ['Spacer', 'Captcha']))
			{
				$field->class = 'Form-input ' . $field->class;
			}
		}
	}
}
?>
<div class="edit item-page<?php echo $this->pageclass_sfx; ?>">
	<?php if ($params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<form class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-size-full" action="<?php echo JRoute::_('index.php?option=com_content&a_id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical">
		<fieldset class="Form-fieldset">
			<div class="Accordion Accordion--default fr-accordion js-fr-accordion" id="accordion-<?php echo $this->tab_name; ?>">

				<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-<?php echo $this->tab_name; ?>-editor" aria-expanded="true">
					<span class="Accordion-link"><?php echo JText::_('COM_CONTENT_ARTICLE_CONTENT'); ?></span>
				</h2>
				<div id="accordion-panel-<?php echo $this->tab_name; ?>-editor" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
				<?php echo $this->form->renderField('title'); ?>

				<?php if (is_null($this->item->id)) : ?>
					<?php echo $this->form->renderField('alias'); ?>
				<?php endif; ?>

				<?php echo $this->form->getInput('articletext'); ?>

				<?php if ($this->captchaEnabled) : ?>
					<?php echo $this->form->renderField('captcha'); ?>
				<?php endif; ?>
				</div>

				<?php if ($params->get('show_urls_images_frontend')) : ?>
				<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-<?php echo $this->tab_name; ?>-images">
					<span class="Accordion-link"><?php echo JText::_('COM_CONTENT_IMAGES_AND_URLS'); ?></span>
				</h2>
				<div id="accordion-panel-<?php echo $this->tab_name; ?>-images" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
					<?php echo $this->form->renderField('image_intro', 'images'); ?>
					<?php echo $this->form->renderField('image_intro_alt', 'images'); ?>
					<?php echo $this->form->renderField('image_intro_caption', 'images'); ?>
					<?php echo $this->form->renderField('float_intro', 'images'); ?>
					<?php echo $this->form->renderField('image_fulltext', 'images'); ?>
					<?php echo $this->form->renderField('image_fulltext_alt', 'images'); ?>
					<?php echo $this->form->renderField('image_fulltext_caption', 'images'); ?>
					<?php echo $this->form->renderField('float_fulltext', 'images'); ?>
					<?php echo $this->form->renderField('urla', 'urls'); ?>
					<?php echo $this->form->renderField('urlatext', 'urls'); ?>
					<div class="control-group">
						<div class="controls">
							<?php echo $this->form->getInput('targeta', 'urls'); ?>
						</div>
					</div>
					<?php echo $this->form->renderField('urlb', 'urls'); ?>
					<?php echo $this->form->renderField('urlbtext', 'urls'); ?>
					<div class="control-group">
						<div class="controls">
							<?php echo $this->form->getInput('targetb', 'urls'); ?>
						</div>
					</div>
					<?php echo $this->form->renderField('urlc', 'urls'); ?>
					<?php echo $this->form->renderField('urlctext', 'urls'); ?>
					<div class="control-group">
						<div class="controls">
							<?php echo $this->form->getInput('targetc', 'urls'); ?>
						</div>
					</div>
				</div>
				<?php endif; ?>

			<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

				<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-<?php echo $this->tab_name; ?>-publishing">
					<span class="Accordion-link"><?php echo JText::_('COM_CONTENT_PUBLISHING'); ?></span>
				</h2>
				<div id="accordion-panel-<?php echo $this->tab_name; ?>-publishing" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
				<?php echo $this->form->renderField('catid'); ?>
				<?php echo $this->form->renderField('tags'); ?>
				<?php if ($params->get('save_history', 0)) : ?>
					<?php echo $this->form->renderField('version_note'); ?>
				<?php endif; ?>
				<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
					<?php echo $this->form->renderField('created_by_alias'); ?>
				<?php endif; ?>
				<?php if ($this->item->params->get('access-change')) : ?>
					<?php echo $this->form->renderField('state'); ?>
					<?php echo $this->form->renderField('featured'); ?>
					<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
						<?php echo $this->form->renderField('publish_up'); ?>
						<?php echo $this->form->renderField('publish_down'); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php echo $this->form->renderField('access'); ?>
				<?php if (is_null($this->item->id)) : ?>
					<div class="control-group">
						<div class="control-label">
						</div>
						<div class="controls">
							<?php echo JText::_('COM_CONTENT_ORDERING'); ?>
						</div>
					</div>
				<?php endif; ?>
				</div>

				<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-<?php echo $this->tab_name; ?>-language">
					<span class="Accordion-link"><?php echo JText::_('JFIELD_LANGUAGE_LABEL'); ?></span>
				</h2>
				<div id="accordion-panel-<?php echo $this->tab_name; ?>-language" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
				<?php echo $this->form->renderField('language'); ?>
				</div>

			<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
				<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-<?php echo $this->tab_name; ?>-metadata">
					<span class="Accordion-link"><?php echo JText::_('COM_CONTENT_METADATA'); ?></span>
				</h2>
				<div id="accordion-panel-<?php echo $this->tab_name; ?>-metadata" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
					<?php echo $this->form->renderField('metadesc'); ?>
					<?php echo $this->form->renderField('metakey'); ?>
				</div>
			<?php endif; ?>

			</div>

			<input type="hidden" name="task" value="" />
			<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
		<div class="Grid Grid--fit Grid--withGutter u-padding-all-l">
			<div class="Grid-cell">
				<button type="button" class="Button Button--default u-text-r-xs" onclick="Joomla.submitbutton('article.save')">
					<span class="Icon-ok"></span><?php echo JText::_('JSAVE') ?>
				</button>
			</div>
			<div class="Grid-cell">
				<button type="button" class="Button Button--danger u-text-r-xs" onclick="Joomla.submitbutton('article.cancel')">
					<span class="Icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
				</button>
			</div>
			<?php if ($params->get('save_history', 0) && $this->item->id) : ?>
			<div class="Grid-cell">
				<?php echo $this->form->getInput('contenthistory'); ?>
			</div>
			<?php endif; ?>
		</div>
	</form>
</div>

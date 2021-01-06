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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

// Load tooltips behavior
JHtml::_('behavior.formvalidator');
JHtml::_('bootstrap.tooltip');
JHtml::_('formbehavior.chosen', 'select');

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'config.cancel' || document.formvalidator.isValid(document.getElementById('application-form'))) {
			Joomla.submitform(task, document.getElementById('application-form'));
		}
	}
");
?>

<form class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-size-full form-validate"
	action="<?php echo JRoute::_('index.php?option=com_config'); ?>" method="post" id="application-form" name="adminForm">

	<fieldset class="Form-fieldset">
		<?php echo JHtml::_('iwt.startAccordion', 'config', array('multiselectable'=>true)); ?>
			<?php echo $this->loadTemplate('site'); ?>
			<?php echo $this->loadTemplate('metadata'); ?>
			<?php echo $this->loadTemplate('seo'); ?>
		<?php echo JHtml::_('iwt.endAccordion'); ?>
	</fieldset>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>

	<div class="Grid Grid--fit Grid--withGutter u-padding-all-l" role="toolbar" aria-label="<?php echo JText::_('JTOOLBAR'); ?>">
		<div class="Grid-cell">
			<button type="button" class="Button Button--default u-text-r-xs" onclick="Joomla.submitbutton('config.save.config.apply')">
				<span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
			</button>
		</div>
		<div class="Grid-cell">
			<button type="button" class="Button Button--danger u-text-r-xs" onclick="Joomla.submitbutton('config.cancel')">
				<span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
	</div>
</form>

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

JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');

$user = JFactory::getUser();

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'config.cancel' || document.formvalidator.isValid(document.getElementById('templates-form')))
		{
			Joomla.submitform(task, document.getElementById('templates-form'));
		}
	}
");
?>

<form class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-size-full form-validate"
	action="<?php echo JRoute::_('index.php?option=com_config'); ?>" method="post" id="templates-form" name="adminForm">

	<fieldset class="Form-fieldset">
		<?php echo JHtml::_('iwt.startAccordion', 'templates', array('multiselectable'=>true)); ?>
			<?php echo $this->loadTemplate('options'); ?>
		<?php echo JHtml::_('iwt.endAccordion'); ?>
	</fieldset>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>

	<div class="Grid Grid--fit Grid--withGutter u-padding-all-l" role="toolbar" aria-label="<?php echo JText::_('JTOOLBAR'); ?>">
		<div class="Grid-cell">
			<button type="button" class="Button Button--default u-text-r-xs" onclick="Joomla.submitbutton('config.save.templates.apply')">
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

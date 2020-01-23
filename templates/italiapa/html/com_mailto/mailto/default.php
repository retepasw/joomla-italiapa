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
defined('_JEXEC') or die();

JHtml::_('behavior.core');
JHtml::_('behavior.keepalive');

?>
<div id="mailto-window">
	<a class="u-floatRight u-linkClean" href="#"
		onclick="window.close();return false;"><span
		class="u-text-r-m Icon Icon-close"></span>
		<span class="u-hidden"><?php echo JText::_('COM_MAILTO_CLOSE_WINDOW') ?></span>
		</a>
	<h2 class="u-text-h3">
		<?php echo JText::_('COM_MAILTO_EMAIL_TO_A_FRIEND'); ?>
	</h2>
	<form
		action="<?php echo JRoute::_('index.php?option=com_mailto&task=send&tmpl=component&template=italiapa'); ?>"
		method="post"
		class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose form-validate">
		<fieldset>
			<?php foreach ($this->form->getFieldset('') as $field) : ?>
				<?php if (!$field->hidden) : ?>
					<?php echo $field->renderField(); ?>
				<?php endif; ?>
			<?php endforeach; ?>

			<div class="Form-field Grid-cell u-textRight">
				<button type="submit" class="Button Button--default u-text-xs">
					<?php echo JText::_('COM_MAILTO_SEND'); ?>
				</button>
				<button type="button" class="Button Button--danger u-text-xs"
					onclick="window.close();return false;">
						<?php echo JText::_('COM_MAILTO_CANCEL'); ?>
				</button>
			</div>
		</fieldset>
		<input type="hidden" name="layout"
			value="<?php echo htmlspecialchars($this->getLayout(), ENT_COMPAT, 'UTF-8'); ?>" />
		<input type="hidden" name="option" value="com_mailto" /> <input
			type="hidden" name="task" value="send" /> <input type="hidden"
			name="tmpl" value="component" /> <input type="hidden" name="link"
			value="<?php echo $this->link; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>

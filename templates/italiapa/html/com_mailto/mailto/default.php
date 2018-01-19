<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

JHtml::_('behavior.core');
JHtml::_('behavior.keepalive');

JHtml::_('behavior.framework', true);

$data = $this->get('data');

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(pressbutton)
	{
		var form = document.getElementById('mailtoForm');

		// do field validation
		if (form.mailto.value == '' || form.from.value == '')
		{
			alert('" . JText::_('COM_MAILTO_EMAIL_ERR_NOINFO', true) . "');
			return false;
		}
		form.submit();
	}
");

//JFactory::getDocument()->addStyleSheet($this->baseurl . '/templates/' . JFactory::getApplication()->input->getString('template') . '/build/build.css');

?>
<div id="mailto-window">
	<form class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose" action="<?php echo JUri::base(); ?>index.php" id="mailtoForm" method="post">
    	<div class="Prose Alert Alert--info">
            <p><?php echo JText::_('COM_MAILTO_EMAIL_TO_A_FRIEND'); ?></p>
        </div>
		<fieldset class="Form-fieldset">
    		<div class="Form-field">
                <label class="Form-label is-required" for="mailto_field"><?php echo JText::_('COM_MAILTO_EMAIL_TO'); ?>*</label>
    			<input type="text" id="mailto_field" name="mailto" class="Form-input" size="25" value="<?php echo $this->escape($data->mailto); ?>" aria-required="true"/>
    		</div>
    		<div class="Form-field">
                <label class="Form-label is-required" for="sender_field"><?php echo JText::_('COM_MAILTO_SENDER'); ?></label>
    			<input type="text" id="sender_field" name="sender" class="Form-input" size="25" value="<?php echo $this->escape($data->sender); ?>"/>
    		</div>
    		<div class="Form-field">
                <label class="Form-label is-required" for="from_field"><?php echo JText::_('COM_MAILTO_YOUR_EMAIL'); ?>*</label>
    			<input type="text" id="from_field" name="from" class="Form-input" size="25" value="<?php echo $this->escape($data->from); ?>" aria-required="true"/>
    		</div>
    		<div class="Form-field">
                <label class="Form-label is-required" for="subject_field"><?php echo JText::_('COM_MAILTO_SUBJECT'); ?></label>
    			<input type="text" id="subject_field" name="subject" class="Form-input" size="25" value="<?php echo $this->escape($data->subject); ?>"/>
    		</div>
		</fieldset>
		
		<div class="Grid Grid--fit Grid--withGutter u-padding-all-l">
			<div class="Grid-cell">
				<button type="button" class="Button Button--default u-text-r-xs" onclick="return Joomla.submitbutton('send');">
					<span class="icon-ok"></span><?php echo JText::_('COM_MAILTO_SEND') ?>
				</button>
			</div>
			<div class="Grid-cell">
				<button type="button" class="Button Button--danger u-text-r-xs" onclick="window.close();return false;">
					<span class="icon-cancel"></span><?php echo JText::_('COM_MAILTO_CANCEL') ?>
				</button>
			</div>
		</div>

		<input type="hidden" name="layout" value="<?php echo htmlspecialchars($this->getLayout(), ENT_COMPAT, 'UTF-8'); ?>" />
		<input type="hidden" name="option" value="com_mailto" />
		<input type="hidden" name="task" value="send" />
		<input type="hidden" name="tmpl" value="component" />
		<input type="hidden" name="link" value="<?php echo $data->link; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>

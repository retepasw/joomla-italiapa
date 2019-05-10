<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

JHtml::_('behavior.core');
JHtml::_('behavior.polyfill', array('event'), 'lt IE 9');
JHtml::_('script', 'com_content/admin-article-pagebreak.min.js', array('version' => 'auto', 'relative' => true));

$document    = JFactory::getDocument();
$this->eName = JFactory::getApplication()->input->getCmd('e_name', '');
$this->eName = preg_replace('#[^A-Z0-9\-\_\[\]]#i', '', $this->eName);

$document->setTitle(JText::_('COM_CONTENT_PAGEBREAK_DOC_TITLE'));
?>
<div class="container-popup">
	<form class="Form Form--spaced u-padding-top-xl u-padding-left-xl u-padding-right-xl u-background-grey-10 u-text-r-xs u-layout-prose">
		<fieldset class="Form-fieldset">
			<div class="Form-field">
				<label for="title" class="Form-label is-required"><?php echo JText::_('COM_CONTENT_PAGEBREAK_TITLE'); ?></label>
				<input class="Form-input" type="text" id="title" name="title" />
			</div>

			<div class="Form-field">
				<label for="alias" class="Form-label is-required"><?php echo JText::_('COM_CONTENT_PAGEBREAK_TOC'); ?></label>
				<input class="Form-input" type="text" id="alt" name="alt" />
			</div>

			<div class="Form-field Grid-cell u-textRight">
				<button type="button" onclick="insertPagebreak('<?php echo $this->eName; ?>');" class="Button Button--default u-text-xs">
					<?php echo JText::_('COM_CONTENT_PAGEBREAK_INSERT_BUTTON'); ?>
				</button>
		    </div>
		</fieldset>
	</form>
</div>

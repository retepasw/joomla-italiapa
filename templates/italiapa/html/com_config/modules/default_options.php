<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$fieldSets = $this->form->getFieldsets('params');
?>

<?php foreach ($fieldSets as $name => $fieldSet) : ?>
	<?php $label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_MODULES_' . $name . '_FIELDSET_LABEL'; ?>
	<?php echo JHtml::_('iwt.addSlide', 'modules', JText::_($label), $name); ?>
		<?php if (isset($fieldSet->description) && trim($fieldSet->description)) : ?>
			<div class="Prose Alert Alert--info">
	    		<p><?php echo $this->escape(JText::_($fieldSet->description)); ?></p>
	  		</div>
  		<?php endif; ?>
		<?php foreach ($this->form->getFieldset($name) as $field) : ?>
			<?php // If multi-language site, make menu-type selection read-only ?>
			<?php if (JLanguageMultilang::isEnabled() && $this->item['module'] === 'mod_menu' && $field->getAttribute('name') === 'menutype') : ?>
				<?php $field->__set('readonly', true); ?>
			<?php endif; ?>
			<?php $field->class = implode(' ', array_unique(array_merge(explode(' ', $field->class), array('Form-input')))); ?>
			<?php echo $field->renderField(); ?>
		<?php endforeach; ?>
	<?php echo JHtml::_('iwt.endSlide'); ?>
<?php endforeach; ?>

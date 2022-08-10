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

// Load chosen.css
JHtml::_('formbehavior.chosen', 'select');

?>
<?php $fieldSets = $this->form->getFieldsets('params'); ?>

<?php if (!empty($fieldSets['com_config'])) : ?>
	<?php echo JHtml::_('iwt.addSlide', 'templates', JText::_('COM_CONFIG_TEMPLATE_SETTINGS'), 'config'); ?>
		<?php foreach ($this->form->getFieldset('com_config') as $field) : ?>
			<?php $field->class = implode(' ', array_unique(array_merge(explode(' ', $field->class), array('Form-input')))); ?>
			<?php echo $field->renderField(); ?>
		<?php endforeach; ?>
	<?php echo JHtml::_('iwt.endSlide'); ?>
<?php else : ?>
	<?php foreach ($fieldSets as $name => $fieldSet) : ?>
		<?php $label = !empty($fieldSet->label) ? $fieldSet->label : 'JGLOBAL_FIELDSET_' . strtoupper($name); ?>
		<?php echo JHtml::_('iwt.addSlide', 'templates', JText::_($label), $name); ?>
			<?php if (isset($fieldSet->description) && trim($fieldSet->description)) : ?>
				<div class="Prose Alert Alert--info">
		    		<p><?php echo $this->escape(JText::_($fieldSet->description)); ?></p>
		  		</div>
	  		<?php endif; ?>
			<?php foreach ($this->form->getFieldset($name) as $field) : ?>
				<?php $field->class = implode(' ', array_unique(array_merge(explode(' ', $field->class), array('Form-input')))); ?>
				<?php echo $field->renderField(); ?>
			<?php endforeach; ?>
		<?php echo JHtml::_('iwt.endSlide'); ?>
	<?php endforeach; ?>
<?php endif;

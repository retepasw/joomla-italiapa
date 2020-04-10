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
?>
<?php echo JHtml::_('iwt.addSlide', 'config', JText::_('COM_CONFIG_SITE_SETTINGS'), 'site'); ?>
	<?php foreach ($this->form->getFieldset('site') as $field) : ?>
		<?php $field->class = implode(' ', array_unique(array_merge(explode(' ', $field->class), array('Form-input')))); ?>
		<?php echo $field->renderField(); ?>
	<?php endforeach; ?>
<?php echo JHtml::_('iwt.endSlide'); ?>

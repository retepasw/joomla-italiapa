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
?>
<div class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose profile<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="u-text-r-l u-padding-r-bottom">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<?php if (JFactory::getUser()->id == $this->data->id) : ?>
	<div class="Form-field Grid-cell u-textRight">
		<button type="button" class="Button Button--default u-text-xs" onclick="location.href='<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id=' . (int) $this->data->id); ?>';"><?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?></button>
	</div>
	<?php endif; ?>

	<?php echo $this->loadTemplate('core'); ?>

	<?php echo $this->loadTemplate('params'); ?>

	<?php echo $this->loadTemplate('custom'); ?>

</div>

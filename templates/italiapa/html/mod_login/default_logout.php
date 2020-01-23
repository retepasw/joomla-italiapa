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

JHtml::_('behavior.keepalive');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical Form Form--spaced u-padding-all-xl u-text-r-xs u-layout-prose<?php echo ($module->position == 'footer') ? '' : '  u-background-grey-10'; ?>">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting Form-field Grid-cell">
	<?php if ($params->get('name') == 0) : ?>
		<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name'), ENT_COMPAT, 'UTF-8')); ?>
	<?php else : ?>
		<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username'), ENT_COMPAT, 'UTF-8')); ?>
	<?php endif; ?>
	</div>
<?php endif; ?>
<?php if ($params->get('profilelink')) : ?>
	<div class="Form-field Grid-cell">
		<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>">
		<?php echo JText::_('MOD_LOGIN_PROFILE'); ?></a> <span class="u-text-r-m Icon Icon-link"></span>
	</div>
<?php endif; ?>

	<div class="logout-button Form-field Grid-cell u-textRight">
		<button type="submit" name="Submit" class="Button Button--default u-text-xs"><?php echo JText::_('JLOGOUT'); ?></button>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

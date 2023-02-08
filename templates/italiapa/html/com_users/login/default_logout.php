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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HtmlHelper::_('behavior.keepalive');
HtmlHelper::_('behavior.formvalidator');
?>

<div class="remind<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="u-text-r-l u-padding-r-bottom">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<form action="<?php echo Route::_('index.php?option=com_users&task=user.logout'); ?>" method="post"
		class="form-horizontal well Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose">

		<?php if (($this->params->get('logoutdescription_show') == 1 && str_replace(' ', '', $this->params->get('logout_description')) != '') || $this->params->get('logout_image') != '') : ?>
		 <div class="Prose Alert Alert--info">
		<?php endif; ?>

			<?php if ($this->params->get('logoutdescription_show') == 1) : ?>
				<p><?php echo $this->params->get('logout_description'); ?></p>
			<?php endif; ?>

			<?php if ($this->params->get('logout_image') != '') : ?>
				<img src="<?php echo $this->escape($this->params->get('logout_image')); ?>" class="logout-image" alt="<?php echo Text::_('COM_USERS_LOGIN_IMAGE_ALT'); ?>"/>
			<?php endif; ?>

		<?php if (($this->params->get('logoutdescription_show') == 1 && str_replace(' ', '', $this->params->get('logout_description')) != '') || $this->params->get('logout_image') != '') : ?>
		</div>
		<?php endif; ?>

		<div class="Form-field Grid-cell u-textRight">
			<button type="submit" class="Button Button--default u-text-xs"><?php echo Text::_('JLOGOUT'); ?></button>
		</div>

		<?php if ($this->params->get('logout_redirect_url')) : ?>
			<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('logout_redirect_url', $this->form->getValue('return'))); ?>" />
		<?php else : ?>
			<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('logout_redirect_menuitem', $this->form->getValue('return'))); ?>" />
		<?php endif; ?>
		<?php echo HtmlHelper::_('form.token'); ?>
	</form>
</div>
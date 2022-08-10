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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>
<div class="reset-complete<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="u-text-r-l u-padding-r-bottom">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_users&task=reset.complete'); ?>" method="post"
		class="form-validate form-horizontal well Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose">
		<?php
		$layout = new JLayoutFile('eshiol.form.renderform', $basePath = null);
		echo $layout->render(['form' => $this->form]);
		?>
		<div class="Form-field Grid-cell u-textRight">
			<button type="submit" class="Button Button--default u-text-xs"><?php echo JText::_('JSUBMIT'); ?></button>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>

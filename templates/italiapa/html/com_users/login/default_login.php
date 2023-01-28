<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2023 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HtmlHelper::_('behavior.keepalive');
HtmlHelper::_('behavior.formvalidator');

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';
?>

<div class="login<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="u-text-r-l u-padding-r-bottom">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<?php
		// Load Joomla Login Form as First (0: None - 1: First - 2: Last)
		if ($this->params->get('login_joomla', 1) == 1)
		{
			ob_start();
			echo $this->loadTemplate('joomla');
			$tabs[] = [
				'label'   => Text::_('TPL_ITALIAPA_LOGIN_CREDENTIALS'),
				'name'    => 'joomla',
				'content' => ob_get_contents()
			];
			ob_end_clean();
		}

		// Load login modules
		foreach (ModuleHelper::getModules('login') AS $module)
		{
			$alias = $module->title;
			$alias = ApplicationHelper::stringURLSafe($alias, $this->language);
			if (trim(str_replace('-', '', $alias)) == '')
			{
				$alias = Factory::getDate()->format('Y-m-d-H-i-s');
			}

			$tabs[] = [
				'label'   => $module->title,
				'name'    => $alias,
				'content' => ModuleHelper::renderModule($module, array())
			];
		}

		// Load Joomla Login Form as Last (0: None - 1: First - 2: Last)
		if ($this->params->get('login_joomla', 1) == 2)
		{
			ob_start();
			echo $this->loadTemplate('joomla');
			$tabs[] = [
				'label'   => Text::_('TPL_ITALIAPA_LOGIN_CREDENTIALS'),
				'name'    => 'joomla',
				'content' => ob_get_contents()
			];
			ob_end_clean();
		}
	?>

	<?php if (count($tabs)) : ?>
		<?php echo HTMLHelper::_('iwt.startTabSet', 'tab-login', array('active' => $tabs[0]['name'])); ?>

		<?php foreach ($tabs as $tab) : ?>
			<?php echo HTMLHelper::_('iwt.addTab', 'tab-login', $tab['label'], $tab['name']); ?>
			<?php echo HTMLHelper::_('iwt.startTabPanel', 'tab-login', $tab['name']); ?>
			<?php echo $tab['content']; ?>
			<?php echo HTMLHelper::_('iwt.endTabPanel'); ?>
		<?php endforeach; ?>

		<?php echo HTMLHelper::_('iwt.endTabSet'); ?>
	<?php else : ?>
		<?php echo $this->loadTemplate('joomla'); ?>
	<?php endif; ?>
</div>

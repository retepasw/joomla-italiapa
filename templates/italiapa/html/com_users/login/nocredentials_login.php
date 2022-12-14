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

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$trusted = (PluginHelper::isEnabled('twofactorauth', 'trust')
		&& PlgTwofactorauthTrust::isActive()
		&& PlgTwofactorauthTrust::checkCookie());

Text::script('TPL_ITALIAPA_UNTRUST_THIS_BROWSER');
?>

<div class="login<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="u-text-r-l u-padding-r-bottom">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

<?php // Load Login tabs ?>
<?php PluginHelper::importPlugin('authentication'); ?>
<?php $tabs = JEventDispatcher::getInstance()->trigger('onAuthenticationAddLoginTab', array()); ?>

<?php if (count($tabs)) : ?>

<?php Factory::getDocument()->addStyleDeclaration('
	#accordion-tab-login .Button {
		border-bottom: 0;
	}
	#accordion-tab-login [aria-selected=true].Button {
		background-color: #f5f5f0!important;
	}
	#accordion-tab-login .Button--info:focus {
		outline: none;
		background-color: #e6e6e6;
	}'); ?>

	<?php echo HTMLHelper::_('iwt.startTabSet', 'tab-login', array('active' => 'spid')); ?>
		<?php foreach ($tabs as $tab) : ?>
			<?php echo HTMLHelper::_('iwt.addTab', 'tab-login', $tab['label'], $tab['name']); ?>
			<?php echo HTMLHelper::_('iwt.startTabPanel', 'tab-login', $tab['name']); ?>
			<?php echo $tab['content']; ?>
			<?php echo HTMLHelper::_('iwt.endTabPanel'); ?>
		<?php endforeach; ?>

	<?php echo HTMLHelper::_('iwt.endTabSet'); ?>
<?php endif; ?>	
</div>

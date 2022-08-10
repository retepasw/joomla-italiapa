<?php
/**
 * @package     Joomla.Site
 * @subpackage  Modules.mod_cookiebar
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Site.Modules.mod_cookiebar  is  free  software. This version may have
 * been modified pursuant to the GNU General Public License, and as distributed
 * it  includes or is derivative of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
?>

<div id="cookie-bar" class="CookieBar js-CookieBar u-background-95 u-padding-r-all" aria-hidden="true">
	<p class="u-color-white u-text-r-xs u-lineHeight-m u-padding-r-bottom"><?php echo $text; ?></p>
	<p>
		<?php if ($params->get('decline', 0)) : ?>
			<button class="Button Button--danger u-text-r-xxs js-cookieBarDecline u-inlineBlock u-margin-r-all"><?php echo JText::_('MOD_COOKIEBAR_DECLINE'); ?></button>
		<?php endif; ?>
		<button class="Button Button--default u-text-r-xxs js-cookieBarAccept u-inlineBlock u-margin-r-all"><?php echo JText::_('MOD_COOKIEBAR_ACCEPT'); ?></button>
		<?php if ($item->id): ?>
			<a href="<?php echo  $item->link; ?>" class="u-text-r-xs u-color-teal-50"><?php echo JText::_('MOD_COOKIEBAR_POLICY'); ?></a>
		<?php endif; ?>
	</p>
</div>


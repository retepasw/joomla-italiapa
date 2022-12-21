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

defined('_JEXEC') or die();

JHtml::_('bootstrap.tooltip');

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$attributes = JHtml::_('iwt.getLinkAttributes', $item, isset($item->attributes) && is_array($item->attributes) ? $item->attributes : array());

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
}
elseif ($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,' . $params->get('window_open');

	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}

unset($attributes['title']);
if (isset($item->anchor_title) && $item->anchor_title)
{
	$attributes['data-tooltip'] = $item->anchor_title;
}

$title = JHtml::_('iwt.linkType', $item) . ($item->deeper ? '<span class="Icon Icon-expand u-padding-left-xs"></span>' : '');

echo JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $title, $attributes);

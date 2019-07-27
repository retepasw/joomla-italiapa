<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('_JEXEC') or die();

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

JHtml::_('bootstrap.tooltip');

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

if ($item->anchor_css)
{
	JLog::add(new JLogEntry('anchor_css: '.print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
	$anchor_css = explode(' ', $item->anchor_css);
	for($i = count($anchor_css) - 1; $i >= 0; $i--)
	{
		if (substr($anchor_css[$i], 0, 4) == 'ipa:')
		{
			if (substr($anchor_css[$i], 4) == 'theme')
			{
				$item->flink = 'javascript:eshiol.italiapa.setTheme(\'' . substr($item->flink, 1)  . '\');';
			}
			unset($anchor_css[$i]);
		}
	}
	$item->anchor_css = (substr($item->anchor_css, 0, 1) == ' ' ? ' ' : '') . implode(' ', $anchor_css);
	JLog::add(new JLogEntry('anchor_css: '.print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
}

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

if ($item->menu_text)
{
	$title = JHtml::_('iwt.linkType', $item) . $item->deeper ? '<span class="Icon Icon-expand u-padding-left-xs"></span>' : '';
}
elseif ($item->menu_image_css)
{
	$title = JHtml::_('iwt.linkType', $item);
}
elseif ($item->deeper)
{
	$title =  '<span class="Icon Icon-expand u-padding-left-xs"></span>';
}
else 
{
	$title = JHtml::_('iwt.linkType', $item);
}

echo JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $title, $attributes);
?>
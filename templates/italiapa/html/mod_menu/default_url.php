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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

if ($item->anchor_css)
{
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
}

$attributes = JHtml::_('iwt.getLinkAttributes', $item);

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
}
elseif ($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,' . $params->get('window_open');

	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}

echo JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), JHtml::_('iwt.linkType', $item), $attributes);

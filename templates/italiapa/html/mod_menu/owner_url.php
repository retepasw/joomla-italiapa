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
JLog::add(new JLogEntry($module->position, JLog::DEBUG, 'tpl_italiapa'));

$attributes = array();

if ($item->anchor_title)
{
	$attributes['title'] = $item->anchor_title;
	$linktype = '<span class="u-inline u-md-hidden u-lg-hidden u-sm-hidden">' . $item->title .
			 '</span><span class="u-hidden u-md-inline u-lg-inline u-sm-inline">' . $item->anchor_title . '</span>';
}
else
{
	$linktype = $item->title;
}

if ($item->anchor_css)
{
	$attributes['class'] = $item->anchor_css;
}

if ($item->anchor_rel)
{
	$attributes['rel'] = $item->anchor_rel;
}

if ($item->menu_image)
{
	if ($item->menu_image_css)
	{
		$image_attributes['class'] = $item->menu_image_css;
		$linktype = JHtml::_('image', $item->menu_image, $item->title, $image_attributes);
	}
	else
	{
		$linktype = JHtml::_('image', $item->menu_image, $item->title);
	}
	
	if ($item->params->get('menu_text', 1))
	{
		$linktype .= '<span class="image-title">' . $item->title . '</span>';
	}
}

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
	$attributes['rel'] = 'noopener noreferrer';
	
	if ($item->anchor_rel == 'nofollow')
	{
		$attributes['rel'] .= ' nofollow';
	}
}
elseif ($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,' . $params->get('window_open');
	
	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}

echo JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);

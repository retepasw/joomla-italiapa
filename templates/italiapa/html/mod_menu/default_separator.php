<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$title      = $item->anchor_title ? ' title="' . $item->anchor_title . '"' : '';

$icon = '';
if ($item->anchor_css)
{
	JLog::add(new JLogEntry('anchor_css: '.print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
	$anchor_css = explode(' ', $item->anchor_css);
	for($i = 0; $i < count($anchor_css); $i++)
	{
		if (substr($anchor_css[$i], 0, 4) == 'Icon')
		{
			$icon = $icon . ' ' . $anchor_css[$i];
			unset($anchor_css[$i]);
		}
	}
	$item->anchor_css = (substr($item->anchor_css, 0, 1) == ' ' ? ' ' : '') . implode(' ', $anchor_css);
	JLog::add(new JLogEntry('anchor_css: '.print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
	JLog::add(new JLogEntry('icon: '.$icon, JLog::DEBUG, 'tpl_italiapa'));
}

$linktype   = ($icon ? '<span class="' . substr($icon, 1) . '"></span> ' : '') . $item->title;

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

?>
<a href>
<span class="separator <?php echo $item->anchor_css; ?>"<?php echo $title; ?>><?php echo $linktype; ?></span>
</a>

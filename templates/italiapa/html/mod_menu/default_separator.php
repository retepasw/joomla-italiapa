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

$title = $item->anchor_title ? ' title="' . $item->anchor_title . '"' : '';

$icon = '';
if ($item->anchor_css)
{
	JLog::add(new JLogEntry('anchor_css: ' . print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
	$anchor_css = explode(' ', $item->anchor_css);
	for ($i = count($anchor_css) - 1; $i >= 0; $i --)
	{
		if (substr($anchor_css[$i], 0, 4) == 'Icon')
		{
			$icon = $icon . ' ' . $anchor_css[$i];
			unset($anchor_css[$i]);
		}
	}
	$item->anchor_css = (substr($item->anchor_css, 0, 1) == ' ' ? ' ' : '') . implode(' ', $anchor_css);
	JLog::add(new JLogEntry('anchor_css: ' . print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
	JLog::add(new JLogEntry('icon: ' . $icon, JLog::DEBUG, 'tpl_italiapa'));
}

if ($icon && ! $item->menu_image)
{
	$icon .= ' ' . $item->menu_image_css;
	$item->menu_image_css = '';
}

$linktype = ($icon ? '<span class="' . trim($icon) . '"></span> ' : '') . $item->title;

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
<a href> <span class="separator <?php echo $item->anchor_css; ?>"
	<?php echo $title; ?>><?php echo $linktype; ?></span>
</a>

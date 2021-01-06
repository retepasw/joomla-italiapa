<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('_JEXEC') or die();

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$title      = $item->anchor_title ? ' title="' . $item->anchor_title . '"' : '';
$anchor_css = $item->anchor_css ? ' ' . $item->anchor_css : '';

if ($item->level == 1)
{
	$linktype = '|';
}
elseif ($item->level == 2)
{
	$linktype   = $item->title;
	$anchor_css .= ' u-visibilityHidden';

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
}
else
{
	$linktype = '<hr/>';
}

$linktype   = $item->title;

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
<span class="separator<?php echo $anchor_css; ?>"<?php echo $title; ?>><?php echo $linktype; ?></span>

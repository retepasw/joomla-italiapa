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

defined('_JEXEC') or die;

JHtml::_('bootstrap.popover');

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
JLog::add(new JLogEntry($module->position, JLog::DEBUG, 'tpl_italiapa'));

function hierarchical_array_from_array ($farray)
{
	$tree = array();
	$nodes = array();

	foreach ($farray as $node)
	{
		$node->child = array();
		$node->cols = 1;
		$node->depth = 1;
		//		$node->grandchild = array();
		if (!array_key_exists($node->parent_id, $nodes))
		{
			$tree[$node->id] = $node;
			$nodes[$node->id] = $node;
		}
		else
		{
			$nodes[$node->parent_id]->child[] = $node;
			$nodes[$node->parent_id]->depth = max(array_map(function($o) { return $o->depth; }, $nodes[$node->parent_id]->child)) + 1;

			if (($node->type == 'separator') && ($node->anchor_css == 'megacolumn'))
			{
				$nodes[$node->parent_id]->cols = $nodes[$node->parent_id]->cols + 1;
			}

			$nodes[$node->id] = $node;
		}
	}

	return $tree;
}

$menu = hierarchical_array_from_array($list);

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}

ob_start();
?>

<div class="Megamenu Megamenu--default js-megamenu">
<ul class="Megamenu-list Megamenu<?php echo $class_sfx; ?>"<?php echo $id; ?>>
<?php 
$buffer = ob_get_flush();
JLog::add(new JLogEntry($buffer, JLog::DEBUG, 'tpl_italiapa'));

$parent_id = 0;
foreach ($list as $i => &$item)
{
	$item->level = $item->level - $params->get('startLevel', 1) + 1;
	JLog::add(new JLogEntry(print_r($item, true), JLog::DEBUG, 'tpl_italiapa'));

	ob_start();

	$class = ' item-' . $item->id;
	$subclass = '';

	if ($item->id == $default_id)
	{
		$class .= ' default';
	}

	if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type === 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' deeper';
	}

	if ($item->parent)
	{
		$class .= ' parent';
	}

	$icon = '';
	$columns = '';
	if ($item->anchor_css)
	{
		$anchor_css = explode(' ', $item->anchor_css);
		for($i = count($anchor_css) - 1; $i >= 0; $i--)
		{
			if (substr($anchor_css[$i], 0, 3) == 'li:')
			{
				$subclass = substr($anchor_css[$i], 3) . ' ' . $subclass;
				unset($anchor_css[$i]);
			}
			elseif (substr($anchor_css[$i], 0, 12) == 'ipa:columns-')
			{
				$columns = substr($anchor_css[$i], 12);
				unset($anchor_css[$i]);
			}
		}
		$item->anchor_css = (substr($item->anchor_css, 0, 1) == ' ' ? ' ' : '') . implode(' ', $anchor_css);
		JLog::add(new JLogEntry('anchor_css: '.print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
	}

	if (!$item->anchor_css)
	{
		$class = 'Megamenu-item' . $class;
	}

	if (preg_match_all('/(^|\s)Icon-/', $item->menu_image_css, $matches, PREG_SET_ORDER, 0))
	{
		$icon = '';
		$svg = '';
		$menu_image_css = explode(' ', $item->menu_image_css);
		for ($i = count($menu_image_css) - 1; $i >= 0; $i --)
		{
			if (substr($menu_image_css[$i], 0, 5) == 'Icon-')
			{
				if (file_exists(JPATH_SITE . '/templates/italiapa/src/icons/img/SVG/' . substr($menu_image_css[$i], 5) . '.svg'))
				{
					$svg .= ' ' . $menu_image_css[$i];
				}
				else
				{
					$icon .= ' ' . $menu_image_css[$i];
				}
				unset($menu_image_css[$i]);
			}
		}
		$item->menu_image_css = implode(' ', $menu_image_css);

		if ($svg)
		{
			$icon = '<svg class="' . trim($icon . ' ' . $item->menu_image_css) . '"><use xlink:href="#' . trim($svg) . '"></use></svg>';
		}
		elseif ($icon)
		{
			$icon = '<span class="' . trim($icon . ' ' . $item->menu_image_css) . '"></span>';
		}
	}

	JLog::add(new JLogEntry('class: '.$class, JLog::DEBUG, 'tpl_italiapa'));
	JLog::add(new JLogEntry('subclass: '.$subclass, JLog::DEBUG, 'tpl_italiapa'));
	JLog::add(new JLogEntry('icon: '.$icon, JLog::DEBUG, 'tpl_italiapa'));

	if ($item->level == 1)
	{
		echo '<li' . ($class || $subclass ? ' class="' . $class . ' ' . $subclass . '"' : '') .
			(!$item->deeper ? ' role="presentation"' : '') .
			($item->type == 'separator' ? ' role="presentation"' : '') . 
			'>';
	}
	elseif ($item->level == 2)
	{
		if (($item->deeper) || ($menu[$item->parent_id]->depth > 2))
		{
			echo '<ul class="Megamenu-subnavGroup' . (!empty($columns) ? ' columns" data-columns="' . $columns : '') . '">';
		}
		elseif ($item->parent_id != $parent_id)
		{
			echo '<ul' . (!empty($columns) ? ' class="columns" data-columns="' . $columns . '"' : '') . '>';
			$parent_id = $item->parent_id;
		}
		echo '<li' . ($subclass ? ' class="' . $subclass . '"' : '') . '>';
	}
	else 
	{
		echo '<li' . ($subclass ? ' class="' . $subclass . '"' : '') . '>';
	}
	if ($icon)
	{
		echo $icon;
	}

	switch ($item->type) :
		case 'separator':
		case 'heading':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			break;

		case 'url':
		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		if ($item->level == 1)
		{
			echo '<div class="Megamenu-subnav">';
		}
		else 
		{
			echo '<ul>';
		}
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		for ($i = 0, $l = $item->level; $i < $item->level_diff; $i++, $l--)
		{
			if ($l == 3)
			{
				echo '</ul></li></ul>';
			}
			elseif ($l == 2)
			{
				echo '</div></li>';
			}
			else
			{
				echo '</ul></li>';
			}
		}
	}
	// The next item is on the same level.
	elseif ($item->level == 2)
	{
		echo '</li>';
		if (($item->shallower) || ($menu[$item->parent_id]->depth > 2))
		{
			echo '</ul>';
		}
	}
	else
	{
		echo '</li>';
	}

	$buffer = ob_get_flush();
	JLog::add(new JLogEntry($buffer, JLog::DEBUG, 'tpl_italiapa'));
}
ob_start();
?>
</ul>
</div>
<?php
$buffer = ob_get_flush();
JLog::add(new JLogEntry($buffer, JLog::DEBUG, 'tpl_italiapa'));

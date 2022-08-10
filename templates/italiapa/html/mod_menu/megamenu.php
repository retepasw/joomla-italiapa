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

JHtml::_('bootstrap.popover');

if (!function_exists('hierarchical_array_from_array'))
{
	function hierarchical_array_from_array (&$farray, &$nodes, $level = 1)
	{
		$tree  = array();
		$level--;
		foreach ($farray as &$node)
		{
			$node->child = array();
			$node->cols = 1;
			$node->level -= $level;
			$node->footer = false;

			if (array_key_exists($node->parent_id, $nodes))
			{
				$nodes[$node->parent_id]->child[] = $node;
				if ($node->anchor_css)
				{
					$anchor_css = explode(' ', $node->anchor_css);
					for($i = count($anchor_css) - 1; $i >= 0; $i--)
					{
						if (substr($anchor_css[$i], 0, 8) == 'columns-')
						{
							$node->cols = substr($anchor_css[$i], 8);
						}
						elseif (($node->type == 'separator') && ($anchor_css[$i] == 'column-break'))
						{
							$nodes[$node->parent_id]->cols = $nodes[$node->parent_id]->cols + 1;
						}
						elseif (($node->type == 'separator') && ($anchor_css[$i] == 'footer'))
						{
							$node->footer = true;
						}
										}
				}
				$nodes[$node->id] = $node;
			}
			elseif ($node->level == 1)
			{
				$tree[$node->id] = $node;
				$nodes[$node->id] = $node;
			}
			else
			{
				$node->access = 0;
			}
		}
			return $tree;
	}
}

$nodes = array();
$menu = hierarchical_array_from_array($list, $nodes, $params->get('startLevel', 1));

if (!function_exists('megamenu'))
{
	function megamenu($menu, $nodes, $options)
	{
		$default_id = $options['default_id'];
		$active_id = $options['active_id'];
		$path = $options['path'];

		foreach ($menu as $i => $item)
		{
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
			$columns = $item->cols;
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
					elseif ($anchor_css[$i] == 'column-break')
					{
						$subclass = 'column-break ' . $subclass;
						unset($anchor_css[$i]);
					}
				}
				$item->anchor_css = (substr($item->anchor_css, 0, 1) == ' ' ? ' ' : '') . implode(' ', $anchor_css);
			}
			$class = 'Megamenu-item' . $class;
			if ($item->level == 1)
			{
				$class = ($class || $subclass ? ' class="' . $class . ' ' . $subclass . '"' : '');
			}
			elseif ($item->level == 2)
			{
				if (!$item->footer)
				{
					echo '<ul class="Megamenu-subnavGroup' . ($item->cols > 1 ? ' columns" data-columns="' . $item->cols : '') . '">';
				}
				elseif ($item->cols > 1)
				{
					echo '<ul class="columns" data-columns="' . $item->cols . '">';
				}
				else
				{
					echo '<ul>';
				}
				$class = $subclass ? ' class="' . $subclass . '"' : '';
			}
			else
			{
				$class = $subclass ? ' class="' . $subclass . '"' : '';
			}
			echo '<li' . $class . '>';
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
			if ($item->child) 
			{
				if ($item->level == 1)
				{
					echo '<div class="Megamenu-subnav">';
				}
				elseif ($item->footer)
				{
					$c = 0;
					foreach ($nodes[$item->parent_id]->child as $child)
					{
						$c += $child->cols;
					}
					echo '<ul class="u-before' . ($c - 1) . 'of' . $c . '">';
				}
				else
				{
					echo '<ul>';
				}
				megamenu($item->child, $nodes, $options);
				if ($item->level == 1)
				{
					echo '</div>';
				}
				else
				{
					echo '</ul>';
				}
			}
			echo '</li>';
			if ($item->level == 2)
			{
				echo '</ul>';
			}
		}
	}
}
?>

<?php $id = ($tagId = $params->get('tag_id', '')) ? ' id="' . $tagId . '"' : ''; ?>

<div class="Megamenu Megamenu--default js-megamenu">
  <ul class="Megamenu-list Megamenu">
	<?php megamenu($menu, $nodes, ['default_id' => $default_id, 'active_id' => $active_id, 'path' => $path]); ?>
  </ul>
</div>

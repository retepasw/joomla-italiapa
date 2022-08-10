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
?>

<?php $id = ($tagId = $params->get('tag_id', '')) ? ' id="' . $tagId . '"' : ''; ?>

<?php
$background = 'u-background-compl-80';
$color      = 'u-color-white';
$u_flex     = false;
$u_size     = '';

$moduleclass_sfx  = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
if ($moduleclass_sfx)
{
    $moduleclass_sfx_array = explode(' ', $moduleclass_sfx);
    for ($i = count($moduleclass_sfx_array) - 1; $i >= 0; $i--)
    {
    	if ($moduleclass_sfx_array[$i] == 'u-flex')
        {
            $u_flex = true;
            unset($moduleclass_sfx_array[$i]);
        }
        elseif (substr($moduleclass_sfx_array[$i], 0, 13) == 'u-background-')
        {
        	$background = $moduleclass_sfx_array[$i];
        	unset($moduleclass_sfx_array[$i]);
        }
        elseif (substr($moduleclass_sfx_array[$i], 0, 8) == 'u-color-')
        {
        	$color = $moduleclass_sfx_array[$i];
        	unset($moduleclass_sfx_array[$i]);
        }
    }
    $moduleclass_sfx = trim(implode(' ', $moduleclass_sfx_array));
}

$class_sfx = 'Arrange-sizeFill ' . $class_sfx;
//if ($class_sfx)
//{
	$class_sfx_array = array_unique(explode(' ', $class_sfx));
	for ($i = count($class_sfx_array) - 1; $i >= 0; $i--)
	{
		if ($class_sfx_array[$i] == 'u-flex')
		{
			$u_flex = true;
			unset($class_sfx_array[$i]);
		}
		elseif (substr($class_sfx_array[$i], 0, 13) == 'u-background-')
		{
			$background = $class_sfx_array[$i];
			unset($class_sfx_array[$i]);
		}
		elseif (substr($class_sfx_array[$i], 0, 8) == 'u-color-')
		{
			$color = $class_sfx_array[$i];
			unset($class_sfx_array[$i]);
		}
		elseif ((substr($class_sfx_array[$i], 0, 6) == 'u-size') || (substr($class_sfx_array[$i], 0, 2) == 'u-') && (substr($class_sfx_array[$i], 4, 5) == '-size'))
		{
			$u_size .= $class_sfx_array[$i] . ' ';
			unset($class_sfx_array[$i]);
		}
	}

	$class_sfx = trim(implode(' ', $class_sfx_array));
//}

$u_size .= $u_size ? '' : 'u-md-size1of3 u-lg-size1of3 ';
?>

<div class="Grid Grid--withGutter u-padding-r-top u-padding-r-bottom u-text-r-s <?php echo $class_sfx; ?>"<?php echo $id; ?>>
<?php foreach ($list as $i => &$item) : ?>
<?php
	if ($item->level > 2)
	{
		continue;
	}
	ob_start();

	$class = 'item-' . $item->id;

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

	$icon            = '';
	if ($item->level == 1)
	{
		$column_background = $background;
		$column_color      = $color;
	}
	$item_background = $column_background;
	$item_color      = $column_color;
	$subclass        = '';
	if ($item->anchor_css)
	{
		$anchor_css = explode(' ', $item->anchor_css);
		for ($i = count($anchor_css) - 1; $i >= 0; $i--)
		{
			if ($anchor_css[$i] == 'u-flex')
			{
				$class .= ' u-flex';
				unset($anchor_css[$i]);
			}
			elseif ($anchor_css[$i] == 'u-flexCol')
			{
				$class .= ' u-flexCol';
				unset($anchor_css[$i]);
			}
			elseif (substr($anchor_css[$i], 0, 13) == 'u-background-')
			{
				$item_background = $anchor_css[$i];
				unset($anchor_css[$i]);
			}
			elseif (substr($anchor_css[$i], 0, 8) == 'u-color-')
			{
				$item_color = $anchor_css[$i];
				unset($anchor_css[$i]);
			}
			elseif (substr($anchor_css[$i], 0, 3) == 'li:')
			{
				$subclass = substr($anchor_css[$i], 3) . ' ' . $subclass;
				unset($anchor_css[$i]);
			}
		}
		$item->anchor_css = implode(' ', $anchor_css);
	}

	if ($item->level == 1)
	{
		echo '<div class="Grid-cell ' . $u_size . $class . ($u_flex ? ' u-flex' . (($item->parent) ? ' u-flexCol' : '') : '') . '">';
		$column_background = $item_background;
		$column_color      = $item_color;
	}

	if (! $item->parent)
	{
		echo '<div class="Entrypoint-item ' . ($item->level == 1 ? 'u-sizeFill ' : '') .
			trim($subclass . ' ' . $item_background) . '"><p>';

		$item->anchor_css .= (empty($item->anchor_css) ? 'u-textClean u-text-h3' : '') . ' ' . $item_color;

		switch ($item->type)
		{
			case 'separator':
			case 'component':
			case 'heading':
			case 'url':
				require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
				break;

			default:
				require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
				break;
		}
		echo '</p></div>';
	}

	if ($item->shallower)
	{
		// echo '</div>';
		echo str_repeat('</div>', $item->level_diff);
	}
	// The next item is on the same level.
	elseif ($item->level == 1 && ! $item->parent)
	{
		echo '</div>';
	}

	$buffer = ob_get_flush();
?>
<?php endforeach; ?>
</div>

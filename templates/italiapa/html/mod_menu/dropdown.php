<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
?>

<?php $id = ($tagId = $params->get('tag_id', '')) ? ' id="' . $tagId . '"' : ''; ?>

<div class="mod-menu<?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8'); ?>">
<?php foreach ($list as $i => &$item) : ?>
<?php
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

/**
	<a href="#options" data-menu-trigger="options" class="Button Button--info">Menu</a>
	<div id="options" data-menu class="Dropdown-menu u-borderShadow-m u-background-white">
	<span class="Icon-drop-down Dropdown-arrow u-color-white"></span>
	<ul class="Linklist">
	<li><a href="#" class="u-color-50 u-padding-r-all">Tempore accusamus eaque rerum est.</a></li>
	<li><a href="#" class="u-color-50 u-padding-r-all">Ut adipisci iure tempore ullam laborum.</a></li>
	<li><a href="#" class="u-color-50 u-padding-r-all">Consequuntur est et quo ullam aut omnis aut et.</a></li>
	<li><a href="#" class="u-color-50 u-padding-r-all">Et vitae qui ullam quis alias quibusdam quos.</a></li>
	</ul>
	</div>
*/

	if ($item->level == 1)
	{
		if ($module->position == 'languages')
		{
			$item->anchor_css = "Header-language " . $item->anchor_css;
		}
		$item->attributes = array(		'data-menu-trigger'=>'item-' . $module->id . '-' . $item->id,
			'aria-controls'=>'item-' . $module->id . '-' . $item->id,
			'aria-haspopup'=>'true',
			'role'=>'button');
		$item->flink = '#item-' . $module->id . '-' . $item->id;
		require JModuleHelper::getLayoutPath('mod_menu', 'dropdown_url');
	}
	else
	{
		echo '<li class="' . $class . '">';

		switch ($item->type) :
			case 'separator':
			case 'component':
			case 'heading':
			case 'url':
				require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
				break;

			default:
				require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
				break;
		endswitch;
	}

	// The next item is deeper.
	if ($item->deeper)
	{
		if ($item->level == 1)
		{
			echo '<div id="item-' . $module->id . '-' . $item->id . '" data-menu class="Dropdown-menu Header-language-other u-jsVisibilityHidden u-nojsDisplayNone">';
			echo '<span class="Icon-drop-down Dropdown-arrow u-color-white"></span>';
		}
		echo '<ul>';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		if ($item->level - $item->level_diff > 1)
		{
			echo str_repeat('</ul></li>', $item->level_diff);
		}
		else
		{
			echo str_repeat('</ul></li>', $item->level_diff - 1);
			echo '</ul></div>';
		}
	}
	// The next item is on the same level.
	elseif ($item->level > 1)
	{
		echo '</li>';
	}
?>
<?php endforeach; ?>
</div>

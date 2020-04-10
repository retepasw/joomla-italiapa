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

<?php if ($module->position == 'menu') : ?>
	<?php require JModuleHelper::getLayoutPath('mod_menu', 'treeview'); ?>
<?php elseif ($module->position == 'mainmenu') : ?>
	<?php require JModuleHelper::getLayoutPath('mod_menu', 'megamenu'); ?>
<?php elseif ($module->position == 'socials') : // TODO: remove default layout for position socials ?>
	<?php require JModuleHelper::getLayoutPath('mod_menu', 'socials'); ?>
<?php elseif ($module->position == 'owner') : ?>
	<?php require JModuleHelper::getLayoutPath('mod_menu', 'owner'); ?>
<?php elseif ($module->position == 'languages') : ?>
	<?php require JModuleHelper::getLayoutPath('mod_menu', 'dropdown'); ?>
<?php else : ?>
	<?php $id = ($tagId = $params->get('tag_id', '')) ? ' id="' . $tagId . '"' : ''; ?>
	<?php
	if ($module->position == 'right')
	{
		if (empty($class_sfx))
		{
			$class_sfx = 'Treeview--default';
		}
		$class_sfx = ' Linklist Linklist--padded Treeview js-Treeview u-text-r-xs '.$class_sfx;
	}
	elseif ($module->position == 'footermenu')
	{
		$class_sfx = 'Footer-links u-cf ' . $class_sfx;
	}
	if (!empty($class_sfx))
	{
		$class_sfx = ' class="' . $class_sfx .'"';
	}
	?>
	<?php if ($module->position != 'footermenu'): ?>
		<nav>
	<?php endif; ?>

	<ul<?php echo $class_sfx; ?><?php echo $id; ?>>
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

		// The next item is deeper.
		if ($item->deeper)
		{
			echo '<ul class="nav-child unstyled small">';
		}
		// The next item is shallower.
		elseif ($item->shallower)
		{
			echo '</li>';
			echo str_repeat('</ul></li>', $item->level_diff);
		}
		// The next item is on the same level.
		else
		{
			echo '</li>';
		}
	?>
	<?php endforeach; ?>
	</ul>

	<?php if ($module->position != 'footermenu'): ?>
		</nav>
	<?php endif; ?>
<?php endif; 

<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
JLog::add(new JLogEntry($module->position, JLog::DEBUG, 'tpl_italiapa'));

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}
?>

<div class="Grid Grid--withGutter u-padding-r-top u-padding-r-bottom u-text-r-s <?php echo $class_sfx; ?>"<?php echo $id; ?>>
<?php foreach ($list as $i => &$item)
{
	JLog::add(new JLogEntry(print_r($item, true), JLog::DEBUG, 'tpl_italiapa'));
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
		$class .= ' parent u-flex u-flexCol';
	}
	else
	{
		$class .= ' u-flex';
	}

	if ($item->level == 1)
	{
		echo '<div class="Grid-cell u-md-size1of3 u-lg-size1of3 ' . $class . '">';
	}

	if (!$item->parent)
	{
		$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
		echo '<div class="Entrypoint-item '.($item->level == 1 ? 'u-sizeFill ' : '') .($moduleclass_sfx ? $moduleclass_sfx : 'u-background-compl-80').'"><p>';
		if (!$item->anchor_css)
		{
			$item->anchor_css = 'u-textClean u-text-h3 u-color-white';
		}
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
		echo '</p></div>';
	}

	if ($item->shallower)
	{
//		echo '</div>';
		echo str_repeat('</div>', $item->level_diff);
	}
	// The next item is on the same level.
	elseif ($item->level == 1 && !$item->parent)
	{
		echo '</div>';
	}

	$buffer = ob_get_flush();
	JLog::add(new JLogEntry($buffer, JLog::DEBUG, 'tpl_italiapa'));
}
?></div>

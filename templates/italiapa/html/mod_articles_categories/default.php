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

defined('_JEXEC') or die;
?>

<?php if ($module->position == 'owner') : ?>
	<?php require 'dropdown.php'; ?>
<?php elseif ($module->position == 'languages') : ?>
	<?php $moduleclass_sfx .= ' u-padding-top-s'; ?>
	<?php require 'dropdown.php'; ?>
<?php elseif ($module->position == 'right') : ?>
	<?php require 'treeview.php'; ?>
<?php elseif ($module->position == 'services') : ?>
	<?php require 'treeview.php'; ?>
<?php elseif ($module->position == 'featured') : ?>
	<?php
	$moduleclass_sfx = explode(' ', $params->get('moduleclass_sfx'));
	$columnClass     = 'Grid-cell u-flex u-flexCol';
	$itemClass       = '';
	$singleColumn    = false;
	for ($i = count($moduleclass_sfx) - 1; $i >= 0; $i--)
	{
		if ($moduleclass_sfx[$i] == 'column')
		{
			$singleColumn = true;
			unset($moduleclass_sfx[$i]);
		}
		elseif ((substr($moduleclass_sfx[$i], 0, 6) == 'u-size') || (substr($moduleclass_sfx[$i], 4, 5) == '-size'))
		{
			$columnClass .= ' ' . $moduleclass_sfx[$i];
			unset($moduleclass_sfx[$i]);
		}
		elseif ((substr($moduleclass_sfx[$i], 0, 8) == 'u-margin') || (substr($moduleclass_sfx[$i], 0, 9) == 'u-padding'))
		{
			$itemClass .= ' ' . $moduleclass_sfx[$i];
			unset($moduleclass_sfx[$i]);
		}
	}
	$moduleclass_sfx = (substr($params->get('moduleclass_sfx'), 0, 1) == ' ' ? ' ' : '') . implode(' ', $moduleclass_sfx);
	?>
	<div class="Grid Grid--withGutter category-module<?php echo $moduleclass_sfx; ?> mod-list"<?php echo ($params->get('link_titles') == 1) ? ' itemscope itemtype="http://schema.org/ItemList"' : ''; ?>>
		<?php require 'entrypoint.php'; ?>
	</div>
<?php elseif ($module->position == 'news') : ?>
	<?php require 'treeview.php'; ?>
<?php elseif ($module->position == 'lead') : ?>
	<?php require 'lead.php'; ?>
<?php elseif ($module->position == 'footermenu') : ?>
	<?php $moduleclass_sfx .= ' Footer-links u-cf'; ?>
	<?php require 'list.php'; ?>
<?php else : ?>
	<?php //require 'treeview.php'; ?>
	<?php require 'focus.php'; ?>
<?php endif;
	
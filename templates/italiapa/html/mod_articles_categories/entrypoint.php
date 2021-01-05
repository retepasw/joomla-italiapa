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

$columnClass  = !empty($columnClass) ? ' ' . $columnClass : '';
$itemClass    = !empty($itemClass) ? ' ' . $itemClass : '';
$singleColumn = !empty($singleColumn) ? $singleColumn : false;
?>

<?php if (($singleColumn === false) || $params->get('show_children', 0)) : ?>
	<?php foreach ($list as $item) : ?>
		<div class="categories-module<?php echo $columnClass; ?>">
			<?php require JModuleHelper::getLayoutPath('mod_articles_categories', 'entrypoint_item'); ?>
		</div>
	<?php endforeach; ?>
<?php else : ?>
	<div class="<?php echo $columnClass; ?>">
		<?php foreach ($list as $item) : ?>
			<?php require JModuleHelper::getLayoutPath('mod_articles_categories', 'entrypoint_item'); ?>
		<?php endforeach; ?>
	</div>
<?php endif;

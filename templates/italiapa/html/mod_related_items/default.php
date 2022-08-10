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
?>

<?php if ($module->position == 'owner') : ?>
	<?php require 'dropdown.php'; ?>
<?php elseif ($module->position == 'languages') : ?>
	<?php $moduleclass_sfx .= ' u-padding-top-s'; ?>
	<?php require 'dropdown.php'; ?>
<?php elseif ($module->position == 'right') : ?>
	<?php require 'linklist.php'; ?>
<?php elseif ($module->position == 'services') : ?>
	<?php require 'linklist.php'; ?>
<?php elseif ($module->position == 'featured') : ?>
	<?php require 'entrypoint.php'; ?>
<?php elseif ($module->position == 'news') : ?>
	<?php require 'linklist.php'; ?>
<?php elseif ($module->position == 'lead') : ?>
	<?php require 'lead.php'; ?>
<?php elseif ($module->position == 'footermenu') : ?>
	<?php $moduleclass_sfx .= ' Footer-links u-cf'; ?>
	<?php require 'list.php'; ?>
<?php else : ?>
	<?php require 'list.php'; ?>
<?php endif;

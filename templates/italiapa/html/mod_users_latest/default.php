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

<?php if ($module->position == 'right') : ?>
	<?php require 'linklist.php'; ?>
<?php elseif (!empty($names)) : ?>
	<ul class="latestusers<?php echo $moduleclass_sfx; ?> mod-list" >
	<?php foreach ($names as $name) : ?>
		<li>
			<span class="u-color-teal-50"><?php echo $name->username; ?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif;

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

$moduleclass_sfx = $moduleclass_sfx ?: ' Arrange-sizeFill';
?>
<div class="random-image<?php echo $moduleclass_sfx; ?>" data-tooltip="<?php echo JHtml::tooltipText(pathinfo($image->name)['filename'], 0); ?>">
<?php if ($link) : ?>
<a href="<?php echo $link; ?>">
<?php endif; ?>
	<?php echo JHtml::_('image', $image->folder . '/' . htmlspecialchars($image->name, ENT_COMPAT, 'UTF-8'), null, array('width' => $image->width, 'height' => $image->height)); ?>
<?php if ($link) : ?>
</a>
<?php endif; ?>
</div>

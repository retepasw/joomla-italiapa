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
<span class="Dot u-background-50"></span><strong>
<?php $title = $this->escape($displayData['item']->parent_title); ?>
<?php if ($displayData['params']->get('link_parent_category') && $displayData['item']->parent_slug) : ?>
	<a class="u-textClean u-text-r-xs" href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->parent_slug)); ?>" itemprop="genre"><?php echo $title; ?></a>
<?php else : ?>
	<span itemprop="genre"><?php echo $title; ?></span>
<?php endif; ?>
</strong>

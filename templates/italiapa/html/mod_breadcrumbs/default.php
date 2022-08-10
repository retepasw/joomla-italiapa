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
<?php if ($count) : ?>
<nav <?php echo $params->get('showHere', 1) ? 'aria-label="'.JText::_('MOD_BREADCRUMBS_HERE').'"' : '' ?>>
	<ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb<?php echo $moduleclass_sfx; ?>">
	<?php
	// Get rid of duplicated entries on trail including home page when using multilanguage
	for ($i = 0; $i < $count; $i++)
	{
		if (empty($list[$i]->link) || $i === 1 && isset($list[$i - 1]) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link)
		{
			unset($list[$i]);
		}
	}

	// Make a link if not the last item in the breadcrumbs
	if (!$params->get('showLast', 1))
	{
		array_pop($list);
	}

	// Generate the trail
	$i = 1;
	?>
	<?php foreach ($list as $key => $item) : ?>
		<li class="Breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
			<a itemprop="item" href="<?php echo $item->link; ?>" class="Breadcrumb-link u-color-50 pathway"><span itemprop="name"><?php echo $item->name; ?></span></a>
			<meta itemprop="position" content="<?php echo $i++; ?>">
		</li>
	<?php endforeach; ?>
	</ul>
</nav>
<?php endif;

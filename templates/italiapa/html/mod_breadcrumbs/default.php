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

?>
<?php if (JFactory::getApplication()->getTemplate(true)->params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
see <a href="https://italia.github.io/design-web-toolkit/components/detail/breadcrumb.html">https://italia.github.io/design-web-toolkit/components/detail/breadcrumb.html</a>
</div>
<?php endif; ?>
<?php if ($count) : ?>
<nav <?php echo $params->get('showHere', 1) ? 'aria-label="'.JText::_('MOD_BREADCRUMBS_HERE').'"' : '' ?> role="navigation">
	<ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb<?php echo $moduleclass_sfx; ?>">
	<?php
	// Get rid of duplicated entries on trail including home page when using multilanguage
	for ($i = 0; $i < $count; $i++)
	{
		if ($i === 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link)
		{
			unset($list[$i]);
		}
	}

	// Find last and penultimate items in breadcrumbs list
	end($list);
	$last_item_key   = key($list);
	prev($list);
	$penult_item_key = key($list);

	// Make a link if not the last item in the breadcrumbs
	$show_last = $params->get('showLast', 1);

	// Generate the trail
	foreach ($list as $key => $item) :
		if (($key !== $last_item_key) || ($show_last)) :
			// Render all but last item - along with separator ?>
		<li class="Breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
<?php		if (!empty($item->link)) : ?>
			<a itemprop="item" href="<?php echo $item->link; ?>" class="Breadcrumb-link u-color-50 pathway"><span itemprop="name"><?php echo $item->name; ?></span></a>
<?php		else : ?>
			<span itemprop="name">
				<?php echo $item->name; ?>
			</span>
<?php		endif; ?>
			<meta itemprop="position" content="<?php echo $key + 1; ?>">
		</li>
<?php	endif;
	endforeach; ?>
	</ul>
</nav>
<?php endif; ?>
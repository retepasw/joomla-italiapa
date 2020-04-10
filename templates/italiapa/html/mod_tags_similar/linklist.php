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
<div class="tagssimilar<?php echo $moduleclass_sfx; ?>">
<?php if ($list) : ?>
	<ul class="Linklist Prose u-text-r-xs" itemscope itemtype="http://schema.org/ItemList">
	<?php foreach ($list as $i => $item) : ?>
		<li>
			<?php if (($item->type_alias === 'com_users.category') || ($item->type_alias === 'com_banners.category')) : ?>
				<?php if (!empty($item->core_title)) : ?>
					<?php echo htmlspecialchars($item->core_title, ENT_COMPAT, 'UTF-8'); ?>
				<?php endif; ?>
			<?php else : ?>
				<a href="<?php echo JRoute::_($item->link); ?>">
					<?php if (!empty($item->core_title)) : ?>
						<?php echo htmlspecialchars($item->core_title, ENT_COMPAT, 'UTF-8'); ?>
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php else : ?>
	<div class="Prose Alert Alert--warning Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
	    <h2 class="u-text-h3"><?php echo JText::_('WARNING'); ?></h2>
	    <p class="u-text-p"><?php echo JText::_('MOD_TAGS_SIMILAR_NO_MATCHING_TAGS'); ?></p>
	</div>
<?php endif; ?>
</div>

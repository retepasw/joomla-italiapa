<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$minsize = $params->get('minsize', 1);
$maxsize = $params->get('maxsize', 2);

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');
?>
<div class="tagspopular<?php echo $moduleclass_sfx; ?> tagscloud<?php echo $moduleclass_sfx; ?>">
<?php
if (!count($list)) : ?>
	<div class="Prose Alert Alert--warning Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
	    <h2 class="u-text-h3"><?php echo JText::_('WARNING'); ?></h2>
	    <p class="u-text-p"><?php echo JText::_('MOD_TAGS_POPULAR_NO_ITEMS_FOUND'); ?></p>
	</div>
<?php else :
	// Find maximum and minimum count
	$mincount = null;
	$maxcount = null;
	foreach ($list as $item)
	{
		if ($mincount === null || $mincount > $item->count)
		{
			$mincount = $item->count;
		}
		if ($maxcount === null || $maxcount < $item->count)
		{
			$maxcount = $item->count;
		}
	}
	$countdiff = $maxcount - $mincount;

	foreach ($list as $item) :
		if ($countdiff === 0) :
			$fontsize = $minsize;
		else :
			$fontsize = $minsize + (($maxsize - $minsize) / $countdiff) * ($item->count - $mincount);
		endif;
?>
		<span class="tag">
			<a class="tag-name u-linkClean" style="font-size: <?php echo $fontsize . 'em'; ?>" href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($item->tag_id . ':' . $item->alias)); ?>">
				<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?></a>
			<?php if ($display_count) : ?>
				<span class="tag-count"><?php echo $item->count; ?></span>
			<?php endif; ?>
		</span>
	<?php endforeach; ?>
<?php endif; ?>
</div>

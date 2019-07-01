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
?>
<?php JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php'); ?>
<div class="tagspopular<?php echo $moduleclass_sfx; ?>">
<?php if (!count($list)) : ?>
	<div class="Prose Alert Alert--warning Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
	    <h2 class="u-text-h3"><?php echo JText::_('WARNING'); ?></h2>
	    <p class="u-text-p"><?php echo JText::_('MOD_TAGS_POPULAR_NO_ITEMS_FOUND'); ?></p>
	</div>
<?php else : ?>
	<ul role="presentation">
	<?php foreach ($list as $item) : ?>
		<li class="Button--default u-padding-all-s u-text-r-xs u-borderRadius-l u-background-50 u-inlineBlock u-margin-right-m">
			<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($item->tag_id . ':' . $item->alias)); ?>"
				class="u-textWeight-600 u-linkClean u-color-white" itemprop="keywords" rel="tag"> 
				<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?></a>
			<?php if ($display_count) : ?>
				<span class="tag-count Button--default u-padding-left-xxs u-padding-right-xxs u-text-r-xxs u-borderRadius-m u-textWeight-700"><?php echo $item->count; ?></span>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
</div>

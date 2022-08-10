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

$info = $item->params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $item->params->get('show_associations'));
?>
<?php $images = json_decode($item->images); ?>
<?php if (($params->get('img_intro_full') == 'intro') && isset($images->image_intro) && !empty($images->image_intro)) : ?>
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $item); ?>
<?php elseif (($params->get('img_intro_full') == 'full') && isset($images->image_full) && !empty($images->image_full)) : ?>
	<?php echo JLayoutHelper::render('joomla.content.full_image', $item); ?>
<?php endif; ?>
<div class="u-color-grey-30 u-border-top-xxs u-padding-right-xxl u-padding-r-all">
	<?php
	$useDefList = ($item->params->get('show_modify_date') || $item->params->get('show_publish_date') || $item->params->get('show_create_date') || $item->params->get('show_hits') || $item->params->get('show_category') || $item->params->get('show_parent_category') || $item->params->get('show_author') || $assocParam);

	if ($useDefList && ($info == 0 || $info == 2)) :
		echo JLayoutHelper::render('joomla.content.info_block', array('item' => $item, 'params' => $item->params, 'position' => 'above'));
	endif;
	?>

	<?php if ($params->get('item_title')) : ?>
	<h3 class="u-padding-r-top u-padding-r-bottom">
		<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
		<a class="u-text-h4 u-textClean u-color-black" href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?>
		</a>
		<?php else : ?>
			<span class="u-text-h4 u-textClean u-color-black"><?php echo $item->title; ?></span>
		<?php endif; ?>
	</h3>
	<?php endif; ?>

	<div class="u-lineHeight-l u-text-r-xs u-textSecondary u-padding-r-right">
		<?php
		if (!$params->get('intro_only')) :
			echo $item->afterDisplayTitle;
		endif;

		if ($params->get('show_tags', 0)) :
			$itemtags = (new JHelperTags)->getItemTags('com_content.article', $item->id);
			if ($itemtags) : ?>
				<div class="mod-articles-news-tags">
					<?php echo JLayoutHelper::render('joomla.content.tags', $itemtags); ?>
				</div>
			<?php endif;
		endif;

		echo $item->beforeDisplayContent;

		if ($params->get('show_introtext', '1')) :
			echo $item->introtext;
		endif;

		echo $item->afterDisplayContent;

		if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) :
			echo '<a class="readmore" href="' . $item->link . '">' . $item->linkText . '</a>';
		endif;
		?>
	</div>
</div>

<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
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

defined('JPATH_BASE') or die;

$params = $displayData->params;
?>
<?php $images = json_decode($displayData->images); ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
	<?php $imgfloat = empty($images->float_intro) ? $params->get('float_intro') : $images->float_intro; ?>
	<div class="pull-<?php echo htmlspecialchars($imgfloat, ENT_COMPAT, 'UTF-8'); ?> item-image" itemscope itemtype='http://schema.org/ImageObject'>
	<?php $image = '<img class="u-sizeFull' . ($images->image_intro_caption ? ' caption" title="' . htmlspecialchars($images->image_intro_caption) : '') . '"' .
		' src="' . htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8') .'"' .
		' alt="' . htmlspecialchars($images->image_intro_alt, ENT_COMPAT, 'UTF-8') . '" itemprop="thumbnailUrl"/>'; ?>
	<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)); ?>"><?php echo $image; ?></a>
	<?php else : ?>
		<?php echo $image; ?>
	<?php endif; ?>
	</div>
<?php endif; ?>

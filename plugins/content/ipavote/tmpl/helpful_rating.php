<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Ipavote
 *
 * @version		__DEPLOY_VERSION__
 * 
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugin.Content.Ipavote is a free software. This version may have been
 * modified  pursuant to the GNU General Public License,  and as distributed it
 * includes  or  is  derivative  of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */
defined('_JEXEC') or die();

/**
 * Layout variables
 * -----------------
 *
 * @var string $context The context of the content being passed to the plugin
 * @var object &$row The article object
 * @var object &$params The article params
 * @var integer $page The 'page' number
 * @var array $parts The context segments
 * @var string $path Path to this file
 */

if ($context == 'com_content.categories')
{
	return;
}

$rating = (int) $row->rating;
$rcount = (int) $row->rating_count;

// Look for images in template if available
$starImageOn = JHtml::_('image', 'system/rating_star.png', JText::_('PLG_CONTENT_IPAVOTE_STAR_ACTIVE'), null, true);
$starImageOff = JHtml::_('image', 'system/rating_star_blank.png', JText::_('PLG_CONTENT_IPAVOTE_STAR_INACTIVE'), null, true);

$img = '';

for ($i = 0; $i < $rating; $i ++)
{
	$img .= $starImageOn;
}

for ($i = $rating; $i < 5; $i ++)
{
	$img .= $starImageOff;
}
?>
<div class="content_rating">
	<?php if ($rcount) : ?>
		<p class="unseen element-invisible" itemprop="aggregateRating"
		itemscope itemtype="https://schema.org/AggregateRating">
			<?php echo JText::sprintf('PLG_CONTENT_IPAVOTE_USER_RATING', '<span itemprop="ratingValue">' . $rating . '</span>', '<span itemprop="bestRating">5</span>'); ?>
			<meta itemprop="ratingCount" content="<?php echo $rcount; ?>" />
		<meta itemprop="worstRating" content="1" />
	</p>
	<?php endif; ?>
	<?php echo $img; ?>
</div>

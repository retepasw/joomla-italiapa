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

/**
 * Layout variables
 * -----------------
 * @var   string   $context  The context of the content being passed to the plugin
 * @var   object   &$row     The article object
 * @var   object   &$params  The article params
 * @var   integer  $page     The 'page' number
 * @var   array    $parts    The context segments
 * @var   string   $path     Path to this file
 */

if ($context == 'com_content.categories')
{
	return;
}

$rating = (int) $row->rating;
$rcount = (int) $row->rating_count;
?>

<style>
	.rating {
	  border: none;
	  float: left;
	}

	.rating > input {
		position: absolute;
		left: -9999px;
	}

	.rating > label {
		float: right;
		margin: 0 2px 0 0;
		margin: 0;
		padding-right: 2px;
	}

	.rating > label:first-of-type {
		margin-right: 0;
	}

	.rating svg {
		pointer-events: none;
	}

	.rating svg.Icon.blank {
	    stroke-width: 1px;
	    fill: transparent;
	}

	.rating > legend {
		display: inline-block;
		color: currentColor;
		font-size: 1.5rem;
		float: right;
		width: auto;
		margin-left: 16px;
		font-weight: 500;
	}

	.rating.rating-read-only > input,
	.rating.rating-read-only > label {
		pointer-events: none;
	}
</style>

<div class="content_rating u-cf">
	<fieldset class="rating rating-label"<?php echo ($rcount ? ' itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating"' : ''); ?>>
		<legend>
			<?php echo JText::sprintf('PLG_VOTE_USER_RATING', '<span itemprop="ratingValue">' . $rating . '</span>', '<span itemprop="bestRating">5</span>'); ?>
			<meta itemprop="ratingCount" content="<?php echo $rcount; ?>" />
			<meta itemprop="worstRating" content="1" />
		</legend>
		<?php for ($i = 5; $i > 0; $i--): ?>
			<label class = "u-floatRight" for="content_vote_<?php echo (int) $row->id; ?>_<?php echo $i; ?>">
				<svg class="Icon<?php echo ($rating < $i ? ' blank' : '') ?>"><use xlink:href="#Icon-star-full"></use></svg>
			</label>
		<?php endfor; ?>
	</fieldset>
</div>

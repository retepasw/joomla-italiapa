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

use Joomla\String\StringHelper;

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

// Get the mime type class.
$mime = !empty($this->result->mime) ? 'mime-' . $this->result->mime : null;

$show_description = $this->params->get('show_description', 1);

if ($show_description)
{
	// Calculate number of characters to display around the result
	$term_length = StringHelper::strlen($this->query->input);
	$desc_length = $this->params->get('description_length', 255);
	$pad_length  = $term_length < $desc_length ? (int) floor(($desc_length - $term_length) / 2) : 0;

	// Make sure we highlight term both in introtext and fulltext
	if (!empty($this->result->summary) && !empty($this->result->body))
	{
		$full_description = FinderIndexerHelper::parse($this->result->summary . $this->result->body);
	}
	else
	{
		$full_description = $this->result->description;
	}

	// Find the position of the search term
	$pos = $term_length ? StringHelper::strpos(StringHelper::strtolower($full_description), StringHelper::strtolower($this->query->input)) : false;

	// Find a potential start point
	$start = ($pos && $pos > $pad_length) ? $pos - $pad_length : 0;

	// Find a space between $start and $pos, start right after it.
	$space = StringHelper::strpos($full_description, ' ', $start > 0 ? $start - 1 : 0);
	$start = ($space && $space < $pos) ? $space + 1 : $start;

	$description = JHtml::_('string.truncate', StringHelper::substr($full_description, $start), $desc_length, true);
}

$route = $this->result->route;

// Get the route with highlighting information.
if (!empty($this->query->highlight)
	&& empty($this->result->mime)
	&& $this->params->get('highlight_terms', 1)
	&& JPluginHelper::isEnabled('system', 'highlight'))
{
	$route .= '&highlight=' . base64_encode(json_encode($this->query->highlight));
}

$result = $this->result;
?>

<div class="Grid-cell u-md-size1of3 u-lg-size1of3 u-flex u-margin-r-bottom u-flexJustifyCenter" itemprop="blogPost" itemscope="" itemtype="https://schema.org/BlogPosting">
	<div class="u-nbfc u-borderShadow-xxs u-borderRadius-m u-color-grey-30 u-background-white u-sizeFull">
		<?php if (isset($result->images)) : ?>
			<?php $images  = json_decode($result->images); ?>
			<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
		<img src="<?php echo $images->image_intro; ?>" class="u-sizeFull"<?php if (isset($images->image_intro_alt)) echo ' alt="'.$images->image_intro_alt.'"'; ?>/>
			<?php endif; ?>
		<?php endif; ?>
		<div class="u-text-r-l u-padding-r-all u-layout-prose">
			<?php if (!empty($result->category)) : ?>
				<p class="u-padding-r-bottom">
					<span class="Dot u-background-50"></span>
					<?php if ($result->context = 'com_content.article') : ?>
						<a href="<?php echo $this->baseUrl, ContentHelperRoute::getCategoryRoute($result->catid); ?>" class="u-textClean u-textWeight-700 u-text-r-xs u-color-50" itemprop="genre"><?php echo $result->category; ?></a>
					<?php else: ?>
						<span class="u-textClean u-textWeight-700 u-text-r-xs u-color-50" itemprop="genre"><?php echo $result->category; ?></span>
					<?php endif; ?>
					<?php /** ?>
					<span class="u-text-r-xxs u-textSecondary u-textWeight-400 u-lineHeight-xl u-cf">
						<time datetime="<?php echo JHtml::_('date', $result->created, 'c'); ?>" itemprop="dateCreated">
							<?php JText::sprintf('COM_CONTENT_CREATED_DATE_ON', $result->created); ?>
						</time>
					</span>
					<?php */ ?>
				</p>
			<?php endif; ?>
			<h3 class="u-text-h4 u-margin-r-bottom" itemprop="headline">
				<a class="u-text-r-m u-color-black u-textWeight-400 u-textClean" href="<?php echo JRoute::_($route); ?>">
					<?php // $result->title should not be escaped in this case, as it may ?>
					<?php // contain span HTML tags wrapping the searched terms, if present ?>
					<?php // in the title. ?>
					<?php echo $result->title; ?>
				</a>
			</h3>
			<?php if ($show_description && $description !== '') : ?>
				<p class="u-text-p u-textSecondary<?php echo $this->pageclass_sfx; ?>">
					<?php echo $description; ?>
				</p>
			<?php endif; ?>
			<?php if ($this->params->get('show_url', 1)) : ?>
				<div class="u-color-black u-textBreak u-padding-top-m small<?php echo $this->pageclass_sfx ? ' ' . $this->pageclass_sfx : ''; ?>">
					<?php echo $this->baseUrl, JRoute::_($this->result->route); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

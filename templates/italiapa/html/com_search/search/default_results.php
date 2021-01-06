<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
?>

<div class=" u-background-compl-10 u-layout-centerContent u-padding-r-top">
	<section class="u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom">
		<div class="Grid Grid--withGutterM">
			<?php foreach ($this->results as $result) : ?>
				<div class="Grid-cell u-md-size1of3 u-lg-size1of3 u-flex u-margin-r-bottom u-flexJustifyCenter" itemprop="blogPost" itemscope="" itemtype="https://schema.org/BlogPosting">
					<div class="u-nbfc u-borderShadow-xxs u-borderRadius-m u-color-grey-30 u-background-white u-sizeFull">
						<?php if (isset($result->images)) : ?>
							<?php $images  = json_decode($result->images); ?>
							<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
						<img src="<?php echo $images->image_intro; ?>" class="u-sizeFull"<?php if (isset($images->image_intro_alt)) echo ' alt="'.$images->image_intro_alt.'"'; ?>/>
							<?php endif; ?>
						<?php endif; ?>
						<div class="u-text-r-l u-padding-r-all u-layout-prose">
							<p class="u-padding-r-bottom">
								<span class="Dot u-background-50"></span>
								<span class="u-textClean u-textWeight-700 u-text-r-xs u-color-50" itemprop="genre"><?php echo $result->section; ?></span>
								<?php /** ?>
								<span class="u-text-r-xxs u-textSecondary u-textWeight-400 u-lineHeight-xl u-cf">
									<time datetime="<?php echo JHtml::_('date', $result->created, 'c'); ?>" itemprop="dateCreated">
										<?php JText::sprintf('COM_CONTENT_CREATED_DATE_ON', $result->created); ?>
									</time>
								</span>
								<?php */ ?>
							</p>
							<h3 class="u-text-h4 u-margin-r-bottom" itemprop="headline">
							<?php if ($result->href) : ?>
								<a class="u-text-r-m u-color-black u-textWeight-400 u-textClean" href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) echo ' target="_blank"'; ?>>
									<?php // $result->title should not be escaped in this case, as it may ?>
									<?php // contain span HTML tags wrapping the searched terms, if present ?>
									<?php // in the title. ?>
									<?php echo $result->title; ?>
								</a>
							<?php else : ?>
								<?php // see above comment: do not escape $result->title ?>
								<?php echo $result->title; ?>
							<?php endif; ?>
							</h3>
							<div class="u-text-p u-textSecondary">
								<?php echo $result->text; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="search-pages-counter">
			<?php // Prepare the pagination string.  Results X - Y of Z ?>
			<?php $start = (int) $this->pagination->get('limitstart') + 1; ?>
			<?php $total = (int) $this->pagination->get('total'); ?>
			<?php $limit = (int) $this->pagination->get('limit') * $this->pagination->get('pages.current'); ?>
			<?php $limit = (int) ($limit > $total ? $total : $limit); ?>
			<?php echo JText::sprintf('JLIB_HTML_RESULTS_OF', $start, $limit, $total); ?>
		</div>
	</section>
</div>

<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>

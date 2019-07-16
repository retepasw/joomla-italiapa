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

<?php if (!$grouped) : ?>
<div class="<?echo $columnClass; ?>">
<?php endif; ?>
	<?php $i = 1; ?>
	<?php if (!$grouped) $list = array('default' => $list); ?>
	<?php foreach ($list as $group_name => $group) : ?>
		<?php if ($grouped) : ?>
			<div class="mod-articles-category-group<?php echo $moduleclass_sfx; ?> <?echo $columnClass; ?>">
				<h3 class="u-block u-text-h3 u-color-60 u-textClean"><?php echo $group_name; ?></h3>
		<?php endif; ?>

		<?php foreach ($group as $item) : ?>
			<div class="Entrypoint-item u-background-50" itemprop="itemListElement" itemscope itemtype="http://schema.org/CreativeWork">
				<meta itemprop="position" content="<?php echo $i++; ?>"/>
				<?php if ($item->displayCategoryTitle) : ?>
					<span class="Dot u-background-50"></span>
					<span class="mod-articles-category-category">
						<?php echo $item->displayCategoryTitle; ?>
					</span>
				<?php endif; ?>

				<?php if ($params->get('show_tags', 0) && $item->tags->itemTags) : ?>
					<div class="mod-articles-category-tags">
						<?php echo JLayoutHelper::render('joomla.content.tags', $item->tags->itemTags); ?>
					</div>
				<?php endif; ?>

				<?php if ($params->get('link_titles') == 1) : ?>
					<a class="mod-articles-category-title <?php echo $item->active; ?> u-textClean u-color-white u-text-r-m" href="<?php echo $item->link; ?>" itemprop="url">
						<span itemprop="name" class="u-cf"><?php echo $item->title; ?></span>
					</a>
				<?php else : ?>
					<span itemprop="name" class="u-cf"><?php echo $item->title; ?></span>
				<?php endif; ?>

				<?php if ($item->displayHits) : ?>
					<span class="mod-articles-category-hits">
						<meta itemprop="interactionCount" content="UserPageVisits:<?php echo $item->displayHits; ?>" />
						[<?php echo $item->displayHits; ?>]
					</span>
				<?php endif; ?>

				<?php if ($params->get('show_author')) : ?>
					<span class="mod-articles-category-writtenby">
						<span itemprop="author"><?php echo $item->displayAuthorName; ?></span>
					</span>
				<?php endif; ?>

				<?php if ($item->displayDate) : ?>
					<?php
					switch ($params->get('show_date_field')) :
					case 'modified':
						$date = $item->modified;
						$prop = 'dateModified';
						break;
					case 'publish_up':
						$date = $item->publish_up;
						$prop = 'datePublished';
						break;
					default: // case 'created':
						$date = $item->created;
						$prop = 'dateCreated';
						break;
					endswitch;
					?>
					<span class="mod-articles-category-date">
						<time datetime="<?php echo JHtml::_('date', $date, JText::_('DATE_FORMAT_LC4')); ?>" itemprop="<?php echo $prop; ?>">
							<?php echo $item->displayDate; ?>
						</time>
					</span>
				<?php endif; ?>

				<?php if ($params->get('show_introtext')) : ?>
					<p class="u-textSecondary mod-articles-category-introtext">
						<?php echo strip_tags($item->displayIntrotext); ?>
					</p>
				<?php endif; ?>

				<?php if ($params->get('show_readmore')) : ?>
					<p class="u-textRight mod-articles-category-readmore">
						<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>" itemprop="url">
							<?php if ($item->params->get('access-view') == false) : ?>
								<?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
							<?php elseif ($readmore = $item->alternative_readmore) : ?>
								<?php echo $readmore; ?>
								<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
									<?php if ($params->get('show_readmore_title', 0) != 0) : ?>
										<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
									<?php endif; ?>
							<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
								<?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
							<?php else : ?>
								<?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
								<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
							<?php endif; ?>
							<span class="Icon Icon-chevron-right"></span>
						</a>
					</p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>

		<?php if ($grouped) : ?>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php if (!$grouped) : ?>
</div>
<?php endif; ?>

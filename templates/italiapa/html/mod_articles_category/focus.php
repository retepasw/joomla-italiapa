<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All Rights Reserved
 * @license	    http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

$moduleclass_sfx = explode(' ', $params->get('moduleclass_sfx'));
$responsiveClass = '';
for ($i = count($moduleclass_sfx) - 1; $i >= 0; $i--)
{
	if ((substr($moduleclass_sfx[$i], 0, 6) == 'u-size') || (substr($moduleclass_sfx[$i], 4, 5) == '-size'))
	{
		$responsiveClass .= ' ' . $moduleclass_sfx[$i];
		unset($moduleclass_sfx[$i]);
	}
}
$moduleclass_sfx = (substr($params->get('moduleclass_sfx'), 0, 1) == ' ' ? ' ' : '') . implode(' ', $moduleclass_sfx);
?>
<div class="Grid Grid--withGutter category-module mod-list">
	<?php $i = 1; ?>
	<?php if (!$grouped) $list = array('default' => $list); ?>
	<?php foreach ($list as $group_name => $group) : ?>
		<?php if ($grouped) : ?>
			<div class="mod-articles-category-group"><?php echo $group_name; ?></div>
		<?php endif; ?>

		<?php foreach ($group as $item) : ?>
			<div class="Grid-cell <?php echo $responsiveClass ?: 'u-md-size1of3 u-lg-size1of3'; ?> u-flex u-margin-r-bottom u-flexJustifyCenter">
				<div class="u-nbfc u-borderShadow-m u-borderRadius-m u-color-grey-30 u-background-white Arrange-sizeFill">
					<?php $images = json_decode($item->images); ?>
					<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
						<?php echo JLayoutHelper::render('joomla.content.intro_image', $item); ?>
					<?php endif; ?>
					<div class="u-text-r-l u-padding-r-all u-layout-prose">
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

						<h3 class="u-text-h4 u-margin-r-bottom">
							<?php $icon = ''; ?>
							<?php if (JPluginHelper::isEnabled('system', 'fields')) : ?>
								<?php $jcFields = FieldsHelper::getFields('com_content.article', $item, true); ?>
								<?php foreach ($jcFields as $jcField) : ?>
									<?php if (($jcField->name == 'articleicon') && $jcField->rawvalue): ?>
										<?php $icon = '<span class="' . $jcField->rawvalue . '"></span> '; ?>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>

							<?php if ($params->get('link_titles') == 1) : ?>
								<a class="mod-articles-category-title u-text-r-m u-color-95 u-textWeight-400 u-textClean <?php echo $item->active; ?>" href="<?php echo $item->link; ?>" itemprop="url">
									<span itemprop="name" class="u-cf"><?php echo $icon . $item->title; ?></span>
								</a>
							<?php else : ?>
								<span itemprop="name" class="u-text-r-m u-color-95 u-textWeight-400 u-textClean u-cf"><?php echo $icon . $item->title; ?></span>
							<?php endif; ?>
						</h3>

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
							<p class="u-text-p u-textSecondary mod-articles-category-introtext">
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
									<span class="icon-chevron-right"></span>
								</a>
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

		<?php if ($grouped) : ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>

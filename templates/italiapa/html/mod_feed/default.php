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
?>

<?php
if (!empty($feed) && is_string($feed)) :
	echo $feed;
else :
	$lang      = JFactory::getLanguage();
	$myrtl     = $params->get('rssrtl', 0);
	$direction = ' ';

	$isRtl = $lang->isRtl();

	if ($isRtl && $myrtl == 0)
	{
		$direction = ' redirect-rtl';
	}

	// Feed description
	elseif ($isRtl && $myrtl == 1)
	{
		$direction = ' redirect-ltr';
	}

	elseif ($isRtl && $myrtl == 2)
	{
		$direction = ' redirect-rtl';
	}

	elseif ($myrtl == 0)
	{
		$direction = ' redirect-ltr';
	}
	elseif ($myrtl == 1)
	{
		$direction = ' redirect-ltr';
	}
	elseif ($myrtl == 2)
	{
		$direction = ' redirect-rtl';
	}

	if ($feed !== false) :
		// Image handling
		$iUrl   = isset($feed->image) ? $feed->image : null;
		$iTitle = isset($feed->imagetitle) ? $feed->imagetitle : null;
		?>
		<div style="direction: <?php echo $rssrtl ? 'rtl' :'ltr'; ?>; text-align: <?php echo $rssrtl ? 'right' :'left'; ?> !important" class="feed">
			<?php if ($feed->title !== null && $params->get('rsstitle', 1)) : // Feed description ?>
				<h2 class="<?php echo $direction; ?>">
					<a href="<?php echo htmlspecialchars($rssurl, ENT_COMPAT, 'UTF-8'); ?>" target="_blank">
						<?php echo $feed->title; ?></a>
				</h2>
			<?php endif; ?>

			<!-- Show items -->
			<?php if (!empty($feed)) : ?>
				<ul class="newsfeed<?php echo $params->get('moduleclass_sfx'); ?>">
					<?php for ($i = 0, $max = min(count($feed), $params->get('rssitems', 3)); $i < $max; $i++) : ?>
						<?php
							$uri  = $feed[$i]->uri || !$feed[$i]->isPermaLink ? trim($feed[$i]->uri) : trim($feed[$i]->guid);
							$uri  = !$uri || stripos($uri, 'http') !== 0 ? $rssurl : $uri;
							$text = $feed[$i]->content !== '' ? trim($feed[$i]->content) : '';
						?>
						<li>
							<?php if (!empty($uri)) : ?>
								<span class="feed-link">
									<a href="<?php echo htmlspecialchars($uri, ENT_COMPAT, 'UTF-8'); ?>" target="_blank">
										<?php echo trim($feed[$i]->title); ?></a></span>
							<?php else : ?>
								<span class="feed-link"><?php echo trim($feed[$i]->title); ?></span>
							<?php endif; ?>

							<?php if ($params->get('rssitemdate', 0)) : ?>
								<div class="feed-item-date">
									<time datetime="<?php echo JHtml::_('date', $date, JText::_('DATE_FORMAT_LC4')); ?>" itemprop="<?php echo $prop; ?>">
										<?php echo JHtml::_('date', $feed[$i]->publishedDate, JText::_('DATE_FORMAT_LC3')); ?>
									</time>
								</div>
							<?php endif; ?>

							<?php if ($params->get('rssitemdesc', 1) && $text !== '') : ?>
								<div class="feed-item-description">
									<?php
										// Strip the images.
										$text = JFilterOutput::stripImages($text);
										$text = JHtml::_('string.truncate', $text, $params->get('word_count', 0));
										echo strip_tags(str_replace('&apos;', "'", $text));
									?>
								</div>
							<?php endif; ?>
						</li>
					<?php endfor; ?>
				</ul>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php endif; 

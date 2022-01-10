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

<?php if (!empty($list)) : ?>
<section class="u-background-carousel u-padding-r-all <?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8'); ?>">
	<div class="u-layout-medium u-layoutCenter">
		<?php if ((bool) $module->showtitle || $params->get('show_controls', 1)) : ?>
			<div class="Grid">
				<?php if ((bool) $module->showtitle) : ?>
					<h2 id="carousel-heading-<?php echo $module->id; ?>" class="Grid-cell u-text-h2 u-color-white u-layout-centerLeft"><?php echo $module->title; ?></h2>
				<?php endif; ?>

				<?php if ($params->get('show_controls', 1)) : ?>
					<!-- <next / prev buttons> -->
					<div class="Grid-cell u-layout-centerRight">
						<button class="owl-prev u-padding-bottom-xl u-padding-right-xxl u-text-r-xl u-color-white" aria-controls="carousel-<?php echo $module->id; ?>">
							<span class="u-hiddenVisually">Vai alla slide precedente</span>
							<span class="u-alignMiddle Icon Icon-arrow-left" role="presentation"></span>
						</button>
						<button class="owl-next u-padding-bottom-xl u-padding-left u-text-r-xl u-color-white" aria-controls="carousel-<?php echo $module->id; ?>">
						  <span class="u-hiddenVisually">Vai alla slide successiva</span>
						  <span class="u-alignMiddle Icon Icon-arrow-right" role="presentation"></span>
						</button>
						<p class="u-hiddenVisually" aria-hidden="true">&Egrave; possibile navigare le slide utilizzando i tasti freccia</p>
					</div>
					<!-- </next / prev buttons> -->
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="owl-carousel owl-theme" role="region" id="carousel-<?php echo $module->id; ?>" aria-label="carousel-<?php echo $module->title; ?>"
			data-carousel-options='{"items":<?php echo $params->get('count', 1); ?><?php
			echo $params->get('auto_sliding', 1) ? ',"autoplay":true,"autoplaySpeed":' . $params->get('speed', 1000) . ',"autoplayTimeout":' . $params->get('interval', 5000) : '';
			echo $params->get('lazy', 1) ? ',"lazyLoad":true' : '';
			echo $params->get('loop', 1) ? ',"loop":true' : '';
			echo $params->get('show_indicators', 1) ? ',"dots":true' : ''; ?>,"responsive":false}'>
			<?php
			$i = 1000 * (int)$module->id;
			$target_default = $params->get('target', 2);
			?>
			<?php foreach ($list as $item) : ?>
			<div class="Carousel-item">
				<div class="u-color-grey-30">
					<figure>
						<?php
						$item->img = '<img class="u-sizeFull'
 							. ($params->get('lazy', 1) ? ' owl-lazy" data-' : '" ')
 							. 'src="' . JUri::root(true) . '/' . htmlspecialchars($item->image, ENT_COMPAT, 'UTF-8') . '" '
							. 'data-tooltip="' . htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8') . '" '
							. 'alt="' . htmlspecialchars($item->description, ENT_COMPAT, 'UTF-8') . '" />';
						if ($item->link)
						{
							// Compute the correct link
							$item->target = $item->target ?: $target_default;
							switch ($item->target)
							{
								case 2:
									// Open in a new window
									echo '<a href="' . htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8') . '" target="_blank"  rel="nofollow">' . $item->img . '</a>';
									break;

								case 3:
									// Open in a popup window
								    if ($props = @getimagesize($item->link))
								    {
								        list($width, $height, $type, $attr) = $props;
								        $tmp = 'location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='.$width.',height='.$height;
								    }
								    else
							    	{
								        $tmp = 'location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=screen.width/2,height=screen.height/2';
								    }

									echo "<a href=\"" . htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8') . "\" onclick=\"window.open(this.href, 'targetWindow', '" . $tmp . "'); return false;\">" .
										$item->img . '</a>';
									break;

								case 4:
									// Open in a modal window
									JHtml::_('behavior.modal', 'a.modal');

									if ($props = @getimagesize($item->link))
									{
									    list($width, $height, $type, $attr) = $props;
									    $rel = ' rel="{handler:\'iframe\',size:{x:' . ($width + 20) . ',y:' . ($height + 20) . '}}"';
									}
									else
									{
									    $rel = ' rel="{handler:\'iframe\',size:{x:screen.width/2,y:screen.height/2}}"';
									}
								
									echo '<a class="modal" href="' . htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8') . '"' . $rel . '>' .
									    $item->img . ' </a>';
									break;

								default:
									// Open in parent window
									echo '<a href="' . htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8') . '" rel="nofollow">' .
										$item->img . ' </a>';
									break;
							}
						} else {
						    echo $item->img;
						}
						?>
						<figcaption class="u-padding-r-top">
							<p class="u-color-teal-50 u-text-r-xxs u-textWeight-700 u-padding-bottom-s"><?php echo $item->caption; ?></p>
							<div class="Grid">
								<?php if ($item->icon) : ?>
									<span class="Grid-cell u-sizeFit Icon-<?php echo $item->icon; ?> u-color-white u-floatLeft u-text-r-l" aria-hidden="true"></span>
								<?php endif; ?>
								<h3 id="desc-<?php echo $i; ?>" class="Grid-cell u-sizeFill u-padding-left-s u-lineHeight-l u-color-white u-text-r-xs u-textWeight-700">
									<?php echo $item->description; ?>
								</h3>
							</div>
						</figcaption>
					</figure>
				</div>
			</div>
				<?php $i++; ?>
			<?php endforeach; ?>
		</div>
		<!--
		<p class="u-padding-r-top u-text-r-xl">
			<a href="#" class="u-layout-centerLeft u-padding-r-top u-text-h4 u-textWeight-700 u-color-teal-50">Vedi tutte le gallerie</a>
		</p>
		-->
	</div>
</section>
<?php endif; ?>

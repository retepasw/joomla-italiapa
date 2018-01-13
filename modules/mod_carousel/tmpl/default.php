<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	mod_carousel
 * @version		3.8
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'mod_carousel'));
?>

<?php if (!empty($list)) : ?>
<section class="u-background-grey-60 u-padding-r-all <?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8'); ?>">
	<div class="u-layout-medium u-layoutCenter">
	<?php if ($params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
	<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
	see <a href="https://italia.github.io/design-web-toolkit/components/detail/carousel.html">https://italia.github.io/design-web-toolkit/components/detail/carousel.html</a>
	</div>
	<?php endif; ?>
		<div class="Grid">
			<?php if ((bool) $module->showtitle) : ?>
			<h2 id="carousel-heading-<?php echo $module->id; ?>" class="Grid-cell u-text-h2 u-color-white u-layout-centerLeft"><?php echo $module->title; ?></h2>
			<?php endif; ?>
			<!-- <next / prev buttons> -->
			<div class="Grid-cell u-layout-centerRight">
				<button class="owl-prev u-padding-bottom-xl u-padding-right-xxl u-text-r-xl u-color-teal-50" aria-controls="carousel-<?php echo $module->id; ?>">
					<span class="u-hiddenVisually">Vai alla slide precedente</span>
					<span class="u-alignMiddle Icon Icon-arrow-left" role="presentation"></span>
				</button>
				<button class="owl-next u-padding-bottom-xl u-padding-left u-text-r-xl u-color-teal-50" aria-controls="carousel-<?php echo $module->id; ?>">
				  <span class="u-hiddenVisually">Vai alla slide successiva</span>
				  <span class="u-alignMiddle Icon Icon-arrow-right" role="presentation"></span>
				</button>
				<p class="u-hiddenVisually">� possibile navigare le slide utilizzando i tasti freccia</p>
			</div>
			<!-- </next / prev buttons> -->
		</div>
		
		<div class="owl-carousel owl-theme" role="region" id="carousel-<?php echo $module->id; ?>">
			<?php 
			$i = 1000 * (int)$module->id; 
			$target_default = $params->get('target', 2);
			?>
			<?php foreach ($list as $item) : ?>
			<?php JLog::add(new JLogEntry(print_r($item, true), JLog::DEBUG, 'mod_carousel')); ?>
			<div class="Carousel-item">
				<div class="u-color-grey-30">
					<figure>
						<?php
						$item->img = '<img src="' . htmlspecialchars($item->image, ENT_COMPAT, 'UTF-8') . '" '
								. 'class="u-sizeFull" '
								. 'title="' . htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8') . '" '
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
									list($width, $height, $type, $attr) = getimagesize($item->link);
									$tmp = 'location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='.$width.',height='.$height;
									echo "<a href=\"" . htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8') . "\" onclick=\"window.open(this.href, 'targetWindow', '" . $tmp . "'); return false;\">" .
										$item->img . '</a>';
									break;
								case 4:
									// Open in a modal window
									JHtml::_('behavior.modal', 'a.modal');
									list($width, $height, $type, $attr) = getimagesize($item->link);
									echo '<a class="modal" href="' . htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8') . '"'.
										' rel="{handler: \'iframe\', size: {x:' . ($width + 20) . ', y:' . ($height + 20) . '}}">' .
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
								<span class="Grid-cell u-sizeFit Icon-camera u-color-white u-floatLeft u-text-r-l" aria-hidden="true"></span>
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
			<a href="" class="u-layout-centerLeft u-padding-r-top u-text-h4 u-textWeight-700 u-color-teal-50">Vedi tutte le gallerie</a>
		</p>
		-->
	</div>
</section>
<?php endif; ?>

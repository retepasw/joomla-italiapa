<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	mod_carousel
 * @version		3.8.1
 * @since		3.8
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'mod_carousel'));

$document = JFactory::getDocument();
$document->addStyleSheet('media/jui/css/icomoon.css','text/css');
$document->addStyleSheet('media/mod_carousel/css/bootstrap.css','text/css');
$document->addScript('media/mod_carousel/js/bootstrap.js');
?>

<?php if (!empty($list)) : ?>
	<div id="carousel<?php echo $module->id; ?>" class="carousel slide multi-item-carousel"<?php echo $params->get('auto_sliding', 1) ? ' data-ride="carousel"' : ' data-interval="false"'; ?>>
		<?php if ($params->get('show_indicators', 1)) : ?>
			<ol class="carousel-indicators">
			<?php $class = ' class="active"'; ?>
				<?php //$i = 0; ?>
				<?php for ($i = 0; $i <= (int) ((count((array) $list) - 1) / 3); $i++) : ?>
				<?php //foreach ($list as $item) : ?>
					<li data-target="#carousel<?php echo $module->id; ?>" data-slide-to="<?php echo $i; ?>"<?php echo $class; ?>></li>
					<?php $class = ''; ?>
					<?php //$i++; ?>
				<?php //endforeach; ?>
				<?php endfor; ?>
			</ol>
		<?php endif; ?>

		<div class="carousel-inner">
			<?php $i = 0; ?>
			<?php $class = " active"; ?>
			<?php $target_default = $params->get('target', 2); ?>
			<?php foreach ($list as $item) : ?>
				<?php if ($i == 0) : ?>
					<div class="item<?php echo $class; ?>">
					<div class="row-fluid">
				<?php endif; ?>
				<?php $class = ""; ?>

				<?php JLog::add(new JLogEntry(print_r($item, true), JLog::DEBUG, 'mod_carousel')); ?>
				<figure class="span4">
					<?php 
					$class = "";
					$item->img = '<img src="' . htmlspecialchars($item->image, ENT_COMPAT, 'UTF-8') . '" '
//							. 'class="d-block w-100" '
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
					<figcaption>
						<h3><?php echo $item->caption; ?></h3>
						<p>
							<?php if ($item->icon) : ?>
								<span class="icon-<?php echo $item->icon; ?>"></span>
							<?php endif; ?>						
							<?php echo $item->description; ?>
						</p>
					</figcaption>
				</figure>

				<?php $i = ($i + 1) % 3; ?>
				<?php if ($i == 0) : ?>
					</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php if ($i > 0) : ?>
				</div>
				</div>
			<?php endif; ?>
		</div>

		<?php if ($params->get('show_controls', 1)) : ?>
			<a class="left carousel-control" href="#carousel<?php echo $module->id; ?>" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only"><?php echo JText::_('JPREVIOUS'); ?></span>
			</a>
			<a class="right carousel-control" href="#carousel<?php echo $module->id; ?>" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only"><?php echo JText::_('JNEXT'); ?></span>
			</a>
		<?php endif; ?>
  	</div>
<?php endif; ?>

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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$cparams = JComponentHelper::getParams('com_media');
$mparams = $this->params;
?>

<?php if ($mparams->get('show_page_heading')) : ?>
	<h1 class="u-text-h1">
		<?php echo $this->escape($mparams->get('page_heading')); ?>
	</h1>
<?php endif; ?>

<div class="Grid">

<?php foreach ($this->items as $i => $item) : ?>
	<?php
	$this->item = &$item;
	$tparams = $item->params;
	$presentation_style = $tparams->get('presentation_style');
	$accordionStarted = false;
	$tabSetStarted = false;
	?>
	<?php if (in_array($item->access, $this->user->getAuthorisedViewLevels())) : ?>
		<div class="u-sizeFull">
			<?php $show_contact_category = $tparams->get('show_contact_category'); ?>
			<?php if ($show_contact_category === 'show_no_link') : ?>
				<span class="u-text-h2">
					<span class="Dot u-background-70"></span>
					<span class="u-textClean u-textWeight-700 u-text-r-xs u-color-50 contact-category"><?php echo $this->category->title; ?></span>
				</span>
			<?php elseif ($show_contact_category === 'show_with_link') : ?>
				<span class="u-text-h2 u-cf">
					<span class="Dot u-background-70"></span>
					<?php $contactLink = ContactHelperRoute::getCategoryRoute($item->catid); ?>
					<span class="contact-category"><a href="<?php echo $contactLink; ?>" class="u-textClean u-textWeight-700 u-text-r-xs u-color-50">
						<?php echo $this->escape($this->category->title); ?></a>
					</span>
				</span>
			<?php endif; ?>

			<div class="u-cf u-margin-bottom-s">
				<?php if ($item->image && $tparams->get('show_image', $mparams->get('show_image_heading'))) : ?>
					<div class="u-inlineBlock u-floatLeft u-borderRadius-circle u-nbfc u-margin-right-m contact-image">
						<?php echo JHtml::_('image', $item->image, $item->name, array('itemprop' => 'image', 'class' => 'u-sizeFull')); ?>
					</div>
				<?php endif; ?>

				<div class="page-header">
					<h4 class="u-text-h4">
						<?php if ($item->published == 0) : ?>
							<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
						<?php endif; ?>
						<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>" class="u-linkClean">
							<span class="contact-name" itemprop="name"><?php echo $item->name; ?></span>
						</a>
					</h4>
				</div>
			
				<?php // echo $item->event->afterDisplayTitle; ?>
			
				<?php // echo $item->event->beforeDisplayContent; ?>

				<?php //if ($item->con_position && $tparams->get('show_position')) : ?>				
				<?php if ($item->con_position && $mparams->get('show_position_headings')) : ?>
					<div class="contact-position u-text-h5">
						<span class="u-hiddenVisually"><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</span>
						<span itemprop="jobTitle"><?php echo $item->con_position; ?></span>
					</div>
				<?php endif; ?>

				<?php if ($tparams->get('show_links')) : ?>
					<?php echo $this->loadTemplate('links'); ?>
				<?php endif; ?>

				<?php // echo $item->event->afterDisplayContent; ?>
			</div>

		</div>
	<?php endif; ?>
<?php endforeach; ?>

</div>

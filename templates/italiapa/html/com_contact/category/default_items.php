<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

JHtml::_('behavior.core');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

$headerClass = $this->params->get('show_headings') != 1 ? ' u-hiddenVisually' : '';
$class = "u-text-r-xs u-padding-all-xs";

$app = JFactory::getApplication();
$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->get('list_limit', 20), 'uint');
?>
<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_CONTACT_NO_CONTACTS'); ?>	 </p>
<?php else : ?>
<div class="u-color-grey-30 u-border-top-xxs u-border-bottom-xxs">
	<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="Form Form--ultraLean u-margin-bottom-l">
		<?php if ($this->params->get('filter_field') || ($this->params->get('show_pagination_limit'))) : ?>
		<div class="Grid">
			<?php if ($this->params->get('filter_field')) : ?>
				<?php if ($this->params->get('show_pagination_limit')) : ?>
					<?php $size = "u-sizeFull u-sm-size8of12 u-md-size8of12 u-lg-size8of12"; ?>
				<?php else : ?>
					<?php $size = "u-size8of12 u-sm-size10of12 u-md-size10of12 u-lg-size10of12"; ?>
				<?php endif; ?>
			<div class="Form-field Grid-cell <?php echo $size; ?> u-border-right-xxs u-border-top-xxs">
				<input class="Form-input u-text-r-s u-padding-r-all u-color-black" type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="Form-input u-color-grey-90 <?php echo $class; ?>" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_CONTACT_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_CONTACT_FILTER_LABEL'); ?>" />
				<label class="Form-label u-color-grey-90 u-text-r-m u-hiddenVisually" for="filter-search">
				<?php echo JText::_('COM_CONTACT_FILTER_LABEL'); ?>
				</label>
			</div>
			<?php else : ?>
			<div class="Form-field Grid-cell u-size6of12 u-sm-size10of12 u-md-size10of12 u-lg-size10of12 u-border-right-xxs u-border-top-xxs">
			</div>
			<?php endif; ?>

			<?php if ($this->params->get('show_pagination_limit')) : ?>
			<div class="Form-field Grid-cell u-size6of12 u-sm-size2of12 u-md-size2of12 u-lg-size2of12 u-border-right-xxs u-border-top-xxs">
				<label for="limit" class="Form-label u-hiddenVisually">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php
					echo str_replace(
						'class="inputbox input-mini"',
						'class="Form-input u-color-grey-90 u-text-r-s u-padding-r-all"',
						$this->pagination->getLimitBox()
						);
				?>
			</div>
			<?php endif; ?>

			<?php if ($this->params->get('filter_field')) : ?>
				<?php if ($this->params->get('show_pagination_limit')) : ?>
					<?php $size = "u-size6of12"; ?>
				<?php else : ?>
					<?php $size = "u-size4of12"; ?>
				<?php endif; ?>
			<button type="submit" name="filter_submit" class="<?php echo $size; ?> u-sm-size2of12 u-md-size2of12 u-lg-size2of12 u-background-40 u-color-white u-padding-all-s u-text-r-m u-textNoWrap <?php echo $class; ?>"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<input type="hidden" name="limitstart" value="" />
		<input type="hidden" name="task" value="" />
	</form>

	<div class="Grid Grid--withGutterM">
		<?php foreach ($this->items as $i => $item) : ?>
		<div class="Grid-cell u-md-size1of3 u-lg-size1of3 u-flex u-margin-r-bottom u-flexJustifyCenter">
			<?php if (in_array($item->access, $this->user->getAuthorisedViewLevels())) : ?>
				<?php //if ($this->items[$i]->published == 0) : ?>
			<div class="u-nbfc u-borderShadow-xxs u-borderRadius-m u-color-grey-30 u-background-white">

				<?php if ($this->params->get('show_image_heading')) : ?>
					<?php if ($this->items[$i]->image) : ?>
						<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>">
							<?php echo JHtml::_('image', $this->items[$i]->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('class' => 'u-sizeFull contact-thumbnail img-thumbnail')); ?></a>
					<?php endif; ?>
				<?php endif; ?>

				<div class="u-text-r-l u-padding-r-all u-layout-prose list-title">
					<h3 class="u-text-h4 u-margin-r-bottom">
						<a class="u-text-r-m u-color-black u-textWeight-400 u-textClean" href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>">
						<?php echo $item->name; ?></a>
					<?php if ($this->items[$i]->published == 0) : ?>
						<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
					<?php endif; ?>
					</h3>
					<?php echo $item->event->afterDisplayTitle; ?>

					<div class="u-text-p u-textSecondary">
					<?php echo $item->event->beforeDisplayContent; ?>

					<?php if ($this->params->get('show_position_headings')) : ?>
							<?php echo $item->con_position; ?><br />
					<?php endif; ?>
					<?php if ($this->params->get('show_email_headings')) : ?>
							<?php echo $item->email_to; ?><br />
					<?php endif; ?>
					<?php $location = array(); ?>
					<?php if ($this->params->get('show_suburb_headings') && !empty($item->suburb)) : ?>
						<?php $location[] = $item->suburb; ?>
					<?php endif; ?>
					<?php if ($this->params->get('show_state_headings') && !empty($item->state)) : ?>
						<?php $location[] = $item->state; ?>
					<?php endif; ?>
					<?php if ($this->params->get('show_country_headings') && !empty($item->country)) : ?>
						<?php $location[] = $item->country; ?>
					<?php endif; ?>
					<?php if (count($location)) : ?>
						<?php echo implode($location, ', '); ?><br />
					<?php endif; ?>

					<?php if ($this->params->get('show_telephone_headings') && !empty($item->telephone)) : ?>
						<?php echo JText::sprintf('COM_CONTACT_TELEPHONE_NUMBER', $item->telephone); ?><br />
					<?php endif; ?>

					<?php if ($this->params->get('show_mobile_headings') && !empty ($item->mobile)) : ?>
							<?php echo JText::sprintf('COM_CONTACT_MOBILE_NUMBER', $item->mobile); ?><br />
					<?php endif; ?>

					<?php if ($this->params->get('show_fax_headings') && !empty($item->fax) ) : ?>
						<?php echo JText::sprintf('COM_CONTACT_FAX_NUMBER', $item->fax); ?><br />
					<?php endif; ?>
					</div>

				<?php echo $item->event->afterDisplayContent; ?>

				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>

<!--
			<?php if ($this->params->get('show_pagination', 2)) : ?>
			<div class="pagination">
				<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
				<?php endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
			<?php endif; ?>
 -->
	</div>
</div>
<?php endif; ?>

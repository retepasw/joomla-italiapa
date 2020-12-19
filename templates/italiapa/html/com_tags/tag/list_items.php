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

JHtml::_('behavior.core');

$n         = count($this->items);
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

JFactory::getDocument()->addScriptDeclaration("
		var resetFilter = function() {
		document.getElementById('filter-search').value = '';
	}
");

?>

<?php if ($this->params->get('filter_field') || $this->params->get('show_pagination_limit')) : ?>
<div class="u-color-grey-30 u-border-top-xxs u-border-bottom-xxs">
	<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="Form Form--ultraLean">
		<div class="Grid">
			<legend class="u-hiddenVisually"><?php echo JText::_('COM_TAGS_FORM_FILTER_LEGEND'); ?></legend>
			<?php if ($this->params->get('filter_field')) : ?>
			<div class="Form-field Grid-cell u-sizeFull u-sm-size6of12 u-md-size4of12 u-lg-size8of12 u-border-right-xxs u-border-top-xxs">
				<input class="Form-input u-text-r-s u-padding-r-all u-color-black" type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="Form-input u-color-grey-90 <?php echo $class; ?>" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_TAGS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>" />
				<label class="Form-label u-color-grey-90 u-text-r-m u-hiddenVisually" for="filter-search">
					<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>
				</label>
			</div>
			<?php endif; ?>

			<?php if ($this->params->get('show_pagination_limit')) : ?>
				<div class="Form-field Grid-cell u-sizeFull u-sm-size4of12 u-md-size3of12 u-lg-size2of12 u-border-right-xxs u-border-top-xxs">
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

			<input type="hidden" name="filter_order" value="" />
			<input type="hidden" name="filter_order_Dir" value="" />
			<input type="hidden" name="limitstart" value="" />
			<input type="hidden" name="task" value="" />

			<button type="submit" name="filter_submit" class="u-lg-size2of12 u-background-40 u-color-white u-padding-all-s u-text-r-m u-textNoWrap <?php echo $class; ?>"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
		</div>
	</form>
</div>
<?php endif; ?>

	<?php if ($this->items === false || $n === 0) : ?>
		<p><?php echo JText::_('COM_TAGS_NO_ITEMS'); ?></p>
	<?php else : ?>
		<table class="category Table Table--withBorder u-text-r-xs">
			<?php if ($this->params->get('show_headings')) : ?>
				<thead>
					<tr>
						<th id="categorylist_header_title">
							<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'c.core_title', $listDirn, $listOrder); ?>
						</th>
						<?php if ($date = $this->params->get('tag_list_show_date')) : ?>
							<th id="categorylist_header_date">
								<?php if ($date === 'created') : ?>
									<?php echo JHtml::_('grid.sort', 'COM_TAGS_' . $date . '_DATE', 'c.core_created_time', $listDirn, $listOrder); ?>
								<?php elseif ($date === 'modified') : ?>
									<?php echo JHtml::_('grid.sort', 'COM_TAGS_' . $date . '_DATE', 'c.core_modified_time', $listDirn, $listOrder); ?>
								<?php elseif ($date === 'published') : ?>
									<?php echo JHtml::_('grid.sort', 'COM_TAGS_' . $date . '_DATE', 'c.core_publish_up', $listDirn, $listOrder); ?>
								<?php endif; ?>
							</th>
						<?php endif; ?>
					</tr>
				</thead>
			<?php endif; ?>
			<tbody>
				<?php foreach ($this->items as $i => $item) : ?>
					<?php if ($this->items[$i]->core_state == 0) : ?>
						<tr class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
					<?php else : ?>
						<tr class="cat-list-row<?php echo $i % 2; ?>">
					<?php endif; ?>
						<td <?php if ($this->params->get('show_headings')) echo "headers=\"categorylist_header_title\""; ?> class="list-title">
							<a href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>">
								<?php echo $this->escape($item->core_title); ?>
							</a>
							<?php if ($item->core_state == 0) : ?>
								<span class="list-published label label-warning">
									<?php echo JText::_('JUNPUBLISHED'); ?>
								</span>
							<?php endif; ?>
						</td>
						<?php if ($this->params->get('tag_list_show_date')) : ?>
							<td headers="categorylist_header_date" class="list-date small">
								<?php
								echo JHtml::_(
									'date', $item->displayDate,
									$this->escape($this->params->get('date_format', JText::_('DATE_FORMAT_LC3')))
								); ?>
							</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

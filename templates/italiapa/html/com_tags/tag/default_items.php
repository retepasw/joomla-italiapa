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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.core');

// Get the user object.
$user = JFactory::getUser();

// Check if user is allowed to add/edit based on tags permissions.
// Do we really have to make it so people can see unpublished tags???
$canEdit      = $user->authorise('core.edit', 'com_tags');
$canCreate    = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');
$items        = $this->items;
$n            = count($this->items);

JFactory::getDocument()->addScriptDeclaration("
		var resetFilter = function() {
		document.getElementById('filter-search').value = '';
	}
");

?>

<?php if ($this->params->get('filter_field') || $this->params->get('show_pagination_limit')) : ?>
<div class="u-color-grey-30 u-border-top-xxs u-border-bottom-xxs">
	<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="Form Form--ultraLean">
		<div class="Grid Grid--alignRight">
			<legend class="u-hiddenVisually"><?php echo JText::_('COM_TAGS_FORM_FILTER_LEGEND'); ?></legend>
			<?php if ($this->params->get('filter_field')) : ?>
			
			<?php $size = 'u-sizeFull ' . ($this->params->get('show_pagination_limit') ? 'u-sm-size8of12 u-md-size8of12 u-lg-size8of12' : 'u-sm-size10of12 u-md-size10of12 u-lg-size10of12'); ?>

			<div class="Form-field Grid-cell <?php echo $size; ?> u-border-left-xxs u-border-right-xxs">
				<input class="Form-input u-text-r-s u-padding-r-all u-color-black" type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="Form-input u-color-grey-90 <?php echo $class; ?>" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_TAGS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>" />
				<label class="Form-label u-color-grey-90 u-text-r-m u-hiddenVisually" for="filter-search">
					<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>
				</label>
			</div>
			<?php endif; ?>

			<?php if ($this->params->get('show_pagination_limit')) : ?>
				<div class="Form-field Grid-cell u-sizeFull u-sm-size2of12 u-md-size2of12 u-lg-size2of12 u-border-left-xxs<?php echo !$this->params->get('filter_field') ? '' : ' u-border-top-xxs'; ?> u-border-right-xxs">
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
				<button type="submit" name="filter_submit" class="u-sizeFull u-sm-size2of12 u-md-size2of12 u-lg-size2of12 u-background-40 u-color-white u-padding-all-s u-text-r-m u-textNoWrap <?php echo $class; ?>"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<?php endif; ?>

			<input type="hidden" name="filter_order" value="" />
			<input type="hidden" name="filter_order_Dir" value="" />
			<input type="hidden" name="limitstart" value="" />
			<input type="hidden" name="task" value="" />
		</div>
	</form>
</div>
<?php endif; ?>

	<?php if ($this->items === false || $n === 0) : ?>
		<p><?php echo JText::_('COM_TAGS_NO_ITEMS'); ?></p>
	<?php else : ?>
<div class="Grid-cell u-sizeFull u-sm-size1of2 u-md-size1of3 u-lg-size1of3 u-margin-r-bottom">
    <div class="u-sizeFull u-text-r-s u-color-70">
<?php /**
    	<h3 class="u-border-bottom-m">
        <a href="#" class="u-block u-text-h3 u-textClean u-color-60">sample title
        <!-- <span class="u-text-r-s Icon Icon-chevron-right"></span> -->
        </a></h3>
*/ ?>
        <ul class="Linklist Prose u-text-r-xs">
			<?php foreach ($items as $i => $item) : ?>
				<?php if ($item->core_state == 0) : ?>
					<li class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
				<?php else : ?>
					<li class="cat-list-row<?php echo $i % 2; ?> clearfix">
					<?php if (($item->type_alias === 'com_users.category') || ($item->type_alias === 'com_banners.category')) : ?>
						<h3>
							<?php echo $this->escape($item->core_title); ?>
						</h3>
					<?php else : ?>
						<h3>
							<a href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>">
								<?php echo $this->escape($item->core_title); ?>
							</a>
						</h3>
					<?php endif; ?>
				<?php endif; ?>
				<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
				<?php echo $item->event->afterDisplayTitle; ?>
				<?php $images = json_decode($item->core_images); ?>
				<?php if ($this->params->get('tag_list_show_item_image', 1) == 1 && !empty($images->image_intro)) : ?>
					<a href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>">
						<img src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" />
					</a>
				<?php endif; ?>
				<?php if ($this->params->get('tag_list_show_item_description', 1)) : ?>
					<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
					<?php echo $item->event->beforeDisplayContent; ?>
					<span class="tag-body">
						<?php echo JHtml::_('string.truncate', $item->core_body, $this->params->get('tag_list_item_maximum_characters')); ?>
					</span>
					<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
					<?php echo $item->event->afterDisplayContent; ?>
				<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
    </div>
</div>
	<?php endif; ?>

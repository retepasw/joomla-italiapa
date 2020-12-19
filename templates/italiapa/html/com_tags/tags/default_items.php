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
$canEdit      = $user->authorise('core.edit', 'com_tags');
$canCreate    = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');

$columns = $this->params->get('tag_columns', 1);

// Avoid division by 0 and negative columns.
if ($columns < 1)
{
	$columns = 1;
}

$bsspans = floor(12 / $columns);

if ($bsspans < 1)
{
	$bsspans = 1;
}

$bscolumns = min($columns, floor(12 / $bsspans));
$n         = count($this->items);

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
			
			<?php $size = 'u-sizeFull ' . ($this->params->get('show_pagination_limit') ? 'u-sm-size6of12 u-md-size4of12 u-lg-size8of12' : 'u-sm-size10of12 u-md-size7of12 u-lg-size10of12'); ?>

			<div class="Form-field Grid-cell <?php echo $size; ?>">
				<input class="Form-input u-text-r-s u-padding-r-all u-color-black" type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="Form-input u-color-grey-90 <?php echo $class; ?>" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_TAGS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>" />
				<label class="Form-label u-color-grey-90 u-text-r-m u-hiddenVisually" for="filter-search">
					<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>
				</label>
			</div>
			<?php endif; ?>

			<?php if ($this->params->get('show_pagination_limit')) : ?>
				<div class="Form-field Grid-cell u-sizeFull u-sm-size4of12 u-md-size3of12 u-lg-size2of12 u-border-left-xxs<?php echo !$this->params->get('filter_field') ? ' u-border-right-xxs' : ''; ?>">
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
				<button type="submit" name="filter_submit" class="u-lg-size2of12 u-background-40 u-color-white u-padding-all-s u-text-r-m u-textNoWrap <?php echo $class; ?>"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<?php endif; ?>

			<input type="hidden" name="filter_order" value="" />
			<input type="hidden" name="filter_order_Dir" value="" />
			<input type="hidden" name="limitstart" value="" />
			<input type="hidden" name="task" value="" />
		</div>
	</form>
</div>
<?php endif; ?>

	<?php if ($this->items == false || $n === 0) : ?>
		<p><?php echo JText::_('COM_TAGS_NO_TAGS'); ?></p>
	<?php else : ?>
<!--
		<div class="Grid-cell u-sizeFull u-sm-size1of2 u-md-size1of3 u-lg-size1of3 u-margin-r-bottom">
    		<div class="u-sizeFull u-text-r-s u-color-70">
-->
<?php /**
    	<h3 class="u-border-bottom-m">
        <a href="#" class="u-block u-text-h3 u-textClean u-color-60">sample title
        <!-- <span class="u-text-r-s Icon Icon-chevron-right"></span> -->
        </a></h3>
*/ ?>
		<?php foreach ($this->items as $i => $item) : ?>
			<?php if ($n === 1 || $i === 0 || $bscolumns === 1 || $i % $bscolumns === 0) : ?>
				<div class="Grid Grid--withGutter u-padding-all-l">
		        <!-- <ul class="thumbnails Linklist Prose u-text-r-xs"> -->
			<?php endif; ?>
			<?php if ((!empty($item->access)) && in_array($item->access, $this->user->getAuthorisedViewLevels())) : ?>
				<div class="Grid-cell u-size1of<?php echo $columns; ?>">
				<!-- <li class="cat-list-row<?php echo $i % 2; ?>"> -->
					<h3>
						<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($item->id . ':' . $item->alias)); ?>">
							<?php echo $this->escape($item->title); ?>
						</a>
					</h3>
			<?php //endif; ?>
			<?php if ($this->params->get('all_tags_show_tag_image') && !empty($item->images)) : ?>
				<?php $images  = json_decode($item->images); ?>
				<span class="tag-body">
					<?php if (!empty($images->image_intro)) : ?>
						<?php $imgfloat = empty($images->float_intro) ? $this->params->get('float_intro') : $images->float_intro; ?>
						<div class="item-image<?php echo $imgfloat ? ' pull-' . htmlspecialchars($imgfloat) : ''; ?>">
							<img
								<?php if ($images->image_intro_caption) : ?>
									<?php echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_intro_caption) . '"'; ?>
								<?php endif; ?>
								class="u-sizeFull" src="<?php echo $images->image_intro; ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" />
						</div>
					<?php endif; ?>
				</span>
			<?php endif; ?>
			<div class="caption">
				<?php if ($this->params->get('all_tags_show_tag_description', 1)) : ?>
					<span class="tag-body">
						<?php echo JHtml::_('string.truncate', $item->description, $this->params->get('all_tags_tag_maximum_characters')); ?>
					</span>
				<?php endif; ?>
				<?php if ($this->params->get('all_tags_show_tag_hits')) : ?>
					<span class="list-hits badge badge-info">
						<?php echo JText::sprintf('JGLOBAL_HITS_COUNT', $item->hits); ?>
					</span>
				<?php endif; ?>
			</div>
			</div>
			<!-- </li> -->
			<?php endif; ?>
			<?php if (($i === 0 && $n === 1) || $i === $n - 1 || $bscolumns === 1 || (($i + 1) % $bscolumns === 0)) : ?>
				</div>
				<!-- </ul> -->
			<?php endif; ?>
		<?php endforeach; ?>
<!--
			</div>
		</div>
-->
	<?php endif; ?>
	<?php // Add pagination links ?>
	<?php if (!empty($this->items)) : ?>
		<?php if (($this->params->def('show_pagination', 2) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
			<div class="pagination">
				<?php if ($this->params->def('show_pagination_results', 1)) : ?>
					<p class="counter pull-right">
						<?php echo $this->pagination->getPagesCounter(); ?>
					</p>
				<?php endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

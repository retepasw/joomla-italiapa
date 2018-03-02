<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');

// Create some shortcuts.
$params	= &$this->item->params;
$n		 = count($this->items);
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

// Check for at least one editable article
$isEditable = false;

if (!empty($this->items))
{
	foreach ($this->items as $article)
	{
		if ($article->params->get('access-edit'))
		{
			$isEditable = true;
			break;
		}
	}
}

$headerClass = $this->params->get('show_headings') != 1 ? ' u-hiddenVisually' : '';
$class = "u-text-r-xs u-padding-all-xs";
?>
<!--
<div class="Grid-cell u-sizeFull u-md-size4of12 u-lg-size4of12">
<div class="u-sizeFull u-md-size11of12 u-lg-size11of12" id="subnav">
-->
<?php if ($this->params->get('filter_field') !== 'hide' || $this->params->get('show_pagination_limit')) : ?>
<div class="u-color-grey-30 u-border-top-xxs u-border-bottom-xxs">
	<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="Form Form--ultraLean">
		<div class="Grid">
			<legend class="u-hiddenVisually"><?php echo JText::_('COM_CONTENT_FORM_FILTER_LEGEND'); ?></legend>
			<?php if ($this->params->get('filter_field') !== 'hide') : ?>
			<div class="Form-field Grid-cell u-sizeFull u-sm-size6of12 u-md-size4of12 u-lg-size8of12 u-border-right-xxs u-border-top-xxs">
			<?php if ($this->params->get('filter_field') === 'tag') : ?>
				<label class="Form-label is-required u-hiddenVisually" for="filter_tag"><?php echo JText::_('JTAG'); ?></label>
				<select name="filter_tag" id="filter_tag" onchange="document.adminForm.submit();" class="Form-input u-color-grey-90 <?php echo $class; ?>">
					<option value=""><?php echo JText::_('JOPTION_SELECT_TAG'); ?></option>
					<?php echo JHtml::_('select.options', JHtml::_('tag.options', true, true), 'value', 'text', $this->state->get('filter.tag')); ?>
				</select>
			<?php elseif ($this->params->get('filter_field') === 'month') : ?>
				<label class="Form-label is-required u-hiddenVisually" for="filter-search"><?php echo JText::_('JMONTH'); ?></label>
				<select name="filter-search" id="filter-search" onchange="document.adminForm.submit();" class="Form-input u-color-grey-90 <?php echo $class; ?>">
					<option value=""><?php echo JText::_('JOPTION_SELECT_MONTH'); ?></option>
					<?php echo JHtml::_('select.options', JHtml::_('content.months', $this->state), 'value', 'text', $this->state->get('list.filter')); ?>
				</select>
			<?php else : ?>
				<input class="Form-input u-text-r-s u-padding-r-all u-color-black" type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="Form-input u-color-grey-90 <?php echo $class; ?>" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_CONTENT_' . $this->params->get('filter_field') . '_FILTER_LABEL'); ?>" />
				<label class="Form-label u-color-grey-90 u-text-r-m u-hiddenVisually" for="filter-search">
					<?php echo JText::_('COM_CONTENT_' . $this->params->get('filter_field') . '_FILTER_LABEL'); ?>
				</label>
			<?php endif; ?>
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

			<button type="submit" name="filter_submit" class="u-lg-size2of12 u-background-40 u-color-white u-padding-all-s u-text-r-m u-textNoWrap <?php echo $class; ?>"><?php echo JText::_('COM_CONTENT_FORM_FILTER_SUBMIT'); ?></button>
		</div>
	</form>
</div>
<?php endif; ?>

<?php if (empty($this->items)) : ?>
	<?php if ($this->params->get('show_no_articles', 1)) : ?>
		<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php endif; ?>
<?php else : ?>

<?php
$tot = 6 + 4 * (
	$this->params->get('list_show_date') ||
	$this->params->get('list_show_author', 1) ||
	$this->params->get('list_show_hits', 1) ||
	$this->params->get('list_show_votes', 0) ||
	$this->params->get('list_show_ratings', 0)
	) + 2 * $isEditable
	;
?>

<table class="Table Table--striped Table--hover Table--withBorder">
	<caption class="u-hiddenVisually"><?php echo JText::sprintf('COM_CONTENT_CATEGORY_LIST_TABLE_CAPTION', $this->category->title); ?></caption>
	<thead>
		<tr class="u-border-bottom-xs<?php echo $headerClass ?>">
			<th scope="col" id="categorylist_header_title" class="u-textCenter">
				<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder, null, 'asc', '', 'adminForm'); ?>
			</th>
		<?php if ($date = $this->params->get('list_show_date')) : ?>
			<th scope="col" id="categorylist_header_date" class="u-textCenter">
				<?php if ($date === 'created') : ?>
					<?php echo JHtml::_('grid.sort', 'COM_CONTENT_' . $date . '_DATE', 'a.created', $listDirn, $listOrder); ?>
				<?php elseif ($date === 'modified') : ?>
					<?php echo JHtml::_('grid.sort', 'COM_CONTENT_' . $date . '_DATE', 'a.modified', $listDirn, $listOrder); ?>
				<?php elseif ($date === 'published') : ?>
					<?php echo JHtml::_('grid.sort', 'COM_CONTENT_' . $date . '_DATE', 'a.publish_up', $listDirn, $listOrder); ?>
				<?php endif; ?>
			</th>
		<?php endif; ?>
		<?php if ($this->params->get('list_show_author')) : ?>
			<th scope="col" id="categorylist_header_author" class="u-textCenter">
				<?php echo JHtml::_('grid.sort', 'JAUTHOR', 'author', $listDirn, $listOrder); ?>
			</th>
		<?php endif; ?>
		<?php if ($this->params->get('list_show_hits')) : ?>
			<th scope="col" id="categorylist_header_hits" class="u-textCenter">
				<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'a.hits', $listDirn, $listOrder); ?>
			</th>
		<?php endif; ?>
		<?php if ($this->params->get('list_show_votes', 0) && $this->vote) : ?>
			<th scope="col" id="categorylist_header_votes" class="u-textCenter">
				<?php echo JHtml::_('grid.sort', 'COM_CONTENT_VOTES', 'rating_count', $listDirn, $listOrder); ?>
			</th>
		<?php endif; ?>
		<?php if ($this->params->get('list_show_ratings', 0) && $this->vote) : ?>
			<th scope="col" id="categorylist_header_ratings" class="u-textCenter">
				<?php echo JHtml::_('grid.sort', 'COM_CONTENT_RATINGS', 'rating', $listDirn, $listOrder); ?>
			</th>
		<?php endif; ?>
		<?php if ($isEditable) : ?>
			<th scope="col" id="categorylist_header_edit" class="u-textCenter"><?php echo JText::_('COM_CONTENT_EDIT_ITEM'); ?></th>
		<?php endif; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->items as $i => $article) : ?>
			<?php if ($this->items[$i]->state == 0) : ?>
				<tr class="system-unpublished">
			<?php else : ?>
				<tr>
			<?php endif; ?>
				<td>
				<?php if (in_array($article->access, $this->user->getAuthorisedViewLevels())) : ?>
					<a
						href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language)); ?>">
						<?php echo $this->escape($article->title); ?>
					</a>
					<?php if (JLanguageAssociations::isEnabled() && $this->params->get('show_associations')) : ?>
						<?php $associations = ContentHelperAssociation::displayAssociations($article->id); ?>
						<?php foreach ($associations as $association) : ?>
							<?php if ($this->params->get('flags', 1)) : ?>
								<?php $flag = JHtml::_('image', 'mod_languages/' . $association['language']->image . '.gif', $association['language']->title_native, array('title' => $association['language']->title_native), true); ?>
								&nbsp;<a href="<?php echo JRoute::_($association['item']); ?>"><?php echo $flag; ?></a>&nbsp;
							<?php else : ?>
								<?php $class = 'label label-association label-' . $association['language']->sef; ?>
								&nbsp;<a class="' . <?php echo $class; ?> . '" href="<?php echo JRoute::_($association['item']); ?>"><?php echo strtoupper($association['language']->sef); ?></a>&nbsp;
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php
					echo $this->escape($article->title) . ' : ';
					$menu   = JFactory::getApplication()->getMenu();
					$active = $menu->getActive();
					$itemId = $active->id;
					$link   = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
					$link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language)));
					?>
					<a href="<?php echo $link; ?>" class="register">
						<?php echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE'); ?>
					</a>
					<?php if (JLanguageAssociations::isEnabled() && $this->params->get('show_associations')) : ?>
						<?php $associations = ContentHelperAssociation::displayAssociations($article->id); ?>
						<?php foreach ($associations as $association) : ?>
							<?php if ($this->params->get('flags', 1)) : ?>
								<?php $flag = JHtml::_('image', 'mod_languages/' . $association['language']->image . '.gif', $association['language']->title_native, array('title' => $association['language']->title_native), true); ?>
								&nbsp;<a href="<?php echo JRoute::_($association['item']); ?>"><?php echo $flag; ?></a>&nbsp;
							<?php else : ?>
								<?php $class = 'label label-association label-' . $association['language']->sef; ?>
								&nbsp;<a class="' . <?php echo $class; ?> . '" href="<?php echo JRoute::_($association['item']); ?>"><?php echo strtoupper($association['language']->sef); ?></a>&nbsp;
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($article->state == 0) : ?>
					<span class="list-published label label-warning">
						<?php echo JText::_('JUNPUBLISHED'); ?>
					</span>
				<?php endif; ?>
				<?php if (strtotime($article->publish_up) > strtotime(JFactory::getDate())) : ?>
					<span class="list-published label label-warning">
						<?php echo JText::_('JNOTPUBLISHEDYET'); ?>
					</span>
				<?php endif; ?>
				<?php if ((strtotime($article->publish_down) < strtotime(JFactory::getDate())) && $article->publish_down != JFactory::getDbo()->getNullDate()) : ?>
					<span class="list-published label label-warning">
						<?php echo JText::_('JEXPIRED'); ?>
					</span>
				<?php endif; ?>
				</td>

			<?php if ($this->params->get('list_show_date')) : ?>
				<td class="list-date">
					<?php
					echo JHtml::_(
						'date', $article->displayDate,
						$this->escape($this->params->get('date_format', JText::_('DATE_FORMAT_LC3')))
					); ?>
				</td>
			<?php endif; ?>

			<?php if ($this->params->get('list_show_author', 1)) : ?>
				<td class="list-author">
					<?php if (!empty($article->author) || !empty($article->created_by_alias)) : ?>
						<?php $author = $article->author ?>
						<?php $author = $article->created_by_alias ?: $author; ?>
						<?php if (!empty($article->contact_link) && $this->params->get('link_author') == true) : ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', $article->contact_link, $author)); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
						<?php endif; ?>
					<?php endif; ?>
				</td>
			<?php endif; ?>
			<?php if ($this->params->get('list_show_hits', 1)) : ?>
				<td class="list-hits">
							<span class="badge badge-info">
								<?php echo JText::sprintf('JGLOBAL_HITS_COUNT', $article->hits); ?>
							</span>
						</td>
			<?php endif; ?>
			<?php if ($this->params->get('list_show_votes', 0) && $this->vote) : ?>
				<td class="list-votes">
					<span class="badge badge-success">
						<?php echo JText::sprintf('COM_CONTENT_VOTES_COUNT', $article->rating_count); ?>
					</span>
				</td>
			<?php endif; ?>
			<?php if ($this->params->get('list_show_ratings', 0) && $this->vote) : ?>
				<td class="list-ratings">
					<span class="badge badge-warning">
						<?php echo JText::sprintf('COM_CONTENT_RATINGS_COUNT', $article->rating); ?>
					</span>
				</td>
			<?php endif; ?>

			<?php if ($isEditable) : ?>
				<td class="list-edit">
					<?php if ($article->params->get('access-edit')) : ?>
						<?php echo JHtml::_('icon.edit', $article, $params); ?>
					<?php endif; ?>
				</td>
			<?php endif; ?>
			</tr>
<?php endforeach; ?>

	</tbody>
</table>
<?php endif; ?>

<!--
</div>
</div>
-->

<?php 
// Add pagination links
if (!empty($this->items)) :
	if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) :
		echo $this->pagination->getPagesLinks();
	endif; 
endif; 
?>

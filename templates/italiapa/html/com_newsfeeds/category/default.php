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

JHtml::_('behavior.caption');
//JHtml::_('formbehavior.chosen', 'select');

$pageClass = $this->params->get('pageclass_sfx');

?>
<div class="newsfeed-category<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	<?php endif; ?>
	<?php if ($this->params->get('show_category_title', 1)) : ?>
		<h2 class="u-text-h2 u-margin-r-bottom">
			<?php echo JHtml::_('content.prepare', $this->category->title, '', 'com_newsfeeds.category.title'); ?>
		</h2>
	<?php endif; ?>
	<?php if ($this->params->get('show_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
		<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->category->description) : ?>
   		<div class="Grid category-desc">
			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
    			<div class="Grid-cell u-sizeFull u-md-size2of3 u-lg-size2of3 u-text-r-s u-padding-r-all">
       				<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_newsfeeds.category'); ?>
       			</div>
    			<div class="Grid-cell u-sizeFull u-md-size1of3 u-lg-size1of3 u-text-r-s u-padding-r-all">
	   				<img src="<?php echo $this->category->getParams()->get('image'); ?>" class="u-sizeFull"/>
				</div>
			<?php else : ?>
				<div class="Grid-cell u-sizeFull u-md-size2of3 u-lg-size2of3 u-text-r-s u-padding-r-all">
   					<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_newsfeeds.category'); ?>
   				</div>
			<?php endif; ?>
		</div>	   
	<?php elseif ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
   		<div class="Grid category-desc">
   			<div class="Grid-cell u-sizeFull u-md-size1of3 u-lg-size1of3 u-text-r-s u-padding-r-all">
   				<img src="<?php echo $this->category->getParams()->get('image'); ?>" class="u-sizeFull"/>
			</div>
		</div>	   
	<?php endif; ?>

	<?php echo $this->loadTemplate('items'); ?>
	<?php if ($this->maxLevel != 0 && !empty($this->children[$this->category->id])) : ?>
		<div class="cat-children">
			<h3 class="u-text-h3 u-margin-bottom-m">
				<?php echo JText::_('JGLOBAL_SUBCATEGORIES'); ?>
			</h3>
			<?php echo $this->loadTemplate('children'); ?>
		</div>
	<?php endif; ?>
</div>

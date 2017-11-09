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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));
?>

<?php if (JFactory::getApplication()->getTemplate(true)->params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
see <a href="https://italia.github.io/design-web-toolkit/components/detail/layout--default.html">
https://italia.github.io/design-web-toolkit/components/detail/layout--default.html
</a>
</div>
<?php endif; ?>

<div class="u-layout-centerContent u-background-grey-20">
	<section class="u-layout-wide u-padding-top-xxl u-padding-bottom-xxl <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
		<?php if ($this->params->get('show_page_heading') != 0) : ?>
	    <h2 class="u-text-r-l u-padding-r-bottom">
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h2>
		<?php endif; ?>

		<section class="Grid">

			<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2 u-text-r-s u-padding-r-all">
				<div class="Grid Grid--fit u-margin-r-bottom">
					<p class="Grid-cell">
					<?php if ($this->params->get('show_parent_category', 0)) : ?>
						<?php $parent = $this->category->getParent(); ?>
						<span class="Dot u-background-50"></span>
						<?php if ($this->params->get('link_parent_category', 0)) : ?>
						<strong><a class="u-textClean u-text-r-xs" href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($parent->id)); ?>"><?php echo $parent->title; ?></a></strong>
						<?php else: ?>
						<strong><span class="u-textClean u-text-r-xs"><?php echo $parent->title; ?></span></strong>
						<?php endif; ?>
					<?php endif; ?>
					</p>
					
					<?php if ($this->params->get('show_modify_date') || $this->params->get('show_publish_date') || $this->params->get('show_create_date')) : ?>
					<p class="Grid-cell u-textSecondary">
						<?php if ($this->params->get('show_modify_date')) : ?>
							<?php $this->category->modified = $this->category->modified_time; ?>
							<?php echo JLayoutHelper::render('joomla.content.info_block.modify_date', array('item' => $this->category, 'params' => $this->params, 'position' => 'above')); ?>
						<?php endif; ?>
						<?php if ($this->params->get('show_publish_date')  || $this->params->get('show_create_date')) : ?>
							<?php $this->category->created = $this->category->created_time; ?>
							<?php echo JLayoutHelper::render('joomla.content.info_block.create_date', array('item' => $this->category, 'params' => $this->params, 'position' => 'above')); ?>
						<?php endif; ?>
					</p>
					<?php endif; ?>
					
				</div>
		
				<div class="u-text-r-l u-layout-prose">
		
				<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
					<h2 class="u-text-h2 u-margin-r-bottom">
					<?php echo $this->escape($this->params->get('page_subheading')); ?>
						<?php if ($this->params->get('show_category_title')) : ?>
							<span class="u-text-h2 u-textClean u-color-black"><?php echo $this->category->title; ?></span>
						<?php endif; ?>
					</h2>
				<?php endif; ?>
				<?php echo $afterDisplayTitle; ?>
			
				<?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
					<div class="category-desc clearfix">
						<?php echo $beforeDisplayContent; ?>
						<?php if ($this->params->get('show_description') && $this->category->description) : ?>
							<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
						<?php endif; ?>
						<?php echo $afterDisplayContent; ?>
					</div>
				<?php endif; ?>
			    </div>
		
			</div>

			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
			<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2 u-text-r-s u-padding-r-all">
				<img src="<?php echo $this->category->getParams()->get('image'); ?>" class="u-sizeFull" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8'); ?>"/>
			</div>
			<?php endif; ?>
		
		</section>

		<div class="Grid Grid--withGutter">
			<?php 
			$c = (int) $this->columns;
			$i = 1; 
			?>
			<?php foreach (array_merge($this->lead_items, $this->intro_items) as &$item) : ?>
			<div class="Grid-cell u-md-size1of<?php echo $c; ?> u-lg-size1of<?php echo $c; ?> u-padding-r-left<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
				itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
				<?php
					$this->item = &$item;
					echo $this->loadTemplate('tile');
				?>
			</div>
			<?php 
			if ($i == $c)
			{
				echo '</div><div class="Grid Grid--withGutter">';
				$i = 1;
			}
			else
			{
				$i++;
			}
			?>
			<?php endforeach; ?>
	
		</div>
		
		<!-- 
		<p class="u-textCenter u-text-md-right u-text-lg-right u-padding-r-top">
			<a href="#" class="u-color-50 u-textClean u-text-h4">
				tutte le notizie <span class="Icon Icon-chevron-right"></a>
		</p>
 		-->
		
		<?php 
		if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) :
			echo $this->pagination->getPagesLinks();
		endif; 
		?>

	</section>
</div>

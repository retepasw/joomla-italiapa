<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$class = ' class="first"';
$lang  = JFactory::getLanguage();
?>

<?php if (count($this->children[$this->category->id]) > 0) : ?>
	<ul class="Linklist Linklist--padded Treeview Treeview--default js-Treeview u-text-r-xs">
		<?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
			<?php if ($this->params->get('show_empty_categories') || $child->getNumItems(true) || count($child->getChildren())) : ?>
				<?php if (!isset($this->children[$this->category->id][$id + 1])) : ?>
					<?php $class = ' class="last"'; ?>
				<?php endif; ?>

				<li<?php echo $class; ?>>
					<?php $class = ''; ?>
					<?php if ($lang->isRtl()) : ?>
						<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
							<span class="badge badge-info tip hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_CONTENT_NUM_ITEMS_TIP'); ?>">
								<?php echo $child->getNumItems(true); ?>
							</span>
						<?php endif; ?>
						<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>">
							<?php echo $this->escape($child->title); ?></a>

						<?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
							<a href="#category-<?php echo $child->id; ?>" data-toggle="collapse" data-toggle="button" class="btn btn-mini pull-right"><span class="icon-plus"></span></a>
						<?php endif; ?>
					<?php else : ?>
						<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>">
							<?php echo $this->escape($child->title); ?>
						</a>
						<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
							<span class="badge badge-info tip hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_CONTENT_NUM_ITEMS_TIP'); ?>">
								<?php echo $child->getNumItems(true); ?>
							</span>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->params->get('show_subcat_desc') == 1) : ?>
						<?php if ($child->description) : ?>
							<div class="category-desc">
								<?php echo JHtml::_('content.prepare', $child->description, '', 'com_content.category'); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
						<?php $this->children[$child->id] = $child->getChildren(); ?>
						<?php $this->category = $child; ?>
						<?php $this->maxLevel--; ?>
						<?php echo $this->loadTemplate('children'); ?>
						<?php $this->category = $child->getParent(); ?>
						<?php $this->maxLevel++; ?>
					<?php endif; ?>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

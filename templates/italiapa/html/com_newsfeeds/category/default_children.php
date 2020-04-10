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
?>
<?php if ($this->maxLevel != 0 && count($this->children[$this->category->id]) > 0) : ?>
	<ul<?php echo empty($this->level) ? ' class="Linklist Linklist--padded Treeview Treeview--default js-Treeview u-text-r-xs"' : ''; ?>>
	   <?php $this->level = empty($this->level) ? 1 : $this->level + 1; ?>
	   <?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
			<?php if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) : ?>
				<li>
					<a href="<?php echo JRoute::_(NewsfeedsHelperRoute::getCategoryRoute($child->id)); ?>">
						<span class="u-text-r-xs"><?php echo $this->escape($child->title); ?></span>
						<?php if ($this->params->get('show_cat_items') == 1) : ?>
							<span class="u-text-r-xxs u-linkClean">[<?php echo $child->numitems; ?>]</span>
						<?php endif; ?>
					</a>
					<?php if ($this->params->get('show_subcat_desc') == 1) : ?>
						<?php if ($child->description) : ?>
							<div class="category-desc">
								<?php echo JHtml::_('content.prepare', $child->description, '', 'com_newsfeeds.category'); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					<?php if (count($child->getChildren()) > 0) : ?>
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
	<?php $this->level = $this->level - 1; ?>
<?php endif;

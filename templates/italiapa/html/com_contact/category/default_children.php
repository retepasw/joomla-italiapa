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

$class = ' first';
if ($this->maxLevel != 0 && count($this->children[$this->category->id]) > 0) :
?>
<ul class="contact-category list-striped list-condensed">
<?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
	<?php
	if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) :
		if (!isset($this->children[$this->category->id][$id + 1]))
		{
			$class = ' last';
		}
	?>
	<li class="contact-item<?php echo $class; ?>" id="category-<?php echo $child->id; ?>">
		<?php $class = ''; ?>
			<h3 class="item-title u-text-h<?php echo $child->level; ?>">
				<a href="<?php echo JRoute::_(ContactHelperRoute::getCategoryRoute($child->id)); ?>" class="u-linkClean">
				<?php echo $this->escape($child->title); ?>
				</a>

				<?php if (false && $this->params->get('show_cat_items') == 1) : ?>
					<span class="badge badge-info pull-right" title="<?php echo JText::_('COM_CONTACT_CAT_NUM'); ?>"><?php echo $child->numitems; ?></span>
				<?php endif; ?>
			</h3>

			<?php if ($this->params->get('show_subcat_desc') == 1) : ?>
				<?php if ($child->description) : ?>
					<div class="category-desc">
						<?php echo JHtml::_('content.prepare', $child->description, '', 'com_contact.category'); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php
			// Get Category Model data
			$categoryModel = JModelLegacy::getInstance('Category', 'ContactModel', array('ignore_request' => true));

			$categoryModel->setState('category.id', $child->id);
			$categoryModel->setState('filter.published', 1);

			$this->items = $categoryModel->getItems();
			$this->params->set('level', $child->level);

			echo $this->loadTemplate('items');
			?>

			<?php if (count($child->getChildren()) > 0 ) :
				$this->children[$child->id] = $child->getChildren();
				$this->category = $child;
				$this->maxLevel--;
				echo $this->loadTemplate('children');
				$this->category = $child->getParent();
				$this->maxLevel++;
			endif; ?>
	</li>
	<?php endif; ?>
<?php endforeach; ?>
</ul>
<?php endif;

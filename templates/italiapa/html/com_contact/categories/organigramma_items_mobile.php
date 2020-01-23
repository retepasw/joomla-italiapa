<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if ($this->maxLevelcat != 0 && count($this->items[$this->parent->id]) > 0) : ?>
	<?php $c = 0; ?>
	<?php foreach ($this->items[$this->parent->id] as $item) : ?>
		<?php $c += count($item->getChildren()); ?>
	<?php endforeach; ?>
	<?php if ($c == 0) : ?>
		<?php $i = 1; ?>
		<?php $last = count($this->items[$this->parent->id]); ?>
		<?php foreach ($this->items[$this->parent->id] as $id => $item) : ?>
			<p<?php echo ($item->level - $this->levelcat == 3) ? ' data-group="' . $this->escape($this->parent->title) . '"' : ''; ?>>
				<a href="<?php echo JRoute::_(ContactHelperRoute::getCategoryRoute($item->id, $item->language) . '&layout=organigramma'); ?>" class="u-textClean">
				<strong><?php echo $this->escape($item->title); ?></strong></a></p>
			<?php $i = $i + 1; ?>
		<?php endforeach; ?>
	<?php else : ?>
		<?php foreach ($this->items[$this->parent->id] as $id => $item) : ?>
		<?php
			$this->items[$item->id] = $item->getChildren();
			$this->parent = $item;
			$this->maxLevelcat--;
			echo $this->loadTemplate('items_mobile');
			$this->parent = $item->getParent();
			$this->maxLevelcat++;
		?>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>

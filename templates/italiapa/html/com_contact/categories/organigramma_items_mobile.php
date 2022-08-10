<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
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

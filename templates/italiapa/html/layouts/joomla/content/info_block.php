<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$blockPosition = $displayData['params']->get('info_block_position', 0);
$blockStyle = $displayData['params']->get('info_block_style', 'default');

?>
<?php if ($blockStyle == 'inline'): ?>
<div class="Grid Grid--fit u-margin-r-bottom u-margin-r-top">
<?php else: ?>
<p class="u-padding-r-bottom">
<?php endif; ?>
		<?php if ($displayData['position'] === 'above' && ($blockPosition == 0 || $blockPosition == 2)
				|| $displayData['position'] === 'below' && ($blockPosition == 1)
				) : ?>

			<?php if ($displayData['params']->get('show_category') || $displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug)) : ?>
				<?php if ($displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug)) : ?>
					<?php echo $this->sublayout('parent_category', $displayData); ?>
				<?php endif; ?>

				<?php if ($displayData['params']->get('show_category')) : ?>
					<?php if ($blockStyle == 'inline') echo '<p class="Grid-cell">'; ?>
					<?php echo $this->sublayout('category', $displayData); ?>
					<?php if ($blockStyle == 'inline') echo '</p>'; ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($displayData['params']->get('show_associations')) : ?>
				<?php // echo $this->sublayout('associations', $displayData); ?>
			<?php endif; ?>

			<?php if ($blockStyle == 'inline') echo '<p class="Grid-cell">'; ?>

			<?php if ($displayData['params']->get('show_publish_date')) : ?>
				<?php echo $this->sublayout('publish_date', $displayData); ?>
			<?php endif; ?>

			<?php if ($displayData['params']->get('show_author') && !empty($displayData['item']->author )) : ?>
				<?php echo $this->sublayout('author', $displayData); ?>
			<?php endif; ?>

			<?php if ($blockStyle == 'inline') echo '</p>'; ?>

		<?php endif; ?>

		<?php if ($displayData['position'] === 'above' && ($blockPosition == 0)
				|| $displayData['position'] === 'below' && ($blockPosition == 1 || $blockPosition == 2)
				) : ?>
			<?php if ($displayData['params']->get('show_create_date')) : ?>
				<?php if ($blockStyle == 'inline') echo '<p class="Grid-cell">'; ?>
				<?php echo $this->sublayout('create_date', $displayData); ?>
				<?php if ($blockStyle == 'inline') echo '</p>'; ?>
			<?php endif; ?>

			<?php if ($displayData['params']->get('show_modify_date')) : ?>
				<?php if ($blockStyle == 'inline') echo '<p class="Grid-cell">'; ?>
				<?php echo $this->sublayout('modify_date', $displayData); ?>
				<?php if ($blockStyle == 'inline') echo '</p>'; ?>
			<?php endif; ?>

			<?php //if ($displayData['item']->metadata->xreference) : ?>
				<?php if ($blockStyle == 'inline') echo '<p class="Grid-cell">'; ?>
				<?php echo $this->sublayout('xreference', $displayData); ?>
				<?php if ($blockStyle == 'inline') echo '</p>'; ?>
			<?php //endif; ?>

			<?php if ($displayData['params']->get('show_hits')) : ?>
				<?php if ($blockStyle == 'inline') echo '<p class="Grid-cell">'; ?>
				<?php echo $this->sublayout('hits', $displayData); ?>
				<?php if ($blockStyle == 'inline') echo '</p>'; ?>
			<?php endif; ?>
		<?php endif; ?>
<?php if ($blockStyle == 'inline'): ?>
</div>
<?php else: ?>
</p>
<?php endif; ?>

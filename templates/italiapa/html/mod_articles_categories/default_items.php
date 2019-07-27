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

defined('_JEXEC') or die;

$itemClass = !empty($itemClass) ? $itemClass : '';
$linkClass = !empty($linkClass) ? $linkClass : '';
?>

<?php foreach ($list as $item) : ?>
	<?php $class = trim($itemClass . (($_SERVER['REQUEST_URI'] === JRoute::_(ContentHelperRoute::getCategoryRoute($item->id))) ? ' active' : '')); ?> 
	<?php $levelup = $item->level - $startLevel - 1; ?>
	<li<?php echo $class ? ' class="' . $class . '"' : ''; ?>>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id)); ?>"<?php echo $linkClass ? ' class="' . $linkClass . '"' : ''; ?>>
			<span itemprop="name">
				<?php echo $item->title; ?>
			</span>
			<?php if ($params->get('numitems')) : ?>
				(<?php echo $item->numitems; ?>)
			<?php endif; ?>
		</a>

		<?php if ($params->get('show_description', 0)) : ?>
			<?php echo JHtml::_('content.prepare', $item->description, $item->getParams(), 'mod_articles_categories.content'); ?>
		<?php endif; ?>
		<?php if ($params->get('show_children', 0) && (($params->get('maxlevel', 0) == 0)
			|| ($params->get('maxlevel') >= ($item->level - $startLevel)))
			&& count($item->getChildren())) : ?>
			<?php echo '<ul>'; ?>
			<?php $temp = $list; ?>
			<?php $list = $item->getChildren(); ?>
			<?php require JModuleHelper::getLayoutPath('mod_articles_categories', basename(__FILE__)); ?>
			<?php $list = $temp; ?>
			<?php echo '</ul>'; ?>
		<?php endif; ?>
	</li>
<?php endforeach; ?>

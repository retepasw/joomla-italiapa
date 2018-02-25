<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

$authorised = JFactory::getUser()->getAuthorisedViewLevels();

?>
<?php if (!empty($displayData)) : ?>
<div class="Prose u-layout-prose u-margin-r-bottom">
<small class="u-textWeight-900"><?php echo JText::_('JTAG'); ?>: </small>
<span class="u-color-70">
		<?php $tags = array(); ?>
		<?php foreach ($displayData as $i => $tag) : ?>
			<?php if (in_array($tag->access, $authorised)) : ?>
				<?php $tagParams = new Registry($tag->params); ?>
				<?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
				<?php $tags[] = '<a href="' . JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . ':' . $tag->alias)) . 
						'" class="' . $link_class .'" itemprop="keywords" rel="tag">' . $this->escape($tag->title) . '</a>'; ?>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php echo implode(', ', $tags); ?>
</span>
</div>
<?php endif; ?>

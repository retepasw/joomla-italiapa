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
<div class="u-margin-r-top u-margin-r-bottom">
	<!--
	<small class="u-textWeight-900"><?php echo JText::_('JTAG'); ?>: </small>
	<span>
	-->
		<?php $tags = array(); ?>
		<?php foreach ($displayData as $i => $tag) : ?>
			<?php if (in_array($tag->access, $authorised)) : ?>
				<?php $tagParams = new Registry($tag->params); ?>
				<?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
				<?php $link_class .= (($link_class == 'label label-info') ? ' u-textNoWrap u-textClean u-color-white' : ''); ?>
				<?php $tags[] = '<li class="u-inlineBlock u-padding-top-xxs u-padding-right-xs u-padding-bottom-xxs u-padding-left-xs u-borderRadius-m u-background-50 u-margin-right-xs u-margin-bottom-xs">' .
						'<a href="' . JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . ':' . $tag->alias)) . 
						'" class="' . $link_class .'" itemprop="keywords" rel="tag" style="background-color:transparent!important;padding:0!important;color:white!important;display:inline!important">' . $this->escape($tag->title) . '</a></li>'; ?>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php if ($tags) : ?>
			<ul role="presentation"><?php echo implode('', $tags); ?></ul>
		<?php endif; ?>
	<!--
	</span>
	-->
</div>
<?php endif; ?>

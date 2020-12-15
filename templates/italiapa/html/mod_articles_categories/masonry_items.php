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

JHtml::_('bootstrap.tooltip');

$lang  = JFactory::getLanguage();

	JPluginHelper::importPlugin('content');
	$dispatcher = JEventDispatcher::getInstance();
	foreach ($list as $item) :
		$dispatcher->trigger('onContentPrepare', array('com_content.categories', &$item, &$params, 0));
?>
<div class="Masonry-item js-Masonry-item">
	<div class="u-nbfc u-borderShadow-m u-borderRadius-m u-color-grey-30 u-background-white">
		<?php //if ($this->params->get('show_description_image') && $item->getParams()->get('image')) : ?>
		<!--<img src="<?php echo $item->getParams()->get('image'); ?>"
			alt="<?php echo htmlspecialchars($item->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8'); ?>"
			class="u-sizeFull"
			/>-->
		<?php //endif; ?>
		<div class="u-text-r-l u-padding-r-all u-layout-prose">
		<!--
		<p class="u-text-h6 u-margin-bottom-l"><a class="u-color-50 u-textClean" href="">sed vel itaque</a></p>
        -->
		<h3 class="u-text-h4 u-margin-r-bottom">
			<a class="u-text-r-m u-color-95 u-textWeight-400 u-textClean" href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language)); ?>">
				<?php echo $item->title; ?>
			</a>
		</h3>
		<?php if ($params->get('show_description')) : ?>
			<?php if ($item->description) : ?>
				<div class="u-text-p u-textSecondary">
					<?php echo $item->description; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		</div>
	</div>
</div>
<?php endforeach;

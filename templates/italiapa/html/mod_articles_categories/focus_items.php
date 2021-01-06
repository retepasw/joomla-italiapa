<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang  = JFactory::getLanguage();
?>
<div class="Grid Grid--withGutter categories-module">
	<?php foreach ($list as $item) : ?>
		<div class="Grid-cell <?php echo $responsiveClass ?: 'u-md-size1of3 u-lg-size1of3'; ?> u-flex u-margin-r-bottom u-flexJustifyCenter">
			<div class="u-nbfc u-borderShadow-m u-borderRadius-m u-color-grey-30 u-background-white Arrange-sizeFill">
				<div class="u-text-r-l u-padding-r-all u-layout-prose">
					<?php $icon = ''; ?>
					<?php $jcFields = FieldsHelper::getFields('com_content.categories', $item, true); ?>
					<?php foreach ($jcFields as $jcField) : ?>
						<?php if (($jcField->name == 'categoryicon') && $jcField->rawvalue): ?>
							<?php $icon = '<span class="' . $jcField->rawvalue . '"></span> '; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<h3 class="u-text-h4 u-margin-r-bottom">
						<a class="u-text-r-m u-color-95 u-textWeight-400 u-textClean" href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language)); ?>">
							<?php echo $icon . $item->title; ?>
						</a>
					</h3>
					<?php if ($params->get('show_description', 0) && $item->description) : ?>
						<div class="u-text-p u-textSecondary">
							<?php echo JHtml::_('content.prepare', $item->description, $item->getParams(), 'mod_articles_categories.content'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

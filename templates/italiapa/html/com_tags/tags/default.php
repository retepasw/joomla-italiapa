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

// Note that there are certain parts of this layout used only when there is exactly one tag.

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$description      = $this->params->get('all_tags_description');
$descriptionImage = $this->params->get('all_tags_description_image');

?>
<section class="Grid tag-category<?php echo $this->pageclass_sfx; ?>">
	<?php $img = null;?>
	<?php if ($descriptionImage) : ?>
		<?php $img = '<img src="' . htmlspecialchars($descriptionImage, ENT_COMPAT, 'UTF-8') . '" alt="' . htmlspecialchars($this->params->get('page_heading')). '" class="u-sizeFull" />'; ?>
	<?php endif; ?>

	<?php $size = 'u-sizeFull' . ($img && ($this->params->get('show_page_heading') || !empty($description)) ? ' u-md-size1of2 u-lg-size1of2' : '' ); ?>

	<?php if ($this->params->get('show_page_heading') || !empty($description)) : ?>
		<div class="Grid-cell <?php echo $size; ?> u-text-r-s u-padding-r-all">
			<div class="u-text-r-l u-layout-prose">
				<?php if ($this->params->get('show_page_heading')) : ?>
					<h2 class="u-text-h2 u-margin-r-bottom u-color-black">
						<?php echo $this->escape($this->params->get('page_heading')); ?>
					</h2>
				<?php endif; ?>
				<?php if (!empty($description)) : ?>
					<div class="u-textSecondary u-lineHeight-l">
						<?php echo JHtml::_('content.prepare', $description, '', 'com_tags.tag'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($img) : ?>
		<div class="Grid-cell <?php echo $size; ?> u-text-r-s u-padding-r-all">
			<?php echo $img; ?>
		</div>
	<?php endif; ?>

   	<div class="Grid-cell u-sizeFull u-text-r-s u-padding-r-all">
		<?php echo $this->loadTemplate('items'); ?>
	</div>
</section>

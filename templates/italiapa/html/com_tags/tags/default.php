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
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

// Note that there are certain parts of this layout used only when there is exactly one tag.

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$description      = $this->params->get('all_tags_description');
$descriptionImage = $this->params->get('all_tags_description_image');

?>
<section class="tag-category<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<h2 class="u-text-h2 u-margin-r-bottom u-color-black">
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h2>
	<?php endif; ?>
	<?php if ($this->params->get('all_tags_show_description_image') && !empty($descriptionImage)) : ?>
		<div>
			<img src="<?php echo $descriptionImage; ?>" class="u-sizeFull" />
		</div>
	<?php endif; ?>
	<?php if (!empty($description)) : ?>
		<div class="u-textSecondary u-lineHeight-l">
			<?php echo $description; ?>
		</div>
	<?php endif; ?>
	<?php echo $this->loadTemplate('items'); ?>
</section>

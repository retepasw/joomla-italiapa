<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
 JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.caption');
?>
<section class="archive<?php echo $this->pageclass_sfx; ?>">
	<div class="u-color-grey-30 u-border-top-xxs u-border-bottom-xxs">
		<form class="form-inline Form Form--ultraLean" id="adminForm" action="<?php echo JRoute::_('index.php'); ?>" method="post">
			<fieldset class="Form-fieldset u-sizeFull filters">
				<div class="Grid filter-search">
			        <div class="Form-field Form-field--withPlaceholder Grid-cell u-sizeFull u-sm-size4of12 u-md-size5of12 u-lg-size5of12 u-border-right-xxs">
						<?php if ($this->params->get('filter_field') !== 'hide') : ?>
							<input class="Form-input u-text-r-s u-padding-r-all u-color-black" type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" onchange="document.getElementById('adminForm').submit();" placeholder="<?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL'); ?>" />
					        <label class="Form-label u-color-grey-90 u-text-r-m" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL') . '&#160;'; ?></label>
						<?php endif; ?>
					</div>

					<div class="Form-field Grid-cell u-size6of12 u-sm-size2of12 u-md-size2of12 u-lg-size2of12 u-border-right-xxs">
						<?php echo str_replace('class="inputbox"', 'class="Form-input u-color-grey-90 u-text-r-s u-padding-r-all"', $this->form->monthField); ?>
					</div>
					<div class="Form-field Grid-cell u-size6of12 u-sm-size2of12 u-md-size2of12 u-lg-size2of12 u-border-right-xxs">
						<?php echo str_replace('class="inputbox"', 'class="Form-input u-color-grey-90 u-text-r-s u-padding-r-all"', $this->form->yearField); ?>
					</div>
					<div class="Form-field Grid-cell u-sizeFull u-sm-size2of12 u-md-size2of12 u-lg-size2of12 u-border-right-xxs">
						<?php echo str_replace('class="inputbox input-mini"', 'class="Form-input u-color-grey-90 u-text-r-s u-padding-r-all"', $this->form->limitField); ?>
					</div>

			        <button class="u-background-40 u-color-white u-padding-all-s u-text-r-m u-textNoWrap u-sizeFull u-sm-size2of12 u-md-size1of12 u-lg-size1of12"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>

					<input type="hidden" name="view" value="archive" />
					<input type="hidden" name="option" value="com_content" />
					<input type="hidden" name="limitstart" value="0" />
				</div>
			</fieldset>
		</form>
	</div>

	<div class="u-layout-centerContent u-background-grey-20">
		<div class="u-layout-wide u-padding-top-xxl u-padding-bottom-xxl" class="archive<?php echo $this->pageclass_sfx; ?>">
			<?php if ($this->params->get('show_page_heading')) : ?>
				<div class="page-header">
					<h1>
						<?php echo $this->escape($this->params->get('page_heading')); ?>
					</h1>
				</div>
			<?php endif; ?>
			<?php echo $this->loadTemplate('items'); ?>
		</div>
	</div>
</section>

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

defined('JPATH_BASE') or die;

JHTML::_('bootstrap.tooltip');

$lang		= JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();

$state	   = $this->get('state');
?>
<form class="Form Form--spaced u-padding-all-xl u-text-r-xs" id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post">
	<?php if (!empty($this->searchword)) : ?>
	<div class="Prose Alert Alert--success Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
		<h2 class="u-text-h3">
			Operazione eseguita con successo.
		</h2>
		<p class="u-text-p"><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="badge badge-info">' . $this->total . '</span>'); ?></p>
	</div>
	<?php endif; ?>

	<fieldset class="Form-fieldset">
		<div class="Form-field">
			<input class="Form-input u-text-r-s u-borderRadius-m" type="text" name="searchword" title="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" />
		</div>
		<div class="Form-field Grid-cell u-textRight">
			<button type="submit" class="Button Button--default Button--shadow u-text-m"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
		</div>
		<input type="hidden" name="task" value="search" />
	</fieldset>

	<?php if ($this->params->get('search_phrases', 1)) : ?>
	 	<?php if ($this->params->get('search_areas', 1)) : ?>
		<div class="Grid Grid--withGutter">
			<div class="Grid-cell u-md-size1of2 u-lg-size1of2">
	 	<?php endif; ?>

	<fieldset class="Form-field Form-field--choose Grid-cell u-text-r-s">
		<legend class="Form-legend is-required" for="searchphrase"><?php echo JText::_('COM_SEARCH_FOR'); ?></legend>
		<label class="Form-label Form-label--block">
			<input type="radio" class="Form-input" name="searchphrase" aria-required="true" required="" value="all"<?php if ($state->get('match') == 'all') echo ' checked="checked"'; ?>/>
			<span class="Form-fieldIcon" role="presentation"></span> <?php echo JText::_('COM_SEARCH_ALL_WORDS'); ?>
		</label>
		<label class="Form-label Form-label--block">
			<input type="radio" class="Form-input" name="searchphrase" aria-required="true" required="" value="any"<?php if ($state->get('match') == 'any') echo ' checked="checked"'; ?>/>
			<span class="Form-fieldIcon" role="presentation"></span> <?php echo JText::_('COM_SEARCH_ANY_WORDS'); ?>
		</label>
		<label class="Form-label Form-label--block">
			<input type="radio" class="Form-input" name="searchphrase" aria-required="true" required="" value="exact"<?php if ($state->get('match') == 'exact') echo ' checked="checked"'; ?>/>
			<span class="Form-fieldIcon" role="presentation"></span> <?php echo JText::_('COM_SEARCH_EXACT_PHRASE'); ?>
		</label>
	</fieldset>

	<fieldset class="Form-field u-text-r-s">
		<div class="Form-field">
			<legend class="Form-legend is-required" for="ordering"><?php echo JText::_('COM_SEARCH_ORDERING'); ?></legend>
			<?php echo JHtml::_('select.genericlist', array(
				JHtml::_('select.option', 'newest', JText::_('COM_SEARCH_NEWEST_FIRST')),
				JHtml::_('select.option', 'oldest', JText::_('COM_SEARCH_OLDEST_FIRST')),
				JHtml::_('select.option', 'popular', JText::_('COM_SEARCH_MOST_POPULAR')),
				JHtml::_('select.option', 'alpha', JText::_('COM_SEARCH_ALPHABETICAL')),
				JHtml::_('select.option', 'category', JText::_('JCATEGORY'))
			), 'ordering', 'class="Form-input u-color-grey-90 u-text-r-s u-padding-r-all"', 'value', 'text', $state->get('ordering')); ?>
		</div>
	</fieldset>
	 	<?php if ($this->params->get('search_areas', 1)) : ?>
		</div>
	 	<?php endif; ?>
 	<?php endif; ?>

 	<?php if ($this->params->get('search_areas', 1)) : ?>
		<?php if ($this->params->get('search_phrases', 1)) : ?>
		<div class="Grid-cell u-md-size1of2 u-lg-size1of2">
		<?php endif; ?>
  	<fieldset class="Form-field Form-field--choose Grid-cell u-text-r-s">
 		<legend class="Form-legend is-required"><?php echo JText::_('COM_SEARCH_SEARCH_ONLY'); ?></legend>
 		<?php foreach ($this->searchareas['search'] as $val => $txt) : ?>
			<?php
			if (is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']))
			{
				$checked = ' checked="checked"';
				$is_checked = ' is-checked';
			}
			else
			{
				$checked = '';
				$is_checked = '';
			}
			?>
		<label for="area-<?php echo $val; ?>" class="Form-label Form-label--block<?php echo $is_checked; ?>">
			<input type="checkbox" class="Form-input" name="areas[]" value="<?php echo $val; ?>" id="area-<?php echo $val; ?>"<?php echo $checked; ?>/>
			<span class="Form-fieldIcon" role="presentation"></span> <?php echo JText::_($txt); ?>
		</label>
		<?php endforeach; ?>
	</fieldset>
		<?php if ($this->params->get('search_phrases', 1)) : ?>
		</div>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->total > 0) : ?>
		<div class="form-limit">
			<label for="limit">
				<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
			</label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		<p class="counter">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
	<?php endif; ?>
</form>


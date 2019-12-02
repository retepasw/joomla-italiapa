<?php
/**
 * @package     Joomla.Site
 * @subpackage	Templates.ItaliaPA
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

?>
<div class=" u-background-compl-10 u-layout-centerContent u-padding-r-top">
	<section class="u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom">
		<?php // Display the suggested search if it is different from the current search. ?>
		<?php if (($this->suggested && $this->params->get('show_suggested_query', 1)) || ($this->explained && $this->params->get('show_explained_query', 1))) : ?>
			<div class="Prose Alert Alert--info">
		    	<p>
				<?php // Display the suggested search query. ?>
				<?php if ($this->suggested && $this->params->get('show_suggested_query', 1)) : ?>
					<?php // Replace the base query string with the suggested query string. ?>
					<?php $uri = JUri::getInstance($this->query->toUri()); ?>
					<?php $uri->setVar('q', $this->suggested); ?>
					<?php // Compile the suggested query link. ?>
					<?php $linkUrl = JRoute::_($uri->toString(array('path', 'query'))); ?>
					<?php $link = '<a href="' . $linkUrl . '">' . $this->escape($this->suggested) . '</a>'; ?>
					<?php echo JText::sprintf('COM_FINDER_SEARCH_SIMILAR', $link); ?>
				<?php elseif ($this->explained && $this->params->get('show_explained_query', 1)) : ?>
					<?php // Display the explained search query. ?>
					<?php echo $this->explained; ?>
				<?php endif; ?>
				</p>
			</div>
		<?php endif; ?>
		<?php // Display the 'no results' message and exit the template. ?>
		<?php if (($this->total === 0) || ($this->total === null)) : ?>
			<div id="search-result-empty">
				<h2><?php echo JText::_('COM_FINDER_SEARCH_NO_RESULTS_HEADING'); ?></h2>
				<?php $multilang = JFactory::getApplication()->getLanguageFilter() ? '_MULTILANG' : ''; ?>
				<p><?php echo JText::sprintf('COM_FINDER_SEARCH_NO_RESULTS_BODY' . $multilang, $this->escape($this->query->input)); ?></p>
			</div>
			<?php // Exit this template. ?>
			<?php return; ?>
		<?php endif; ?>
		<?php // Activate the highlighter if enabled. ?>
		<?php if (!empty($this->query->highlight) && $this->params->get('highlight_terms', 1)) : ?>
			<?php JHtml::_('behavior.highlighter', $this->query->highlight); ?>
		<?php endif; ?>

		<?php // Display a list of results ?>
		<div class="Grid Grid--withGutterM">
			<?php $this->baseUrl = JUri::getInstance()->toString(array('scheme', 'host', 'port')); ?>
			<?php foreach ($this->results as $result) : ?>
				<?php $this->result = &$result; ?>
				<?php $layout = $this->getLayoutFile($this->result->layout); ?>
				<?php echo $this->loadTemplate($layout); ?>
			<?php endforeach; ?>
		</div>

		<div class="search-pages-counter">
			<?php // Prepare the pagination string.  Results X - Y of Z ?>
			<?php $start = (int) $this->pagination->get('limitstart') + 1; ?>
			<?php $total = (int) $this->pagination->get('total'); ?>
			<?php $limit = (int) $this->pagination->get('limit') * $this->pagination->get('pages.current'); ?>
			<?php $limit = (int) ($limit > $total ? $total : $limit); ?>
			<?php echo JText::sprintf('COM_FINDER_SEARCH_RESULTS_OF', $start, $limit, $total); ?>
		</div>
	</section>
</div>

<?php // Display the pagination ?>
<div class="search-pagination">
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
</div>


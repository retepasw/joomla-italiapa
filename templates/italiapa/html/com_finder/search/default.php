<?php
/**
 * @package     Joomla.Site
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

JHtml::_('behavior.core');
JHtml::_('formbehavior.chosen');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('stylesheet', 'com_finder/finder.css', array('version' => 'auto', 'relative' => true));

?>
<div class="finder<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<h1>
			<?php if ($this->escape($this->params->get('page_heading'))) : ?>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			<?php else : ?>
				<?php echo $this->escape($this->params->get('page_title')); ?>
			<?php endif; ?>
		</h1>
	<?php endif; ?>
	<?php if ($this->params->get('show_search_form', 1)) : ?>
		<div id="search-form">
			<?php echo $this->loadTemplate('form'); ?>
		</div>
	<?php endif; ?>
	<?php // Load the search results layout if we are performing a search. ?>
	<?php if ($this->query->search === true) : ?>
		<div id="search-results">
			<?php echo $this->loadTemplate('results'); ?>
		</div>
	<?php endif; ?>
</div>

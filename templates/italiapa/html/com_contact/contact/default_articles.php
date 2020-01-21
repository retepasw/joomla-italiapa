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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

$params             = $this->item->params;
$presentation_style = $params->get('presentation_style');

?>
<?php if ($presentation_style === 'sliders') : ?>
	<?php echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-articles')); ?>
	<?php $accordionStarted = true; ?>
	<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('JGLOBAL_ARTICLES'), 'display-articles'); ?>
<?php elseif ($presentation_style === 'tabs') : ?>
	<?php echo JHtml::_('iwt.startTabSet', 'tab-contact', array('active' => 'display-articles')); ?>
	<?php $tabSetStarted = true; ?>
	<?php echo JHtml::_('iwt.addTab', 'tab-contact', JText::_('JGLOBAL_ARTICLES'), 'display-articles'); ?>
	<?php echo JHtml::_('iwt.startTabPanel', 'tab-contact', 'display-articles'); ?>
<?php elseif ($presentation_style === 'plain') : ?>
	<div class="u-sizeFull u-md-size1of2 u-lg-size1of2">
		<h3 class="u-text-h3"><?php echo JText::_('JGLOBAL_ARTICLES'); ?></h3>
<?php endif; ?>

<?php if ($this->params->get('show_articles')) : ?>
<div class="u-sizeFull u-text-r-s u-color-70 contact-articles">
	<ul class="Linklist Prose u-text-r-xs nav nav-tabs nav-stacked">
		<?php foreach ($this->item->articles as $article) : ?>
			<li>
				<?php echo JHtml::_('link', JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language)), htmlspecialchars($article->title, ENT_COMPAT, 'UTF-8')); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>

<?php if ($presentation_style == 'sliders') : ?>
	<?php echo JHtml::_('iwt.endSlide'); ?>
<?php elseif ($presentation_style == 'tabs') : ?>
	<?php echo JHtml::_('iwt.endTabPanel'); ?>
<?php elseif ($presentation_style === 'plain') : ?>
	</div>
<?php endif;

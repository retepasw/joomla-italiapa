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

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

?>

<?php if ($this->params->get('presentation_style') === 'sliders') : ?>
	<?php echo JHtml::_('webtoolkit.addSlide', 'slide-contact', JText::_('COM_CONTACT_LINKS'), 'display-links'); ?>
<?php endif; ?>
<?php if ($this->params->get('presentation_style') === 'tabs') : ?>
	<?php echo JHtml::_('webtoolkit.addTab', 'myTab', 'display-links', JText::_('COM_CONTACT_LINKS')); ?>
<?php endif; ?>
<?php if ($this->params->get('presentation_style') === 'plain') : ?>
	<?php echo '<h3 class="u-text-h3">' . JText::_('COM_CONTACT_LINKS') . '</h3>'; ?>
<?php endif; ?>

<div class="u-sizeFull u-text-r-s u-color-70 contact-links">
	<ul class="Linklist Prose u-text-r-xs nav nav-tabs nav-stacked">
		<?php
		// Letters 'a' to 'e'
		foreach (range('a', 'e') as $char) :
			$link = $this->contact->params->get('link' . $char);
			$label = $this->contact->params->get('link' . $char . '_name');

			if (!$link) :
				continue;
			endif;

			// Add 'http://' if not present
			$link = (0 === strpos($link, 'http')) ? $link : 'http://' . $link;

			// If no label is present, take the link
			$label = $label ?: $link;
			?>
			<li>
				<a href="<?php echo $link; ?>" itemprop="url">
					<?php echo $label; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php if ($this->params->get('presentation_style') === 'sliders') : ?>
	<?php echo JHtml::_('webtoolkit.endSlide'); ?>
<?php endif; ?>
<?php if ($this->params->get('presentation_style') === 'tabs') : ?>
	<?php echo JHtml::_('webtoolkit.endTab'); ?>
<?php endif; ?>

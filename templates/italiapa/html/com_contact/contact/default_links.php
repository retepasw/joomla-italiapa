<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';
?>

<div class="contact-links">
	<ul>
		<?php if ($this->contact->webpage && $this->contact->params->get('show_webpage')) : ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<a href="<?php echo $this->contact->webpage; ?>" target="_blank" rel="noopener noreferrer" itemprop="url">
					<span data-tooltip="<?php echo JHtml::tooltipText('webpage: ' . $this->contact->webpage, null, 0, 0); ?>"
					class="Icon-earth u-color-50"></span>
					<span class="u-hiddenVisually">webpage</span>
				</a>
			</li>
		<?php endif; ?>
		<?php if ($this->contact->email_to && $this->contact->params->get('show_email')) : ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<?php $icon = "<span class='Icon-mail Icon u-borderRadius-circle u-background-50 u-color-white u-padding-all-xxs'></span><span class='u-hiddenVisually'>e-mail</span>"; ?>
				<?php echo JHtml::_('iwt.cloak', $this->item->email_raw, true, $icon, false); ?>
			</li>
		<?php endif; ?>
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
			if ($label)
			{
				$icon = strtolower($label);
				if ($icon == 'jed') {
					$icon = 'joomla';
				} else if ($icon == 'www') {
					$icon = 'earth';
				}
			}
			else
			{
				$label = $link;
				$icon = 'link';
			}
			?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<a href="<?php echo $link; ?>" itemprop="url" rel="nofollow" target="_blank">
					<?php $class = ($icon == 'earth' ? ' u-color-50 ' : ' u-color-white u-background-50 u-borderRadius-circle u-padding-all-xxs u-inlineBlock'); ?>
					<span data-tooltip="<?php echo JHtml::tooltipText($label . ': ' . $link, null, 0, 0); ?>"
						class="Icon-<?php echo $icon . $class; ?>"></span>
					<span class="u-hiddenVisually"><?php echo $label; ?></span>
				</a>
			</li>
		<?php endforeach; ?>

		<?php if ($this->contact->params->get('show_telephone_headings') && !empty($this->contact->telephone)) : ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<span data-tooltip="<?php echo JHtml::tooltipText(JText::sprintf('COM_CONTACT_TELEPHONE_NUMBER', $this->contact->telephone), null, 0, 0); ?>"
					class="Icon-phone u-color-white u-background-50 u-borderRadius-circle u-padding-all-xxs u-inlineBlock"></span>
				<span class="u-hiddenVisually"><?php echo JText::sprintf('COM_CONTACT_TELEPHONE_NUMBER', $this->contact->telephone); ?></span>
			</li>
		<?php endif; ?>

		<?php if ($this->contact->params->get('show_mobile_headings') && !empty($this->contact->mobile)) : ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<span class="Icon-mobile u-color-white u-background-50 u-borderRadius-circle u-padding-all-xxs u-inlineBlock"
					data-tooltip="<?php echo JHtml::tooltipText(JText::sprintf('COM_CONTACT_MOBILE_NUMBER', $this->contact->mobile), null, 0, 0); ?>">
					<svg class="Icon"><use xlink:href="#Icon-mobile"></use></svg></span>
				<span class="u-hiddenVisually"><?php echo JText::sprintf('COM_CONTACT_MOBILE_NUMBER', $this->contact->mobile); ?></span>
			</li>
		<?php endif; ?>

		<?php if ($this->contact->params->get('show_fax_headings') && !empty($this->contact->fax)) : ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<span class="Icon-fax u-color-white u-background-50 u-borderRadius-circle u-padding-all-xxs u-inlineBlock"
					data-tooltip="<?php echo JHtml::tooltipText(JText::sprintf('COM_CONTACT_FAX_NUMBER', $this->contact->fax), null, 0, 0); ?>">
					<svg class="Icon"><use xlink:href="#Icon-fax"></use></svg></span>
				<span class="u-hiddenVisually"><?php echo JText::sprintf('COM_CONTACT_FAX_NUMBER', $this->contact->fax); ?></span>
			</li>
		<?php endif; ?>
	</ul>
</div>

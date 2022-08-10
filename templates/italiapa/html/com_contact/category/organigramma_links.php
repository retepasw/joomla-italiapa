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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$db = JFactory::getDbo();
?>

<div class="contact-links">
	<ul>
		<?php if ($this->item->address && (true || $this->params->get('show_address'))) : ?>
			<?php $address = JText::_('COM_CONTACT_ADDRESS') . ': ' . $this->item->address; ?>
			<?php if ($this->item->postcode || $this->item->suburb || $this->item->state) : ?>
				<?php $address .= '<br/>' . $this->item->postcode . ' ' . $this->item->suburb . ' ' . $this->item->state; ?>
			<?php endif; ?>
			<?php if ($this->item->country) : ?>
				<?php $address .= '<br/>' . $this->item->country; ?>
			<?php endif; ?>
			<?php $guid = GUIDv4(); ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<span class="Icon Icon-pin u-color-white u-background-50 u-borderRadius-circle u-padding-all-xxs u-inlineBlock esh-dblclick"
					data-tooltip="<?php echo JHtml::tooltipText($address, null, 0, 0); ?>"
					onclick="jQuery( '#<?php echo $guid; ?>' ).toggleClass( 'u-hiddenVisually' );"
					ondblclick="eshiol.italiapa.clipboard.write('<?php echo str_replace('<br/>', ' ' , $address); ?>', 'Indirizzo copiato negli appunti!');"
					onmouseover="javascript:window.status='fai doppio click per copiare negli appunti';"
					onmouseoout="javascript:window.status='';"
					></span>
				<span id="<?php echo $guid; ?>" class="u-hiddenVisually"><?php echo $this->item->address; ?></span>
			</li>
		<?php endif; ?>

		<?php if ($this->item->webpage && (true || $this->params->get('show_webpage'))) : ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<a href="<?php echo $this->item->webpage; ?>" target="_blank" rel="noopener noreferrer" itemprop="url">
					<span data-tooltip="<?php echo JHtml::tooltipText('webpage: ' . $this->item->webpage, null, 0, 0); ?>"
					class="Icon-earth u-color-50"></span>
					<span class="u-hiddenVisually1><?php echo $this->item->webpage; ?></span>
				</a>
			</li>
		<?php endif; ?>

		<?php //if ($this->item->email_to && $this->item->params->get('show_email')) : ?>
		<?php if ($this->item->email_to && (true || $this->params->get('show_email_headings'))) : ?>
			<?php if (filter_var($this->item->email_to, FILTER_VALIDATE_EMAIL)) : ?>
				<?php $this->item->email_raw = $this->item->email_to; ?>
			<?php else : ?>
				<?php
				$query = $db->getQuery(true)
					->select($db->quoteName('email_to'))
					->from('#__contact_details')
					->where($db->quoteName('id') . ' = ' . $this->item->id);
				$db->setQuery($query);
				$this->item->email_raw = $db->loadResult();
				?>
			<?php endif; ?>
			<?php if (!empty($this->item->email_raw)) : ?>
				<li class="u-inlineBlock u-margin-right-xxs">
					<?php $icon = "<span class='Icon-mail Icon u-borderRadius-circle u-background-50 u-color-white u-padding-all-xxs'></span><span class='u-hiddenVisually'>" . $this->item->email_raw . "</span>"; ?>
					<?php echo JHtml::_('iwt.cloak', $this->item->email_raw, true, $icon, false); ?>
				</li>
			<?php endif; ?>
		<?php endif; ?>
		<?php
		// Letters 'a' to 'e'
		foreach (range('a', 'e') as $char) :
			$link = $this->item->params->get('link' . $char);
			$label = $this->item->params->get('link' . $char . '_name');

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

		<?php if ($this->item->telephone && (true || $this->item->params->get('show_telephone_headings'))) : ?>
			<?php $guid = GUIDv4(); ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<span data-tooltip="<?php echo JHtml::tooltipText(JText::sprintf('COM_CONTACT_TELEPHONE_NUMBER', $this->item->telephone), null, 0, 0); ?>"
					class="Icon-phone u-color-white u-background-50 u-borderRadius-circle u-padding-all-xxs u-inlineBlock esh-dblclick"
					onclick="jQuery( '#<?php echo $guid; ?>' ).toggleClass( 'u-hiddenVisually' );"
					ondblclick="eshiol.italiapa.clipboard.write('<?php echo $this->item->telephone; ?>', 'Numero di telefono copiato negli appunti!');"
					onmouseover="javascript:window.status='fai doppio click per copiare negli appunti';"
					onmouseoout="javascript:window.status='';"></span>
				<span id="<?php echo $guid; ?>" class="u-hiddenVisually"><?php echo $this->item->telephone; ?></span>
			</li>
		<?php endif; ?>

		<?php if ($this->item->mobile && (true || $this->item->params->get('show_mobile_headings'))) : ?>
			<?php $guid = GUIDv4(); ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<span class="Icon-mobile u-color-white u-background-50 u-borderRadius-circle u-padding-all-xxs u-inlineBlock esh-dblclick"
					data-tooltip="<?php echo JHtml::tooltipText(JText::sprintf('COM_CONTACT_MOBILE_NUMBER', $this->item->mobile), null, 0, 0); ?>"
					onclick="jQuery( '#<?php echo $guid; ?>' ).toggleClass( 'u-hiddenVisually' );"
					ondblclick="eshiol.italiapa.clipboard.write('<?php echo $this->item->mobile; ?>', 'Numero di cellulare copiato negli appunti!');"
					onmouseover="javascript:window.status='fai doppio click per copiare negli appunti';"
					onmouseoout="javascript:window.status='';"
					>
					<svg class="Icon"><use xlink:href="#Icon-mobile"></use></svg></span>
				<span id="<?php echo $guid; ?>" class="u-hiddenVisually"><?php echo $this->item->mobile; ?></span>
			</li>
		<?php endif; ?>

		<?php if ($this->item->fax && (true || $this->item->params->get('show_fax_headings'))) : ?>
			<?php $guid = GUIDv4(); ?>
			<li class="u-inlineBlock u-margin-right-xxs">
				<span class="Icon-fax u-color-white u-background-50 u-borderRadius-circle u-padding-all-xxs u-inlineBlock esh-dblclick"
					data-tooltip="<?php echo JHtml::tooltipText(JText::sprintf('COM_CONTACT_FAX_NUMBER', $this->item->fax), null, 0, 0); ?>"
					onclick="jQuery( '#<?php echo $guid; ?>' ).toggleClass( 'u-hiddenVisually' );"
					ondblclick="eshiol.italiapa.clipboard.write('<?php echo $this->item->fax; ?>', 'Numero di fax copiato negli appunti!');"
					onmouseover="javascript:window.status='fai doppio click per copiare negli appunti';"
					onmouseoout="javascript:window.status='';"
					>
					<svg class="Icon"><use xlink:href="#Icon-fax"></use></svg></span>
				<span id="<?php echo $guid; ?>" class="u-hiddenVisually"><?php echo $this->item->fax; ?></span>
			</li>
		<?php endif; ?>
	</ul>
</div>

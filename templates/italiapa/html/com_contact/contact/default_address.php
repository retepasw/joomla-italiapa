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
<dl class="contact-address dl-horizontal" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
	<?php if (($this->params->get('address_check') > 0) &&
		($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
		<dt>
			<svg class="u-text-r-m Icon Icon-office" style="margin-right: 0.25em;"><use xlink:href="#Icon-office"></use></svg>
		</dt>

		<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
			<dd>
				<span class="contact-street" itemprop="streetAddress">
					<?php echo nl2br($this->contact->address); ?>
					<br />
				</span>
			</dd>
		<?php endif; ?>

		<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
			<dd>
				<span class="contact-suburb" itemprop="addressLocality">
					<?php echo $this->contact->suburb; ?>
					<br />
				</span>
			</dd>
		<?php endif; ?>
		<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
			<dd>
				<span class="contact-state" itemprop="addressRegion">
					<?php echo $this->contact->state; ?>
					<br />
				</span>
			</dd>
		<?php endif; ?>
		<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
			<dd>
				<span class="contact-postcode" itemprop="postalCode">
					<?php echo $this->contact->postcode; ?>
					<br />
				</span>
			</dd>
		<?php endif; ?>
		<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
		<dd>
			<span class="contact-country" itemprop="addressCountry">
				<?php echo $this->contact->country; ?>
				<br />
			</span>
		</dd>
		<?php endif; ?>
	<?php endif; ?>

<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>" itemprop="email">
			<?php echo nl2br($this->params->get('marker_email')); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-emailto">
			<?php echo $this->contact->email_to; ?>
		</span>
	</dd>
<?php endif; ?>

<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
	<dt>
		<svg class="u-text-r-m Icon Icon-phone" style="margin-right: 0.25em;"><use xlink:href="#Icon-phone"></use></svg>
	</dt>
	<dd>
		<span class="contact-telephone" itemprop="telephone">
			<?php echo $this->contact->telephone; ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
	<dt>
		<svg class="u-text-r-m Icon Icon-fax" style="margin-right: 0.25em;"><use xlink:href="#Icon-fax"></use></svg>
	</dt>
	<dd>
		<span class="contact-fax" itemprop="faxNumber">
		<?php echo $this->contact->fax; ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->contact->mobile && $this->params->get('show_mobile')) : ?>
	<dt>
		<svg class="u-text-r-m Icon Icon-mobile" style="margin-right: 0.25em;"><use xlink:href="#Icon-mobile"></use></svg>
	</dt>
	<dd>
		<span class="contact-mobile" itemprop="telephone">
			<?php echo $this->contact->mobile; ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<dt>
		<svg class="u-text-r-m Icon Icon-earth" style="margin-right: 0.25em;"><use xlink:href="#Icon-earth"></use></svg>
	</dt>
	<dd>
		<span class="contact-webpage">
			<a href="<?php echo $this->contact->webpage; ?>" target="_blank" rel="noopener noreferrer" itemprop="url">
			<?php echo JStringPunycode::urlToUTF8($this->contact->webpage); ?></a>
		</span>
	</dd>
<?php endif; ?>
</dl>

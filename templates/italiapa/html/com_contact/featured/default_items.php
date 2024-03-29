<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
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

JHtml::_('behavior.core');
require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

?>

<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_CONTACT_NO_CONTACTS'); ?>	 </p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset class="filters">
	<legend class="u-hidden"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
	<?php if ($this->params->get('show_pagination_limit')) : ?>
		<div class="display-limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	<?php endif; ?>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	</fieldset>

	<table class="Table Table--withBorder u-text-r-xs category">
		<?php if ($this->params->get('show_headings')) : ?>
		<thead><tr class="u-border-bottom-xs">
			<th class="item-num">
				<?php echo JText::_('JGLOBAL_NUM'); ?>
			</th>
			<th class="item-title">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_CONTACT_EMAIL_NAME_LABEL', 'a.name', $listDirn, $listOrder); ?>
			</th>
			<?php if ($this->params->get('show_position_headings')) : ?>
			<th class="item-position">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_POSITION', 'a.con_position', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>
			<?php if ($this->params->get('show_email_headings')) : ?>
			<th class="item-email">
				<?php echo JText::_('JGLOBAL_EMAIL'); ?>
			</th>
			<?php endif; ?>
			<?php if ($this->params->get('show_telephone_headings')) : ?>
			<th class="item-phone">
				<?php echo JText::_('COM_CONTACT_TELEPHONE'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_mobile_headings')) : ?>
			<th class="item-phone">
				<?php echo JText::_('COM_CONTACT_MOBILE'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_fax_headings')) : ?>
			<th class="item-phone">
				<?php echo JText::_('COM_CONTACT_FAX'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_suburb_headings')) : ?>
			<th class="item-suburb">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_SUBURB', 'a.suburb', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_state_headings')) : ?>
			<th class="item-state">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_STATE', 'a.state', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_country_headings')) : ?>
			<th class="item-state">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			</tr>
		</thead>
		<?php endif; ?>

		<tbody>
			<?php foreach ($this->items as $i => $item) : ?>
				<tr class="<?php echo ($i % 2) ? 'odd' : 'even'; ?>" itemscope itemtype="https://schema.org/Person">
					<td class="item-num">
						<?php echo $i; ?>
					</td>

					<td class="item-title">
						<?php if ($this->items[$i]->published == 0) : ?>
							<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
						<?php endif; ?>
						<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>" itemprop="url">
							<span itemprop="name"><?php echo $item->name; ?></span>
						</a>
					</td>

					<?php if ($this->params->get('show_position_headings')) : ?>
						<td class="item-position" itemprop="jobTitle">
							<?php echo $item->con_position; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_email_headings')) : ?>
						<td class="item-email" itemprop="email">
							<?php echo $item->email_to; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_telephone_headings')) : ?>
						<td class="item-phone" itemprop="telephone">
							<?php echo $item->telephone; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_mobile_headings')) : ?>
						<td class="item-phone" itemprop="telephone">
							<?php echo $item->mobile; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_fax_headings')) : ?>
						<td class="item-phone" itemprop="faxNumber">
							<?php echo $item->fax; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_suburb_headings')) : ?>
						<td class="item-suburb" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
							<span itemprop="addressLocality"><?php echo $item->suburb; ?></span>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_state_headings')) : ?>
						<td class="item-state" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
							<span itemprop="addressRegion"><?php echo $item->state; ?></span>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_country_headings')) : ?>
						<td class="item-state" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
							<span itemprop="addressCountry"><?php echo $item->country; ?></span>
						</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>

		</tbody>
	</table>

</form>
<?php endif; ?>

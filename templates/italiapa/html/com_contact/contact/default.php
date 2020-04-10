<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
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

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->item->params;

$presentation_style = $tparams->get('presentation_style');
$accordionStarted = false;
$tabSetStarted = false;
?>

<?php if ($tparams->get('show_page_heading')) : ?>
	<h1 class="u-text-h1">
		<?php echo $this->escape($tparams->get('page_heading')); ?>
	</h1>
<?php endif; ?>

<div class="<?php echo ($presentation_style === 'plain') ? 'Grid ' : '';?>contact<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Person">
	<?php if ($presentation_style === 'plain') : ?>
		<div class="u-sizeFull u-md-size1of2 u-lg-size1of2">
	<?php endif; ?>

		<?php $show_contact_category = $tparams->get('show_contact_category'); ?>
		<?php if ($show_contact_category === 'show_no_link') : ?>
			<span class="u-text-h2">
				<span class="Dot u-background-70"></span>
				<span class="u-textClean u-textWeight-700 u-text-r-xs u-color-50 contact-category"><?php echo $this->contact->category_title; ?></span>
			</span>
		<?php elseif ($show_contact_category === 'show_with_link') : ?>
			<span class="u-text-h2 u-cf">
				<span class="Dot u-background-70"></span>
				<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
				<span class="contact-category"><a href="<?php echo $contactLink; ?>" class="u-textClean u-textWeight-700 u-text-r-xs u-color-50">
					<?php echo $this->escape($this->contact->category_title); ?></a>
				</span>
			</span>
		<?php endif; ?>

		<div class="u-cf">
			<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
				<div class="u-inlineBlock u-floatLeft u-borderRadius-circle u-nbfc u-margin-right-m contact-image">
					<?php echo JHtml::_('image', $this->contact->image, $this->contact->name, array('itemprop' => 'image', 'class' => 'u-sizeFull')); ?>
				</div>
			<?php endif; ?>

			<?php if ($this->contact->name && $tparams->get('show_name')) : ?>
				<div class="page-header">
					<h2 class="u-text-h4">
						<?php if ($this->item->published == 0) : ?>
							<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
						<?php endif; ?>
						<span class="contact-name" itemprop="name"><?php echo $this->contact->name; ?></span>
					</h2>
				</div>
			<?php endif; ?>

			<?php echo $this->item->event->afterDisplayTitle; ?>

			<?php if ($tparams->get('show_contact_list') && count($this->contacts) > 1) : ?>
				<form action="#" method="get" name="selectForm" id="selectForm">
					<label for="select_contact"><?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?></label>
					<?php echo JHtml::_('select.genericlist', $this->contacts, 'select_contact', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link); ?>
				</form>
			<?php endif; ?>

			<?php if ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<?php endif; ?>

			<?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
				<div class="contact-position u-text-h5">
					<span class="u-hiddenVisually"><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</span>
					<span itemprop="jobTitle"><?php echo $this->contact->con_position; ?></span>
				</div>
			<?php endif; ?>

			<?php if ($tparams->get('show_links')) : ?>
				<?php echo $this->loadTemplate('links'); ?>
			<?php endif; ?>
		</div>

		<?php if ($this->params->get('show_info', 1)) : ?>
			<?php if ($presentation_style === 'sliders') : ?>
				<?php echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'basic-details')); ?>
				<?php $accordionStarted = true; ?>
				<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('COM_CONTACT_DETAILS'), 'basic-details'); ?>
			<?php elseif ($presentation_style === 'tabs') : ?>
				<?php echo JHtml::_('iwt.startTabSet', 'tab-contact', array('active' => 'basic-details')); ?>
				<?php $tabSetStarted = true; ?>
				<?php echo JHtml::_('iwt.addTab', 'tab-contact', JText::_('COM_CONTACT_DETAILS'), 'basic-details'); ?>
				<?php echo JHtml::_('iwt.startTabPanel', 'tab-contact', 'basic-details'); ?>
			<?php elseif ($presentation_style === 'plain') : ?>
				<h3 class="u-text-h3"><?php echo JText::_('COM_CONTACT_DETAILS'); ?></h3>
			<?php endif; ?>

			<?php echo $this->item->event->beforeDisplayContent; ?>

			<?php echo $this->loadTemplate('address'); ?>

			<?php if ($tparams->get('allow_vcard')) : ?>
				<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
				<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
				<?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
			<?php endif; ?>

			<?php echo $this->item->event->afterDisplayContent; ?>

			<?php if ($presentation_style === 'sliders') : ?>
				<?php echo JHtml::_('iwt.endSlide'); ?>
			<?php elseif ($presentation_style === 'tabs') : ?>
				<?php echo JHtml::_('iwt.endTabPanel'); ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($presentation_style === 'plain') : ?>
			<div class="Grid">
		<?php endif; ?>

		<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
			<?php echo $this->loadTemplate('profile'); ?>
		<?php endif; ?>

		<?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
			<?php echo $this->loadTemplate('user_custom_fields'); ?>
		<?php endif; ?>

		<?php if ($presentation_style === 'plain') : ?>
			</div>
		<?php endif; ?>

	<?php if ($presentation_style === 'plain') : ?>
		</div>
	<?php endif; ?>

	<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<?php echo $this->loadTemplate('form'); ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<?php echo $this->loadTemplate('articles'); ?>
	<?php endif; ?>

	<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-misc')); ?>
			<?php $accordionStarted = true; ?>
			<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php echo JHtml::_('iwt.startTabSet', 'tab-contact', array('active' => 'display-misc')); ?>
			<?php $tabSetStarted = true; ?>
			<?php echo JHtml::_('iwt.addTab', 'tab-contact', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc'); ?>
			<?php echo JHtml::_('iwt.startTabPanel', 'tab-contact', 'display-misc'); ?>
		<?php elseif ($presentation_style === 'plain') : ?>
			<div class="u-sizeFull u-md-size1of2 u-lg-size1of2">
				<h3 class="u-text-h3"><?php echo JText::_('COM_CONTACT_OTHER_INFORMATION'); ?></h3>
		<?php endif; ?>

		<dl class="contact-misc dl-horizontal">
			<dt>
				<span class="Icon-info"></span>
			</dt>
			<dd>
				<span class="contact-misc">
					<?php echo $this->contact->misc; ?>
				</span>
			</dd>
		</dl>

		<?php if ($presentation_style == 'sliders') : ?>
			<?php echo JHtml::_('iwt.endSlide'); ?>
		<?php elseif ($presentation_style == 'tabs') : ?>
			<?php echo JHtml::_('iwt.endTabPanel'); ?>
		<?php elseif ($presentation_style === 'plain') : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>

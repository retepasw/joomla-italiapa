<?php 
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
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

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->item->params;

JFactory::getDocument()->addStyleDeclaration('
.contact dt {
    float: left;
    width: 25%;
    padding-right: 1em;
    clear: left;
    text-align: right;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.contact dd {
    margin-left: 25%;
}
.contact dt, .contact dd {
    line-height: 32px;
}
.fr-accordion button {
    margin-right: 1em;
    margin-bottom: 0.5em;
}
.fr-accordion button.Button--default.fr-accordion__header[aria-selected="true"] {
    background-color: #004a4d;
    border-color: #000;
    color: #65dde0;
}
');
?>

	<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
<div class="Grid contact<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Person">
	<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2 u-text-r-s u-padding-r-all">
	<?php else: ?>
<div class="contact<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Person">
	<?php endif; ?>
	<?php if ($tparams->get('show_page_heading')) : ?>
		<h1 class="u-text-h1">
			<?php echo $this->escape($tparams->get('page_heading')); ?>
		</h1>
	<?php endif; ?>

	<?php if ($this->contact->name && $tparams->get('show_name')) : ?>
		<div class="page-header">
			<h2 class="u-text-h2">
				<?php if ($this->item->published == 0) : ?>
					<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
				<?php endif; ?>
				<span class="contact-name" itemprop="name"><?php echo $this->contact->name; ?></span>
			</h2>
		</div>
	<?php endif; ?>

	<?php $show_contact_category = $tparams->get('show_contact_category'); ?>

		<h3 class="u-text-h3">
			<span class="Dot u-background-70"></span>
	<?php if ($show_contact_category === 'show_no_link') : ?>
			<span class="u-textClean u-textWeight-700 u-text-r-xs u-color-50 contact-category"><?php echo $this->contact->category_title; ?></span>
	<?php elseif ($show_contact_category === 'show_with_link') : ?>
		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
			<span class="contact-category"><a href="<?php echo $contactLink; ?>" class="u-textClean u-textWeight-700 u-text-r-xs u-color-50">
				<?php echo $this->escape($this->contact->category_title); ?></a>
			</span>
	<?php endif; ?>
		</h3>

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

	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php $presentation_style = $tparams->get('presentation_style'); ?>
	<?php $accordionStarted = false; ?>
	<?php $tabSetStarted = false; ?>

	<?php if ($this->params->get('show_info', 1)) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'basic-details')); ?>
			<?php $accordionStarted = true; ?>
			<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('COM_CONTACT_DETAILS'), 'basic-details'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php echo JHtml::_('iwt.startTabSet', 'myTab', array('active' => 'basic-details')); ?>
			<?php $tabSetStarted = true; ?>
			<?php echo JHtml::_('iwt.addTab', 'myTab', 'basic-details', JText::_('COM_CONTACT_DETAILS')); ?>
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="u-text-h3">' . JText::_('COM_CONTACT_DETAILS') . '</h3>'; ?>
		<?php endif; ?>

		<?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
			<dl class="contact-position dl-horizontal">
				<dt><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</dt>
				<dd itemprop="jobTitle">
					<?php echo $this->contact->con_position; ?>
				</dd>
			</dl>
		<?php endif; ?>

		<?php echo $this->loadTemplate('address'); ?>

		<?php if ($tparams->get('allow_vcard')) : ?>
			<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
			<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
			<?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
		<?php endif; ?>

		<?php if ($presentation_style === 'sliders') : ?>
			<?php echo JHtml::_('iwt.endSlide'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php echo JHtml::_('iwt.endTab'); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted)
			{
				echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-form'));
				$accordionStarted = true;
			}
			?>
			<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('COM_CONTACT_EMAIL_FORM'), 'display-form'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted)
			{
				echo JHtml::_('iwt.startTabSet', 'myTab', array('active' => 'display-form'));
				$tabSetStarted = true;
			}
			?>
			<?php echo JHtml::_('iwt.addTab', 'myTab', 'display-form', JText::_('COM_CONTACT_EMAIL_FORM')); ?>
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="u-text-h3">' . JText::_('COM_CONTACT_EMAIL_FORM') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('form'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
			<?php echo JHtml::_('iwt.endSlide'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php echo JHtml::_('iwt.endTab'); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_links')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted) : ?>
				<?php echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-links')); ?>
				<?php $accordionStarted = true; ?>
			<?php endif; ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted) : ?>
				<?php echo JHtml::_('iwt.startTabSet', 'myTab', array('active' => 'display-links')); ?>
				<?php $tabSetStarted = true; ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted)
			{
				echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-articles'));
				$accordionStarted = true;
			}
			?>
			<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('JGLOBAL_ARTICLES'), 'display-articles'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted)
			{
				echo JHtml::_('iwt.startTabSet', 'myTab', array('active' => 'display-articles'));
				$tabSetStarted = true;
			}
			?>
			<?php echo JHtml::_('iwt.addTab', 'myTab', 'display-articles', JText::_('JGLOBAL_ARTICLES')); ?>
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="u-text-h3">' . JText::_('JGLOBAL_ARTICLES') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('articles'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
			<?php echo JHtml::_('iwt.endSlide'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php echo JHtml::_('iwt.endTab'); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted)
			{
				echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-profile'));
				$accordionStarted = true;
			}
			?>
			<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('COM_CONTACT_PROFILE'), 'display-profile'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted)
			{
				echo JHtml::_('iwt.startTabSet', 'myTab', array('active' => 'display-profile'));
				$tabSetStarted = true;
			}
			?>
			<?php echo JHtml::_('iwt.addTab', 'myTab', 'display-profile', JText::_('COM_CONTACT_PROFILE')); ?>
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="u-text-h3">' . JText::_('COM_CONTACT_PROFILE') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('profile'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
			<?php echo JHtml::_('iwt.endSlide'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php echo JHtml::_('iwt.endTab'); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
		<?php echo $this->loadTemplate('user_custom_fields'); ?>
	<?php endif; ?>

	<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted)
			{
				echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-misc'));
				$accordionStarted = true;
			}
			?>
			<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted)
			{
				echo JHtml::_('iwt.startTabSet', 'myTab', array('active' => 'display-misc'));
				$tabSetStarted = true;
			}
			?>
			<?php echo JHtml::_('iwt.addTab', 'myTab', 'display-misc', JText::_('COM_CONTACT_OTHER_INFORMATION')); ?>
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="u-text-h3">' . JText::_('COM_CONTACT_OTHER_INFORMATION') . '</h3>'; ?>
		<?php endif; ?>
			<dl class="dl-horizontal">
				<dt>
					<span class="Icon-info"></span>
				</dt>
				<dd>
					<span class="contact-misc">
						<?php echo $this->contact->misc; ?>
					</span>
				</dd>
			</dl>

		<?php if ($presentation_style === 'sliders') : ?>
			<?php echo JHtml::_('iwt.endSlide'); ?>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php echo JHtml::_('iwt.endTab'); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($accordionStarted) : ?>
		<?php echo JHtml::_('iwt.endAccordion'); ?>
	<?php elseif ($tabSetStarted) : ?>
		<?php echo JHtml::_('iwt.endTabSet'); ?>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>

	<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
	</div>
	<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2 u-text-r-s u-padding-r-all thumbnail pull-right">
		<?php echo JHtml::_('image', $this->contact->image, $this->contact->name, array('itemprop' => 'image', 'class' => 'u-sizeFull')); ?>
	</div>
	<?php endif; ?>

</div>

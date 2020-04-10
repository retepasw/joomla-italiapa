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

$params             = $this->item->params;
$presentation_style = $params->get('presentation_style');

?>
<?php if (JPluginHelper::isEnabled('user', 'profile')) :
	$fields = $this->item->profile->getFieldset('profile'); ?>

	<?php if ($presentation_style === 'sliders') : ?>
		<?php echo JHtml::_('iwt.startAccordion', 'slide-contact', array('active' => 'display-profile')); ?>
		<?php $accordionStarted = true; ?>
		<?php echo JHtml::_('iwt.addSlide', 'slide-contact', JText::_('COM_CONTACT_PROFILE'), 'display-profile'); ?>
	<?php elseif ($presentation_style === 'tabs') : ?>
		<?php echo JHtml::_('iwt.startTabSet', 'tab-contact', array('active' => 'display-profile')); ?>
		<?php $tabSetStarted = true; ?>
		<?php echo JHtml::_('iwt.addTab', 'tab-contact', JText::_('COM_CONTACT_PROFILE'), 'display-profile'); ?>
		<?php echo JHtml::_('iwt.startTabPanel', 'tab-contact', 'display-profile'); ?>
	<?php elseif ($presentation_style === 'plain') : ?>
		<div class="u-size1of2">
			<h3 class="u-text-h3"><?php echo JText::_('COM_CONTACT_PROFILE'); ?></h3>
	<?php endif; ?>

	<dl class="contact-profile dl-horizontal" id="users-profile-custom">
		<?php foreach ($fields as $profile) :
			if ($profile->value) :
				// echo '<dt>' . $profile->label . '</dt>';
				echo '<dt>' . JText::_($profile->getAttribute('label')) . '</dt>';
				$profile->text = htmlspecialchars($profile->value, ENT_COMPAT, 'UTF-8');

				switch ($profile->id) :
					case 'profile_website':
						$v_http = substr($profile->value, 0, 4);

						if ($v_http === 'http') :
							echo '<dd><a href="' . $profile->text . '">' . JStringPunycode::urlToUTF8($profile->text) . '</a></dd>';
						else :
							echo '<dd><a href="http://' . $profile->text . '">' . JStringPunycode::urlToUTF8($profile->text) . '</a></dd>';
						endif;
						break;

					case 'profile_dob':
						echo '<dd>' . JHtml::_('date', $profile->text, JText::_('DATE_FORMAT_LC4'), false) . '</dd>';
					break;

					default:
						echo '<dd>' . $profile->text . '</dd>';
						break;
				endswitch;
			endif;
		endforeach; ?>
	</dl>

	<?php if ($presentation_style == 'sliders') : ?>
		<?php echo JHtml::_('iwt.endSlide'); ?>
	<?php elseif ($presentation_style == 'tabs') : ?>
		<?php echo JHtml::_('iwt.endTabPanel'); ?>
	<?php elseif ($presentation_style == 'plain') : ?>
		</div>
	<?php endif; ?>
<?php endif; ?>

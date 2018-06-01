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

use Joomla\Registry\Registry;

$user = JFactory::getUser();
$params = JPluginHelper::getPlugin('jagdpr', 'joomla');
$general = JPluginHelper::getPlugin('jagdpr', 'general');
$joomlaParams = new Registry( !empty($params->params) ? $params->params: '{}' );
$generalParams = new Registry( !empty($general->params) ? $general->params: '{}'  );
$lang = JFactory::getLanguage();
$currentLang = $lang->getTag();
$jinput = JFactory::getApplication()->input;
?>

<div id="joomla-panel" class="ja-gdpr">
	<div class="Accordion Accordion--default fr-accordion js-fr-accordion" id="accordion-gdpr">
		<?php
			// print all other plugin.
			$dispatcher = JEventDispatcher::getInstance();
			JPluginHelper::importPlugin( 'jagdpr' );
			$dispatcher->trigger('onPrepareLayout');
		?>
	</div>

	<div class="row panel-footer">
		<div class="form-group actions-wrap">
			<div class="controls">
<?php if ( ( $jinput->get('print', 0) == 0 ) && ( $generalParams->get('delete_all') == 1 ) && $joomlaParams->get('status', 1) ) : ?>
				<button type="button" 
					class="Button Button--danger u-text-r-xs js-fr-dialogmodal-open<?php echo (!empty($this->request_send) ? ' is-disabled ': ''); ?>"
					aria-controls="deleteAllModal">
					<?php echo JText::_('JA_GDPR_DELETE_ALL_ACCOUNT'); ?>
				</button>
	<div class="Dialog js-fr-dialogmodal" id="deleteAllModal">
	    <div class="
	      Dialog-content
	      Dialog-content--centered
	      u-background-white
	      u-layout-prose
	      u-margin-all-xl
	      u-padding-all-xl
	      js-fr-dialogmodal-modal
	    " aria-labelledby="modal-title">
			<form action="<?php echo JRoute::_('index.php?option=com_jagdpr', false); ?>" method="post">
		        <div role="document" class="Prose">
		            <h2 class="u-cf u-text-h2 u-borderHideFocus" id="modal-title" tabindex="0"><?php echo JText::_('JA_GDPR_DELETE_ACCOUNT'); ?></h2>	
					<div class="modal-body">
						<?php if (!empty($generalParams->get('notify')->{$currentLang})): ?>
							<div class="notify-text">
								<?php echo $generalParams->get('notify')->{$currentLang}; ?>
							</div>
						<?php endif; ?>
					</div>
					<button type="submit" class="Button Button--default u-text-r-xs"><?php echo JText::_('JDELETE'); ?></button>
					<button class="Button Button--danger js-fr-dialogmodal-close u-floatRight"><?php echo JText::_('JCLOSE'); ?></button>
				</div>
				<input type="hidden" name="task" value="collection.jacustom" />
				<input type="hidden" name="action" value="deleteuser" />
				<input type="hidden" name="step" value="confirm" />
				<input type="hidden" name="plugin" value="joomla" />
				<?php echo JHtml::_('form.token'); ?>
			</form>
		</div>
	</div>
<?php elseif ( ( $jinput->get('print', 0) == 0 ) && ( $generalParams->get('delete_all') == 2 ) && $joomlaParams->get('status', 1) ) : ?>
				<button type="button" 
					class="Button Button--danger u-text-r-xs js-fr-dialogmodal-open<?php echo (!empty($this->request_send) ? ' is-disabled ': ''); ?>"
					aria-controls="deleteAllRequestModal">
					<?php echo JText::_('JA_GDPR_REQUEST_DELETE_ALL_ACCOUNT'); ?>
				</button>
	<div class="Dialog js-fr-dialogmodal" id="deleteAllRequestModal">
	    <div class="
	      Dialog-content
	      Dialog-content--centered
	      u-background-white
	      u-layout-prose
	      u-margin-all-xl
	      u-padding-all-xl
	      js-fr-dialogmodal-modal
	    " aria-labelledby="modal-title">
			<form action="<?php echo JRoute::_('index.php?option=com_jagdpr', false); ?>" method="post">
		        <div role="document" class="Prose">
		            <h2 class="u-cf u-text-h2 u-borderHideFocus" id="modal-title" tabindex="0"><?php echo JText::_('JA_GDPR_REQUEST_DELETE_ALL_ACCOUNT'); ?></h2>
					<div class="modal-body">
						<?php if (!empty($generalParams->get('notify')->{$currentLang})): ?>
							<div class="notify-text">
								<?php echo $generalParams->get('notify')->{$currentLang}; ?>
							</div>
						<?php endif; ?>
					</div>
					<button type="submit" class="Button Button--default u-text-r-xs"><?php echo JText::_('JA_GDPR_REQUEST_DELETE_ALL_ACCOUNT'); ?></button>
					<button class="Button Button--danger js-fr-dialogmodal-close u-floatRight"><?php echo JText::_('JCLOSE'); ?></button>						
				</div>
				<input type="hidden" name="task" value="collection.jacustom" />
				<input type="hidden" name="action" value="requestdelete" />
				<input type="hidden" name="step" value="confirm" />
				<input type="hidden" name="plugin" value="joomla" />
				<?php echo JHtml::_('form.token'); ?>
			</form>
		</div>
	</div>
<?php endif; ?>

<?php if ( ( $jinput->get('print', 0) == 0 ) && $generalParams->get('cta_btn') && $joomlaParams->get('status', 1)): ?>
	<button 
		type="button" 
		class="Button Button--default u-text-r-xs"
		onclick="window.open('<?php echo $generalParams->get('cta_link', '#'); ?>','_blank')"
		>
		<?php if ( $cta_icon = $generalParams->get('cta_icon') ) : ?>
			<span data-tooltip="<?php echo JHtml::tooltipText(JText::_('JA_GDPR_CUSTOM_CTA_BUTTON_TITLE'), null, 0, 0); ?>">
			<span class="Icon Icon-<?php echo $cta_icon; ?>"></span>
		<?php else : ?>
			<?php echo JText::_('JA_GDPR_CUSTOM_CTA_BUTTON_TITLE'); ?>
		<?php endif; ?>
	</button>
<?php endif; ?>

<?php if($generalParams->get('download_profile')): ?>
				<button type="button" class="Button Button--default u-text-r-xs"
					<?php if (!$jinput->get('print', 0)): ?>
					onclick="window.open('<?php echo JRoute::_('index.php?option=com_jagdpr&tmpl=component&print=1'); ?>','win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no'); return false;" 
					<?php else: ?>
					onclick="window.print(); return false;"
					<?php endif; ?>
					>
					<?php echo JText::_('JA_GDPR_DOWNLOAD_PROFILE'); ?>
				</button>
<?php endif;?>

			</div>
		</div>
	</div>
</div>

<style>
.ja-gdpr ul {
    list-style-type: disc;
}
</style>
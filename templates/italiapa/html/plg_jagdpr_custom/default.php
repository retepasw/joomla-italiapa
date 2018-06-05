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
$customParams = $this->params;
$lang = JFactory::getLanguage();
$currentLang = $lang->getTag();

$html = $customParams->get('html', array());
$general = JPluginHelper::getPlugin('jagdpr', 'general');
$generalParams = new Registry( $general->params );
?>
<?php if($customParams->get('status', 1)): ?>
<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-jagdpr_custom">
	<?php echo JText::_('TPL_ITALIAPA_JAGDPR_CUSTOM'); ?>
</h2>

<div id="accordion-panel-jagdpr_custom" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">

<fieldset>
	<div class="panel panel-custom-msg">

		<div class="panel-body">
			<?php echo !empty($html->$currentLang) ? $html->$currentLang : ''; ?>
		</div>

		<div class="panel-footer">
			<div class="form-group actions-wrap">
				<div class="controls">
					<?php if($customParams->get('show_request')): ?>
					<button 
						type="button" 
						class="Button Button--default u-text-r-xs<?php echo $this->isPending ? ' is-disabled ': ' js-fr-dialogmodal-open'; ?>"
						<?php echo $this->isPending ? '': 'aria-controls="customRequestModal"'; ?>
						>
						<?php echo JText::_('JA_GDPR_REQUEST_CUSTOM'); ?>
					</button>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>
</fieldset>

<div class="Dialog js-fr-dialogmodal" id="customRequestModal">
    <div class="
      Dialog-content
      Dialog-content--centered
      u-background-white
      u-layout-prose
      u-margin-all-xl
      u-padding-all-xl
      js-fr-dialogmodal-modal
    " aria-labelledby="modal-title">
        <div role="document" class="Prose">
            <h2 class="u-cf u-text-h2 u-borderHideFocus" id="modal-title" tabindex="0"><?php echo JText::_('JA_GDPR_REQUEST_DELETE_ALL_ACCOUNT'); ?></h2>

			<div class="modal-body">
				<?php if (!empty($generalParams->get('notify')->{$currentLang})): ?>
					<div class="notify-text">
						<?php echo $generalParams->get('notify')->{$currentLang}; ?>
					</div>
				<?php endif; ?>
			</div>

            <button class="Button Button--danger js-fr-dialogmodal-close u-floatRight">Chiudi</button>
				<form action="<?php echo JRoute::_('index.php?option=com_jagdpr', false); ?>" method="post">
					<button type="submit" class="Button Button--default u-text-r-xs"><?php echo JText::_('JA_GDPR_REQUEST_DELETE_ALL_ACCOUNT'); ?></button>
					<input type="hidden" name="task" value="collection.jacustom" />
					<input type="hidden" name="action" value="customrequest" />
					<input type="hidden" name="plugin" value="custom" />
					<input type="hidden" name="step" value="confirm" />
					<?php echo JHtml::_('form.token'); ?>
				</form>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
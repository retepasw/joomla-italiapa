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
$jinput = JFactory::getApplication()->input;
$joomlaParams = $this->params;
$lang = JFactory::getLanguage();
$currentLang = $lang->getTag();
$title = $joomlaParams->get('title', array());
$info = $joomlaParams->get('header', array());
$warning = $joomlaParams->get('notify', array());
$general = JPluginHelper::getPlugin('jagdpr', 'general');
$generalParams = new Registry( $general->params );

JHtml::_('script', 'system/core.js', false, true);
?>

<?php if($joomlaParams->get('status', 1)): ?>

<?php
// user custom field process;
$userFieldGroups    = array();
if (JComponentHelper::isEnabled('com_fields') && JComponentHelper::getParams('com_contact')->get('custom_fields_enable', '1')) {
	$user->text = '';

	JEventDispatcher::getInstance()->trigger('onContentPrepare', array ('com_users.user', &$user, &$user->params, 0));

	if (!isset($user->jcfields))
	{
		$user->jcfields = array();
	}

	foreach ($user->jcfields as $field) {
		if (!key_exists($field->group_title, $userFieldGroups))
			$userFieldGroups[$field->group_title] = array();
		$userFieldGroups[$field->group_title][] = $field;
	}

	if ($this->checkExtension()) {
		// Get the dispatcher and load the users plugins.
		$dispatcher = JEventDispatcher::getInstance();
		JPluginHelper::importPlugin('user', 'profile');

		// Trigger the data preparation event.
		$profile = $dispatcher->trigger('onContentPrepareData', array('com_users.profile', $user));
	}
}

?>

<script type="text/javascript">
/**
 * Render messages send via JSON
 * Used by some javascripts such as validate.js
 *
 * @param   {object}  messages    JavaScript object containing the messages to render. Example:
 *                              var messages = {
 *                                  "message": ["Message one", "Message two"],
 *                                  "error": ["Error one", "Error two"]
 *                              };
 * @return  {void}
 */
Joomla.renderMessages = function( messages ) {
	Joomla.removeMessages();

	var messageContainer = document.getElementById( 'system-message-container' ),
		type, typeMessages, messagesBox, title, titleWrapper, i, messageWrapper, alertClass;

	for ( type in messages ) {
		if ( !messages.hasOwnProperty( type ) ) { continue; }
		// Array of messages of this type
		typeMessages = messages[ type ];

		// Create the alert box
		messagesBox = document.createElement( 'div' );

		// Message class
		alertClass = (type == 'notice') ? 'Alert--info' : 'Alert--' + type;
		alertClass = (type == 'message') ? 'Alert--success' : alertClass;

		messagesBox.className = 'Prose Alert ' + alertClass + ' Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom'

		// Close button
		var buttonWrapper = document.createElement( 'button' );
		buttonWrapper.setAttribute('type', 'button');
		buttonWrapper.setAttribute('data-dismiss', 'alert');
		buttonWrapper.className = 'Button u-border-none u-floatRight';
		buttonWrapper.innerHTML = '<span class="u-text-r-m Icon Icon-close"></span>';
		messagesBox.appendChild( buttonWrapper );

		// Title
		title = Joomla.JText._( type );

		// Skip titles with untranslated strings
		if ( typeof title != 'undefined' ) {
			titleWrapper = document.createElement( 'h2' );
			titleWrapper.className = 'u-text-h';
			titleWrapper.innerHTML = Joomla.JText._( type );
			messagesBox.appendChild( titleWrapper );
		}

		// Add messages to the message box
		for ( i = typeMessages.length - 1; i >= 0; i-- ) {
			messageWrapper = document.createElement( 'div' );
			messageWrapper.innerHTML = typeMessages[ i ];
			messagesBox.appendChild( messageWrapper );
		}

		messageContainer.appendChild( messagesBox );
	}
};

jQuery(document).ready(function($){
		// should rewrite the js here.
		$('#save-username').hide();
		$('#cancel-username').hide();
		$('#edit-username').on('click', function(e){
			$(this).hide();
			$('#save-username').show();
			$('#cancel-username').show();			
			$('#joomla-edit-username').removeAttr('readonly');
			$('#joomla-edit-username').focus();
			e.preventDefault();
			return false;
		});
		$('#cancel-username').on('click', function(e){
			$('#joomla-edit-username').val('<?php echo $user->username; ?>');
			$('#joomla-edit-username').attr('readonly','');
			$('#save-username').hide();
			$('#cancel-username').hide();
	 		$('#edit-username').show();
			e.preventDefault();
			return false;
		});
		$('#save-username').on('click', function(e) {
			if ($('#joomla-edit-username').val() == '') {
				Joomla.renderMessages({warning: ['<?php echo JText::_('JA_GDPR_USERNAME_NOTEMPTY') ?>']});
 				setTimeout(function() {
 					Joomla.removeMessages();
 				}, 5000);
				e.preventDefault();
				return false;
			}
			$.ajax('<?php echo JRoute::_('index.php?option=com_jagdpr') ?>',
			{
				method: 'POST',
				data: {
					newname: $('#joomla-edit-username').val(),
					task: 'collection.jacustom',
					action: 'changename',
					plugin: 'joomla',
					'<?php echo JSession::getFormToken() ?>' : 1
				},
// 				cache: false,
				dataType: 'json', // type of response data
				success: function (data,status,xhr) {   // success callback function
	 				if (data.success==1) {
	 				}

					Joomla.renderMessages({message: [data.message]});
	 				setTimeout(function() {
	 					Joomla.removeMessages();
	 				}, 5000);
				},
				error: function (jqXhr, textStatus, errorMessage) { // error callback 
					Joomla.renderMessages({error: [errorMessage]});
	 				setTimeout(function() {
	 					Joomla.removeMessages();
	 				}, 5000);
				}
			});
			e.preventDefault();
			return false;
		});
	});
</script>

<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-jagdpr_joomla">
	<?php echo !empty($title->$currentLang) ? $title->$currentLang : JText::_('TPL_ITALIAPA_JAGDPR_JOOMLA'); ?>
</h2>

<div id="accordion-panel-jagdpr_joomla" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
<div class="Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs u-layout-prose">
	<?php if (!empty($info->$currentLang)): ?>
		<div class="Prose Alert Alert--info">
			<p><?php echo $info->$currentLang; ?></p>
		</div>
	<?php endif; ?>

	<fieldset class="Form-fieldset">

	<?php if (!empty($title->$currentLang)): ?>
		<legend class="Form-legend"><?php echo $title->$currentLang; ?></legend>
	<?php endif; ?>

	<div class="Form-field">
		<label class="Form-label is-required" for="name"><?php echo JText::_('JNAME'); ?></label>
		<input class="Form-input" id="name" aria-required="true" required readonly value="<?php echo $user->name; ?>" />
	</div>

	<div class="Form-field">
		<label class="Form-label is-required" for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
		<?php if( ( $jinput->get('print', 0) == 0 ) && $joomlaParams->get('edit_username')): ?>
		<div class="Grid Grid--withGutter">
			<div class="Grid-cell u-md-size8of12 u-lg-size8of12">
				<input class="Form-input" id="joomla-edit-username" aria-required="true" required readonly value="<?php echo $user->username; ?>" />
			</div>
			<div class="Grid-cell u-md-size4of12 u-lg-size4of12">
				<button id="edit-username" type="button" class="Button Button--default u-text-xs">
					<span data-tooltip="<?php echo JHtml::tooltipText(JText::_('JACTION_EDIT'), null, 0, 0); ?>">
						<span class="u-text-r-m Icon Icon-more-actions"></span>
					</span>									
				</button>
				<button id="save-username" type="button" class="Button Button--default u-text-r-xs">
					<span data-tooltip="<?php echo JHtml::tooltipText(JText::_('JUPDATE'), null, 0, 0); ?>">
						<span class="u-text-r-m Icon Icon-check"></span>
					</span>									
				</button>
				<button id="cancel-username" type="button" class="Button Button--danger u-text-r-xs">
					<span data-tooltip="<?php echo JHtml::tooltipText(JText::_('JCANCEL'), null, 0, 0); ?>">
						<span class="u-text-r-m Icon Icon-close"></span>
					</span>									
				</button>
			</div>
		</div>
		<?php else: ?>
		<input class="Form-input" id="username" aria-required="true" required readonly value="<?php echo $user->username; ?>" />
		<?php endif; ?>
	</div>

	<div class="Form-field">
		<label class="Form-label is-required"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
		<input class="Form-input" readonly value="******" />
	</div>

	<div class="Form-field">
		<label class="Form-label is-required"><?php echo JText::_('JGLOBAL_EMAIL'); ?></label>
		<input class="Form-input" readonly value="<?php echo $user->email; ?>" />
	</div>

	<!-- Profile Data -->
	<?php if (!empty($profile) && count($profile) && in_array(false, $profile, true)): ?>
	<?php else: ?>
		<?php if ($joomlaParams->get('show_profile_field') && !empty($user->profile)): ?>
			<?php $i=0; ?>
			<?php foreach ($user->profile as $k => $v) : ?>
				<?php $i++; ?>
				<div class="Form-field">
					<label class="Form-label"><?php echo $k; ?></label>
					<input class="Form-input" readonly value="<?php echo $v; ?>" />
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>

	<!-- CUSTOM FIELD FOR JOOMLA USER -->
	<?php if ($joomlaParams->get('show_custom_field') && !empty($userFieldGroups)): ?>
		<?php $i=0; ?>
		<?php foreach ($userFieldGroups as $groupTitle => $fields) : ?>
			<?php $id = JApplicationHelper::stringURLSafe($groupTitle); ?>
				<?php foreach ($fields as $field) : ?>
					<?php if (!$field->value) : ?>
						<?php continue; ?>
					<?php endif; ?>
					<?php $i++; ?>
					<div class="Form-field">
						<?php if ($field->params->get('showlabel')) : ?>
							<label class="Form-label"><?php echo JText::_($field->label); ?></label>
						<?php endif; ?>
						<input class="Form-input" readonly value="<?php echo $field->value; ?>" />
					</div>
				<?php endforeach; ?>
		<?php endforeach; ?>
	<?php endif; ?>
 
	<?php if ( ( $jinput->get('print', 0) == 0 ) && $joomlaParams->get('edit_profile') ) : ?>
		<div class="row panel-footer">
			<div class="form-group actions-wrap">
				<div class="controls">
					<button type="button" class="Button Button--default u-text-xs" onclick="location.href='<?php echo JRoute::_('index.php?option=com_users&view=profile', false); ?>';">
						<?php echo JText::_('JA_GDPR_EDIT_PROFILE'); ?>
					</button>
				</div>
			</div>
		</div>
	<?php endif; ?>
	</fieldset>
</div>
</div>

<style>
#joomla-panel #joomla-edit-username {
  border: 1px solid #ccc;
  max-width: unset;
  padding: .5em;
}
</style>
<?php endif; ?>

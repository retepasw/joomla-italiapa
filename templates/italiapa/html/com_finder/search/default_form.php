<?php
/**
 * @package     Joomla.Site
 * @subpackage	Templates.ItaliaPA
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

JHtml::addIncludePath(__DIR__);

if ($this->params->get('show_advanced', 1) || $this->params->get('show_autosuggest', 1))
{
	JHtml::_('jquery.framework');

	$script = "
jQuery(function() {";

	if ($this->params->get('show_advanced', 1))
	{
		/*
		* This segment of code disables select boxes that have no value when the
		* form is submitted so that the URL doesn't get blown up with null values.
		*/
		$script .= "
	jQuery('#finder-search').on('submit', function(e){
		e.stopPropagation();
		// Disable select boxes with no value selected.
		jQuery('#advancedSearch').find('select').each(function(index, el) {
			var el = jQuery(el);
			if(!el.val()){
				el.attr('disabled', 'disabled');
			}
		});
	});";
	}

	/*
	* This segment of code sets up the autocompleter.
	*/
	if ($this->params->get('show_autosuggest', 1))
	{
		JHtml::_('script', 'jui/jquery.autocomplete.min.js', array('version' => 'auto', 'relative' => true));

		$script .= "
	var suggest = jQuery('#q').autocomplete({
		serviceUrl: '" . JRoute::_('index.php?option=com_finder&task=suggestions.suggest&format=json&tmpl=component') . "',
		paramName: 'q',
		minChars: 1,
		maxHeight: 400,
		width: 300,
		zIndex: 9999,
		deferRequestBy: 500
	});";
	}

	$script .= "
});";

	JFactory::getDocument()->addScriptDeclaration($script);
}

?>

<form id="finder-search" action="<?php echo JRoute::_($this->query->toUri()); ?>" method="get" class="Form Form--spaced u-padding-all-xl u-text-r-xs">
	<?php echo $this->getFields(); ?>
	<?php // DISABLED UNTIL WEIRD VALUES CAN BE TRACKED DOWN. ?>
	<?php if (false && $this->state->get('list.ordering') !== 'relevance_dsc') : ?>
		<input type="hidden" name="o" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
	<?php endif; ?>
	<fieldset class="Form-fieldset">
		<div class="Form-field">
			<input class="Form-input u-text-r-s u-borderRadius-m" title="<?php echo JText::_('COM_FINDER_SEARCH_TERMS'); ?>" placeholder="<?php echo JText::_('COM_FINDER_SEARCH_TERMS'); ?>"
				type="text" name="q" id="q" size="30" value="<?php echo $this->escape($this->query->input); ?>" />
		</div>
		<?php if ($this->escape($this->query->input) != '' || $this->params->get('allow_empty_query')) : ?>
			<div class="Form-field Grid-cell u-textRight">
				<button name="Search" type="submit" class="Button Button--default Button--shadow u-text-m"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			</div>
		<?php else : ?>
			<div class="Form-field Grid-cell u-textRight">
				<button name="Search" type="submit" class="Button Button--danger Button--shadow u-text-m"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			</div>
		<?php endif; ?>
	</fieldset>

<?php
function GUIDv4 ($trim = true)
{
	// Windows
	if (function_exists('com_create_guid') === true) {
		if ($trim === true)
		{
			return trim(com_create_guid(), '{}');
		}
		else
		{
			return com_create_guid();
		}
	}

	// OSX/Linux
	if (function_exists('openssl_random_pseudo_bytes') === true)
	{
		$data = openssl_random_pseudo_bytes(16);
		$data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
		$data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
		return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}

	// Fallback (PHP 4.2+)
	mt_srand((double)microtime() * 10000);
	$charid = strtolower(md5(uniqid(rand(), true)));
	$hyphen = chr(45);                  // "-"
	$lbrace = $trim ? "" : chr(123);    // "{"
	$rbrace = $trim ? "" : chr(125);    // "}"
	$guidv4 = $lbrace.
		substr($charid,  0,  8).$hyphen.
		substr($charid,  8,  4).$hyphen.
		substr($charid, 12,  4).$hyphen.
		substr($charid, 16,  4).$hyphen.
		substr($charid, 20, 12).
		$rbrace;
	return $guidv4;
}
?>
	<?php if ($this->params->get('show_advanced', 1)) : ?>
		<?php $guid = GUIDv4(); ?>
		<div class="Accordion Accordion--default fr-accordion js-fr-accordion" id="accordion-<?php echo $guid; ?>">
			<?php $guid = GUIDv4(); ?>
			<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-<?php echo $guid; ?>"
				<?php echo $this->params->get('expand_advanced', 0) ? ' aria-selected="true" aria-expanded="true"' : ''; ?>>
				<span class="Accordion-link"><?php echo JText::_('COM_FINDER_ADVANCED_SEARCH_TOGGLE'); ?></span>
			</h2>
			<div id="accordion-panel-<?php echo $guid; ?>" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
				<?php if ($this->params->get('show_advanced_tips', 1)) : ?>
					<div id="search-query-explained" class="u-padding-bottom-l">
						<div class="u-text-p">
							<?php echo JText::_('COM_FINDER_ADVANCED_TIPS'); ?>
						</div>
						<hr />
					</div>
				<?php endif; ?>
				<div>
					<?php echo JHtml::_('filter.select', $this->query, $this->params); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</form>

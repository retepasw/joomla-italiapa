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

JHtml::addIncludePath(JPATH_SITE . '/components/com_finder/helpers/html');
JHtml::addIncludePath(JPATH_THEMES . '/italiapa/html/com_finder/search');

$moduleclass_sfx = $params->get('moduleclass_sfx');
$button = $params->get('show_button', 0);
$text = $params->get('alt_label', JText::_('MOD_FINDER_SEARCH_VALUE'));
$label = $params->get('alt_label', JText::_('JSEARCH_FILTER_SUBMIT'));

//if ($attribs['style'] != 'none')
if ($module->position == 'footer')
{
	// do not use u-*-size*of*
	$moduleclass_sfx = explode(' ', $moduleclass_sfx);
	for ($i = count($moduleclass_sfx) - 1; $i >= 0; $i--)
	{
		if ((substr($moduleclass_sfx[$i], 0, 6) == 'u-size') || (substr($moduleclass_sfx[$i], 4, 5) == '-size'))
		{
			unset($moduleclass_sfx[$i]);
		}
	}
	$moduleclass_sfx = implode(' ', $moduleclass_sfx);
}

$script = "
jQuery(document).ready(function() {
	var value, searchword = jQuery('#mod-finder-searchword" . $module->id . "');
			
		// Get the current value.
		value = searchword.val();
			
		// If the current value equals the default value, clear it.
		searchword.on('focus', function ()
		{
			var el = jQuery(this);
			
			if (el.val() === '" . JText::_('MOD_FINDER_SEARCH_VALUE', true) . "')
			{
				el.val('');
			}
		});
					
		// If the current value is empty, set the previous value.
		searchword.on('blur', function ()
		{
			var el = jQuery(this);
					
			if (!el.val())
			{
				el.val(value);
			}
		});
					
		jQuery('#mod-finder-searchform" . $module->id . "').on('submit', function (e)
		{
			e.stopPropagation();
			var advanced = jQuery('#mod-finder-advanced" . $module->id . "');
					
			// Disable select boxes with no value selected.
			if (advanced.length)
			{
				advanced.find('select').each(function (index, el)
				{
					var el = jQuery(el);
					
					if (!el.val())
					{
						el.attr('disabled', 'disabled');
					}
				});
			}
		});";
/*
 * This segment of code sets up the autocompleter.
 */
if ($params->get('show_autosuggest', 1))
{
	JHtml::_('script', 'jui/jquery.autocomplete.min.js', array('version' => 'auto', 'relative' => true));
	
	$script .= "
	var suggest = jQuery('#mod-finder-searchword" . $module->id . "').autocomplete({
		serviceUrl: '" . JRoute::_('index.php?option=com_finder&task=suggestions.suggest&format=json&tmpl=component') . "',
		paramName: 'q',
		minChars: 1,
		maxHeight: 400,
		width: 300,
		zIndex: 9999,
		deferRequestBy: 500
	});";
}

$script .= '});';

JFactory::getDocument()->addScriptDeclaration($script);
?>
<div class="search<?php echo $moduleclass_sfx; ?>">
	<form id="mod-finder-searchform<?php echo $module->id; ?>" action="<?php echo JRoute::_($route); ?>" method="get" class="Form" role="search">
		<div class="Form-field Form-field--withPlaceholder Grid u-margin-bottom-l" role="search">
			<?php
				$output = '<input type="text" name="q" id="mod-finder-searchword' . $module->id . '" class="Form-input Grid-cell u-sizeFill u-text-r-s u-borderRadius-m" size="'
 					. $params->get('field_size', 20) . '" value="' . htmlspecialchars(JFactory::getApplication()->input->get('q', '', 'string'), ENT_COMPAT, 'UTF-8') . '"'
 					. ' placeholder="' . JText::_('MOD_FINDER_SEARCH_VALUE') . '"/>';
 		
				if ($button) :
					$btn_output = '<button class="Grid-cell u-sizeFit Icon-search u-background-60 u-color-white u-padding-all-s u-textWeight-700" data-tooltip="' . JHtml::tooltipText($label, null, 0, 0) . '"></button>';
	
					switch ($button_pos) :
						case 'left' :
							$output = $btn_output . $output;
						break;
	
						case 'right' :
						default :
							$output .= $btn_output;
							break;
					endswitch;
				endif;

				$show_advanced = $params->get('show_advanced', 0);
				if ($show_advanced == 2) :
					$output .= '<a href="' . JRoute::_($route) . '"'
						. ' class="Grid-cell u-sizeFit Icon-more-items u-background-60 u-color-white u-padding-all-s u-textWeight-700 u-linkClean"'
						. ' data-tooltip="' . JHtml::tooltipText(JText::_('COM_FINDER_ADVANCED_SEARCH'), null, 0, 0) . '"></a>';
				endif;

				echo $output;
			?>
		</div>

		<?php if ($show_advanced == 1) : ?>
			<div id="mod-finder-advanced<?php echo $module->id; ?>" class="Form--spaced">
				<?php echo JHtml::_('filter.select', $query, $params); ?>
			</div>
		<?php endif; ?>
		<?php echo modFinderHelper::getGetFields($route, (int) $params->get('set_itemid', 0)); ?>
	</form>
</div>

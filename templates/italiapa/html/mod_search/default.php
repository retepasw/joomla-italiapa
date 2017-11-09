<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true));

/*
if ($width)
{
	$moduleclass_sfx .= ' ' . 'mod_search' . $module->id;
	$css = 'div.mod_search' . $module->id . ' input[type="search"]{ width:auto; }';
	JFactory::getDocument()->addStyleDeclaration($css);
	$width = ' size="' . $width . '"';
}
else
{
	$width = '';
}
 */
?>
<!--
<div class="search<?php echo $moduleclass_sfx; ?>">
-->

	<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="Form">
		<div class="Form-field Form-field--withPlaceholder Grid" role="search">
		<?php
//			$output = '<label for="mod-search-searchword' . $module->id . '" class="element-invisible">' . $label . '</label> ';
//			$output .= '<input name="searchword" id="mod-search-searchword' . $module->id . '" maxlength="' . $maxlength . '"  class="inputbox search-query" type="search"' . $width;
//			$output .= ' placeholder="' . $text . '" />';
			$output = '<input name="searchword" class="Form-input Grid-cell u-sizeFill u-text-r-s" required="" id="mod-search-searchword' . $module->id . '">';
			$output .= '<label class="Form-label" for="mod-search-searchword' . $module->id . '">'.$text.'</label>';

//			if ($button) :
				$btn_output = '<button class="Grid-cell u-sizeFit Icon-search u-background-60 u-color-white u-padding-all-s u-textWeight-700" title="'.$button_text.'" aria-label="'.$button_text.'"></button>';
/*
				if ($imagebutton) :
					$btn_output = ' <input type="image" alt="' . $button_text . '" class="button" src="' . $img . '" onclick="this.form.searchword.focus();"/>';
				else :
					$btn_output = ' <button class="button btn btn-primary" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
				endif;
 */
/*
				switch ($button_pos) :
					case 'top' :
						$output = $btn_output . '<br />' . $output;
						break;

					case 'news' :
						$output .= '<br />' . $btn_output;
						break;

					case 'right' :
 */
						$output .= $btn_output;
/*
						break;

					case 'left' :
					default :
						$output = $btn_output . $output;
						break;
				endswitch;
			endif;
 */
			echo $output;
		?>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		</div>
	</form>
<!--
</div>
-->
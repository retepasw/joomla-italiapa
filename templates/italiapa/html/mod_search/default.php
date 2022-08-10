<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
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
?>
<div class="search<?php echo $moduleclass_sfx; ?>">
	<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="Form">
		<div class="Form-field Form-field--withPlaceholder Grid" role="search">
			<?php
				$output = '<input name="searchword" class="Form-input Grid-cell u-sizeFill u-text-r-s" required="" id="mod-search-searchword' . $module->id . '" type="search">';
				$output .= '<label class="Form-label' . ($button && $button_pos == 'left' ? ' u-margin-left-xxl' : '') . '" for="mod-search-searchword' . $module->id . '">'.$text.'</label>';

				if ($button) :
					if ($imagebutton) :
						$btn_output = '<button class="Grid-cell u-sizeFit Icon-' . $button_text . ' u-background-60 u-color-white u-padding-all-s u-textWeight-700" data-tooltip="' . JHtml::tooltipText($label, null, 0, 0) . '"></button>';
					else :
						$btn_output = '<button class="Grid-cell u-sizeFit Icon-search u-background-60 u-color-white u-padding-all-s u-textWeight-700" data-tooltip="' . JHtml::tooltipText($label, null, 0, 0) . '"></button>';
					endif;

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

				echo $output;
			?>
			<input type="hidden" name="task" value="search" />
			<input type="hidden" name="option" value="com_search" />
			<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
		</div>
	</form>
</div>

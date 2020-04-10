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

extract($displayData);

/**
 * Layout variables
 * ---------------------
 * 	$text		 : (string)  The label text
 * 	$description  : (string)  An optional description to use in a tooltip
 * 	$for		  : (string)  The id of the input this label is for
 * 	$required	 : (boolean) True if a required field
 * 	$classes	  : (array)   A list of classes
 * 	$position	 : (string)  The tooltip position. Bottom for alias
 */

$classes = array_filter((array) $classes);

$id = $for . '-lbl';
$title = '';

if (!empty($description))
{
	if ($text && $text !== $description)
	{
		JHtml::_('bootstrap.popover', '.hasPopover', array('placement' => 'bottom'));
		$classes[] = 'hasPopover';
		$title	 = ' title="' . htmlspecialchars(trim($text, ':')) . '"'
			. ' data-content="'. htmlspecialchars($description) . '"';

		if (!$position && JFactory::getLanguage()->isRtl())
		{
			$position = ' data-placement="left" ';
		}
	}
	else
	{
		// TODO: ripristinare tooltip
		//JHtml::_('bootstrap.tooltip', '.hasTooltip', array('placement' => 'bottom'));
		//$classes[] = 'hasTooltip';
		//$title	 = ' title="' . JHtml::tooltipText(trim($text, ':'), $description, 0) . '"';
		JHtml::_('bootstrap.popover', '.hasPopover', array('placement' => 'bottom'));
		$classes[] = 'hasPopover';
		$title	 = ' data-content="' . htmlspecialchars(trim($text, ':')) . '"';
	}
}

if ($required)
{
	$classes[] = 'required';
}

?>
<label id="<?php echo $id; ?>" for="<?php echo $for; ?>" class="Form-label <?php echo implode(' ', $classes); ?>"<?php echo $title; ?><?php echo $position; ?>>
	<?php echo $text; ?><?php if ($required) : ?><span class="star">&#160;*</span><?php endif; ?>
</label>

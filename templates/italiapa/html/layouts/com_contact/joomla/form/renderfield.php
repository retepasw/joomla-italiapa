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

defined('_JEXEC') or die();

extract($displayData);

/**
 * Layout variables
 * ---------------------
 * $options : (array) Optional parameters
 * $label : (string) The html code for the label (not required if
 * $options['hiddenLabel'] is true)
 * $input : (string) The input field html code
 */

if (! empty($options['showonEnabled']))
{
	JHtml::_('jquery.framework');
	JHtml::_('script', 'jui/cms.js', array(
			'version' => 'auto',
			'relative' => true
	));
}

$class = empty($options['class']) ? '' : ' ' . $options['class'];
$rel = empty($options['rel']) ? '' : ' ' . $options['rel'];

/**
 *
 * @todo :
 *      
 *       As mentioned in #8473 (https://github.com/joomla/joomla-cms/pull/8473),
 *       ...
 *       as long as we cannot access the field properties properly, this seems
 *       to
 *       be the way to go for now.
 *      
 *       On a side note: Parsing html is seldom a good idea.
 *      
 *      
 *       https://stackoverflow.com/questions/1732348/regex-match-open-tags-except-xhtml-self-contained-tags/1732454#1732454
 */
preg_match('/class=\"([^\"]+)\"/i', $input, $match);

$required = (strpos($input, 'aria-required="true"') !== false || (! empty($match[1]) && strpos($match[1], 'required') !== false));
$typeOfSpacer = (strpos($label, 'spacer-lbl') !== false);
?>
<?php if (strpos($input, 'type="checkbox"') !== false) : ?>
	<div class="Form-field Form-field--choose Grid-cell<?php echo $class; ?>" <?php echo $rel; ?>>
		<?php $label = addClass($label, "Form-label--block"); ?>
		<?php $label = setAttribute($label, "for", getAttribute($input, "id")); ?>
		<?php $input = addClass($input, "Form-input"); ?>
		<?php preg_match('~<label(.*?)>~', $label, $output); ?>
		<?php if (empty($options['hiddenLabel'])) : ?>
			<?php echo '<label' . $output[1] . '>' . $input . '<span class="Form-fieldIcon" role="presentation"></span>' . strip_tags($label); ?>
			<?php if (!$required && !$typeOfSpacer) : ?>
				<span class="optional"><?php echo JText::_('COM_CONTACT_OPTIONAL'); ?></span>
			<?php endif; ?>
			<?php echo '</label>'; ?>
		<?php else : ?>
			<?php echo $input; ?>
		<?php endif; ?>
	</div>
<?php else : ?>
	<div class="Form-field<?php echo $class; ?>" <?php echo $rel; ?>>
		<?php if (empty($options['hiddenLabel'])) : ?>
			<?php echo $label; ?>
			<?php if (!$required && !$typeOfSpacer) : ?>
				<span class="optional"><?php echo JText::_('COM_CONTACT_OPTIONAL'); ?></span>
			<?php endif; ?>
		<?php endif; ?>
		<?php echo $input; ?>
	</div>
<?php endif; ?>

<?php
if (! function_exists('addClass'))
{
	function addClass ($htmlString, $newClass)
	{
		$pattern = '/class="([^"]*)"/';

		// class attribute set
		if (preg_match($pattern, $htmlString, $matches))
		{
			$definedClasses = explode(' ', $matches[1]);
			if (! in_array($newClass, $definedClasses))
			{
				$definedClasses[] = $newClass;
				$htmlString = str_replace($matches[0], sprintf('class="%s"', implode(' ', $definedClasses)), $htmlString);
			}
		}
		// class attribute not set
		else
		{
			$htmlString = preg_replace('/(\<.+\s)/', sprintf('$1class="%s" ', $newClass), $htmlString);
		}

		return $htmlString;
	}
}

if (! function_exists('setAttribute'))
{
	function setAttribute ($htmlString, $attributeName, $newAttribute)
	{
		$pattern = '/' . $attributeName . '="([^"]*)"/';

		// attribute set
		if (preg_match($pattern, $htmlString, $matches))
		{
			$htmlString = str_replace($matches[0], sprintf('%s="%s"', $attributeName, $newAttribute), $htmlString);
		}
		// attribute not set
		else
		{
			$htmlString = preg_replace('/(\<.+\s)/', sprintf('$1%s="%s" ', $attributeName, $newAttribute), $htmlString);
		}

		return $htmlString;
	}
}


if (! function_exists('getAttribute'))
{
	function getAttribute ($htmlString, $attributeName)
	{
		$pattern = '/' . $attributeName . '="([^"]*)"/';

		$attribute = preg_match($pattern, $htmlString, $matches) ? $matches[1] : '';

		return $attribute;
	}
}
?>

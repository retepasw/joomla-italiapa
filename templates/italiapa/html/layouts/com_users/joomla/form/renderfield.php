<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2018 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

extract($displayData);

/**
 * Layout variables
 * ---------------------
 *    $options         : (array)  Optional parameters
 *    $label           : (string) The html code for the label (not required if $options['hiddenLabel'] is true)
 *    $input           : (string) The input field html code
 */

if (!empty($options['showonEnabled']))
{
	JHtml::_('jquery.framework');
	JHtml::_('script', 'jui/cms.js', array('version' => 'auto', 'relative' => true));
}

$class = empty($options['class']) ? '' : ' ' . $options['class'];
$rel   = empty($options['rel']) ? '' : ' ' . $options['rel'];

/**
 * @TODO:
 *
 * As mentioned in #8473 (https://github.com/joomla/joomla-cms/pull/8473), ...
 * as long as we cannot access the field properties properly, this seems to
 * be the way to go for now.
 *
 * On a side note: Parsing html is seldom a good idea.
 * https://stackoverflow.com/questions/1732348/regex-match-open-tags-except-xhtml-self-contained-tags/1732454#1732454
 */
preg_match('/class=\"([^\"]+)\"/i', $input, $match);

$required     = (strpos($input, 'aria-required="true"') !== false || (!empty($match[1]) && strpos($match[1], 'required') !== false));
$typeOfSpacer = (strpos($label, 'spacer-lbl') !== false);
//$typeOfSpacer = (strpos($class, 'field-spacer') !== false);


$dom = new DOMDocument();
@$dom->loadHTML($input);
$x = $dom->getElementsByTagName('input')->item(0);
$readOnly = $x ? $x->getAttribute("readonly") : false;
?>

<div class="Form-field<?php echo $class; ?>"<?php echo $rel; ?>>
	<?php if (empty($options['hiddenLabel'])): ?>
		<div class="control-label">
			<?php echo $label; ?>
			<?php if (!$required && !$typeOfSpacer && !$readOnly) : ?>
				<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="controls">
		<?php echo $input; ?>
	</div>
</div>

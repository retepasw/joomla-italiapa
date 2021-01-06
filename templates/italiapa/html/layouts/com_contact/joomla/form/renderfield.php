<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
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
 * 	$options         : (array)  Optional parameters
 * 	$label           : (string) The html code for the label (not required if $options['hiddenLabel'] is true)
 * 	$input           : (string) The input field html code
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

$required      = (strpos($input, 'aria-required="true"') !== false || (!empty($match[1]) && strpos($match[1], 'required') !== false));
$typeOfSpacer  = (strpos($label, 'spacer-lbl') !== false);

?>
<div class="control-group<?php echo $class; ?>"<?php echo $rel; ?>>
	<?php if (empty($options['hiddenLabel']) || $options['hiddenLabel'] == false) : ?>
		<div class="control-label">
			<?php echo $label; ?>
			<?php if (!$required && !$typeOfSpacer) : ?>
				<span class="optional"><?php echo JText::_('COM_CONTACT_OPTIONAL'); ?></span>
			<?php endif; ?>
		</div>
		<div class="controls"><?php echo $input; ?></div>
	<?php else : ?>
		<div class="controls u-margin-top-m"><?php echo $input; ?></div>
	<?php endif; ?>
</div>

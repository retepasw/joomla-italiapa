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

defined('JPATH_BASE') or die;

extract($displayData);

/**
 * Layout variables
 * ---------------------
 * 	$options		 : (array)  Optional parameters
 * 	$label		   : (string) The html code for the label (not required if $options['hiddenLabel'] is true)
 * 	$input		   : (string) The input field html code
 */

if (!empty($options['showonEnabled']))
{
	JHtml::_('jquery.framework');
	JHtml::_('script', 'jui/cms.js', array('version' => 'auto', 'relative' => true));
}

$class = empty($options['class']) ? '' : ' ' . $options['class'];
$rel   = empty($options['rel']) ? '' : ' ' . $options['rel'];

$input = str_replace('btn btn-small', 'Button Button--default u-text-xs', $input);

//<div class="Form-field Grid-cell u-textRight">

$pattern = '/(.*?)\<button(.*?)\<\/button\>(.*?)/s';
$replacement = '$1<div class="Grid-cell u-textRight u-margin-top-m"><button$2</button></div>$3';
$input = preg_replace($pattern, $replacement, $input);
?>
<div class="Form-field<?php echo $class; ?>"<?php echo $rel; ?>>
	<?php if (empty($options['hiddenLabel'])) : ?>
		<div class="control-label"><?php echo $label; ?></div>
	<?php endif; ?>
	<div class="controls"><?php echo $input; ?></div>
</div>

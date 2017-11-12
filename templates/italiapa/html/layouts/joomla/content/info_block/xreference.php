<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$xreference = $displayData['item']->xreference;
$metadata = new JRegistry($displayData['item']->metadata);
if ($data = $metadata->get('data'))
{
    $xreference_link = $data->xreference;
}
else
{
    $xreference_link = null;
}
?>
<?php if ($xreference || $xreference_link) : ?>
	<span class="u-text-r-xxs u-textSecondary u-textWeight-400 u-lineHeight-xl u-cf">
	<bold><?php echo JText::_('TPL_ITALIAPA_SOURCE'); ?>: <?php if ($xreference_link) : ?>
	<a class="u-color-50" href="<?php echo $xreference_link; ?>" target="_blank">
	<?php endif; ?>
	<?php
		if ($displayData['item']->xreference) :
			echo $displayData['item']->xreference;
		endif;
		?> <span class="Icon Icon-external-link"></span>
	<?php if ($xreference_link) : ?>
	</a>
	<?php endif; ?>
	</bold></span>
<?php endif; ?>
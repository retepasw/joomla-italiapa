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

defined('JPATH_BASE') or die;

$xreference = $displayData['item']->xreference;
$metadata = new JRegistry($displayData['item']->metadata);
$xreference_link = $metadata->get('xreference');
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

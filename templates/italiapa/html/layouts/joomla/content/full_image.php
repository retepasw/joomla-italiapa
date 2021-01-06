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

if (is_array($displayData))
{
	$images = json_decode($displayData['item']->images);
	$params  = $displayData['item']->params;

	// Receive overridable options
	$displayData['options'] = !empty($displayData['options']) ? $displayData['options'] : array();

	if (is_array($displayData['options']))
	{
		$displayData['options'] = new JRegistry($displayData['options']);
	}
	// Options
	$class = "u-sizeFull item-image " . $displayData['options']->get('class');
}
else
{
	$images = json_decode($displayData->images);
	$params  = $displayData->params;
	$class = "u-sizeFull item-image";
}
?>
<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
	<?php $imgfloat = empty($images->float_fulltext) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
	<img class="<?php echo $class . ($images->image_fulltext_caption ? ' caption"' . ' title="' . htmlspecialchars($images->image_fulltext_caption) : ''); ?>"
	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" itemprop="image"/>
<?php endif; ?>

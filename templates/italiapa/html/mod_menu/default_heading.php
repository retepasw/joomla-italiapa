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
defined('_JEXEC') or die();

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

if ($item->anchor_css)
{
	$anchor_css = explode(' ', $item->anchor_css);
	for($i = count($anchor_css) - 1; $i >= 0; $i--)
	{
		if (substr($anchor_css[$i], 0, 4) == 'ipa:')
		{
			if (substr($anchor_css[$i], 4) == 'user-username')
			{
				$item->title = $user = JFactory::getUser()->name;
			}
			unset($anchor_css[$i]);
		}
	}
	$item->anchor_css = implode(' ', $anchor_css);
}
?>

<<?php echo $item->deeper ? 'a href="#"' : 'span'; ?> class="nav-header <?php echo $item->anchor_css; ?>"
	<?php echo $item->anchor_title ? ' data-tooltip="' . $item->anchor_title . '"' : ''; ?>><?php echo JHtml::_('iwt.linkType', $item); ?>
</<?php echo $item->deeper ? 'a' : 'span'; ?>>
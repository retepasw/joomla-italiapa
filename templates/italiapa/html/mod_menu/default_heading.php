<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('_JEXEC') or die();

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

if ($item->anchor_css)
{
	JLog::add(new JLogEntry('anchor_css: '.print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
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
	JLog::add(new JLogEntry('anchor_css: '.print_r($item->anchor_css, true), JLog::DEBUG, 'tpl_italiapa'));
}
?>

<<?php echo $item->deeper ? 'a href="#"' : 'span'; ?> class="nav-header <?php echo $item->anchor_css; ?>"
	<?php echo $item->anchor_title ? ' title="' . $item->anchor_title . '"' : ''; ?>><?php echo JHtml::_('iwt.linkType', $item); ?>
</<?php echo $item->deeper ? 'a' : 'span'; ?>>

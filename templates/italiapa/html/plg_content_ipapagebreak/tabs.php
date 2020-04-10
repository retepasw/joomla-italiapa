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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$t[] = $text[0];
array_shift($text);

$t[] = (string) JHtml::_('iwt.startTabSet', 'article' . $row->id);

$p = array();

foreach ($text as $key => $subtext)
{
	$match = $matches[$key];
	$match = (array) JUtility::parseAttributes($match[0]);

	if (isset($match['alt']))
	{
		$title = stripslashes($match['alt']);
	}
	elseif (isset($match['title']))
	{
		$title = stripslashes($match['title']);
	}
	else
	{
		$title = JText::sprintf('PLG_CONTENT_PAGEBREAK_PAGE_NUM', $key + 1);
	}

	$t[] = (string) JHtml::_('iwt.addTab', 'article-' . $row->id, $title, 'article-' . $row->id . '-' . $key);
	$p[] = (string) JHtml::_('iwt.startTabPanel', 'article-' . $row->id, 'article-' . $row->id . '-' . $key);
	$p[] = (string) $subtext;
	$p[] = (string) JHtml::_('iwt.endTabPanel');
}

$t = array_merge($t, $p);

$t[] = (string) JHtml::_('iwt.endTabSet');

echo implode(' ', $t);
?>

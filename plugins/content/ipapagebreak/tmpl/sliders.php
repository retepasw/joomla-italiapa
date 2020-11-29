<?php
/**
 * @package		Joomla.Plugins
 * @subpackage	Content.Ipapagebreak
 * 
 * @version		__DEPLOY_VERSION__
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('_JEXEC') or die();

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'plg_content_ipapagebreak'));

$t[] = $text[0];

$t[] = (string) JHtml::_($style . '.start', 'article' . $row->id . '-' . $style);

foreach ($text as $key => $subtext)
{
	if ($key >= 1)
	{
		$match = $matches[$key - 1];
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

		$t[] = (string) JHtml::_($style . '.panel', $title, 'article' . $row->id . '-' . $style . $key);
	}

	$t[] = (string) $subtext;
}

$t[] = (string) JHtml::_($style . '.end');

echo implode(' ', $t);
?>


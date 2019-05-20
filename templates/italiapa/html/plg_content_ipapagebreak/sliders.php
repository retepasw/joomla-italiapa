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

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

$t[] = $text[0];

$t[] = (string) JHtml::_('iwt.startAccordion', 'article-' . $row->id, array());
//$t[] = '<dl class="Accordion Accordion--default">';

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

		$t[] = (string) JHtml::_('iwt.addSlide', 'article-' . $row->id, $title, 'article-' . $row->id . '-' . $key);
		$t[] = (string) $subtext;
		$t[] = (string) JHtml::_('iwt.endSlide');
		//$t[] = '<dt>' . $title . '</dt>';
		//$t[] = '<dd>' . (string) $subtext . '</dd>';
	}
}

$t[] = (string) JHtml::_('iwt.endAccordion');
//$t[] = '</dl>';

echo implode(' ', $t);
?>


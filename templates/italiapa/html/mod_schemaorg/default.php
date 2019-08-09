<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	mod_schemaorg
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template Italia PA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$div = '';
$slash_div = '';
if (($module->position == 'footer') || ($module->position == 'footerinfo'))
{
	$div = $div . '<div class="Footer-subBlock">';
	$slash_div = '</div>' . $slash_div;
}


$text = '';
if ($section = $params->get('section'))
{
	$text .= '<h3 class="Footer-subTitle">'.$section.'</h3>';
}
$text .= '<address class="address">';

$postalAddress = array('addressLocality', 'addressCountry', 'postalCode', 'streetAddress', 'addressRegion');
$previous = '';
foreach($params->get('data') as $item)
{
	if ($item->title)
	{
		$text .= '<div><strong>'.$item->title.'</strong></div>';
	}

	switch ($item->type) 
	{		
		case 'addressLocality':
			if ($previous == 'postalCode')
			{
				$text .= ' - ';
			}
			else 
			{
				if (($previous != '') && ($item->title == ''))
				{
					$text .= '<br/>';
				}
				if (!in_array($previous, $postalAddress))
				{
					$text .= '<div class="address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">';
				}
			}
			$text .= '<span itemprop="'.$item->type.'">'.$item->text.'</span>';
			break;
		case 'addressCountry':
		case 'postalCode':
		case 'streetAddress':
			if (($previous != '') && ($item->title == ''))
			{
				$text .= '<br/>';
			}
			if (!in_array($previous, $postalAddress))
			{
				$text .= '<div class="address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">';
			}
			$text .= '<span itemprop="'.$item->type.'">'.$item->text.'</span>';
			break;
		case 'telephone':
		case 'faxNumber':
		case 'email':
			if (($previous != '') && ($item->title == ''))
			{
				$text .= '<br/>';
			}
			if (in_array($previous, $postalAddress))
			{
				$text .= '</div>';
			}			
			$text .= '<span itemprop="'.$item->type.'">'.$item->text.'</span>';
			break;
		case 'addressRegion':
			if (($item->type == 'addressRegion') && ($previous == 'addressLocality'))
			{
				$text .= ' (<span itemprop="'.$item->type.'">'.$item->text.'</span>)';
			}
			elseif (($previous != '') && ($item->title == ''))
			{
				$text .= '<br/>';
			}
			break;
	}
	
	$previous = $item->type;
}

if (in_array($previous, $postalAddress))
{
	$text .= '</div>';
}

$text .= '</address>';

echo $div . ($params->get('prepare_content', 0) ? JHtml::_('content.prepare', $text) : $text) . $slash_div;

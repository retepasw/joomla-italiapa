<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

use Joomla\Registry\Registry;

/*
 * html5 (chosen html5 tag and font header tags)
 */
function modChrome_lg($module, &$params, &$attribs)
{
	JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'tpl_italiapa'));
	JLog::add(new JLogEntry(print_r($module, true), JLog::DEBUG, 'tpl_italiapa'));

	$moduleTag	  = $params->get('module_tag', 'div');
	$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
	$moduleClass	=
		htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8').
		($bootstrapSize == 0 ? '' : ' u-md-size'.$bootstrapSize.'of12 u-lg-size'.$bootstrapSize.'of12');

	$headerTag	  = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
	$headerClass	= htmlspecialchars($params->get('header_class'), ENT_COMPAT, 'UTF-8');
	JLog::add(new JLogEntry($moduleClass, JLog::DEBUG, 'tpl_italiapa'));

	if ($module->position == 'menu')
	{
		$moduleTag   = 'nav';
	}
	elseif ($module->position == 'mainmenu')
	{
		$moduleTag   = 'nav';
		$moduleClass1 = 'u-textCenter u-hidden u-sm-hidden u-md-block u-lg-block '.$moduleClass;
	}
	elseif ($module->position == 'lead')
	{
		$moduleTag   = 'section';
		$moduleClass1 = 'u-padding-r-top u-padding-r-bottom '.$moduleClass;
		$headerTag   = 'h2';
		$headerClass = 'u-text-h3 u-layout-centerLeft '.$headerClass;
	}
	elseif (($module->position == 'footer') || ($module->position == 'footerinfo'))
	{
		$moduleClass1 = 'Footer-block Grid-cell '.$moduleClass;
		$headerTag   = 'h2';
		$headerClass = 'Footer-blockTitle '.$headerClass;
	}
	elseif ($module->position == 'services')
	{
		$moduleClass1 = 'u-sizeFull u-text-r-s '.$moduleClass;
		$headerTag   = 'h3';
	}
	$moduleClass1 = !empty($moduleClass1) ? ' class="' . htmlspecialchars($moduleClass1, ENT_COMPAT, 'UTF-8') . '"' : '';
	$headerClass = !empty($headerClass) ? ' class="' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : '';

	$plainPositions = array('footermenu', 'news');
	$plainModules = array('mod_carousel');

	if (!empty($module->content))
	{
		if ($module->position == 'services')
		{
			echo '<div class="Grid-cell u-sizeFull u-sm-size1of2 u-md-size1of3 u-lg-size1of3 u-margin-r-bottom">';
		}

		if (!in_array($module->position, $plainPositions) && !in_array($module->module, $plainModules))
//		if (($module->position != 'footermenu') && ($module->module != 'mod_carousel'))
		{
			echo '<' . $moduleTag . $moduleClass1 . '>';
		}
		// Get module parameters
		//$params = new Registry($module->params);

		if ($params->get('layout') == 'italiapa:linklist')
		{
			echo '<div class="u-sizeFull u-text-r-s ' . ($moduleClass ? $moduleClass : 'u-color-60') . '">';
		}
		if ((bool) $module->showtitle)
		{
			if ($params->get('layout') == 'italiapa:linklist')
			{
				echo '<h3 ' . ($headerClass ? $headerClass : 'class="u-border-bottom-m"') . '>';
				echo '<span class="u-block u-text-h3 ' . ($moduleClass ? $moduleClass : 'u-color-60') . ' u-textClean">' . $module->title . '</span></h3>';
			}
			elseif (!in_array($module->position, $plainPositions) && !in_array($module->module, $plainModules))
			{
				echo '<'. $headerTag . $headerClass . '>' . $module->title . '</' . $headerTag . '>';
			}
		}
		echo $module->content;

		if ($params->get('layout') == 'italiapa:linklist')
		{
			echo '</div>';
		}
		if (!in_array($module->position, $plainPositions) && !in_array($module->module, $plainModules))
//		if (($module->position != 'footermenu') && ($module->module != 'mod_carousel'))
		{
			echo '</' . $moduleTag . '>';
		}
		if ($module->position == 'services')
		{
			echo '</div>';
		}
	}
}

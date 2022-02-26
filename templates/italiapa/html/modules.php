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

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/*
 * html5 (chosen html5 tag and font header tags)
 */
function modChrome_lg($module, &$params, &$attribs)
{
    $moduleTag	    = $params->get('module_tag', 'div');
    $bootstrapSize  = (int) $params->get('bootstrap_size', 0);
    $moduleClass	=
        htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8').
        ($bootstrapSize == 0 ? '' : ' u-md-size'.$bootstrapSize.'of12 u-lg-size'.$bootstrapSize.'of12');

    $headerTag	    = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
    $headerClass	= htmlspecialchars($params->get('header_class'), ENT_COMPAT, 'UTF-8');
    $li_css         = '';

    if ($params->get('layout') == 'italiapa:entrypoint')
    {
    	$moduleClass1 = 'Grid Grid--withGutter ' . $moduleClass;
    }
    if ($module->position == 'menu')
    {
        $moduleTag   = 'nav';
    }
    elseif ($module->position == 'mainmenu')
    {
        $moduleTag   = 'nav';
        $moduleClass1 = 'u-textCenter u-hidden u-sm-hidden u-md-block u-lg-block ' . $moduleClass;
    }
    elseif ($module->position == 'lead')
    {
    	$moduleClass = explode(' ', $moduleClass);
    	for ($i = count($moduleClass) - 1; $i >= 0; $i--)
    	{
    		if ((substr($moduleClass[$i], 0, 6) == 'u-size') || (substr($moduleClass[$i], 4, 5) == '-size'))
    		{
    			$li_css = $moduleClass[$i] . ' ' . $li_css;
    			unset($moduleClass[$i]);
    		}
    	}
    	$moduleClass = implode(' ', $moduleClass);

        $moduleTag   = 'section';
        $moduleClass1 = 'u-padding-r-top u-padding-r-bottom ' . $moduleClass;
        $headerTag   = 'h2';
        $headerClass = 'u-text-h3 u-layout-centerLeft ' . $headerClass;
    }
    elseif (($module->position == 'footer') || ($module->position == 'footerinfo'))
    {
        $moduleClass1 = 'Footer-block Grid-cell ' . $moduleClass;
        $headerTag   = 'h2';
        $headerClass = 'Footer-blockTitle ' . $headerClass;
    }
    elseif ($module->position == 'services')
    {
        $moduleClass1 = 'u-sizeFull u-text-r-s ' . ($moduleClass ?: 'u-color-60');
        $headerTag   = 'h3';
    }
    if (!empty($moduleClass1))
    {
        $moduleClass1 = ' class="' . trim(htmlspecialchars($moduleClass1, ENT_COMPAT, 'UTF-8')) . '"';
    }
    elseif (!empty($moduleClass))
    {
        $moduleClass1 = ' class="' . trim(htmlspecialchars($moduleClass, ENT_COMPAT, 'UTF-8')) . '"';
    }
    $headerClass = !empty($headerClass) ? ' class="' . trim(htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8')) . '"' : '';

    $plainPositions = array('footermenu', 'news');
    $plainModules = array('mod_carousel');

    if (!empty($module->content))
    {
        $div = '';
        $slash_div = '';

        if ($module->position == 'services')
        {
            $div .= '<div class="Grid-cell u-sizeFull u-sm-size1of2 u-md-size1of3 u-lg-size1of3 u-margin-r-bottom">';
            $slash_div = '</div>' . $slash_div;
        }

        if ($module->position == 'right')
        {
            $div .= '<div class="u-sizeFull u-text-r-s ' . ($moduleClass ? $moduleClass : 'u-color-70') . '">';
            $slash_div = '</div>' . $slash_div;
        }
        elseif (!in_array($module->position, $plainPositions) && !in_array($module->module, $plainModules))
        {
            $div .= '<' . $moduleTag . $moduleClass1 . '>';
            $slash_div = '</' . $moduleTag . '>' . $slash_div;
        }

        // Get module parameters
        //$params = new Registry($module->params);

        if ((bool) $module->showtitle)
        {
        	if (($params->get('layout') == 'italiapa:linklist')  || ($params->get('layout') == 'italiapa:treeview')
        			|| ($params->get('layout') == 'italiapa:anac')
            		|| ($module->position == 'right') && ($params->get('layout') == '_:default')
            		|| ($module->position == 'services') && ($params->get('layout') == '_:default'))
            {
                $div .= '<h3 ' . ($headerClass ? $headerClass : 'class="u-border-bottom-m"') . '>';
                $div .= '<span class="u-block u-text-h3 ' . ($moduleClass ? $moduleClass : 'u-color-60') . ' u-textClean">' . $module->title . '</span></h3>';
            }
            elseif ($module->position == 'featured')
            {
            	$div .= '<h3 ' . ($headerClass ? $headerClass : 'class="u-text-h3 u-color-60 u-textClean"') . '>';
            	$div .= $module->title . '</h3>';
            }
            elseif (!in_array($module->position, $plainPositions) && !in_array($module->module, $plainModules))
            {
                $div .= '<'. $headerTag . $headerClass . '>' . $module->title . '</' . $headerTag . '>';
            }
        }

        echo $div . $module->content . $slash_div;
    }
}

function modChrome_entrypoint($module, &$params, &$attribs)
{
	if (!empty ($module->content))
	{
		$moduleTag      = $params->get('module_tag');
		$headerTag      = htmlspecialchars($params->get('header_tag'), ENT_COMPAT, 'UTF-8');
		$headerClass    = $params->get('header_class');
		$bootstrapSize  = $params->get('bootstrap_size');
		$moduleClass    = !empty($bootstrapSize) ? ' u-md-size'.$bootstrapSize.'of12 u-lg-size'.$bootstrapSize.'of12' : '';
		$moduleClassSfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

		$moduleClassSfx = explode(' ', $moduleClassSfx);
		for ($i = count($moduleClassSfx) - 1; $i >= 0; $i--)
		{
			if ((substr($moduleClassSfx[$i], 0, 6) == 'u-size') || (substr($moduleClassSfx[$i], 4, 5) == '-size'))
			{
				unset($moduleClassSfx[$i]);
			}
		}
		$moduleClassSfx = implode(' ', $moduleClassSfx);

		$html  = "<{$moduleTag} class=\"Grid Grid--withGutter moduletable{$moduleClassSfx} {$moduleClass}\">";

		if ((bool) $module->showtitle)
		{
			$html .= "<{$headerTag} class=\"{$headerClass}\">{$module->title}</{$headerTag}>";
		}

		$html .= $module->content;
		$html .= "</{$moduleTag}>";

		echo $html;
	}
}

function modChrome_iwt($module, &$params, &$attribs)
{
	$moduleTag             = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
	$headerTag             = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$bootstrapSize         = (int) $params->get('bootstrap_size', 0);
	$moduleSizeClass       = $bootstrapSize ? 'u-sizeFull u-md-size'.$bootstrapSize.'of12 u-lg-size'.$bootstrapSize.'of12 ' : '';
	$moduleColor           = '';
	$moduleclass_sfx       = $params->get('moduleclass_sfx');
	$moduleclass_sfx_array = explode(' ', $moduleclass_sfx);
	for ($i = count($moduleclass_sfx_array) - 1; $i >= 0; $i--)
	{
		if ((substr($moduleclass_sfx_array[$i], 0, 6) == 'u-size') || (substr($moduleclass_sfx_array[$i], 4, 5) == '-size')) 
		{
			if ($bootstrapSize == 0)
			{
				$moduleSizeClass .= $moduleclass_sfx_array[$i] . ' ';
			}
			// else do not use u-*-size*of*
			unset($moduleclass_sfx_array[$i]);
		}
		elseif (substr($moduleclass_sfx_array[$i], 0, 13) == 'u-background-')
		{
			$moduleColor = $moduleclass_sfx_array[$i];
			unset($moduleclass_sfx_array[$i]);
		}
	}
	$moduleclass_sfx  = 'Grid-cell ' . $moduleSizeClass . implode(' ', $moduleclass_sfx_array);

	// Temporarily store header class in variable
	$headerClass    = $params->get('header_class');
	$headerClass    = $headerClass ? ' class="' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : '';

	if (!empty ($module->content)) {
		//$content = '<' . $moduleTag . ' class="' . $moduleSizeClass . ' ' . htmlspecialchars($moduleclass_sfx, ENT_COMPAT, 'UTF-8') . '">';
		$content = '<' . $moduleTag . ' id="module-' . $module->id . '" class="' . htmlspecialchars($moduleclass_sfx, ENT_COMPAT, 'UTF-8') . '">';
		if ((bool) $module->showtitle) {
			$content .= '<' . $headerTag . $headerClass . '>' . $module->title . '</' . $headerTag . '>';
		}
		$content .= $module->content;
		$content .= '</' . $moduleTag . '>';
		if (!empty($moduleColor))
		{
			$content = '<div class="u-sizeFull ' . $moduleColor . '">' . $content . '</div>'; 
		}
		echo $content;
	}
}

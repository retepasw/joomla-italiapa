<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
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

// Check if we need to inject the CSS
if ($this->params->get('use_css', 0)) {
	JHtml::stylesheet('media/com_osmap/css/sitemap_html.min.css');
}

$this->titleTag = '<h3 class="u-border-bottom-m u-color-60" id="osmap-menu-uid-%s"><span class="u-block u-text-h3 u-textClean">%s%s</span></h3>';
$this->ulTag = '<ul class="Linklist Prose u-text-r-xs ';

include __DIR__ . '/default.php';

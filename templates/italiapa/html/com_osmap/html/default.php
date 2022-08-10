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

use Alledia\OSMap;

if ($layout = $this->getLayout() == 'default')
{
	\JFactory::getDocument()->addStyleDeclaration('.osmap-items ul{list-style-type:disc;margin: 9px 0 9px 25px}.osmap-items li{margin-bottom:9px}');

	// Check if we need to inject the CSS
	if ($this->params->get('use_css', 1)) {
		JHtml::stylesheet('media/com_osmap/css/sitemap_html.min.css');
	}

	$this->titleTag = '<h3 class="u-text-h3 u-margin-r-bottom" id="osmap-menu-uid-%s">%s%s</h3>';
	$this->ulTag = '';
}

\JFactory::getDocument()->addScriptDeclaration('
( function( $ ) {
	$( document ).ready( function( ) {
		$( \'.osmap-items li span.osmap-item-separator\' ).each( function ( i, el ) {
			$( el ).closest( \'li\' ).after( $( el ).siblings( \'ul\' ).children( \'li\' ) );
			$( el ).closest( \'li\' ).remove();
		});
	} );
} )( jQuery );
');

// If debug is enabled, use text content type
if ($this->debug) {
	OSMap\Factory::getApplication()->input->set('tmpl', 'component');
	JHtml::stylesheet('media/com_osmap/css/sitemap_html_debug.min.css');
}

// Check if we have parameters from a menu, acknowledging we have a menu
if (!is_null($this->params->get('menu_text'))) {
    // We have a menu, so let's use its params to display the heading
    $pageHeading = $this->params->get('page_heading', $this->params->get('page_title'));
} else {
    // We don't have a menu, so lets use the sitemap name
    $pageHeading = $this->sitemap->name;
}
?>

<div id="osmap" class="osmap-sitemap <?php echo $this->debug ? 'osmap-debug' : ''; ?> <?php echo $this->params->get('pageclass_sfx', ''); ?>">
    <!-- Heading -->

    <?php if ($this->params->get('show_page_heading', 1)) : ?>
        <div class="page-header">
            <h1><?php echo $this->escape($pageHeading); ?></h1>
        </div>
    <?php endif; ?>

    <!-- Description -->
    <?php if ($this->params->get('show_sitemap_description', 1)) :   ?>
        <div class="osmap-sitemap-description">
            <?php echo $this->params->get('sitemap_description', ''); ?>
        </div>
    <?php endif; ?>

    <!-- Error message, if exists -->
    <?php if (!empty($this->message)) : ?>
        <div class="alert alert-warning">
            <?php echo $this->message; ?>
        </div>
    <?php endif; ?>

    <!-- Items -->
    <?php if (empty($this->message)) : ?>
        <?php echo $this->loadTemplate('items'); ?>
    <?php endif; ?>
</div>

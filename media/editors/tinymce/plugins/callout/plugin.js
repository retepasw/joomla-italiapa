/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License
 * or other free or open source software licenses.
 */

var css = ".icon-must:before{content:'\\24';color:pink}"+
		".icon-should:before{content:'\\24';color:lightblue}"+
		".icon-could:before{content:'\\24';color:lightgreen}"+
		".icon-example:before{content:'\\24';color:gray}",
	head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

style.type = 'text/css';
if (style.styleSheet) {
	style.styleSheet.cssText = css;
} else {
	style.appendChild(document.createTextNode(css));
}
head.appendChild(style);

tinymce.PluginManager.add('callout', function (editor, url) {
    editor.addButton('must', {
    	text: null,
    	icon: 'none icon-must',
        tooltip: 'Must',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<div class=\"Callout Callout--must u-text-r-xs\" role=\"note\"><h2 class=\"Callout-title u-text-r-l\">Must</h2><p class=\"u-layout-prose u-color-grey-90 u-text-p u-padding-r-all\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'description')+'</p></div>');
    	}
    });
    editor.addButton('should', {
    	text: null,
    	icon: 'none icon-should',
        tooltip: 'Should',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<div class=\"Callout Callout--should u-text-r-xs\" role=\"note\"><h2 class=\"Callout-title u-text-r-l\">Should</h2><p class=\"u-layout-prose u-color-grey-90 u-text-p u-padding-r-all\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'description')+'</p></div>');
    	}
    });
    editor.addButton('could', {
    	text: null,
    	icon: 'none icon-could',
        tooltip: 'Could',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<div class=\"Callout Callout--could u-text-r-xs\" role=\"note\"><h2 class=\"Callout-title u-text-r-l\">Could</h2><p class=\"u-layout-prose u-color-grey-90 u-text-p u-padding-r-all\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'description')+'</p></div>');
    	}
    });
    editor.addButton('example', {
    	text: null,
    	icon: 'none icon-example',
        tooltip: 'Example',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<div class=\"Callout Callout--example u-text-r-xs\" role=\"note\"><h2 class=\"Callout-title u-text-r-l\">Example</h2><p class=\"u-layout-prose u-color-grey-90 u-text-p u-padding-r-all\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'description')+'</p></div>');
    	}
    });
});

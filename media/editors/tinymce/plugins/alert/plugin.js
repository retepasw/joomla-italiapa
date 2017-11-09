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

var css = ".icon-error:before{content:'\\e217';color:red}"+
		".icon-warning:before{content:'\\e225';color:#d1ae00}"+
		".icon-success:before{content:'\\e219';color:#65b446}"+
		".icon-info:before{content:'\\e221';color:#24c3cc}",
	head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

style.type = 'text/css';
if (style.styleSheet) {
	style.styleSheet.cssText = css;
} else {
	style.appendChild(document.createTextNode(css));
}
head.appendChild(style);

tinymce.PluginManager.add('alert', function (editor, url) {
    editor.addButton('error', {
    	text: null,
    	icon: 'none icon-error',
        tooltip: 'Error',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<div class=\"Prose Alert Alert--error Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom\" role=\"error\"><h2 class=\"u-text-h3\">Si è verificato un errore</h2><p class=\"u-text-p\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'descrizione')+'</p></div>');
    	}
    });
    editor.addButton('warning', {
    	text: null,
    	icon: 'none icon-warning',
        tooltip: 'Warning',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<div class=\"Prose Alert Alert--warning Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom\" role=\"warning\"><h2 class=\"u-text-h3\">Attenzione</h2><p class=\"u-text-p\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'descrizione')+'</p></div>');
    	}
    });
    editor.addButton('success', {
    	text: null,
    	icon: 'none icon-success',
        tooltip: 'Success',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<div class=\"Prose Alert Alert--success Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom\" role=\"success\"><h2 class=\"u-text-h3\">Operazione effettuata con successo</h2><p class=\"u-text-p\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'descrizione')+'</p></div>');
    	}
    });
    editor.addButton('info', {
    	text: null,
    	icon: 'none icon-info',
        tooltip: 'Info',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<div class=\"Prose Alert Alert--info Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom\" role=\"info\"><h2 class=\"u-text-h3\">Ulteriori informazioni</h2><p class=\"u-text-p\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'descrizione')+'</p></div>');
    	}
    });
});

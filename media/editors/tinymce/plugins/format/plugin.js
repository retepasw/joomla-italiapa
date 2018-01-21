/**
 *
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

/**
 * @version		3.8.0
 * @since		3.7.0
 */

tinymce.PluginManager.add('format', function (editor, url) {
	editor.contentCSS.push(url + '/build.css');

    editor.addButton('blockquote', {
    	text: null,
    	icon: 'blockquote',
        tooltip: 'Blockquote',
    	onclick: function() {
    		tinyMCE.activeEditor.selection.setContent('<blockquote class=\"Prose-blockquote\"><p class=\"u-layout-prose u-color-grey-90 u-text-p u-padding-r-all\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'Citazione')+'</p></blockquote>');
    	}
    });
    editor.addButton('codesample', {
    	text: null,
    	icon: 'code',
        tooltip: 'Code',
    	onclick: function() {
			tinyMCE.activeEditor.selection.setContent('<pre class=\"u-textPreformatted u-textOverflow\"><code class=\"u-text-r-xxs\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'Codice')+'</code></pre>');    	
    	}
    });

    editor.settings.inline_styles = false;
	editor.settings.table_default_attributes = {class: 'Table Table--withBorder u-text-r-xs'};

	editor.on('init', function() {
		var alignElements = 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table';

		editor.formatter.register({
			aligncenter:  [
				{selector: alignElements, classes: 'u-textCenter'},
				{selector: 'img', styles: {'max-width':'100%', 'height': 'auto', 'display': 'block', 'margin-left': 'auto', 'margin-right': 'auto'}}
				],
			alignleft:    [
				{selector: alignElements, classes: 'u-textLeft'},
				{selector: 'img', styles: {'max-width':'100%', 'height': 'auto', 'display': 'block', 'margin-left': '0', 'margin-right': 'auto'}}
				],
			alignright:   [
				{selector: alignElements, classes: 'u-textRight'},
				{selector: 'img', styles: {'max-width':'100%', 'height': 'auto', 'display': 'block', 'margin-left': 'auto', 'margin-right': '0'}}
				],
			h1:           {block: 'h1', classes: 'u-text-h1', exact: true},
			h2:           {block: 'h2', classes: 'u-text-h2', exact: true},
			h3:           {block: 'h3', classes: 'u-text-h3', exact: true},
			h4:           {block: 'h4', classes: 'u-text-h4', exact: true},
			h5:           {block: 'h5', classes: 'u-text-h5', exact: true},
			h6:           {block: 'h6', classes: 'u-text-h6', exact: true}
		});
	});
});
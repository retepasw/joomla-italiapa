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

tinymce.PluginManager.add('format', function (editor, url) {
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

	editor.on('init', function() {
		var alignElements = 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
				fontSizes = tinymce.explode(editor.settings.font_size_style_values),
				schema = editor.schema;

		// Override some internal formats
		editor.formatter.register({
			// Change alignment formats to use the deprecated align attribute
			aligncenter: {selector: alignElements, classes: 'u-textCenter'},
			alignleft:   {selector: alignElements, classes: 'u-textLeft'},
			alignright:  {selector: alignElements, classes: 'u-textRight'}
		});
	});
});
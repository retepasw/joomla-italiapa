;(typeof(tinymce) !== 'undefined') && tinymce.PluginManager.add('ipa', function (editor, url) {
	console.log('TinyMCE for ItaliaPA v.__DEPLOY_VERSION__');

	var pluginOptions = Joomla.getOptions ? Joomla.getOptions('plg_system_ipatinymce', {})
			:  (Joomla.optionsStorage.plg_system_ipatinymce || {}),
		jsurl = pluginOptions.jsurl || url,
		cssurl = pluginOptions.cssurl || url;

	tinymce.DOM.loadCSS(cssurl + '/editor.min.css');
	editor.contentCSS.push(cssurl + '/italiapa.min.css');
	editor.contentCSS.push(cssurl + '/content.min.css');
    var scriptLoader = new tinymce.dom.ScriptLoader();
    scriptLoader.add(jsurl + '/uuid.min.js');
    scriptLoader.loadQueue();

	var menuItems = [];

	/** Tooltip */

    var showDialogTooltip = function () {
		var selectedNode = editor.selection.getNode();
		var isTooltip = (selectedNode.nodeName.toLowerCase() == 'a') && editor.dom.hasClass(selectedNode, 'Tooltip-toggle');
		var id = '', text = '', tooltip = '';

		if (isTooltip) {
			id = editor.dom.getAttrib(selectedNode, 'href').substr(1);
			text = selectedNode.innerHTML;
			var child = editor.getDoc().getElementById(id).firstChild;
//			var child = editor.dom.getNext(selectedNode,'span').firstChild;
			while (child) {
			    if (child.nodeName.toLowerCase() == 'span') {
			    	tooltip = child.innerHTML;
			    }
			    child = child.nextSibling;
			}
		} else {
			id = 'tooltip-' + uuid.v4();
			text = editor.selection.getContent();
		}

		editor.windowManager.open({
			title: 'Tooltip',
			body: [
				{type: 'textbox', name: 'id',      minWidth: 400, label: 'ID',      value: id,      disabled: true},
				{type: 'textbox', name: 'text',    minWidth: 400, label: 'Text',    value: text},
				{type: 'textbox', name: 'tooltip', minWidth: 400, label: 'Tooltip', value: tooltip, minHeight: 80, multiline: true}
				],
			onsubmit: function(e) {
				var id = e.data.id;
				var text = e.data.text;
				var tooltip = e.data.tooltip;
				var tooltipNode =
					'<span class="Icon-drop-down Dropdown-arrow u-color-teal-70"></span>' +
					'<span class="u-layout-prose u-text-r-xs">' +
					tooltip +
					'</span>';

				if (isTooltip) {
					// selectedNode.href = '#' + id;
					selectedNode.innerHTML = text;
					editor.getDoc().getElementById(id).innerHTML = tooltipNode;
				} else {
					var node =
						'<a href="#' + id + '" class="Tooltip-toggle u-textClean u-padding-right-xs u-padding-left-xs' +
						' u-background-teal-50 u-color-black" data-menu-trigger="' + id + '">' + text + '</a>' +
						'<span id="' + id + '" data-menu class="Dropdown-menu u-borderShadow-m u-background-teal-70 u-color-white u-layout-prose' +
						' u-padding-r-all u-borderRadius-l">' +
						tooltipNode +
						'</span>';
					editor.selection.setContent(node);
				}
			}
		});
	};

	menuItems.push({
		icon: 'none icon-ipa-tooltip',
		text: 'Tooltip',
		context: 'insert',
		onclick: showDialogTooltip
	});

    editor.addButton('ipa-tooltip', {
    	text: null,
    	icon: 'none icon-ipa-tooltip',
        tooltip: 'Tooltip',
		onclick: showDialogTooltip,
		stateSelector: 'a.Tooltip-toggle[data-menu-trigger]'
    });


    /** Dialog */

    var showDialogDialog = function () {
		var selectedNode = editor.selection.getNode();
		var isDialog = (selectedNode.nodeName.toLowerCase() == 'button') && editor.dom.hasClass(selectedNode, 'js-fr-dialogmodal-open');
		var id = '', text = '', title = '', dialog = '', close = '';

		if (isDialog) {
			id = editor.dom.getAttrib(selectedNode, 'aria-controls');
			text = selectedNode.innerHTML;
			var child = editor.getDoc().getElementById(id).firstChild.firstChild;

			var titleNode = child.firstChild;
			if (titleNode.nodeName.toLowerCase() === 'h2') {
				title = titleNode.innerHTML;
				titleNode.parentNode.removeChild(titleNode);
			}
			var closeNode = child.lastChild;
			if (closeNode.nodeName.toLowerCase() === 'button') {
				close = closeNode.innerHTML;
				closeNode.parentNode.removeChild(closeNode);
			}
	    	dialog = child.innerHTML;
		}
		else
		{
			id = 'dialog-' + uuid.v4();
			text = editor.selection.getContent();
		}

		editor.windowManager.open({
			title: 'Dialog',
			body: [
				{type: 'textbox', name: 'id',     minWidth: 400, label: 'ID',     value: id,     disabled: true},
				{type: 'textbox', name: 'text',   minWidth: 400, label: 'Apri',   value: text},
				{type: 'textbox', name: 'title',  minWidth: 400, label: 'Titolo', value: title},
				{type: 'textbox', name: 'dialog', minWidth: 400, label: 'Testo',  value: dialog, minHeight: 80, multiline: true},
				{type: 'textbox', name: 'close',  minWidth: 400, label: 'Chiudi', value: close},
				],
			onsubmit: function(e) {
				var id         = e.data.id,
					text       = e.data.text,
					title      = e.data.title,
					dialog     = e.data.dialog,
					close      = e.data.close,
					dialogNode =
						'<div class="Dialog-content Dialog-content--centered u-background-white u-layout-prose u-margin-all-xl u-padding-all-xl js-fr-dialogmodal-modal" ' +
						'aria-labelledby="modal-title-' + id + '">' +
				        '<div role="document" class="Prose">' +
				        '<h2 class="u-cf u-text-h2 u-borderHideFocus" id="modal-title-' + id + '" tabindex="0">' + title + '</h2>' +
				        dialog +
				        (close ? '<button class="Button Button--danger js-fr-dialogmodal-close u-floatRight">' + close + '</button>' : '') +
				        '</div>' +
				        '</div>';
				if (isDialog) {
					selectedNode.setAttribute('aria-controls', id);
					selectedNode.innerHTML = text;
					editor.getDoc().getElementById(id).innerHTML = dialogNode;
				} else {
					var node =
						'<button class="Button Button--default js-fr-dialogmodal-open" aria-controls="' + id + '">' +
						text +
						'</button>' +
						'<div class="Dialog js-fr-dialogmodal" id="' + id + '">' +
						dialogNode +
						'</div>';
					editor.selection.setContent(node);
				}
			}
		});
	};

	menuItems.push({
		icon: 'none icon-out-2',
		text: 'Dialog',
		context: 'insert',
		onclick: showDialogDialog
	});

    editor.addButton('ipa-dialog', {
    	text: null,
    	icon: 'none icon-out-2',
        tooltip: 'Dialog',
		onclick: showDialogDialog,
		stateSelector: 'button.js-fr-dialogmodal-open'
    });


    /** Alert */

	function insertAlert(format) {
		var selectedNode = editor.dom.getParent(editor.selection.getNode(), 'div.Alert') || editor.selection.getNode(),
			isAlert      = editor.dom.hasClass(selectedNode, 'Alert'),
			titles       = {
								error:   'Si &egrave; verificato un errore',
								warning: 'Attenzione',
								success: 'Operazione effettuata con successo',
								info:    'Ulteriori informazioni'
							},
			text         = editor.selection.getContent() || format.charAt(0).toUpperCase() + format.slice(1),
			title        = titles[format];
			node         = editor.dom.create('div', {
								'role':  'alert',
								'class': 'Prose Alert Alert--' + format +' Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom'
							});

		if (isAlert)
		{
			node.innerHTML = selectedNode.innerHTML;
			selectedNode.parentNode.replaceChild(node, selectedNode);
		}
		else
		{
			node.innerHTML =
				'<h2 class="u-text-h3">' + title + '</h2>' +
				'<p class="u-text-p">' + text + '</p>';
			editor.selection.setContent(node.outerHTML);
		}
	}

	var menuAlerts = [], lastAlert, defaultAlert;

	tinymce.each([
		"error",
		"warning",
		"success",
		"info"
	], function(format) {
		if (!defaultAlert) {
			defaultAlert = format;
		}

		menuAlerts.push({
			icon: 'none icon-' + format,
			text: format.charAt(0).toUpperCase() + format.slice(1),
			context: 'insert',
			onclick: function() {
				lastAlert = format;
				insertAlert(format);
			}
		});
	});

	editor.addButton('ipa-alert', {
		icon: 'none icon-alert',
		type: 'splitbutton',
		title: 'Alert',
		onclick: function() {
			insertAlert(lastAlert || defaultAlert);
		},
		menu: menuAlerts,
		stateSelector: 'div.Alert'
	});

	menuItems.push({
		icon: 'none icon-alert',
		text: 'Alert',
		menu: menuAlerts
	});


	/** Callout */

	function insertCallout(format) {
		var selectedNode = editor.dom.getParent(editor.selection.getNode(), 'div.Callout') || editor.selection.getNode(),
			isCallout    = editor.dom.hasClass(selectedNode, 'Callout'),
			titles       = {
								must:    'Must',
								should:  'Should',
								could:   'Could',
								example: 'Example'
							},
			text         = editor.selection.getContent() || format.charAt(0).toUpperCase() + format.slice(1),
			title        = titles[format];
			node         = editor.dom.create('div', {
								'role':  'note',
								'class': 'Callout Callout--' + format +' u-text-r-xs'
							});

		if (isCallout)
		{
			node.innerHTML = selectedNode.innerHTML;
			selectedNode.parentNode.replaceChild(node, selectedNode);
		}
		else
		{
			node.innerHTML =
				'<h2 class="Callout-title u-text-r-l">' + title + '</h2>' +
				'<p class="u-layout-prose u-color-grey-90 u-text-p u-padding-r-all">' + text + '</p>';
			editor.selection.setContent(node.outerHTML);
		}
	}

	var menuCallouts = [], lastCallout, defaultCallout;

	tinymce.each([
		"must",
		"should",
		"could",
		"example"
	], function(format) {
		if (!defaultCallout) {
			defaultCallout = format;
		}

		menuCallouts.push({
			icon: 'none icon-' + format,
			text: format.charAt(0).toUpperCase() + format.slice(1),
			context: 'insert',
			onclick: function() {
				lastCallout = format;
				insertCallout(format);
			},
		});
	});

	editor.addButton('ipa-callout', {
		icon: 'none icon-callout',
		type: 'splitbutton',
		title: 'Callout',
		onclick: function() {
			insertCallout(lastCallout || defaultCallout);
		},
		menu: menuCallouts,
		stateSelector: 'div.Callout'
	});

	menuItems.push({
		icon: 'none icon-callout',
		text: 'Callout',
		menu: menuCallouts
	});


	/** definition list */

	var dlMenuItems;

	var hasPlugin = function (editor, plugin) {
		var plugins = editor.settings.plugins ? editor.settings.plugins : '';
		return tinymce.util.Tools.inArray(plugins.split(/[ ,]/), plugin) !== -1;
	};

	function isChildOfBody(elm) {
		return editor.$.contains(editor.getBody(), elm);
	}

	function isListNode(node) {
		return node && (/^(OL|UL|DL)$/).test(node.nodeName) && isChildOfBody(node);
	}

	function handleDisabledState(ctrl, selector) {
		function bindStateListener() {
			var selectedElm, selectedCells, state;

			selectedCells = editor.dom.select('dt[data-mce-selected]');
			selectedElm = selectedCells[0];
			if (!selectedElm) {
				selectedElm = editor.selection.getStart();
			}

			state = !editor.dom.getParent(selectedElm, selector);
			ctrl.disabled(state);

			editor.selection.selectorChanged(selector, function(state) {
				ctrl.disabled(!state);
			});
		}

		if (editor.initialized) {
			bindStateListener();
		} else {
			editor.on('init', bindStateListener);
		}
	}

	function handleDisabledAccordionState(ctrl, selector) {
		function bindStateListener() {
			var selectedElm, state, active;

			selectedElm = editor.selection.getStart();

			parent = editor.dom.getParent(selectedElm, selector);
			
			state = !parent;
			ctrl.disabled(state);

			active = isMulti(parent);
			ctrl.active(!state && active);
			
			editor.selection.selectorChanged(selector, function(state) {
				selectedElm = editor.selection.getStart();

				parent = editor.dom.getParent(selectedElm, selector);
				
				state = !parent;
				ctrl.disabled(state);

				active = isMulti(parent);				
				ctrl.active(!state && active);
			});
		}

		if (editor.initialized) {
			bindStateListener();
		} else {
			editor.on('init', bindStateListener);
		}
	}

	function postRenderOpen() {
		/*jshint validthis:true*/
		handleDisabledState(this, 'dl.Accordion>dt:not([aria-selected=true])');
	}

	function postRenderClose() {
		/*jshint validthis:true*/
		handleDisabledState(this, 'dl.Accordion>dt[aria-selected=true]');
	}

	function postRenderMulti() {
		/*jshint validthis:true*/
		handleDisabledAccordionState(this, 'dl.Accordion');
	}

	function isAccordion(elm) {
		return elm && elm.nodeName === 'DL' && editor.dom.hasClass(elm, 'Accordion');
	}

	function hasAccordions(elements) {
		return tinymce.util.Tools.grep(elements, isAccordion).length > 0;
	}

	function isMulti(elm) {
		var multi;	
		if (elm && elm.nodeName === 'DL' && editor.dom.hasClass(elm, 'Accordion')) {
			if (!elm.hasAttribute('aria-multiselectable')) {
				multi = true;
			} else {
				multi = elm.getAttribute('aria-multiselectable') !== 'false';
			}
		} else {
			multi = false;
		}
		return multi;
	}

	function buildMenuItems(listName, styleValues) {
		var items = [];
		if (styleValues) {
			tinymce.util.Tools.each(styleValues.split(/[ ,]/), function (styleValue) {
				items.push({
					text: styleValue.replace(/\-/g, ' ').replace(/\b\w/g, function (chr) {
						return chr.toUpperCase();
					}),
					data: styleValue == 'default' ? '' : styleValue
				});
			});
			items.push({
				text: '-'
			});
			items.push({
				text: 'Multi',
		    	onclick: function () {
		    		var ctrl = this;
					editor.undoManager.transact(function () {
						var list, dom = editor.dom, sel = editor.selection;
						// Check for existing term element
						list = dom.getParent(sel.getNode(), 'dl');
						if (list && list.nodeName == 'DL') {
							if (!list.hasAttribute('aria-multiselectable')) {
								list.setAttribute('aria-multiselectable', 'false');
								ctrl.active(false);
							} else if (list.getAttribute('aria-multiselectable') === 'false') {
								list.removeAttribute('aria-multiselectable');
								ctrl.active(true);
							} else {
								list.setAttribute('aria-multiselectable', 'false');
								ctrl.active(false);
							}
						}
					});
		    	},
		    	selectable: true,
		    	onpostrender: postRenderMulti
			});
			items.push({
				text: '-'
			});
			items.push({
				icon: 'none icon-arrow-up',
				text: 'Open',
		    	onclick: function () {
					editor.undoManager.transact(function () {
						var term, dom = editor.dom, sel = editor.selection;
						// Check for existing term element
						term = dom.getParent(sel.getNode(), 'dt');
						if (term && term.nodeName == 'DT') {
							dom.setAttrib(term, 'aria-selected', 'true');
							dom.setAttrib(term, 'aria-expanded', 'true');
						}
					});
		    	},
		    	onpostrender: postRenderOpen
			});
			items.push({
				icon: 'none icon-arrow-down',
				text: 'Close',
		    	onclick: function () {
					editor.undoManager.transact(function () {
						var term, dom = editor.dom, sel = editor.selection;
						// Check for existing term element
						term = dom.getParent(sel.getNode(), 'dt');
						if (term && term.nodeName == 'DT') {
							dom.setAttrib(term, 'aria-selected', '');
							dom.setAttrib(term, 'aria-expanded', '');
						}
					});
		    	},
		    	onpostrender: postRenderClose
			});
		}
		return items;
	}

	var default_deflist_styles = 'default,Accordion,Accordion--default,Accordion--plus,Timeline';

	dlMenuItems = buildMenuItems('DL', editor.getParam('deflist_styles', default_deflist_styles));

	function applyListFormat(listName, styleValue) {
		if (styleValue == null) return;
		editor.undoManager.transact(function () {
			var list, dom = editor.dom, sel = editor.selection;

			// Check for existing list element
			list = dom.getParent(sel.getNode(), 'dl');

			// Switch/add list type if needed
			if (!list || list.nodeName != listName || styleValue === false) {
				editor.execCommand('InsertDefinitionList', false, null);
			}
			list = dom.getParent(sel.getNode(), 'dl');
			if (list) {
				tinymce.util.Tools.each(dom.select('dl', list).concat([list]), function (list) {
					if (list.nodeName !== listName && styleValue !== false) {
						list = dom.rename(list, listName);
					}

					tinymce.util.Tools.each(editor.getParam('deflist_styles', default_deflist_styles).split(/[ ,]/), function (styleValue) {
						dom.removeClass(list, styleValue);
					});
					if ((styleValue == 'Accordion--default') || (styleValue == 'Accordion--plus'))
					{
						dom.addClass(list, 'Accordion');
					}
					if (styleValue !== '')
					{
						dom.addClass(list, styleValue);
					}
				});
			}

			editor.focus();
		});
	}

	function updateSelection(e) {
		var dom = editor.dom, items = [],
			list = dom.getParent(editor.selection.getNode(), 'dl');

		tinymce.util.Tools.each(default_deflist_styles.split(/[ ,]/), function (styleValue) {
			items.push(styleValue.replace(/\-/g, ' ').replace(/\b\w/g, function (chr) {
				return chr.toUpperCase();
			}));
		});
		if (list) {
			var active_ctrl = null;
			e.control.items().each(function (ctrl) {
				if (tinymce.util.Tools.inArray(items, ctrl.settings.text) !== -1) {
					ctrl.active(false);
					if (dom.hasClass(list, ctrl.settings.data)) {
						active_ctrl = ctrl;
					}
				}
				if (ctrl.settings.data == '') {
					active_ctrl = active_ctrl || ctrl;
				}
			});
			active_ctrl.active(true);
		}
	}

	var listState = function (listName) {
		return function () {
			var self = this;

			editor.on('NodeChange', function (e) {
				var lists = tinymce.util.Tools.grep(e.parents, isListNode);
				self.active(lists.length > 0 && lists[0].nodeName === listName);
			});
		};
	};

	if (hasPlugin(editor, "lists")) {
		editor.addCommand('ApplyDefinitionListStyle', function (ui, value) {
			applyListFormat('DL', false);
		});

		editor.addButton('ipa-deflist', {
			type: (dlMenuItems.length > 0) ? 'splitbutton' : 'button',
			tooltip: 'Definition list',
			icon: 'none icon-list-2',
			menu: dlMenuItems,
			onPostRender: listState('DL'),
			onshow: updateSelection,
			onselect: function (e) {
				applyListFormat('DL', e.control.settings.data);
			},
			onclick: function () {
				applyListFormat('DL', false);
			}
		});

		editor.on('keyup', function (e) {
			if (e.keyCode == 13) {
				// consecutive enter keys will split definition lists
				var item, dom = editor.dom, sel = editor.selection;
				item = dom.getParent(sel.getNode(), 'dt,dd');
				if (item) {
					if (item.nodeName == 'DT') {
						dom.rename(item, 'dd');
					} else if (item.nodeName == 'DD') {
						dom.rename(item, 'dt');
					}
				}
			}
		});
	}

	menuItems.push({
		icon: 'none icon-list-2',
//		type: (dlMenuItems.length > 0) ? 'splitbutton' : 'button',
		text: 'DL',
		title: 'Definition list',
		onselect: function (e) {
			applyListFormat('DL', e.control.settings.data);
		},
		onclick: function () {
			applyListFormat('DL', false);
		},
		onPostRender: listState('DL'),
		onshow: updateSelection,
		menu: dlMenuItems
	});
/*
	menuItems.push({
		icon: 'none icon-callout',
		text: 'Callout',
		context: 'insert',
		onclick: function() {
			insertCallout(lastCallout || defaultCallout);
		},
		menu: menuCallouts
	});
*/

	/** menu */

	editor.addMenuItem('ipa', {
		icon: 'none icon-ipa',
		text: 'ItaliaPA',
		menu: menuItems,
		context: 'insert'
	});

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
			tinyMCE.activeEditor.selection.setContent('<pre class=\"u-textPreformatted u-textOverflow language-markup\"><code class=\"u-text-r-xxs\">'+((text = tinyMCE.activeEditor.selection.getContent()) ? text : 'Codice')+'</code></pre>');
    	}
    });

	editor.on('init', function() {
		var alignElements = 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table';

	    editor.settings.inline_styles = false;
		editor.settings.table_default_attributes = {'class': 'Table Table--withBorder u-text-r-xs'};

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
			// custom_format: { block: 'h1', attributes: { title: 'Header' }, styles: { color: 'red' } }
		});
	});
});

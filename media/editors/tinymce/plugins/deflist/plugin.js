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

/**
 * This class contains all core logic for the deflist plugin.
 *
 * @class tinymce.plugins.deflist.Plugin
 * @private
 */

tinymce.PluginManager.add('deflist', function (editor, url) {
	editor.contentCSS.push(url + '/deflist.css');

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

	function handleDisabledState(ctrl, selector, sameParts) {
		function bindStateListener() {
			var selectedElm, selectedCells, parts = {}, sum = 0, state;

			selectedCells = editor.dom.select('dt[data-mce-selected]');
			selectedElm = selectedCells[0];
			if (!selectedElm) {
				selectedElm = editor.selection.getStart();
			}

			// Make sure that we don't have a selection inside thead and tbody at the same time
			if (sameParts && selectedCells.length > 0) {
				each(selectedCells, function(cell) {
					return parts[cell.parentNode.parentNode.nodeName] = 1;
				});

				each(parts, function(value) {
					sum += value;
				});

				state = sum !== 1;
			} else {
				state = !editor.dom.getParent(selectedElm, selector);
			}

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
	
	function postRenderOpen() {
		/*jshint validthis:true*/
		handleDisabledState(this, 'dl.Accordion>dt:not([aria-selected=true])');
	}

	function postRenderClose() {
		/*jshint validthis:true*/
		handleDisabledState(this, 'dl.Accordion>dt[aria-selected=true]');
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
				icon: 'none icon-arrow-up',
				text: 'Open',
		    	onclick: function () {
					editor.undoManager.transact(function () {
						var term, dom = editor.dom, sel = editor.selection;
						// Check for existing term element
						term = dom.getParent(sel.getNode(), 'dt');
						if (term && term.nodeName == 'DT') {
							dom.setAttrib(term, 'aria-selected', 'true');
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
					dom.addClass(list, styleValue);
				});
			}

			editor.focus();
		});
	}

	function updateSelection(e) {
		var dom = editor.dom,
			list = dom.getParent(editor.selection.getNode(), 'dl');
		if (list) {
			var active_ctrl = null;
			e.control.items().each(function (ctrl) {
				ctrl.active(false);
				if (ctrl.settings.data) {
					if (dom.hasClass(list, ctrl.settings.data)) {
						active_ctrl = ctrl;
					}
				} else if (!active_ctrl) {
					active_ctrl = ctrl;					
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

		editor.addButton('deflist', {
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
});
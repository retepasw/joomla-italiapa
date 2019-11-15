<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('JPATH_PLATFORM') or die();

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

/**
 * Utility class for Webtoolkit elements.
 *
 * @since 3.8
 */
abstract class JHtmlIwt
{

	/**
	 *
	 * @var array Array containing information for loaded files
	 * @since 3.8
	 */
	protected static $loaded = array();

	/**
	 * Add javascript support for Webtoolkit accordians and insert the accordian
	 *
	 * @param string $selector
	 *        	The ID selector for the tooltip.
	 * @param array $params
	 *        	An array of options for the tooltip.
	 *        	Options for the tooltip can be:
	 *        	- parent selector If selector then all collapsible elements
	 *        	under the specified parent will be closed when this
	 *        	collapsible item is shown. (similar to traditional accordion
	 *        	behavior)
	 *        	- toggle boolean Toggles the collapsible element on invocation
	 *        	- active string Sets the active slide during load
	 *
	 *        	- onShow function This event fires immediately when the show
	 *        	instance method is called.
	 *        	- onShown function This event is fired when a collapse element
	 *        	has been made visible to the user
	 *        	(will wait for css transitions to complete).
	 *        	- onHide function This event is fired immediately when the
	 *        	hide method has been called.
	 *        	- onHidden function This event is fired when a collapse
	 *        	element has been hidden from the user
	 *        	(will wait for css transitions to complete).
	 *
	 * @return string HTML for the accordian
	 *
	 * @since 3.8
	 */
	public static function startAccordion ($selector = 'myAccordian', $params = array())
	{
		if (! isset(static::$loaded[__METHOD__][$selector]))
		{
			$opt['active'] = (string) $params['active'];

			if ($opt['active'])
			{
				// Build the script.
				$script = array();
				$script[] = "jQuery(document).ready(function() {";
				$script[] = "	jQuery('#accordion-header-" . $opt['active'] . "').attr('aria-selected','true');";
				$script[] = "	jQuery('#accordion-header-" . $opt['active'] . "').attr('aria-expanded','true');";
				$script[] = "	jQuery('#accordion-panel-" . $opt['active'] . "').attr('aria-hidden','false');";
				$script[] = "	jQuery('#accordion-panel-" . $opt['active'] . "').attr('style','');";
				$script[] = "});";

				// Attach accordion to document
				JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
			}

			// Set static array
			static::$loaded[__METHOD__][$selector] = $opt;

			return '<div class="Accordion Accordion--default fr-accordion js-fr-accordion" id="accordion-' . $selector . '" role="tablist"' . ($params['multiselectable'] ? ' aria-multiselectable="' . $params['multiselectable'] . '"': '') . '>';
		}
	}

	/**
	 * Close the current accordion
	 *
	 * @return string HTML to close the accordian
	 *
	 * @since 3.8
	 */
	public static function endAccordion ()
	{
		return '</div>';
	}

	/**
	 * Begins the display of a new accordion slide.
	 *
	 * @param string $selector
	 *        	Identifier of the accordion group.
	 * @param string $text
	 *        	Text to display.
	 * @param string $id
	 *        	Identifier of the slide.
	 * @param string $class
	 *        	Class of the accordion group.
	 *
	 * @return string HTML to add the slide
	 *
	 * @since 3.8
	 */
	public static function addSlide ($selector, $text, $id, $class = '')
	{
		$html = '<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-' . $id . '"' . '>' .
				 '<span class="Accordion-link">' . $text . '</span>' . '</h2>' . '<div id="accordion-panel-' . $id . '"' .
				 ' class="Accordion-panel fr-accordion__panel js-fr-accordion__panel' . (! empty($class) ? ' ' . $class : '') . '"' .
				 ' role="tabpanel"' . '>';

		return $html;
	}

	/**
	 * Close the current slide
	 *
	 * @return string HTML to close the slide
	 *
	 * @since 3.8
	 */
	public static function endSlide ()
	{
		return '</div>';
	}

	/**
	 * Creates a tab pane
	 *
	 * @param string $selector
	 *        	The pane identifier.
	 * @param array $params
	 *        	The parameters for the pane
	 *
	 * @return string
	 *
	 * @since 3.8
	 */
	public static function startTabSet ($selector = 'myTab', $params = array())
	{
		if (! isset(static::$loaded[__METHOD__][$selector]))
		{
			$opt['active'] = (string) $params['active'];

			// Set static array
			static::$loaded[__METHOD__][$selector] = $opt;

			// Inject tab into UL
			JFactory::getDocument()->addScriptDeclaration(
				'jQuery(function($){
	    	    $(' . json_encode('#accordion-' . $selector . ' button.fr-accordion__header') . ').each(function( index, element ) {
	            $(' . json_encode('#accordion-' . $selector . ' div') . ').first().before( this );
	    	    });
	        });');

			return '<div class="fr-accordion js-fr-accordion" id="accordion-' . $selector . '" role="tablist" aria-multiselectable="false">';
		}
	}

	/**
	 * Close the current tab pane
	 *
	 * @return string HTML to close the pane
	 *
	 * @since 3.8
	 */
	public static function endTabSet ()
	{
		return '</div>';
	}

	/**
	 * Begins the display of a new tab.
	 *
	 * @param string $selector
	 *        	Identifier of the accordion group.
	 * @param string $text
	 *        	Text to display.
	 * @param string $id
	 *        	Identifier of the slide.
	 *
	 * @return string HTML to start a new panel
	 *
	 * @since 3.8
	 */
	public static function addTab ($selector, $text, $id)
	{
		return '<button type="button"' . ((static::$loaded[__CLASS__ . '::startTabSet'][$selector]['active'] == $id) ? ' aria-selected="true" aria-expanded="true"' : '') .
				 ' class="Button Button--info u-text-r-xs' . ' js-fr-accordion__header fr-accordion__header" id="accordion-header-' . $id . '"' .
				 ' role="tab">' . $text . '</button>';
	}

	/**
	 * Begins the display of a new tab content panel.
	 *
	 * @param string $selector
	 *        	Identifier of the accordion group.
	 * @param string $text
	 *        	Text to display.
	 * @param string $id
	 *        	Identifier of the slide.
	 *
	 * @return string HTML to start a new panel
	 *
	 * @since 3.8
	 */
	public static function startTabPanel ($selector, $id)
	{
		return '<div id="accordion-panel-' . $id . '"' .
				((static::$loaded[__CLASS__ . '::startTabSet'][$selector]['active'] == $id) ? ' aria-hidden="false"' : '') .
				' class="Accordion-panel fr-accordion__panel js-fr-accordion__panel"' . ' role="tabpanel"' . '>';
	}

	/**
	 * Close the current tab content panel
	 *
	 * @return string HTML to close the pane
	 *
	 * @since 3.8
	 */
	public static function endTabPanel ()
	{
		return '</div>';
	}

	/**
	 * Get link attributes
	 *
	 * @param unknown $item
	 * @param array $attributes
	 * @return array
	 */
	public static function getLinkAttributes ($item, $attributes = array())
	{
		JLog::add(new JLogEntry(__METHOD__, JLog::DEBUG, 'tpl_italiapa'));
		if ($item->anchor_title)
		{
			JLog::add(new JLogEntry('anchor_title: ' . $item->anchor_title, JLog::DEBUG, 'tpl_italiapa'));
			JLog::add(new JLogEntry('anchor_css: ' . $item->anchor_css, JLog::DEBUG, 'tpl_italiapa'));

			if (preg_match_all('/(^|\s)hasPopover($|\s)/', $item->anchor_css, $matches, PREG_SET_ORDER, 0))
			{
				JHtml::_('bootstrap.popover');
				$attributes['title'] = $item->title;
				$attributes['data-content'] = $item->anchor_title;
			}
			else
			{
				$attributes['title'] = $item->anchor_title;
			}
		}

		if ($item->anchor_css)
		{
			$anchor_css = explode(' ', $item->anchor_css);
			for($i = count($anchor_css) - 1; $i >= 0; $i--)
			{
				if (substr($anchor_css[$i], 0, 4) == 'ipa:')
				{
					if (substr($anchor_css[$i], 4, 14) == 'aria-controls:')
					{
						$attributes['aria-controls'] = substr($anchor_css[$i], 18);
					}
					unset($anchor_css[$i]);
				}
			}
			$anchor_css = implode(' ', $anchor_css);

			if ($anchor_css)
			{
				$attributes['class'] = trim($anchor_css);
			}
		}

		if ($item->anchor_rel)
		{
			$attributes['rel'] = $item->anchor_rel;
		}
		
		return $attributes;
	}

	/**
	 *
	 * @param unknown $item
	 * @return string
	 */
	public static function linkType ($item)
	{
		if ($item->menu_image)
		{
			if ($item->menu_image_css)
			{
				if (preg_match_all('/(^|\s)Icon-/', $item->menu_image_css, $matches, PREG_SET_ORDER, 0))
				{
					$link = '<span class="' . $item->menu_image_css . '"></span>' . JHtml::_('image', $item->menu_image, $item->anchor_title) .
							 '</span>';
					unset($item->menu_image_css);
				}
				else
				{
					$link = JHtml::_('image', $item->menu_image, $item->anchor_title, array(
							'class' => $item->menu_image_css
					));
				}
			}
			else
			{
				$link = JHtml::_('image', $item->menu_image, $item->anchor_title);
			}

			$link .= '<span class="' . $item->menu_title_css . ($item->params->get('menu_text', 1) ? ' image-title' : ' u-hiddenVisually') . '">' . $item->title . '</span>';
		}
		elseif (! $item->menu_image_css)
		{
			$link = $item->title;
		}
		elseif (preg_match_all('/(^|\s)Icon-/', $item->menu_image_css, $matches, PREG_SET_ORDER, 0) || preg_match_all('/(^|\s)it-/', $item->menu_image_css, $matches, PREG_SET_ORDER, 0))
		{
			$icon = '';
			$svg = '';
			$menu_image_css = explode(' ', $item->menu_image_css);
			for ($i = count($menu_image_css) - 1; $i >= 0; $i --)
			{
				if (substr($menu_image_css[$i], 0, 5) == 'Icon-')
				{
					if (file_exists(JPATH_SITE . '/templates/italiapa/src/icons/img/SVG/' . substr($menu_image_css[$i], 5) . '.svg'))
					{
						$svg = $menu_image_css[$i];
					}
					else
					{
						$icon .= ' ' . $menu_image_css[$i];
					}
					unset($menu_image_css[$i]);
				}
				elseif (substr($menu_image_css[$i], 0, 3) == 'it-')
				{
					if (file_exists(JPATH_SITE . '/templates/italiapa/src/icons/img/SVG/' . $menu_image_css[$i] . '.svg'))
					{
						$svg = 'Icon-' . $menu_image_css[$i];
					}
					else
					{
						$icon .= ' ' . $menu_image_css[$i];
					}
					unset($menu_image_css[$i]);
				}
			}
			$item->menu_image_css = implode(' ', $menu_image_css);

			$class = trim($icon . ' ' . $item->menu_image_css);
			if ($svg)
			{
				$link = '<span class="' . trim($svg) . '"><svg' . ($class ? ' class="' . $class . '"' : '') . '><use xlink:href="#' . trim($svg) . '"></use></svg></span>';
			}
			elseif ($icon)
			{
				$link = '<span class="' . $class . '"></span>';
			}

			$link .= '<span class="' . $item->menu_title_css . ($item->params->get('menu_text', 1) ? ' image-title' : ' u-hiddenVisually') . '">' . $item->title . '</span>';
		}
		elseif ($item->menu_title_css)
		{
			$link = '<span class="' . $item->menu_title_css . '">' . $item->title . '</span>'; 
		}
		else
		{
			$link = $item->title;
		}

		$anchor_css = explode(' ', $item->anchor_css);
		for ($i = count($anchor_css) - 1; $i >= 0; $i --)
		{
			if ($anchor_css[$i] == 'del')
			{
				$link = '<del>' . $link . '</del>';
				unset($anchor_css[$i]);
			}
		}
		$item->anchor_css = implode(' ', $anchor_css);
		
		return $link;
	}

	/**
	 * Simple JavaScript email cloaker
	 *
	 * By default replaces an email with a mailto link with email cloaked
	 *
	 * @param   string   $mail    The -mail address to cloak.
	 * @param   boolean  $mailto  True if text and mailing address differ
	 * @param   string   $text    Text for the link
	 * @param   boolean  $email   True if text is an email address
	 *
	 * @return  string  The cloaked email.
	 *
	 * @since   3.8.0.12
	 */
	public static function cloak($mail, $mailto = true, $text = '', $email = true)
	{
		// Handle IDN addresses: punycode for href but utf-8 for text displayed.
		if ($mailto && (empty($text) || $email))
		{
			// Use dedicated $text whereas $mail is used as href and must be punycoded.
			$text = JStringPunycode::emailToUTF8($text ?: $mail);
		}
		elseif (!$mailto)
		{
			// In that case we don't use link - so convert $mail back to utf-8.
			$mail = JStringPunycode::emailToUTF8($mail);
		}
		
		// Convert mail
		$mail = static::convertEncoding($mail);
		
		// Random hash
		$rand = md5($mail . mt_rand(1, 100000));
		
		// Split email by @ symbol
		$mail       = explode('@', $mail);
		$mail_parts = explode('.', $mail[1]);
		
		if ($mailto)
		{
			// Special handling when mail text is different from mail address
			if ($text)
			{
				// Convert text - here is the right place
				//				$text = static::convertEncoding($text);
				$text = str_replace('\'', '\\\'', $text);
				
				if ($email)
				{
					// Split email by @ symbol
					$text = explode('@', $text);
					$text_parts = explode('.', $text[1]);
					$tmpScript = "var addy_text" . $rand . " = '" . @$text[0] . "' + '&#64;' + '" . implode("' + '&#46;' + '", @$text_parts)
					. "';";
				}
				else
				{
					$tmpScript = "var addy_text" . $rand . " = '" . $text . "';";
				}
				
				$tmpScript .= "document.getElementById('cloak" . $rand . "').innerHTML += '<a data-tooltip=\'<strong>e-mail: ' + addy" . $rand
				. " + '</strong>\' ' + path + '\'' + prefix + ':' + addy"
						. $rand . " + '\'>' + addy_text" . $rand . " + '<\/a>';";
			}
			else
			{
				$tmpScript = "document.getElementById('cloak" . $rand . "').innerHTML += '<a data-tooltip=\'<strong>e-mail: ' + addy" . $rand
				. " + '</strong>\' ' + path + '\'' + prefix + ':' + addy"
						. $rand . " + '\'>' +addy" . $rand . "+'<\/a>';";
			}
		}
		else
		{
			$tmpScript = "document.getElementById('cloak" . $rand . "').innerHTML += addy" . $rand . ";";
		}
		
		$script       = "
				document.getElementById('cloak" . $rand . "').innerHTML = '';
				var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
				var path = 'hr' + 'ef' + '=';
				var addy" . $rand . " = '" . @$mail[0] . "' + '&#64;';
				addy" . $rand . " = addy" . $rand . " + '" . implode("' + '&#46;' + '", $mail_parts) . "';
				$tmpScript
		";
				
				// TODO: Use inline script for now
				$inlineScript = "<script type='text/javascript'>" . $script . "</script>";
				
				return '<span id="cloak' . $rand . '">' . JText::_('JLIB_HTML_CLOAKING') . '</span>' . $inlineScript;
	}
	
	/**
	 * Convert encoded text
	 *
	 * @param   string  $text  Text to convert
	 *
	 * @return  string  The converted text.
	 *
	 * @since   1.5
	 */
	protected static function convertEncoding($text)
	{
		$text = html_entity_decode($text);
		
		// Replace vowels with character encoding
		$text = str_replace('a', '&#97;', $text);
		$text = str_replace('e', '&#101;', $text);
		$text = str_replace('i', '&#105;', $text);
		$text = str_replace('o', '&#111;', $text);
		$text = str_replace('u', '&#117;', $text);
		$text = htmlentities($text, ENT_QUOTES, 'UTF-8', false);
		
		return $text;
	}
}

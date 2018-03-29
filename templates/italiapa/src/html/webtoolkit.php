<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

/**
 * Utility class for Webtoolkit elements.
 *
 * @since  3.0
 */
abstract class JHtmlWebtoolkit
{
	/**
	 * @var    array  Array containing information for loaded files
	 * @since  3.0
	 */
	protected static $loaded = array();

	/**
	 * Add javascript support for Webtoolkit accordians and insert the accordian
	 *
	 * @param   string  $selector  The ID selector for the tooltip.
	 * @param   array   $params    An array of options for the tooltip.
	 *                             Options for the tooltip can be:
	 *                             - parent  selector  If selector then all collapsible elements under the specified parent will be closed when this
	 *                                                 collapsible item is shown. (similar to traditional accordion behavior)
	 *                             - toggle  boolean   Toggles the collapsible element on invocation
	 *                             - active  string    Sets the active slide during load
	 *
	 *                             - onShow    function  This event fires immediately when the show instance method is called.
	 *                             - onShown   function  This event is fired when a collapse element has been made visible to the user
	 *                                                   (will wait for css transitions to complete).
	 *                             - onHide    function  This event is fired immediately when the hide method has been called.
	 *                             - onHidden  function  This event is fired when a collapse element has been hidden from the user
	 *                                                   (will wait for css transitions to complete).
	 *
	 * @return  string  HTML for the accordian
	 *
	 * @since   3.0
	 */
	public static function startAccordion($selector = 'myAccordian', $params = array())
	{
		if (!isset(static::$loaded[__METHOD__][$selector]))
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

			return '<div class="Accordion Accordion--default fr-accordion js-fr-accordion" id="accordion-' . $selector . '" role="tablist">';
		}
	}

	/**
	 * Close the current accordion
	 *
	 * @return  string  HTML to close the accordian
	 *
	 * @since   3.0
	 */
	public static function endAccordion()
	{
		return '</div>';
	}

	/**
	 * Begins the display of a new accordion slide.
	 *
	 * @param   string  $selector  Identifier of the accordion group.
	 * @param   string  $text      Text to display.
	 * @param   string  $id        Identifier of the slide.
	 * @param   string  $class     Class of the accordion group.
	 *
	 * @return  string  HTML to add the slide
	 *
	 * @since   3.0
	 */
	public static function addSlide($selector, $text, $id, $class = '')
	{
		$html = '<h2 class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-' . $id . '"'
//			. ((static::$loaded[__CLASS__ . '::startAccordion'][$selector]['active'] == $id) ? '' : ' aria-selected="true" aria-expanded="true"')
			. '>'
			. '<span class="Accordion-link">'
			. $text
			. '</span>'
			. '</h2>'
			. '<div id="accordion-panel-' . $id . '"'
			. ' class="Accordion-panel fr-accordion__panel js-fr-accordion__panel' . (!empty($class) ? ' ' . $class : '') . '"'
			. ' role="tabpanel"'
//			. ((static::$loaded[__CLASS__ . '::startAccordion'][$selector]['active'] == $id) ? '' : ' aria-hidden="false"')
			. '>';

		return $html;
	}

	/**
	 * Close the current slide
	 *
	 * @return  string  HTML to close the slide
	 *
	 * @since   3.0
	 */
	public static function endSlide()
	{
		return '</div>';
	}

	/**
	 * Creates a tab pane
	 *
	 * @param   string  $selector  The pane identifier.
	 * @param   array   $params    The parameters for the pane
	 *
	 * @return  string
	 *
	 * @since   3.1
	 */
	public static function startTabSet($selector = 'myTab', $params = array())
	{
	    if (!isset(static::$loaded[__METHOD__][$selector]))
	    {
	        $opt['active'] = (string) $params['active'];

	        // Set static array
	        static::$loaded[__METHOD__][$selector] = $opt;

	        // Inject tab into UL
	        JFactory::getDocument()->addScriptDeclaration('jQuery(function($){
        	    $(' . json_encode('#accordion-' . $selector . ' button.fr-accordion__header') . ').each(function( index, element ) {
                    $(' . json_encode('#accordion-' . $selector . ' div') . ').first().before( this );
        	    });
            });');

	        return '<div class="fr-accordion js-fr-accordion" id="accordion-' . $selector . '" role="tablist">'
//	           . '<ul class="Grid Grid--withGutter nav nav-tabs" id="' . $selector . 'Tabs"></ul>'
//    	       . '<div class="tab-content" id="' . $selector . 'Content">'
                ;
	    }
	}
	
	/**
	 * Close the current tab pane
	 *
	 * @return  string  HTML to close the pane
	 *
	 * @since   3.1
	 */
	public static function endTabSet()
	{
//	    return '</div></div>';
	    return '</div>';
	}
	
	/**
	 * Begins the display of a new tab content panel.
	 *
	 * @param   string  $selector  Identifier of the panel.
	 * @param   string  $id        The ID of the div element
	 * @param   string  $title     The title text for the new UL tab
	 *
	 * @return  string  HTML to start a new panel
	 *
	 * @since   3.1
	 */
	public static function addTab($selector, $id, $title)
	{
	    return '<button type="button"'
	        . ((static::$loaded[__CLASS__ . '::startTabSet'][$selector]['active'] == $id) ? ' aria-selected="true"' : '')
            . ' class="Button Button--default u-text-r-xs'
//            . ((static::$loaded[__CLASS__ . '::startTabSet'][$selector]['active'] == $id) ? ' is-pressed' : '')
            . ' js-fr-accordion__header fr-accordion__header" id="accordion-header-' . $id . '"'
            . '">'
            . $title
            . '</button>'
            . '<div id="accordion-panel-' . $id . '"'
            . ((static::$loaded[__CLASS__ . '::startTabSet'][$selector]['active'] == $id) ? ' aria-hidden="false"' : '')
            . ' class="Accordion-panel fr-accordion__panel js-fr-accordion__panel"'
            . ' role="tabpanel"'
            . '>';
	}

	/**
	 * Close the current tab content panel
	 *
	 * @return  string  HTML to close the pane
	 *
	 * @since   3.1
	 */
	public static function endTab()
	{
	    return '</div>';
	}
}

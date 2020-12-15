<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  System.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugins.System.ItaliaPA  is  a  free  software. This version may have
 * been modified pursuant to the GNU General Public License, and as distributed
 * it includes  or is derivative of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */

defined('JPATH_PLATFORM') or die;

// Make alias of original Form
\Italiapa\Helper\Joomla::makeAlias(JPATH_LIBRARIES . '/cms/html/bootstrap.php', 'JHtmlBootstrap', '_JHtmlBootstrap');

/**
 * Utility class for coverting Bootstrap to Italia Web Toolkit elements. 
 *
 * @since  __DEPLOY_VERSION__
 */
abstract class JHtmlBootstrap extends _JHtmlBootstrap
{
	/**
	 * Method to render a Bootstrap modal
	 *
	 * @param   string  $selector  The ID selector for the modal.
	 * @param   array   $params	An array of options for the modal.
	 *							 Options for the modal can be:
	 *							 - title		string   The modal title
	 *							 - backdrop	 mixed	A boolean select if a modal-backdrop element should be included (default = true)
	 *													 The string 'static' includes a backdrop which doesn't close the modal on click.
	 *							 - keyboard	 boolean  Closes the modal when escape key is pressed (default = true)
	 *							 - closeButton  boolean  Display modal close button (default = true)
	 *							 - animation	boolean  Fade in from the top of the page (default = true)
	 *							 - footer	   string   Optional markup for the modal footer
	 *							 - url		  string   URL of a resource to be inserted as an `<iframe>` inside the modal body
	 *							 - height	   string   height of the `<iframe>` containing the remote resource
	 *							 - width		string   width of the `<iframe>` containing the remote resource
	 * @param   string  $body	  Markup for the modal body. Appended after the `<iframe>` if the URL option is set
	 *
	 * @return  string  HTML markup for a modal
	 *
	 * @since   3.0
	 */
	public static function renderModal($selector = 'modal', $params = array(), $body = '')
	{
		$layoutData = array(
			'selector' => $selector,
			'params'   => $params,
			'body'	 => $body,
		);

		return JLayoutHelper::render('joomla.modal.main', $layoutData);
	}
}

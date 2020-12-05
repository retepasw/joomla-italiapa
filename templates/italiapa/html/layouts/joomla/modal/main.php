<?php
/**
 * @package	 Joomla.Plugins
 * @subpackage  System.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

// Load bootstrap-tooltip-extended plugin for additional tooltip positions in modal
JHtml::_('bootstrap.tooltipExtended');

extract($displayData);

/**
 * Layout variables
 * ------------------
 * @param   string  $selector  Unique DOM identifier for the modal. CSS id without #
 * @param   array   $params    Modal parameters. Default supported parameters:
 *                             - title        string   The modal title
 *                             - backdrop     mixed    A boolean select if a modal-backdrop element should be included (default = true)
 *                                                     The string 'static' includes a backdrop which doesn't close the modal on click.
 *                             - keyboard     boolean  Closes the modal when escape key is pressed (default = true)
 *                             - closeButton  boolean  Display modal close button (default = true)
 *                             - animation    boolean  Fade in from the top of the page (default = true)
 *                             - url          string   URL of a resource to be inserted as an <iframe> inside the modal body
 *                             - height       string   height of the <iframe> containing the remote resource
 *                             - width        string   width of the <iframe> containing the remote resource
 *                             - bodyHeight   int      Optional height of the modal body in viewport units (vh)
 *                             - modalWidth   int      Optional width of the modal in viewport units (vh)
 *                             - footer       string   Optional markup for the modal footer
 * @param   string  $body      Markup for the modal body. Appended after the <iframe> if the URL option is set
 *
 */

$modalClasses = array('Dialog', 'js-fr-dialogmodal');

$modalAttributes = array(
	'tabindex' => '-1',
	'class'    => implode(' ', $modalClasses)
);
?>
<div id="<?php echo $selector; ?>" <?php echo ArrayHelper::toString($modalAttributes); ?>>
	<div class="Dialog-content Dialog-content--centered u-background-white u-layout-prose u-margin-all-xl u-padding-all-xl js-fr-dialogmodal-modal" aria-labelledby="modal-title">
        <div role="document" class="Prose">
			<?php
			// Header
			if (isset($params['title']))
			{
				echo JLayoutHelper::render('joomla.modal.header', $displayData);
			}
		
			// Body
			echo JLayoutHelper::render('joomla.modal.body', $displayData);
		
			// Footer
			if (!isset($params['closeButton']) || isset($params['footer']) || $params['closeButton'])
			{
				echo JLayoutHelper::render('joomla.modal.footer', $displayData);
			}
			?>
		</div>
	</div>
</div>

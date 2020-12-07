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

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

// Make alias of original Form
\Italiapa\Helper\Joomla::makeAlias(JPATH_PLUGINS . '/content/confirmconsent/fields/consentbox.php', 'JFormFieldConsentBox', '_JFormFieldConsentBox');

/**
 * Consentbox Field class for the Confirm Consent Plugin.
 *
 * @since  __DEPLOY_VERSION__
 */
class JFormFieldConsentBox extends _JFormFieldConsentBox
{
	/**
	 * Method to get the field label markup.
	 *
	 * @return  string  The field label markup.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	protected function getLabel()
	{
		if ($this->hidden)
		{
			return '';
		}

		$data = $this->getLayoutData();

		// Forcing the Alias field to display the tip below
		$position = $this->element['name'] == 'alias' ? ' data-placement="bottom" ' : '';

		// When we have an article let's add the modal and make the title clickable
		if ($data['articleid'])
		{
			$attribs['aria-controls'] = 'modal-' . $this->id;
			$attribs['class'] = 'js-fr-dialogmodal-open';

			$data['label'] = HTMLHelper::_(
				'link',
				'#',
				$data['label'],
				$attribs
				);
		}

		// Here mainly for B/C with old layouts. This can be done in the layouts directly
		$extraData = array(
			'text'     => $data['label'],
			'for'      => $this->id,
			'classes'  => explode(' ', $data['labelclass']),
			'position' => $position,
		);

		return $this->getRenderer($this->renderLabelLayout)->render(array_merge($data, $extraData));
	}

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	protected function getInput()
	{
		$modalHtml  = '';
		$layoutData = $this->getLayoutData();

		if ($this->articleid)
		{
			$modalParams['title']  = $layoutData['label'];
			$modalParams['height'] = 800;
			$modalParams['width']  = '100%';

			$article = JTable::getInstance("content");
			$article->load($this->articleid);

			$modalHtml = HTMLHelper::_('bootstrap.renderModal', 'modal-' . $this->id, $modalParams, JHtml::_('content.prepare', $article->get('introtext') . $article->get('fulltext')));
		}

		return $modalHtml . parent::getInput();
	}
}

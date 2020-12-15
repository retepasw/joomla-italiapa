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

// Make alias of original ContentControllerArticle
\Italiapa\Helper\Joomla::makeAlias(JPATH_SITE . '/components/com_content/controllers/article.php', 'ContentControllerArticle', '_ContentControllerArticle');

/**
 * Content article class.
 *
 * @since  __DEPLOY_VERSION__
 */
class ContentControllerArticle extends _ContentControllerArticle
{
	/**
	 * Method to save a record.
	 *
	 * @param   string  $key     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return  boolean  True if successful, false otherwise.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function save($key = null, $urlVar = 'a_id')
	{
		$result    =  JControllerForm::save($key, $urlVar);

		$app       = JFactory::getApplication();
		$articleId = $app->input->getInt('$urlVar');

		// Load the parameters.
		$params   = $app->getParams();
		$menuitem = (int) $params->get('redirect_menuitem');

		if ($this->getTask() != 'apply')
		{
			// Check for redirection after submission when creating a new article only
			if ($menuitem > 0 && $articleId == 0)
			{
				$lang = '';

				if (JLanguageMultilang::isEnabled())
				{
					$item = $app->getMenu()->getItem($menuitem);
					$lang = !is_null($item) && $item->language != '*' ? '&lang=' . $item->language : '';
				}

				// If ok, redirect to the return page.
				if ($result)
				{
					$this->setRedirect(JRoute::_('index.php?Itemid=' . $menuitem . $lang, false));
				}
			}
			else
			{
				// If ok, redirect to the return page.
				if ($result)
				{
					$this->setRedirect(JRoute::_($this->getReturnPage(), false));
				}
			}
		}

		return $result;
	}

	/**
	 * Method to save a vote.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function vote()
	{
		// Check for request forgeries.
		$this->checkToken();

		$user_rating = $this->input->getInt('user_rating', -1);

		if ($user_rating > -1)
		{
			$url = $this->input->getString('url', '');
			$id = $this->input->getInt('id', 0);
			$viewName = $this->input->getString('view', $this->default_view);
			$model = $this->getModel($viewName);

			if ($model->storeVote($id, $user_rating))
			{
				$this->setRedirect($url, JText::_('COM_CONTENT_ARTICLE_VOTE_SUCCESS'));
			}
			else
			{
				$this->setRedirect($url, JText::_('COM_CONTENT_ARTICLE_VOTE_FAILURE'));
			}
		}
	}
}

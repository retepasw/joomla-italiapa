<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.IpaVote
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2020 - 2022 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugin.Content.IpaVote is a free software. This version may have been
 * modified  pursuant to the GNU General Public License,  and as distributed it
 * includes  or  is  derivative  of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */
defined('_JEXEC') or die();

/**
 * Layout variables
 * -----------------
 * 
 * @var string $context The context of the content being passed to the plugin
 * @var object &$row The article object
 * @var object &$params The article params
 * @var integer $page The 'page' number
 * @var array $parts The context segments
 * @var string $path Path to this file
 */

$uri = clone JUri::getInstance();
$uri->setVar('hitcount', '0');

// Create option list for voting select box
$options = array();

?>
<form method="post"
	action="<?php echo htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8'); ?>"
	class="form-inline" name="adminForm" id="content_vote_form">
	<span class="content_vote"> <label class="unseen element-invisible"
		for="content_vote_<?php echo (int) $row->id; ?>"><?php echo JText::_('PLG_CONTENT_IPAVOTE_LABEL'); ?></label>
		<label><?php echo JText::_('PLG_CONTENT_IPAVOTE_HELPFUL_LABEL'); ?></label>
		<input class="btn btn-mini" type="submit" name="submit_vote"
		value="<?php echo JText::_('JYES'); ?>" /> <input class="btn btn-mini"
		type="submit" name="submit_vote"
		value="<?php echo JText::_('JNO'); ?>"
		onclick="document.getElementById('user_rating').value='1';" /> <input
		type="hidden" name="user_rating" id="user_rating" value="5" /> <input
		type="hidden" name="task" value="article.vote" /> <input type="hidden"
		name="hitcount" value="0" /> <input type="hidden" name="url"
		value="<?php echo htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8'); ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</span>
</form>

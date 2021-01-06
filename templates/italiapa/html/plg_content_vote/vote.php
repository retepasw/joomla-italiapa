<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JHtml::_('behavior.core');

/**
 * Layout variables
 * -----------------
 * @var   string   $context  The context of the content being passed to the plugin
 * @var   object   &$row     The article object
 * @var   object   &$params  The article params
 * @var   integer  $page     The 'page' number
 * @var   array    $parts    The context segments
 * @var   string   $path     Path to this file
 */

$uri = clone JUri::getInstance();
$uri->setVar('hitcount', '0');
?>
<style>
	.rating svg.Icon.blank:hover {
	    fill: currentColor;
	}

	.rating > label:hover {
	    cursor: pointer;
	}

	.rating > label:hover svg {
	    -webkit-transform: scale(1.1);
	    transform: scale(1.1);
	}

	.rating svg:hover {
		cursor: pointer;
	}

	.rating svg:hover svg {
		transform: scale(1.1);
	}

	.rating:not(:checked)>label:hover svg,
	.rating:not(:checked)>label:hover~label svg,
	.rating>input:checked+label:hover+svg,
	.rating>input:checked~label svg,
	.rating>input:checked~label:hover+svg,
	.rating>input:checked~label:hover~label+svg,
	.rating>label:hover~input:checked~label+svg {
	    fill: currentColor;
	}
</style>

<form method="post" action="<?php echo htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8'); ?>" class="form-inline rating" name="voteForm" id="voteForm">
	<?php for ($i = 5; $i > 0; $i--): ?>
		<input type="radio" id="content_vote_<?php echo (int) $row->id; ?>_<?php echo $i; ?>" name="user_rating" value="<?php echo $i; ?>"
			onchange="Joomla.submitform('article.vote', document.getElementById('voteForm'), false);"<?php echo $rating == $i ? ' checked' : ''; ?>/>
	<?php endfor; ?>

	<input type="hidden" name="task" value="article.vote" />
	<input type="hidden" name="hitcount" value="0" />
	<input type="hidden" name="url" value="<?php echo htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8'); ?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>

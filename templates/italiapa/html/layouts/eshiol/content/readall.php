<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
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

$params = $displayData['params'];
$lang = JFactory::getLanguage();
?>

<p class="u-textCenter u-text-md-right u-text-lg-right u-margin-r-top">
	<a href="<?php echo $displayData['link']; ?>" class="u-color-50 u-textClean u-text-h4" itemprop="url">
		<?php if ($lang->isRtl()) : ?>
		<span class="Icon Icon-chevron-left"></span>
		<?php endif; ?>
		<?php
		//if (!$params->get('access-view')) :
		//	echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		//else :
			echo JText::_('COM_CONTENT_READ_MORE_TITLE');
		//endif;
		?>
		<?php if (!$lang->isRtl()) : ?>
		<span class="Icon Icon-chevron-right"></span>
		<?php endif; ?>
	</a>
</p>

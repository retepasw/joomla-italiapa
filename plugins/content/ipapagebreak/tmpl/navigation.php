<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  Content.IpaPageBreak
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Plugins.Content.Ipapagebreak  is  a  free  software. This version may
 * have  been  modified  pursuant  to  the  GNU  General Public License, and as
 * distributed  it  includes  or  is derivative of works licensed under the GNU 
 * General Public License or other free or open source software licenses.
 */

defined('_JEXEC') or die();

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'plg_content_ipapagebreak'));
?>
<ul>
	<li>
		<?php if ($links['previous']) : ?>
		<a href="<?php echo $links['previous']; ?>">
			<?php echo trim(str_repeat(JText::_('JGLOBAL_LT'), 2) . ' ' . JText::_('JPREV')); ?>
		</a>
		<?php else: ?>
		<?php echo JText::_('JPREV'); ?>
		<?php endif; ?>
	</li>
	<li>
		<?php if ($links['next']) : ?>
		<a href="<?php echo $links['next']; ?>">
			<?php echo trim(JText::_('JNEXT') . ' ' . str_repeat(JText::_('JGLOBAL_GT'), 2)); ?>
		</a>
		<?php else: ?>
		<?php echo JText::_('JNEXT'); ?>
		<?php endif; ?>
	</li>
</ul>

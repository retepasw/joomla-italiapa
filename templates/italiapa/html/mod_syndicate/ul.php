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

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
?>

<ul class="<?php echo $moduleclass_pfx; ?>syndicate-module<?php echo $moduleclass_sfx; ?>">
	<li>
		<a href="<?php echo $link; ?>">
			<span class="Icon-rss Icon"></span>
			<?php if ($params->get('display_text', 1)) : ?>
				<span<?php echo isset($textclass) && $textclass ? ' class="' . $textclass .  '"' : ''; ?>>
				<?php if (str_replace(' ', '', $text) !== '') : ?>
					<?php echo $text; ?>
				<?php else : ?>
					<?php echo JText::_('MOD_SYNDICATE_DEFAULT_FEED_ENTRIES'); ?>
				<?php endif; ?>
				</span>
			<?php endif; ?>
		</a>
	</li>
</ul>

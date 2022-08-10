<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

if ($module->position == 'socials') :
	$moduleclass_pfx = 'Header-socialIcons ';
	$textclass = 'u-hiddenVisually';
	require 'ul.php';
elseif ($module->position == 'footermenu') :
	$moduleclass_pfx = 'Footer-links ';
	$textclass = '';
	require 'ul.php';
else :
?>
	<a href="<?php echo $link; ?>" class="syndicate-module<?php echo $moduleclass_sfx; ?>">
		<span class="Icon-rss Icon"></span>
		<?php if ($params->get('display_text', 1)) : ?>
			<span>
			<?php if (str_replace(' ', '', $text) !== '') : ?>
				<?php echo $text; ?>
			<?php else : ?>
				<?php echo JText::_('MOD_SYNDICATE_DEFAULT_FEED_ENTRIES'); ?>
			<?php endif; ?>
			</span>
		<?php endif; ?>
	</a>
<?php endif;

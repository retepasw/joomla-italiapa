<?php
/**
 * @package		Templates.ItaliaPA
 * @subpackage	mod_cookiebar
 * @version		3.8.1
 * @since		3.8
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		https://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'mod_cookiebar'));
?>

<div class="cookiebar bg-dark p-4 hide" aria-hidden="true">
    <div class="text-white"><?php echo $module->content; ?></div>
    <div>
        <button data-accept="cookiebar" class="btn btn-info mr-2"><?php echo JText::_('MOD_COOKIEBAR_ACCEPT'); ?></button>
	    <?php if ($item->id) : ?>
        <a href="<?php echo  $item->link; ?>" class="btn btn-warning"><?php echo JText::_('MOD_COOKIEBAR_POLICY'); ?></a>
    	<?php endif; ?>
    </div>
</div>

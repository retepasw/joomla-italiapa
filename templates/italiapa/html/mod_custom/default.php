<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	mod_schemaorg
 * @version		3.8.0
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template Italia PA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$div = '<div class="custom' . $moduleclass_sfx . '"' . ($params->get('backgroundimage') ? 'style="background-image:url(' . $params->get('backgroundimage') . ')"' : '') . '>';
$slash_div = '</div>';
if (($module->position == 'footer') || ($module->position == 'footerinfo'))
{
	$div = $div . '<div class="Footer-subBlock">';
	$slash_div = '</div>' . $slash_div;
}
?>

<?php echo $div . $module->content . $slash_div; ?>

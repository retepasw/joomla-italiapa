<?php
/**
 * @version		3.7.1 modules/mod_schemaorg/mod_schemaorg.php
 *
 * @package		Template Italia PA
 * @subpackage	mod_schemaorg
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template Italia PA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'mod_schemaorg'));

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
require JModuleHelper::getLayoutPath('mod_schemaorg', $params->get('layout', 'default'));

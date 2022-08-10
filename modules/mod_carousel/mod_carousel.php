<?php
/**
 * @package     Joomla.Site
 * @subpackage  Modules.mod_carousel
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        http://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2022 Helios Ciancio. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Joomla.Site.Modules.mod_carousel  is  free  software.  This version may have
 * been modified pursuant to the GNU General Public License, and as distributed
 * it  includes or is derivative of works licensed under the GNU General Public
 * License or other free or open source software licenses.
 */

defined('_JEXEC') or die;

if ($params->get('debug') || defined('JDEBUG') && JDEBUG)
{
	JLog::addLogger(array('text_file' => $params->get('log', 'eshiol.log.php'), 'extension' => 'mod_carousel_file'), JLog::ALL, array('mod_carousel'));
}
JLog::addLogger(array('logger' => (null !== $params->get('logger')) ? $params->get('logger') : 'messagequeue', 'extension' => 'mod_carousel'), JLOG::ALL & ~JLOG::DEBUG, array('mod_carousel'));
if ($params->get('phpconsole') && class_exists('JLogLoggerPhpconsole'))
{
	JLog::addLogger(array('logger' => 'phpconsole', 'extension' => 'mod_carousel_phpconsole'),  JLOG::DEBUG, array('mod_carousel'));
}
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'mod_carousel'));

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

$list = (array) $params->get('images');

$orderby = $params->get('orderby', 'order');
if ($orderby == 'rorder')
{
	$list = array_reverse($list);
}
elseif ($orderby == 'random')
{
	shuffle($list);
}

require JModuleHelper::getLayoutPath('mod_carousel', $params->get('layout', 'default'));

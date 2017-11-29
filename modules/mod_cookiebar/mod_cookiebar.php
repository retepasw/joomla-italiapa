<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	mod_cookiebar
 * @version		3.8
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or or is derivative of works licensed under the GNU General Public License or or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

if ($params->get('debug') || defined('JDEBUG') && JDEBUG)
{
	JLog::addLogger(array('text_file' => $params->get('log', 'eshiol.log.php'), 'extension' => 'tpl_italiapa_file'), JLog::ALL, array('mod_cookiebar'));
}
JLog::addLogger(array('logger' => (null !== $params->get('logger')) ? $params->get('logger') : 'messagequeue', 'extension' => 'mod_cookiebar'), JLOG::ALL & ~JLOG::DEBUG, array('mod_cookiebar'));
if ($params->get('phpconsole') && class_exists('JLogLoggerPhpconsole'))
{
	JLog::addLogger(array('logger' => 'phpconsole', 'extension' => 'mod_cookiebar_phpconsole'),  JLOG::DEBUG, array('mod_cookiebar'));
}
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'mod_cookiebar'));

JLoader::register('ContentHelperRoute', JPATH_ROOT . '/components/com_content/helpers/route.php');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
$text = $params->get('text', JText::_('MOD_COOKIEBAR_FIELD_TEXT_DESC'));

$item = JTable::getInstance('Content', 'JTable');
$item->load($params->get('articleid'));
$item->slug = $item->alias ? ($item->id . ':' . $item->alias) : $item->id;
$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));

require JModuleHelper::getLayoutPath('mod_cookiebar', $params->get('layout', 'default'));

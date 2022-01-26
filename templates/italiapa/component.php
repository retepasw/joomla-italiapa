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

/** @var JDocumentHtml $this */

$app	= JFactory::getApplication();
$params = $app->getTemplate(true)->params;
$min    = '.min';

if ($params->get('debug') || defined('JDEBUG') && JDEBUG)
{
	JLog::addLogger(array('text_file' => $params->get('log', 'eshiol.log.php'), 'extension' => 'tpl_italiapa_file'), JLog::ALL, array('tpl_italiapa'));
}
JLog::addLogger(array('logger' => (null !== $params->get('logger')) ?$params->get('logger') : 'messagequeue', 'extension' => 'tpl_italiapa'), JLOG::ALL & ~JLOG::DEBUG, array('tpl_italiapa'));
if ($params->get('phpconsole') && class_exists('JLogLoggerPhpconsole'))
{
	JLog::addLogger(array('logger' => 'phpconsole', 'extension' => 'tpl_italiapa_phpconsole'),  JLOG::DEBUG, array('tpl_italiapa'));
}

// Force loading of backend global language file
//JFactory::getLanguage()->load('joomla', JPath::clean(JPATH_ADMINISTRATOR), null, false, true);

// Output as HTML5
$this->setHtml5(true);

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'component.css', array('version' => 'auto', 'relative' => true));

$theme_default = $params->get('theme', 'italia');
$theme = (isset($_COOKIE['theme']) && $_COOKIE['theme']) ? $_COOKIE['theme'] : $theme_default;
$theme_path = JPATH_ROOT . '/templates/italiapa/build/build.' . $theme . '.css';

if (!file_exists($theme_path)) {
	$theme = 'italia';
}

JFactory::getSession()->set('theme', $theme);

/** @var JDocumentHtml $this */
$this->baseurl = JURI::root();

JHtml::_('stylesheet', 'templates/italiapa/build/build' . $min . '.css', array('version' => 'auto'));
JHtml::_('stylesheet', 'templates/italiapa/build/build.' . $theme . $min . '.css', array('version' => 'auto'), array('id'=>'theme'));
JHtml::_('stylesheet', 'italiapa' . $min . '.css', array('version' => 'auto', 'relative' => true));

// Load optional rtl Bootstrap css and Bootstrap bugfixes
JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction);
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<jdoc:include type="head" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="contentpane modal<?php echo $this->direction === 'rtl' ? ' rtl' : ''; ?>">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>

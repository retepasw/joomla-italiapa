<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		https://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

$app	= JFactory::getApplication();
$params = $app->getTemplate(true)->params;

if ($params->get('debug') || defined('JDEBUG') && JDEBUG)
{
    JLog::addLogger(array('text_file' => $params->get('log', 'eshiol.log.php'), 'extension' => 'tpl_italiapa_file'), JLog::ALL, array('tpl_italiapa'));
}
JLog::addLogger(array('logger' => (null !== $params->get('logger')) ?$params->get('logger') : 'messagequeue', 'extension' => 'tpl_italiapa'), JLOG::ALL & ~JLOG::DEBUG, array('tpl_italiapa'));
if ($params->get('phpconsole') && class_exists('JLogLoggerPhpconsole'))
{
    JLog::addLogger(array('logger' => 'phpconsole', 'extension' => 'tpl_italiapa_phpconsole'),  JLOG::DEBUG, array('tpl_italiapa'));
}
JLog::add(new JLogEntry('Template ItaliaPA', JLog::DEBUG, 'tpl_italiapa'));

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Check for a custom JS file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js ie89 ie8" lang="<?php echo $this->language; ?>"><![endif]-->
<!--[if IE 9]><html class="no-js ie89 ie9" lang="<?php echo $this->language; ?>"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="<?php echo $this->language; ?>">
<!--<![endif]-->
<head>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php if ($app->get('debug_lang', '0') == '1' || $app->get('debug', '0') == '1') : ?>
		<link href="<?php echo JUri::root(true); ?>/media/cms/css/debug.css" rel="stylesheet" />
	<?php endif; ?>
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
	<!-- include html5shim per Explorer 8 -->
	<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/modernizr.js"></script>

	<script>__PUBLIC_PATH__ = '<?php echo $this->baseurl ?>/templates/italiapa/build/'</script>

	<!-- <link rel="preload" href="<?php echo $this->baseurl ?>/templates/italiapa/build/IWT.min.js" as="script"> -->
	<!--
		In alternativa a WebFontLoader ÃƒÆ’Ã‚Â¨ possibile caricare il font direttamente da Google
		<link href='//fonts.googleapis.com/css?family=Titillium+Web:400,400italic,700,' rel='stylesheet' type='text/css' />
		o dal repository locale (src/fonts)
	-->
	<script type="text/javascript">
		WebFontConfig = {
			google: {
				families: ['Titillium+Web:400,600,700,400italic:latin']
			}
		};
		(function() {
			var wf = document.createElement('script');
			wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})();
	</script>

	<?php $theme = $this->params->get('theme', 'build'); ?>
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/build/<?php echo $theme; ?>.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/css/italiapa.css">

	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/css/tooltip-theme-arrows.css" />
	<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/tether.min.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/drop.min.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/tooltip.min.js"></script>

	<jdoc:include type="head" />
</head>
<body class="t-Pac">
<div id="main">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</div>
<!--[if IE 8]>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/respond.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/rem.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/selectivizr.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/slice.js"></script>
<![endif]-->

<!--[if lte IE 9]>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/polyfill.min.js"></script>
<![endif]-->

<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/IWT.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/italiapa.min.js"></script>

</body>
</html>

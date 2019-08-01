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
$min = '.min';

if ($params->get('debug') || defined('JDEBUG') && JDEBUG)
{
	JLog::addLogger(array('text_file' => $params->get('log', 'eshiol.log.php'), 'extension' => 'tpl_italiapa_file'), JLog::ALL, array('tpl_italiapa'));
	$min = '';
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

$theme_default = $this->params->get('theme', 'italia');
$theme = (isset($_COOKIE['theme']) && $_COOKIE['theme']) ? $_COOKIE['theme'] : $theme_default;
$theme_path = JPATH_ROOT . '/templates/italiapa/build/build.' . $theme . '.css';

if (!file_exists($theme_path)) {
	$theme = 'italia';	
}
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js ie89 ie8" lang="<?php echo $this->language; ?>"><![endif]-->
<!--[if IE 9]><html class="no-js ie89 ie9" lang="<?php echo $this->language; ?>"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js theme-<?php echo $theme; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
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
		In alternativa a WebFontLoader è possibile caricare il font direttamente da Google
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

	<script>__DEFAULT_THEME__ = '<?php echo $theme_default; ?>'</script>
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/build/build.css">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/build/build.<?php echo $theme; ?>.css" id="theme">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/css/italiapa.css">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/css/prism<?php echo $min; ?>.css">
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/css/tooltip-theme-arrows.css" />
	
	<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/tether<?php echo $min; ?>.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/drop<?php echo $min; ?>.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/tooltip<?php echo $min; ?>.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/prism<?php echo $min; ?>.js"></script>

	<jdoc:include type="head" />

	<?php if ($css = $this->params->get('css', '')) : ?>
		<?php  echo '<style>' . htmlspecialchars($css) . '</style>'; ?>
	<?php endif; ?>
</head>
<body class="t-Pac c-hideFocus enhanced">

<?php $svg_path = JPATH_ROOT .'/templates/' . $this->template . '/src/icons/img/SVG'; ?>
<?php if (file_exists($svg_path) && ($icons = array_diff(scandir($svg_path), array('..', '.')))) : ?>
<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
	<defs>
	<?php foreach ($icons as $filename ) : ?>
		<?php $path_parts = pathinfo($filename); ?>
		<?php if ($path_parts['extension'] != 'svg') continue; ?>
		<?php $iconname = $path_parts['filename']; ?>
		<symbol id="Icon-<?php echo $iconname; ?>" viewBox="0 0 32 32">
		<?php $icon = new SimpleXMLElement(file_get_contents(JPATH_ROOT .'/templates/' . $this->template . '/src/icons/img/SVG/' . $iconname . '.svg')); ?>
		<?php echo $icon->title->asXML() . "\r" . $icon->path->asXML()  . "\r"; ?>
		</symbol>
	<?php endforeach; ?>
	</defs>
</svg>
<?php endif; ?>

<?php if ($this->countModules('cookiebar')) : ?>
	<jdoc:include type="modules" name="cookiebar" style="none" />
<?php endif;?>

<?php if ($this->countModules('menu')) : ?>
<ul class="Skiplinks js-fr-bypasslinks u-hiddenPrint">
	<li><a href="#main">Vai al Contenuto</a></li>
	<li><a class="js-fr-offcanvas-open" href="#menu" aria-controls="menu" aria-label="accedi al menu" title="accedi al menu">Vai alla navigazione del sito</a></li>
</ul>
<?php endif;?>

<header class="Header u-hiddenPrint<?php if ($this->params->get('headroom', 0)) echo ' Headroom--fixed js-Headroom Headroom Headroom--top Headroom--not-bottom" style="position: fixed; top: 0px;'; ?>">

<?php if ($this->countModules('owner') || $this->countModules('languages')) : ?>
<div class="Header-banner Headroom-hideme">
	<?php if ($this->countModules('owner')) : ?>
		<div class="Header-owner">
			<jdoc:include type="modules" name="owner" />
		</div>
	<?php endif; ?> 
	<?php if ($this->countModules('languages')) : ?>
		<div class="Header-languages ">
			<jdoc:include type="modules" name="languages" />
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>

<div class="Header-navbar ">

	<div class="u-layout-wide Grid Grid--alignMiddle u-layoutCenter">
		<?php if ($logo = $this->params->get('logo')) : ?>
		<div class="Header-logo Grid-cell" aria-hidden="true">
			<a href="<?php echo $this->baseurl; ?>/" itemprop="url">
				<img src="<?php echo $logo; ?>" alt="<?php echo htmlspecialchars($app->get('sitename')); ?>">
			</a>
		</div>
		<?php endif; ?>

		<div class="Header-title Grid-cell">
			<h1 class="Header-titleLink">
				<a href="<?php echo $this->baseurl; ?>/">
					<?php echo htmlspecialchars($app->get('sitename')); ?>
					<?php if ($subtitle = $this->params->get('subtitle')) : ?>
					<br><small><?php echo $subtitle; ?></small>
					<?php endif; ?>
				</a>
			</h1>
		</div>
	
		<?php if ($this->countModules('search')) : ?>
		<div class="Header-searchTrigger Grid-cell">
			<button aria-controls="header-search" class="js-Header-search-trigger Icon Icon-search" title="attiva il form di ricerca" aria-label="attiva il form di ricerca" aria-hidden="false"></button>
			<button aria-controls="header-search" class="js-Header-search-trigger Icon Icon-close u-hidden" title="disattiva il form di ricerca" aria-label="disattiva il form di ricerca" aria-hidden="true"></button>
		</div>
		<?php endif; ?>
	
		<?php if ($this->countModules('search') + $this->countModules('socials')) : ?>
		<div class="Header-utils Grid-cell">
	
			<?php if ($this->countModules('socials')) : ?>
			<div class="Header-social Headroom-hideme">
			<jdoc:include type="modules" name="socials" />
			</div>
			<?php endif; ?>
	
			<?php if ($this->countModules('search')) : ?>
			<div class="Header-search" id="header-search">
			<jdoc:include type="modules" name="search" style="none" />
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		
		<?php if ($this->countModules('menu')) : ?>
		<div class="Header-toggle Grid-cell">
			<a class="Hamburger-toggleContainer js-fr-offcanvas-open u-nojsDisplayInlineBlock u-lg-hidden u-md-hidden" href="#menu" aria-controls="menu" aria-label="accedi al menu" title="accedi al menu">
				<span class="Hamburger-toggle" role="presentation"></span>
				<span class="Header-toggleText" role="presentation">Menu</span>
			</a>
		</div>
		<?php endif; ?>
	  
	</div>

</div>
<!-- Header-navbar -->

<?php if ($this->countModules('mainmenu')) : ?>
	<jdoc:include type="modules" name="mainmenu" style="lg" />
<?php endif; ?>

</header>

<?php if ($this->countModules('menu')) : ?>
<section class="Offcanvas Offcanvas--left Offcanvas--modal js-fr-offcanvas u-jsVisibilityHidden u-nojsDisplayNone u-hiddenPrint" id="menu">
	<h2 class="u-hiddenVisually">Menu di navigazione</h2>
	<div class="Offcanvas-content u-background-white">
		<div class="Offcanvas-toggleContainer u-background-70 u-jsHidden">
			<a class="Hamburger-toggleContainer u-block u-color-white u-padding-bottom-xxl u-padding-left-s u-padding-top-xxl js-fr-offcanvas-close" aria-controls="menu" aria-label="esci dalla navigazione" title="esci dalla navigazione" href="#">
				<span class="Hamburger-toggle is-active" aria-hidden="true"></span>
			</a>
		</div>

		<jdoc:include type="modules" name="menu" style="lg" />

	</div>
</section>
<?php endif; ?>

<?php if ($this->countModules('top')) : ?>
<div class="u-layout-wide u-layoutCenter u-layout-withGutter u-padding-r-bottom u-padding-r-top">
	<jdoc:include type="modules" name="top" style="lg" />
</div>
<?php endif; ?>

<?php if ($this->countModules('breadcrumb')) : ?>
<div class="u-layout-wide u-layoutCenter u-layout-withGutter u-padding-r-bottom u-padding-r-top">
	<jdoc:include type="modules" name="breadcrumb" style="none" />
</div>
<?php endif; ?>

<div id="main">
	<?php if ($app->input->get('layout', 'default', 'raw') != 'italiapa:heronews') : ?>
	<div class="u-layout-wide u-layoutCenter u-layout-withGutter u-padding-r-top u-padding-bottom-xxl">
	<?php endif; ?>
		<?php if ($this->countModules('right')) : ?>
		<div class="Grid Grid--withGutter">
			<div class="Grid-cell u-md-size8of12 u-lg-size8of12">
		<?php endif; ?>	
				<jdoc:include type="message" />
				<jdoc:include type="component" />
	
		<?php if ($this->countModules('right')) : ?>
			</div>
			<div id="right" class="Grid-cell u-sizeFull u-md-size4of12 u-lg-size4of12">
				<jdoc:include type="modules" name="right" style="lg" />
			</div>
		</div>
		<?php endif; ?>

		<?php $countFooter = $this->countModules('footer') + $this->countModules('footerinfo') + $this->countModules('footermenu'); ?>

		<?php if ($this->countModules('services') || $this->countModules('featured') || $this->countModules('news') || $this->countModules('lead') || $countFooter) : ?>
			<?php if ($this->countModules('services') || $this->countModules('featured')) : ?>
		<a href="#featured" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($this->countModules('news')) : ?>
		<a href="#news" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($this->countModules('lead')) : ?>
		<a href="#lead" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($countFooter) : ?>
		<a href="#footer" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php endif; ?>
			<span class="Icon Icon-expand u-color-grey-40"></span>
			<span class="u-hidden">vai alla sezione successiva</span>
		</a>
		<?php endif; ?>
	
	<?php if ($app->input->get('layout', 'default', 'raw') != 'italiapa:heronews') : ?>
	</div>
	<?php endif; ?>
</div>

<?php if ($this->countModules('services') || $this->countModules('featured')) : ?>
<div class="u-layout-wide u-layoutCenter u-text-r-xl u-layout-r-withGutter u-padding-r-top" id="featured">
	<?php if ($this->countModules('services')) : ?>
	<div class="Grid Grid--equalHeight Grid--withGutterM" id="servizi">
	<jdoc:include type="modules" name="services" style="lg" />
	</div>
	<?php endif; ?>
	<jdoc:include type="modules" name="featured" />
	<?php if ($this->countModules('news') || $this->countModules('lead') || $countFooter) : ?>
	<?php if ($this->countModules('news')) : ?>
	<a href="#news" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
	<?php elseif ($this->countModules('lead')) : ?>
	<a href="#lead" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
	<?php elseif ($countFooter) : ?>
	<a href="#footer" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
	<?php endif; ?>
		<span class="Icon Icon-expand u-color-grey-40"></span>
		<span class="u-hidden">vai alla sezione successiva</span>
	</a>
	<?php endif; ?>	
</div>
<?php endif; ?>

<?php if ($this->countModules('news')) : ?>
<div class="u-background-compl-10 u-layout-centerContent u-padding-r-top" id="news">
	<jdoc:include type="modules" name="news" style="lg" />
	<?php if ($this->countModules('lead') || $countFooter) : ?>
	<?php if ($this->countModules('lead')) : ?>
	<a href="#lead" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
	<?php elseif ($countFooter) : ?>
	<a href="#footer" title="vai alla sezione successiva" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
	<?php endif; ?>
		<span class="Icon Icon-expand u-color-grey-40"></span>
		<span class="u-hidden">vai alla sezione successiva</span>
	</a>
	<?php endif; ?>	
</div>
<?php endif; ?>

<?php if ($this->countModules('lead')) : ?>
<div class="u-background-white u-color-black u-text-xxl u-padding-r-top u-padding-r-bottom">

<?php if ($params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
see <a href="https://italia.github.io/design-web-toolkit/components/detail/leads.html">
https://italia.github.io/design-web-toolkit/components/detail/leads.html
</a>
</div>
<?php endif; ?>

	<div class="u-layout-wide u-layoutCenter u-layout-r-withGutter" id="lead">
		<jdoc:include type="modules" name="lead" style="lg" />
	</div>
</div>
<?php endif; ?>

<?php if ($countFooter) : ?>
		<footer class="Footer u-padding-all-s u-hiddenPrint" id="footer">

<?php if ($params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
see <a href="https://italia.github.io/design-web-toolkit/components/detail/footer.html">
https://italia.github.io/design-web-toolkit/components/detail/footer.html
</a>
</div>
<?php endif; ?>

			<?php if ($this->countModules('footerinfo')) : ?>
			<div itemscope itemtype="http://schema.org/<?php echo $params->get('schema_org', 'Organization'); ?>">
				<div class="u-cf">
			<?php else : ?>
				<div itemscope itemtype="http://schema.org/<?php echo $params->get('schema_org', 'Organization'); ?>" class="u-cf">
			<?php endif; ?>				
					<?php if ($logo) : ?>
					<a href="<?php echo $this->baseurl; ?>/" itemprop="url">
						<img class="Footer-logo" src="<?php echo $logo; ?>" alt="<?php echo htmlspecialchars($app->get('sitename')); ?>" itemprop="logo">
					</a>
					<?php endif; ?>
					<p class="Footer-siteName" itemprop="name"><?php echo htmlspecialchars($app->get('sitename')); ?></p>
				</div>
			<?php if ($this->countModules('footerinfo')) : ?>
				<div class="Grid Grid--withGutter">
					<jdoc:include type="modules" name="footerinfo" style="lg" />
				</div>
			</div>
			<?php endif; ?>

			<?php if ($this->countModules('footer')) : ?>
				<div class="Grid Grid--withGutter">
					<jdoc:include type="modules" name="footer" style="lg" />
				</div>
			<?php endif; ?>

			<?php if ($this->countModules('footermenu')) : ?>
				<div class="Grid Grid--withGutter u-border-top-xxs">
					<jdoc:include type="modules" name="footermenu" style="none" />
				</div>
			<?php endif; ?>
		</footer>
<?php endif; ?>

<a href="#" title="torna all'inizio del contenuto" class="ScrollTop js-scrollTop js-scrollTo">
	<span class="ScrollTop-icon Icon-collapse" aria-hidden="true"></span>
	<span class="u-hiddenVisually">Torna all'inizio del contenuto</span>
</a>

<!--[if IE 8]>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/respond.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/rem.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/selectivizr.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/slice.js"></script>
<![endif]-->

<!--[if lte IE 9]>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/polyfill.min.js"></script>
<![endif]-->

<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/uuid.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/accordion<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/table<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/map<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/timeline<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/IWT.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/italiapa<?php echo $min; ?>.js"></script>

	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>

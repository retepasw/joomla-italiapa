<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		https://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JHtml::_('behavior.core');

/** @var JDocumentError $this */

if (!isset($this->error))
{
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}

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

$theme_default = $params->get('theme', 'italia');
$theme = (isset($_COOKIE['theme']) && $_COOKIE['theme']) ? $_COOKIE['theme'] : $theme_default;
$theme_path = JPATH_ROOT . '/templates/italiapa/build/build.' . $theme . '.css';

if (!file_exists($theme_path)) {
	$theme = 'italia';
}

JFactory::getSession()->set('theme', $theme);
?>
<!DOCTYPE html>
<html class="no-js theme-<?php echo $theme; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $this->error->getCode(); ?> - <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	<link href="<?php echo $this->baseurl; ?>/templates/italiapa/css/error.css" rel="stylesheet" />
	<?php if ($this->direction === 'rtl') : ?>
		<link href="<?php echo $this->baseurl; ?>/templates/italiapa/css/error_rtl.css" rel="stylesheet" />
	<?php endif; ?>
	<?php if ($app->get('debug_lang', '0') == '1' || $app->get('debug', '0') == '1') : ?>
		<link href="<?php echo JUri::root(true); ?>/media/cms/css/debug.css" rel="stylesheet" />
	<?php endif; ?>
	<?php if (file_exists('templates/italiapa/css/user.css')) : ?>
		<link href="<?php echo $this->baseurl; ?>/templates/italiapa/css/user.css" rel="stylesheet" />
	<?php endif; ?>
	
	<?php if (file_exists('templates/italiapa/js/js.css')) : ?>
		<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/user.js"></script>
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

	<script>var theme='<?php echo JFactory::getSession()->get('theme'); ?>';</script>

	<script>__DEFAULT_THEME__ = '<?php echo $theme_default; ?>'</script>
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/build/build.css">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/build/build.<?php echo $theme; ?>.css" id="theme">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/css/italiapa.css">

	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/css/tooltip-theme-arrows.css" />

	<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/vendor/jquery.min.js"></script>
	
	<?php
	$owner_modules = array();
	foreach (JModuleHelper::getModules('owner') AS $module) {
		$owner_modules[] = JModuleHelper::renderModule($module, array());
	}
	$languages_modules = array();
	foreach (JModuleHelper::getModules('languages') AS $module) {
		$languages_modules[] = JModuleHelper::renderModule($module, array());
	}
	$mainmenu_modules = array();
	foreach (JModuleHelper::getModules('mainmenu') AS $module) {
		$mainmenu_modules[] = JModuleHelper::renderModule($module, array('style'=>'lg'));
	}
	$socials_modules = array();
	foreach (JModuleHelper::getModules('socials') AS $module) {
		$socials_modules[] = JModuleHelper::renderModule($module, array('style'=>'none'));
	}
	$search_modules = array();
	foreach (JModuleHelper::getModules('search') AS $module) {
		$search_modules[] = JModuleHelper::renderModule($module, array('style'=>'none'));
	}
	$menu_modules = array();
	foreach (JModuleHelper::getModules('menu') AS $module) {
		$menu_modules[] = JModuleHelper::renderModule($module, array('style'=>'lg'));
	}
	$footer_modules = array();
	foreach (JModuleHelper::getModules('footer') AS $module) {
		$footer_modules[] = JModuleHelper::renderModule($module, array('style'=>'lg'));
	}
	$footerinfo_modules = array();
	foreach (JModuleHelper::getModules('footerinfo') AS $module) {
		$footerinfo_modules[] = JModuleHelper::renderModule($module, array('style'=>'lg'));
	}
	$footermenu_modules = array();
	foreach (JModuleHelper::getModules('footermenu') AS $module) {
		$footermenu_modules[] = JModuleHelper::renderModule($module, array('style'=>'none'));
	}
	
	$document = \JFactory::getDocument();
	$head = new \JDocumentRendererHead($document);
	echo $head->fetchHead($document);
	?>
</head>
<body class="t-Pac c-hideFocus enhanced">

<?php $svg_path = JPATH_ROOT .'/templates/italiapa/src/icons/img/SVG'; ?>
<?php if (file_exists($svg_path) && ($icons = array_diff(scandir($svg_path), array('..', '.')))) : ?>
<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
	<defs>
	<?php foreach ($icons as $filename ) : ?>
		<?php $path_parts = pathinfo($filename); ?>
		<?php if ($path_parts['extension'] != 'svg') continue; ?>
		<?php $iconname = $path_parts['filename']; ?>
		<?php $icon = new SimpleXMLElement(file_get_contents($svg_path . '/' . $iconname . '.svg')); ?>
		<symbol id="Icon-<?php echo $iconname; ?>" 
			viewBox="<?php echo isset($icon['viewBox']) ? (string) $icon['viewBox'] : '0 0 32 32'; ?>"
			<?php echo isset($icon['style']) ? 'style="' . (string) $icon['style'] . '"' : ''; ?>>
			<?php foreach ($icon->children() as $child) : ?>
				<?php echo $child->asXML()  . "\r"; ?>
			<?php endforeach; ?>
		</symbol>
	<?php endforeach; ?>
	</defs>
</svg>
<?php endif; ?>

<header class="Header u-hiddenPrint<?php if ($params->get('headroom', 0)) echo ' Headroom--fixed js-Headroom Headroom Headroom--top Headroom--not-bottom" style="position: fixed; top: 0px;'; ?>">

<?php if (count($owner_modules) + count($languages_modules)) : ?>
<div class="Header-banner Headroom-hideme">
	<?php if (count($owner_modules)) : ?>
		<div class="Header-owner">
			<?php foreach ($owner_modules AS $module) : ?>
				<?php echo $module; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if (count($languages_modules)) : ?>
		<div class="Header-languages">
			<?php foreach ($languages_modules AS $module) : ?>
				<?php echo $module; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>

<div class="Header-navbar ">

	<div class="u-layout-wide Grid Grid--alignMiddle u-layoutCenter">
		<?php if ($logo = $params->get('logo')) : ?>
		<div class="Header-logo Grid-cell" aria-hidden="true">
			<a href="<?php echo $this->baseurl; ?>/" tabindex="-1">
				<img src="<?php echo $this->baseurl; ?>/<?php echo $logo; ?>" alt="<?php echo htmlspecialchars($app->get('sitename')); ?>">
			</a>
		</div>
		<?php endif; ?>

		<div class="Header-title Grid-cell">
			<h1 class="Header-titleLink">
				<a href="<?php echo $this->baseurl; ?>/">
					<?php echo htmlspecialchars($app->get('sitename')); ?>
					<?php if ($subtitle = $params->get('subtitle')) : ?>
						<br><small><?php echo $subtitle; ?></small>
					<?php endif; ?>
				</a>
			</h1>
		</div>

		<?php if (count($search_modules)) : ?>
			<div class="Header-searchTrigger Grid-cell">
				<button aria-controls="header-search" class="js-Header-search-trigger Icon Icon-search" title="attiva il form di ricerca" aria-label="attiva il form di ricerca" aria-hidden="false"></button>
				<button aria-controls="header-search" class="js-Header-search-trigger Icon Icon-close u-hidden" title="disattiva il form di ricerca" aria-label="disattiva il form di ricerca" aria-hidden="true"></button>
			</div>
		<?php endif; ?>

		<?php if (count($search_modules) + count($socials_modules)) : ?>
			<div class="Header-utils Grid-cell">
	
				<?php if (count($socials_modules)) : ?>
					<div class="Headroom-hideme">
						<?php foreach ($socials_modules AS $module) : ?>
							<?php echo $module; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
	
				<?php if (count($search_modules)) : ?>
					<div class="Header-search" id="header-search">
						<?php foreach ($search_modules AS $module) : ?>
							<?php echo $module; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if (count($mainmenu_modules)) : ?>
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

<?php if (count($mainmenu_modules)) : ?>
	<div class="Headroom-hideme u-textCenter u-hidden u-sm-hidden u-md-block u-lg-block">
		<?php foreach ($mainmenu_modules AS $module) : ?>
			<?php echo $module; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

</header>

<?php if (count($menu_modules)) : ?>
<section class="Offcanvas Offcanvas--<?php echo $params->get('hamburgermenu_pos', 'left')?> Offcanvas--modal js-fr-offcanvas u-jsVisibilityHidden u-nojsDisplayNone u-hiddenPrint" id="menu">
	<h2 class="u-hiddenVisually">Menu di navigazione</h2>
	<div class="Offcanvas-content u-background-white">
		<div class="Offcanvas-toggleContainer u-background-70 u-jsHidden">
			<a class="Hamburger-toggleContainer u-block u-color-white u-padding-bottom-xxl u-padding-left-s u-padding-top-xxl js-fr-offcanvas-close" aria-controls="menu" aria-label="esci dalla navigazione" title="esci dalla navigazione" href="#">
				<span class="Hamburger-toggle is-active" aria-hidden="true"></span>
			</a>
		</div>

		<?php foreach ($menu_modules AS $module) : ?>
			<?php echo $module; ?>
		<?php endforeach;?>
	</div>
</section>
<?php endif; ?>

<div id="main" role="main">
	<div class="Grid">
		<div class="Grid-cell Grid-cell--center u-size10of12 u-sm-size10of12 u-md-size8of12 u-lg-size8of12">
			<div class="ErrorPage u-textCenter u-text-xxs u-text-md-xs u-text-lg-s">
			<?php if ($this->error->getCode() == 404) : ?>
				<h1 class="ErrorPage-title"><?php echo $this->error->getCode(); ?></h1>
				<h2 class="ErrorPage-subtitle"><?php echo JText::_('JERROR_PAGE_NOT_FOUND'); ?></h2>
				<p class="Prose u-margin-r-all"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></p>
				<p><strong><?php echo JText::_('JERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?></strong></p>
				<a class="Button Button--default u-margin-r-all" href="<?php echo JUri::root(true); ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>
			<?php else: ?>
				<h1 class="ErrorPage-title"><?php echo $this->error->getCode(); ?></h1>
				<h2 class="ErrorPage-subtitle"><?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></h2>
				<p class="Prose u-margin-r-all"><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
				<ol class="Bullets">
					<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
					<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
					<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
					<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
					<li><?php echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'); ?></li>
					<li><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></li>
				</ol>
				<p><strong><?php echo JText::_('JERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?></strong></p>
				<a class="Button Button--default u-margin-r-all" href="<?php echo JUri::root(true); ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>
				<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
				<div class="Prose Alert Alert--error Alert--withIcon u-layout-prose u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
					<h2 class="u-text-h3"><?php echo $this->error->getCode(); ?> - <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></h2>
				<?php if ($this->debug) : ?>
					<?php echo $this->renderBacktrace(); ?>
					<?php // Check if there are more Exceptions and render their data as well ?>
					<?php if ($this->error->getPrevious()) : ?>
						<?php $loop = true; ?>
						<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
						<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
						<?php $this->setError($this->_error->getPrevious()); ?>
						<?php while ($loop === true) : ?>
							<p class="u-text-p"><strong><?php echo JText::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong><br/>
							<?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
							<?php echo $this->renderBacktrace(); ?>
							<?php $loop = $this->setError($this->_error->getPrevious()); ?>
						<?php endwhile; ?>
						<?php // Reset the main error object to the base error ?>
						<?php $this->setError($this->error); ?>
					<?php endif; ?>
				<?php endif; ?>
				<div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php if (count($footer_modules) + count($footermenu_modules) + count($footerinfo_modules)) : ?>
	<footer class="Footer u-padding-all-s" id="footer">
		<?php if (count($footerinfo_modules)) : ?>
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
		<?php if (count($footerinfo_modules)) : ?>
			<div class="Grid Grid--withGutter">
				<?php foreach ($footerinfo_modules AS $module) : ?>
					<?php echo $module; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if (count($footer_modules)) : ?>
			<div class="Grid Grid--withGutter">
				<?php foreach ($footer_modules AS $module) : ?>
					<?php echo $module; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if (count($footermenu_modules)) : ?>
			<div class="Grid Grid--withGutter u-border-top-xxs">
				<?php foreach ($footermenu_modules AS $module) : ?>
					<?php echo $module; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</footer>
<?php endif; ?>

<a href="#" title="<?php echo JText::_('TPL_ITALIAPA_BACKTOTOP'); ?>" class="ScrollTop js-scrollTop js-scrollTo">
	<span class="ScrollTop-icon Icon-collapse" aria-hidden="true"></span>
	<span class="u-hiddenVisually"><?php echo JText::_('TPL_ITALIAPA_BACKTOTOP'); ?></span>
</a>

<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/uuid.min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/accordion<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/js/table<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/italiapa/build/IWT.min.js"></script>

</body>
</html>

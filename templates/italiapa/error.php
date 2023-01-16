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

JHtml::_('behavior.core');

/** @var JDocumentError $this */

if (!isset($this->error))
{
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}

$app	= JFactory::getApplication();
$params = $app->getTemplate(true)->params;
$min    = '.min';

if ($params->get('debug') || defined('JDEBUG') && JDEBUG)
{
	JLog::addLogger(array('text_file' => $params->get('log', 'eshiol.log.php'), 'extension' => 'tpl_italiapa_file'), JLog::ALL, array('tpl_italiapa'));
	$min = '';
}
JLog::addLogger(array('logger' => (null !== $params->get('logger')) ?$params->get('logger') : 'messagequeue', 'extension' => 'tpl_italiapa'), JLOG::ALL & ~JLOG::DEBUG, array('tpl_italiapa'));

$theme_default = $params->get('theme', 'italia');
$theme = (isset($_COOKIE['theme']) && $_COOKIE['theme']) ? $_COOKIE['theme'] : $theme_default;
$theme_path = JPATH_ROOT . '/templates/italiapa/build/build.' . $theme . '.css';

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
	<script>__DEFAULT_THEME__ = '<?php echo $theme_default; ?>'</script>
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/build/build.css">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/build/build.<?php echo $theme; ?>.css" id="theme">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/italiapa/css/ita.css">
	<link media="all" rel="stylesheet" href="<?php echo $this->baseurl ?>/media/jui/css/icomoon.css">
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
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php if (count($footer_modules) + count($footermenu_modules) + count($footerinfo_modules) + $params->get('copyright', 1)) : ?>
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

		<?php if ($params->get('copyright', 1)) : ?>
			<div class="ipa-copyright">
				<a href="http://paswjoomla.net/joomla/" data-tooltip="Porte Aperte sul Web" data-tooltip-position="top left" target="_blank" rel="external" class="hasTooltip">
					<span title="Porte Aperte sul Web" style="background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHwAAAAgCAYAAADQUhwyAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAB3RJTUUH4wMUCigUjs+GlQAAEjVJREFUaN7tm3l0VdW9xz/7nHPHJDfzQCCQMATClAIKKkWwQUGtWEXF4SE4oGjV16Kor068vhZ9Tljr1GexWNu6pCr0PUsHpMUqVKmtKKCoCIEAgUBCyHTvPfee/Xt/3BPuzWRitV2rLvZaZ3Fz9m//9u/8pv3dv71RHG//tCYiJpCZ8soBmgBRSh1X0JfI0EpEgiLyKxGpE5GD7rNXRGYe19CX0+jPich/d3pXISLyKWO+cDms46b4pzUFvOMaUSmlBDgMhEVkKBBIoTWAHUqp1uNq+9eN8J+JyGXtUSsij4hIi/TcDonIvH9ElKdKddwy/ziD/1RELnZ/TxORBi0yRESO9kA/VUQaRaT4H5PSlyyBdqRYVjSRsqqT+chnUQjo4wb7XC0ciT256tWR131jWoWIXACMBOoUPLj5g50hssddhLNvDU11LSxZgtxzD0qp10RkDXATcPsXua6kuNUmiwlP/Bb/6CryyiHDhONB//lbKxDQlJWEuHTyUL42PINN1a1sq2niZ2u3Q0TBvt82MNY3mRXLtqdE+TPAPqXUXX3IIPRla5ekSL9eURL7LqNPv5P8CtCxpLG1CU27wZsDgUAyE/TQvIbGYwhhx0T3xWFsjTco2GEFHuMz69NQQsDUxMTAdr6Y/azH0JgmROJGB6dvn6sNE79oTENoiZukmQ4Rx8AR1VU2S9OmTSQmEHe449z+PLG+jiNNcfCYCSvEwrB1dRuHfMPZ+b29IpIPLHeB3TIgzd23d24OcEgpVSMi7WCwZ10d+1UZNygp+3eySiEeBa1BNDgGFxVt5dBTp7HnviH0S/ODdtw+naQT97cd57yT83jnjlHkB1THvlTa9seJ8/jF/Tn80Hh+/e9lEHeS9I7TkVa7c3YY71AQ8LLl7rFMLwsmx3Q3videqbSOhkicO6cXsPKKQXjpOG5MsZ/q+yopMuI8vWAwv1s0mlDQ5pOlY7l4QmZSJy7vYfledny/klHZcdACHgOPqfB7DLBUcn7TD2NmBrNyGu4SkXuBWuAcYBjwP8CFwA9d47c/DwJ/BfaIyI+VUtIbyEsavL5NEfdmYJgdCPK8dbzw3UvZ8tF+oo6XdbeUQCTG5BI/t52Rz5ljAiCCaSrmVKZz+eQcQrZBnr+NAb56LEPRP9fkplPSuWxCOpm+jhEwpTyd684oYuWaPzJ9aDrXfTWxOzl3ZJDvzChiVLEFAsXpJjedlM5lU9LJ9CoUMGmAl0Uz+jEoX5EV8lLY9iYBvxePEi4aHeT6GUVUFni6gNGcNMU1k9K5siqdQr9Jbqbw7TML8VhwyQQ/k0alEfSYZMZrIN5xZ2SZitx0D8aBNwgpH1m6GXX4ILnpXnyNH+PzaeZPSOe6qgxKMg1QilDAw/XjY8w7JYeAYfSwvxYwc7n07Ip5wDygAHgcWKuUOlkpdbNS6iSl1FdTnqkqkcf9wAwRubPLMt2jwYP+RHrpJEtB4SAc4Lu/2MBLm2sozLCY2L+N1++s4OIKzZobhjF9cBbXnZbF89cPptK/GytQS3Z2LpuWfo0RGY08N6+Ma08Jsez8bO6a1R90UqasoA8FXP3AJl7f1caQ+G4uOSmNl79ZwemlR3l90UhCaQbLryrl2tNDLJ2ZxdI5A/D5LNYsHsN5wxrIbNhCOBzj0Vsu4dtT01j0tVx+vnAQN1bGWHvbCAbl+VISoPDU+cXcMSOPe05J45kryikJwvemhwi07Wfu5H7MKq4nLQjCpywvRjooAUOB3wAFMa158sISfnxFCYtPDbHu9uF4BBwRhuVn8uRFRdw/OxfbUTRHnK4rYyzGw7fODwMnKKUaABMI9WHtjgLjXUdJ65vBe0BnImEQ8PuC5AWKiMU044oCKAzG3fAo1fVRzhtQx9ShGaxe9w4337+O1uZ8IuEWbn3wRfZtfpPJwzM5a/H93PKjLZxT2gKN+5M4IN6eSgqxvB4kqJmY6eVnr/6Rc//z93h9JsMOvM+kkVlccuMD/MeTW6jq18Kg1v0EaODUq59ja2MmPo+Hn7z8Ki888wJThgZY9foWvr7kf8lP99I/ciA5nyNMP6mAG5etYNo963j65yvR2sGO2uD3ET8qOE4zrW24IKj7gFESRvwK4gKRKAiEDGHKiBx+8Iu3WHjfWoblBOkX/gCfV7HokdXcv+59zh2RxcZtH7Hx9hFIXPCaCq+VeDAVvmD6G0qp/SIyEFiolLrl09J0ClBrctdz43NW2vzYcWHNvXNQBix+7EUiFCUmyxmF8gSJGA7SFsEwDCidBgGLltYwP3nPJlw2labGVravXIbfBzt37YEWG3IVIIiRwCF65ZUoP/xlHUhODFM8WAMnoTwGomppOhrnnRceBh/s3F+DSDMRrbEGnoDKK8XywG/fruWT4AQQDxdWTeLMaZMAwTTbgFz3ixX3vVzNrx66mU+O2Cx4bBM6qhKxFAMyAPH0hksxlMKxgQwF/vREcHgCRO04N86fxqL5LgMVBcD05+BPK0G8wmuv7eH5UcNYf9sI4o4QiWuyAxZ1LTGAqSKy1Z1mdl/R92fbh4tA9tlCwehuSCJ4TMW3H3ueF1e/xT5VysKrT3I/xgQ0/hhgaYgCTgTlTSQMKz0PZQZIz/Bx1qJHkLowtbF68FYlPVQnMMP4a7/HitsvdxUeArUXHVeIAwqDNK/F+bf9gP0tbdh7G/CNOQOFBh1M+LUG09IQzAO8rH/7AxY/tBrTivL+kRIYUNJuKR5Zc4DVK1dz6dfLuf/fpnDNswcRJeh4K7oZlLJRbrrsGlyJPltrzBiIpXFaDye+xRPDYylWvrKRe5f/gVDIIOIvwACa4mGi4gdbQ8DHvWtq+eEfDmIZCg2YClptTfTx8X92AZoGWr/oUzTDzQvwmwfSsONdM5jyYxqwfa+ffcPmQPlpHDjcDMDt51YyIGTxTkMdFj4MpcDw8cmORvLy87jpjKH4PYoD9XFmTjmRm2+9nuVLb4bMrAQ6dQ0AsLk2k3oKUAI63ExZTn8WTC4hzYL9rTHqWmNMnzKVxVfM57HHbiYWy07MRxMtcZvGcJR5s6dTMdDPgdZG+hfkcNGls3nzuSUMGT88CdxiwvsPj+LuW6+heOAYaNjHgYNbyM7K4+qqYZwwNou6gzbbmjVjywdz5ZQiSNnqHW0xsYHvzDmdsSVeRvTL59ZvTMQyYNu2I9RHhZGlJXxr0Xw2PnsHRwJDOBrW3LlgJudUmHx86AgoGxS0RDWNYYemsMORNgc77ADYSqkmpVRL5y2WiBgiEvo8hyvGsQi/4K42PFaXpTwWaWPL3sPE7BYQD+g4/7ctysIn1zL/pCyWPfsyy9f8jZrWGHvq9oNp8EaNzcInNnLJVwzyD7zDZU+8xbSx/TCPVjP31ofBSq4kjdEwWz/eD54Au/fVU10bRbww+isDmTvWZP7dP6SWPBY8/jYnjg6RJYeYf9ND2Jbi/U/qEK042ibMeWQTmbqRWTk7WPyrejZsq+as4WnM/c6jvLttZ0pOU5z/4IcMsfYwOjPGggd/SW2kkCue3MDCyiAvvfo6z/3xQ17YcJhf/H4zS84IQN0WUAlV7WiwueK+tZxe6WHNaxu5f8Ua5k70cfVdK1i/8whzn95O9d5djM2McNY1D1O99wDnPbCByhyDHe9u47LFj0Bm2d8boNnAKhFZKiIepdRnNnrSdS/7Lw+H02wGTe0I4AwPfPBrSM+EARPhWGHBhO1rIOCBwWfBoRo49FcYfCp4gqBtqN6QOAQqPw3eXwfhJhg9Acz8FI+yYdefILcCTIG6rTx2xwUEDu/lqu+/BiWlMHB8Igttfx3UUSibAEY2bF0PZYMgNCLBq+49OLIXymdA40H46K8wrB/kjutYHlYCuzfDoVoYNQ78/SAeg+o3Erhn8ClgBCF8BLa+CWOHga88WWNWFnz0GpgNkDsRdmyG4iAMqEoUrOoPw4ENkFsK/SYkxu3aDLITCmZCmr/7c4uYRp458RWl1DmfgsqfBS4H2oDrgeeVUraI+IB3gYlKqabeDf7rP6exbEMLQ07rKozhRqSO9/xeqYQidDzpMKn9hpWgcZyuxXnDSqZ4ZTI0oxnr6Ltsd04Ajy85r2ElRNbHFu1kMacdUygjoXSlEvRag3RToDLaaZ2U5aVdXifxDe08epIZleBtuNW4djnbdYF2ebnzYYDEez6k6pvBrwaeTnn1iVuY+QmwCjird4OLwLirLArHxBh0avdbNC0J8vadipZj6+8xHt0BDO0uHJrk2O54d+YlOpFFUsd05iE98UuZs7dKbTsP6eZ0oS/ju5NDUnTlbgUx+wC++mBw1+jSjQQtrsHntaf67gBfErTdcL6F1l0VKDAoU7iyqpgbpoeoGJABMYdHLx+MGdfucOFb04owzU6+EtPceXYB2UFYND2bUcXBLr4U9MDdFw6AWDKCzhiVxVcKvSysymJgnnUMbC2dlc3AnASPgNfgqpNzOvgJQHGawaIZORgCd5+bA3bPa1zQazB7fDoKGD3Qz9kjAx0C+VszsvGavdTcTcXcSblY7YJoYdbwEFPLg26dQXjg4mIyfbqvB1Fpu2vre/OOPd0Eboab6veJyJVAXnfgLsn4oRd8/G5fhLKpXVKO14RB2RZRrWhodWiJOlQODPJuTWuicGIalIcsdrTG0XEnkVrjAloYXOqner9NaZ6XmqYYsZhOwQFgGYrhRR627bWPRVNhyEC3arwZJvUtmkhcQKAs38uhepsWBFMpSkIm1fVxvB6wtYKIxu836V9osvOgQ2meh92H2tBYXR3Z0PgcRUG2l5rGGCG/SZrfoPZI7BjtwHwPNYdjPV8TMByIGZRmWuxucY7ZM+CF0nwfu/ZEiShh2vAQb37YRMToxY6i+OnXm5k7a+pgpdSunqLUPWL9ZS9OUQOsAO5JRfvJhPXhHt1TeizN0qy4cjB76m1aoom8+u7uMBeMy+ObMwtAND9aMJCgA2sWluM3TS78ajrnjcli9ZWDqMhLZ2ddlLurshnV39eBfVwL2/bbHVLnnAl5nDPey756J2Fs1zV3HYyy+Jz+jC7yke41uPX0QmZOyGDpObkQ1qy6cQBVJ2ayYk4+EnHYtTfM2/dUkhHotP7GhafmDWTWyEJq6u1EmSriUNsY6+AYyy8YTMDqwUhx4aXLR3LeuAxuObsoUSlrP/6OwsXjs6kYAdjCTVPySMuW3iPcMHj8pbV/Az4SkSVArogUd3r6A+v7kClKgLuAA+5t2U4R/sqGIMs2tjLktC4pvTBdmDkqi2c3NQIKE+Gm6Vk89uoRYo7CtAzmnJTGixtbsEWDMigrNMkLKP5SbSci2lCgBWWoXr978pAA9VHF9prWrrggpsEy8HsVp5UH+c2WVjAEHJh9YhZvfNzEwWad/DTtZpxOa/OZI4OEI3HW70w427B8D9lBD7YjaO3w3n6bi8Zns2pzI7Eez3g1HjE4uzKNV7a2EU+liyXWbWWA2Dpx7NtbojY1rF26XD5e9QRwG1DRzZGoAXwMvO8a9NOadnl81J4pkpW2kbMjFA/dgsTGoDwdRjUDrS3eY+DEceBwk6DjCiyFRmho9mHTkkCsAGFojasEElbH6pF9WsaOtDroeLx7ROael2sNTXYcZYJIAiA1H27B0R7A7ojGu4Gqu8OKmJ2kC2swI1FijiTQP9AQjaI/dZ9roE2ojzhdv8ujkicU3j4gP8OA2l3geLcppf4mIpf0cvJ1Yy8cq5VSZZ9+42XYJecztOpFSkYqzDQXebt+IilIWrke7FHJNNUdEhV69+qeUC99GJuKolVfjg467QyU6oj4O2vGcc+r+Axy/F2XjqLQWAfbVrzJN385lYXK7sMNl0rgDSC9B5JJSqlNnXFAR5VOW6DY+d5ECqasQGQEAQ+0RiHNB23RBBoJ20lkErbB74VoDLwW2O4es72vfSKPCTEn0ef3QsTtEwG/ByKxhIebCuI6wSsa68innUd7Rgr6OsqWKpNSYBnuJYQU+raou7dWbk1Ad5StfbzPk/gWy0g4stZJOY/JnfId7TxMI9Gnpeuc7fM6umMfgMeKglrGW6vuhY+bmLYE1i+hD0Y/6qLz7kKjCRihlKo9fsfsS9JE5NqUa80tIvKUiMTdv7WINPWV03Ft/nMt9/cafKhr3A9FZJr77vud7re/6L4//p/X/sWju/3frSIyqVPf3Z2M/qfjGvtyGF115wjufn27a+wDIjL4uLa+/M4QEJE3RaQ8NSP8Pw1doc3rLxM+AAAAAElFTkSuQmCC) left center no-repeat; width: 124px; height: 32px; display: inline-block;">&nbsp;</span>
				</a>
				<span>Powered by <a href="https://www.eshiol.it/it/template-italiapa.html" data-tooltip="Template ItaliaPA &copy; 2017 - 2023 Helios Ciancio. All rights reserved." data-tooltip-position="top right" target="_blank" rel="external">ItaliaPA
				<span style="background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAAAQCAYAAACm53kpAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH4gwNCxsFdcv1AQAAA7VJREFUWMPN12mIVmUUB/Df6OA2GspEKpWWZU2UZBRuLVZa2opStHyzlAqyPhSoUISEFpltUKB+iGhVLBpMyMg2mxaCFmjIoqICyYKcmWwbdfTty/+ty+V9ZzQh5sDDfe59znnuOf/7P+c8t6FSqagjy3EmrtD/ZRG2YGzuG0vrf2E+XkdbcWFAnQ0fw95suLCfBz8Bt6AVp8bnbvRk7McfOB1LMQdHVo0bSgxYhGm5NmEf3seXWIdt/RSEu7EC9+BKvJXAq3IAR+AzzMQpWI/VVQBeQAfux44YzcalOA+b0Y4ZGBbEi/IRvgu9Bge8hsJ6N+Zmj8Ul22a8hmcxKM4OL+l04xJsr/FuCfzezFsxr4bObGzNfDMur+bKSEwMIjtwThjQhjtwF1bipoDRgzH4qbD59/gzjNmJF2s4cC4+Dg134uk834WuzLehBatr2LfEp4tD+zWFtSLYX9dhSVNh/p5CsejCU7gI1+FhLEieDAt1pse5dbgtCH4SUODTsGcWHghzvskX7bHfeANtx8A4ezuOKgS6FY+GHQtwTEFXQP81bBkTP4fXAarxIFJmUFl5IlYluONxLb7F6IwPCsajUxM21tjwjYCxD/f9szrQ9ADdlCLUXnJ+cK6P46Tkc1nmJFVgXJ3gD1kGFIDowDOh+6R8jSH4JTqT8XbovTwtpZb8nOCrQcwKgI+EUSvTYepJT53nQw5C55ClsVBkunFcis0q7MYSnI93sSnz0zCqlz2bUkuex7JU4/kBpK2P9lvO58PROSQGzMRVYcGrCX5a6kAXnsNXKWSTSy2mnozE1QF5cfK338mAOFql+I+ZP5H7JfgwFXc7Hkp6dPay594A2pz+/EOKYkd/BKDaBc6qHgzSRm7M2vCkxiScjCnJ6Y05VCzKPntyPTsV/J2cLa7P85txYVKpluwpHVpqyYFe4vj9v9oXc3FFcuvNAn1n5H/g80Jv70oKbCjYzsUr6a9f4BrcWlhfm8r/cu7LKXQZjsbQdIRRqUfVMRYj0iHK9s0BekoKZW/2J8ZmXy0A2sOEl3BnvuSI1ASpB2sDztRSF2gPY1rs15KjZkcKYlPWtmBpj57V6QbFAIamYJ6RNtyZr1oduxP0uNiML9jvykFsYYI9Ifa7C6MTlfg1If8FNf8FijIVNwSUTTn5resjpS7Ag6kXO3OYqVbt7jhRCWPW1+jly8K81ug1lNKkIWeOeXXs18TftlKrbMBvhbT/9/2VSqWv8WSlUhl3EHrVcexh6vyv9n8DKS+vqL7NXR4AAAAASUVORK5CYII=) left center no-repeat; width: 64px; height: 16px; display: inline-block;">&nbsp;</span>eshiol.it</a></span>
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

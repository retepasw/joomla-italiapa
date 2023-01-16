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

// Add JavaScript Frameworks
JHtml::_('behavior.core');
JHtml::_('bootstrap.framework');

$app	= JFactory::getApplication();
$params = $app->getTemplate(true)->params;
$min    = '.min';

if ($params->get('debug') || defined('JDEBUG') && JDEBUG)
{
	JLog::addLogger(array('text_file' => $params->get('log', 'eshiol.log.php'), 'extension' => 'tpl_italiapa_file'), JLog::ALL, array('tpl_italiapa'));
	$min = '';
}
JLog::addLogger(array('logger' => (null !== $params->get('logger')) ?$params->get('logger') : 'messagequeue', 'extension' => 'tpl_italiapa'), JLOG::ALL & ~JLOG::DEBUG, array('tpl_italiapa'));
JLog::add(new JLogEntry('Template ItaliaPA', JLog::DEBUG, 'tpl_italiapa'));

$theme_default = $params->get('theme', 'italia');
$theme = (isset($_COOKIE['theme']) && $_COOKIE['theme']) ? $_COOKIE['theme'] : $theme_default;
$theme_path = JPATH_ROOT . '/templates/italiapa/build/build.' . $theme . '.css';

JFactory::getSession()->set('theme', $theme);

/** @var JDocumentHtml $this */
$this->baseurl = JURI::root();

JHtml::_('stylesheet', 'templates/italiapa/build/build' . $min . '.css', array('version' => 'auto'));
JHtml::_('stylesheet', 'templates/italiapa/build/build.' . $theme . $min . '.css', array('version' => 'auto'), array('id'=>'theme'));
JHtml::_('stylesheet', 'italiapa' . $min . '.css', array('version' => 'auto', 'relative' => true));

JHtml::_('stylesheet', 'prism' . $min . '.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'tooltip-theme-arrows' . $min . '.css', array('version' => 'auto', 'relative' => true));

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

JHtml::_('script', 'tether' . $min . '.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'drop' . $min . '.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'prism' . $min . '.js', array('version' => 'auto', 'relative' => true));

// Check for a custom JS file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js ie89 ie8" lang="<?php echo $this->language; ?>"><![endif]-->
<!--[if IE 9]><html class="no-js ie89 ie9" lang="<?php echo $this->language; ?>"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js theme-<?php echo $theme; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php if ($app->get('debug_lang', '0') == '1' || $app->get('debug', '0') == '1') : ?>
		<link href="<?php echo JUri::root(true); ?>/media/cms/css/debug.css" rel="stylesheet" />
	<?php endif; ?>
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
	<!-- include html5shim per Explorer 8 -->
	<script src="<?php echo $this->baseurl ?>templates/italiapa/build/vendor/modernizr.js"></script>

	<script>__PUBLIC_PATH__ = '<?php echo $this->baseurl ?>templates/italiapa/build/'</script>
	<script>__DEFAULT_THEME__ = '<?php echo $theme_default; ?>'</script>

	<jdoc:include type="head" />
</head>
<?php
	$menu      = JFactory::getApplication()->getMenu()->getActive();
	$pageclass = "";

	if (is_object($menu)) :
		$mparams    = new JRegistry($menu->params);
		$pageclass = $mparams->get('pageclass_sfx');
	endif; 
?>
<body class="t-Pac c-hideFocus enhanced <?php echo $pageclass ? htmlspecialchars($pageclass) : ''; ?>">
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

<?php if ($this->countModules('cookiebar')) : ?>
	<jdoc:include type="modules" name="cookiebar" style="none" />
<?php endif;?>

<?php if ($this->countModules('menu')) : ?>
<ul class="Skiplinks js-fr-bypasslinks u-hiddenPrint">
	<li><a href="#main"><?php echo JText::_('TPL_ITALIAPA_SKIP_TO_MAIN_SECTION'); ?></a></li>
	<li><a class="js-fr-offcanvas-open" href="#menu" aria-controls="menu" aria-label="<?php echo JText::_('TPL_ITALIAPA_OPEN_MENU'); ?>" title="<?php echo JText::_('TPL_ITALIAPA_OPEN_MENU'); ?>"><?php echo JText::_('TPL_ITALIAPA_JUMP_TO_NAV'); ?></a></li>
</ul>
<?php endif;?>

<header class="Header u-hiddenPrint<?php if ($params->get('headroom', 0)) echo ' Headroom--fixed js-Headroom Headroom Headroom--top Headroom--not-bottom" style="position: fixed; top: 0px;'; ?>">

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
		<?php if ($logo = $params->get('logo')) : ?>
		<div class="Header-logo Grid-cell" aria-hidden="true">
			<a href="<?php echo $this->baseurl; ?>" itemprop="url">
				<img src="<?php echo $logo; ?>" alt="<?php echo htmlspecialchars($app->get('sitename')); ?>">
			</a>
		</div>
		<?php endif; ?>

		<div class="Header-title Grid-cell">
			<h1 class="Header-titleLink">
				<a href="<?php echo $this->baseurl; ?>">
					<?php echo htmlspecialchars($app->get('sitename')); ?>
					<?php if ($subtitle = $params->get('subtitle')) : ?>
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
			<div class="Headroom-hideme">
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
			<a class="Hamburger-toggleContainer js-fr-offcanvas-open u-nojsDisplayInlineBlock u-lg-hidden u-md-hidden" href="#menu" aria-controls="menu" aria-label="<?php echo JText::_('TPL_ITALIAPA_OPEN_MENU'); ?>" title="<?php echo JText::_('TPL_ITALIAPA_OPEN_MENU'); ?>">
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
<section class="Offcanvas Offcanvas--<?php echo $params->get('hamburgermenu_pos', 'left')?> Offcanvas--modal js-fr-offcanvas u-jsVisibilityHidden u-nojsDisplayNone u-hiddenPrint" id="menu">
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
				
				<?php if ($this->countModules('main-top')) : ?>
					<jdoc:include type="modules" name="main-top" style="none" />				
				<?php endif; ?>
				
				<jdoc:include type="component" />

				<?php if ($this->countModules('main-bottom')) : ?>
					<jdoc:include type="modules" name="main-bottom" style="none" />				
				<?php endif; ?>

		<?php if ($this->countModules('right')) : ?>
			</div>
			<div id="right" class="Grid-cell u-sizeFull u-md-size4of12 u-lg-size4of12">
				<jdoc:include type="modules" name="right" style="lg" />
			</div>
		</div>
		<?php endif; ?>

		<?php $countFooter = $this->countModules('footer') + $this->countModules('footerinfo') + $this->countModules('footermenu'); ?>

		<?php if ($params->get('forward', 1) && ($this->countModules('services') || $this->countModules('featured') || $this->countModules('news') || $this->countModules('lead') || $countFooter)) : ?>
			<?php if ($this->countModules('services') || $this->countModules('featured')) : ?>
				<a href="#featured" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($this->countModules('news')) : ?>
				<a href="#news" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($this->countModules('lead')) : ?>
				<a href="#lead" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($countFooter) : ?>
				<a href="#footer" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php endif; ?>
			<span class="Icon Icon-expand u-color-grey-40"></span>
			<span class="u-hidden"><?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?></span>
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
		<?php if ($params->get('forward', 1) && ($this->countModules('news') || $this->countModules('lead') || $countFooter)) : ?>
			<?php if ($this->countModules('news')) : ?>
				<a href="#news" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($this->countModules('lead')) : ?>
				<a href="#lead" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($countFooter) : ?>
				<a href="#footer" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php endif; ?>
				<span class="Icon Icon-expand u-color-grey-40"></span>
				<span class="u-hidden"><?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?></span>
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ($this->countModules('news')) : ?>
	<div class="u-background-compl-10 u-layout-centerContent u-padding-r-top" id="news">
		<jdoc:include type="modules" name="news" style="lg" />
		<?php if ($params->get('forward', 1) && ($this->countModules('lead') || $countFooter)) : ?>
			<?php if ($this->countModules('lead')) : ?>
				<a href="#lead" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php elseif ($countFooter) : ?>
				<a href="#footer" title="<?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?>" class="Forward Forward--floating js-scrollTo" aria-hidden="true">
			<?php endif; ?>
				<span class="Icon Icon-expand u-color-grey-40"></span>
				<span class="u-hidden"><?php echo JText::_('TPL_ITALIAPA_SKIP_TO_NEXT_SECTION'); ?></span>
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ($this->countModules('lead')) : ?>
	<div class="u-background-white u-color-black u-text-xxl u-padding-r-top u-padding-r-bottom">
		<div class="u-layout-wide u-layoutCenter u-layout-r-withGutter" id="lead">
			<jdoc:include type="modules" name="lead" style="lg" />
		</div>
	</div>
<?php endif; ?>

<?php if ($countFooter || $params->get('copyright', 1)) : ?>
	<footer class="Footer u-padding-all-s u-hiddenPrint" id="footer">
		<?php if ($this->countModules('footerinfo')) : ?>
			<div itemscope itemtype="http://schema.org/<?php echo $params->get('schema_org', 'Organization'); ?>">
				<div class="u-cf">
			<?php else : ?>
				<div itemscope itemtype="http://schema.org/<?php echo $params->get('schema_org', 'Organization'); ?>" class="u-cf">
			<?php endif; ?>
					<?php if ($logo) : ?>
					<a href="<?php echo $this->baseurl; ?>" itemprop="url">
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

		<?php if ($params->get('copyright', 1)) : ?>
			<div class="ipa-copyright">
				<a href="http://paswjoomla.net/joomla/" data-tooltip="Porte Aperte sul Web" data-tooltip-position="top left" target="_blank" rel="external" class="hasTooltip">
					<span title="Porte Aperte sul Web" style="background: url(data:image/png;base64,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) left center no-repeat; width: 124px; height: 32px; display: inline-block;">&nbsp;</span>
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

<!--[if IE 8]>
<script src="<?php echo $this->baseurl ?>templates/italiapa/build/vendor/respond.min.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/build/vendor/rem.min.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/build/vendor/selectivizr.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/build/vendor/slice.js"></script>
<![endif]-->

<!--[if lte IE 9]>
<script src="<?php echo $this->baseurl ?>templates/italiapa/build/vendor/polyfill.min.js"></script>
<![endif]-->

<script src="<?php echo $this->baseurl ?>templates/italiapa/js/uuid.min.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/js/accordion<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/js/table<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/js/map<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/js/timeline<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/build/IWT.min.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/js/italiapa<?php echo $min; ?>.js"></script>
<script src="<?php echo $this->baseurl ?>templates/italiapa/js/tooltip<?php echo $min; ?>.js"></script>

	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>

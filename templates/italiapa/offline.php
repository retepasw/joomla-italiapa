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

use Joomla\CMS\Filesystem\Path;

// Add JavaScript Frameworks
JHtml::_('behavior.core');
JHtml::_('bootstrap.framework');

$trusted = false;
if (JPluginHelper::isEnabled('twofactorauth', 'trust'))
{
	$file  = Path::clean(JPATH_ROOT . '/plugins/twofactorauth/trust/trust.php');
	if (file_exists($file))
	{
		require_once JPATH_ROOT . '/plugins/twofactorauth/trust/trust.php';
		if (PlgTwofactorauthTrust::isActive() && PlgTwofactorauthTrust::checkCookie())
		{
			$trusted = true;
			JText::script('TPL_ITALIAPA_UNTRUST_THIS_BROWSER');
		}
	}
}

$twofactormethods = JAuthenticationHelper::getTwoFactorMethods();

$app	= JFactory::getApplication();
$params = $app->getTemplate(true)->params;
$min	= '.min';

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

if (!file_exists($theme_path)) {
	$theme = 'italia';
}

JFactory::getSession()->set('theme', $theme);

JHtml::_('stylesheet', 'templates/italiapa/build/build' . $min . '.css', array('version' => 'auto'));
JHtml::_('stylesheet', 'templates/italiapa/build/build.' . $theme . $min . '.css', array('version' => 'auto'), array('id'=>'theme'));
JHtml::_('stylesheet', 'italiapa' . $min . '.css', array('version' => 'auto', 'relative' => true));

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

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
<body class="t-Pac c-hideFocus enhanced">

	<div class="Grid offline u-margin-top-xxl">
		<div class="Grid-cell Grid-cell--center u-layout-prose">
			<div class="Grid u-layout-wide u-layoutCenter u-margin-bottom-l">
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
			</div>

			<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post"
				class="form-validate form-horizontal well Form Form--spaced u-padding-all-xl u-background-grey-10 u-text-r-xs">

				<?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) !== '') : ?>
					<div class="Prose Alert Alert--info">
						<p><?php echo $app->get('offline_message'); ?></p>
					</div>
				<?php elseif ($app->get('display_offline_message', 1) == 2) : ?>
					<div class="Prose Alert Alert--info">
						<p><?php echo JText::_('JOFFLINE_MESSAGE'); ?></p>
					</div>
				<?php endif; ?>

				<fieldset class="Form-fieldset">
					<div class="control-group">
						<div class="control-label">
							<label id="username-lbl" for="username" class="Form-label required invalid"><?php echo JText::_('JGLOBAL_USERNAME'); ?><span class="star">&nbsp;*</span></label>
						</div>
						<div class="controls">
							<input type="text" name="username" id="username" value="" autocomplete="username" class="Form-input Form-input validate-username required invalid" size="25" required="required" aria-required="true" autofocus="" aria-invalid="true">
						</div>
					</div>

					<div class="control-group">
						<div class="control-label">
							<label id="password-lbl" for="password" class="Form-label required invalid"><?php echo JText::_('JGLOBAL_PASSWORD'); ?><span class="star">&nbsp;*</span></label>
						</div>
						<div class="controls">
							<input type="password" name="password" id="password" autocomplete="current-password" value="" class="Form-input Form-input validate-password required invalid" size="25" required="required" aria-required="true" autofocus="" aria-invalid="true">
						</div>
					</div>

					<?php $tfa = JAuthenticationHelper::getTwoFactorMethods(); ?>
					<?php $this->tfa = is_array($tfa) && count($tfa) > 1; ?>
					<?php if ($this->tfa) : ?>
						<div class="Form-field">
							<div class="control-group">
								<div class="control-label">
									<?php if ($trusted) : ?>
										<div class="u-floatRight">
											<a href="#" class="2fa-untrust">
												<?php echo JText::_('TPL_ITALIAPA_UNTRUST_THIS_BROWSER'); ?>
												<svg class="u-text-r-m Icon Icon-unlink" style="margin-right: 0.25em;"><use xlink:href="#Icon-unlink"></use></svg>
												<span class="u-hiddenVisually"><?php echo JText::_('TPL_ITALIAPA_UNTRUST_THIS_BROWSER'); ?></span>
												</a>
										</div>
									<?php endif; ?>
									<label id="secretkey-lbl" for="secretkey" class="Form-label">Secret Key</label>
									<span class="optional">(optional)</span>
								</div>
								<div class="controls">
									<input type="text" name="secretkey" id="secretkey" value="" autocomplete="one-time-code" class="Form-input Form-input" size="25"
									<?php echo $trusted ? 'readonly' : ''; ?>
									placeholder="<?php echo $trusted ? JText::_('PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER') : ''; ?>"
									aria-invalid="false">
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (JPluginHelper::isEnabled('twofactorauth', 'trust') && PlgTwofactorauthTrust::isActive()) : ?>
						<fieldset id="form-login-trust" class="Form-field Form-field--choose Grid-cell">
							<label class="Form-label" for="trust">
							<input type="checkbox" class="Form-input" id="trust" name="trust" value="yes"<?php echo $trusted ? ' checked onclick="return false;"' : ''; ?>>
							<span class="Form-fieldIcon" role="presentation"></span><?php echo JText::_('PLG_TWOFACTORAUTH_TRUST_TRUSTED_BROWSER'); ?></label>
						</fieldset>
					<?php endif; ?>
				</fieldset>

		 		<div class="Form-field Grid-cell u-textRight">
					<button type="submit" class="Button Button--default u-text-xs"><?php echo JText::_('JLOGIN'); ?></button>
				</div>

				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.login" />
				<input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</form>
		</div>
	</div>
</body>
</html>

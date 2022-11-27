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

defined('JPATH_BASE') or die;

$metadesc = $displayData['item']->metadesc ?: JFactory::getApplication()->get('MetaDesc');
$params = $displayData['params'];
?>

<style>
.Share {
  list-style-type: none;
  text-align: center;
  margin: 0;
  padding: 0;
}
<?php if ($params->get('show_icons')) : ?>
.Share li {
	display: inline-block;
	padding: 1em!important;
}
.Share li a {
	text-decoration: none!important;
	color: white;
}
<?php else: ?>
.Share li {
	padding-left: 1em!important;
	padding-right: 1em!important;
}
<?php endif; ?>
</style>

<a href="#share-options" data-menu-trigger="share-options" data-menu-placement="bottom center" class="Button Button--default u-text-r-xs u-linkClean"
	data-tooltip="<?php echo JText::_('JGLOBAL_SHARE') ?>" data-tooltip-position="top center">
	<?php if ($params->get('show_icons')) : ?>
		<span class="u-text-r-m Icon Icon-share"></span>
		<span class="u-hidden"><?php echo JText::_('JGLOBAL_SHARE') ?></span>
	<?php else: ?>
		<?php echo JText::_('JGLOBAL_SHARE') ?>
	<?php endif; ?>
</a>

<?php if ($params->get('show_icons')) : ?>
<div id="share-options" data-menu class="Dropdown-menu u-borderShadow-m u-borderRadius-m u-background-grey-80">
	<span class="Icon-drop-down Dropdown-arrow u-color-grey-80"></span>
	<ul class="Share">
<?php else: ?>
<div id="share-options" data-menu class="Dropdown-menu u-borderShadow-m u-background-white">
	<span class="Icon-drop-down Dropdown-arrow u-color-white"></span>
	<ul class="Share Linklist">
<?php endif; ?>
		<li role="menuitem"><a href="#" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(eshiol.location.href), '', 'width=800,height=600');"
			data-tooltip="<?php echo JText::_('JGLOBAL_SHARE_FACEBOOK_TOOLTIP') ?>" data-tooltip-position="bottom center">
			<?php if ($params->get('show_icons')) : ?>
				<span class="u-text-r-m Icon Icon-facebook"></span><span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_SHARE_FACEBOOK') ?></span>
			<?php else: ?>
				Facebook
			<?php endif; ?>
		</a></li>
		<li role="menuitem"><a href="#" onclick="javascript:window.open('https://t.me/share/url?url=' + encodeURIComponent(eshiol.location.href) + '&text=<?php echo urlencode($metadesc)?>', '', 'width=800,height=600');"
			data-tooltip="<?php echo JText::_('JGLOBAL_SHARE_TWITTER_TOOLTIP') ?>" data-tooltip-position="bottom center">
			<?php if ($params->get('show_icons')) : ?>
				<span class="u-text-r-m Icon Icon-twitter"></span><span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_SHARE_TWITTER') ?></span>
			<?php else: ?>
				Twitter
			<?php endif; ?>
		</a></li>
		<li role="menuitem"><a href="#" onclick="javascript:window.open('https://wa.me/?text=' + encodeURIComponent(eshiol.location.href), '', 'width=800,height=600');"
			data-tooltip="<?php echo JText::_('JGLOBAL_SHARE_WHATSAPP_TOOLTIP') ?>" data-tooltip-position="bottom center">
			<?php if ($params->get('show_icons')) : ?>
				<span class="u-text-r-m Icon Icon-whatsapp"></span><span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_SHARE_WHATSAPP') ?></span>
			<?php else: ?>
				Whatsapp
			<?php endif; ?>
		</a></li>
		<li role="menuitem"><a href="#" onclick="javascript:window.open('https://telegram.me/share/url?url=' + encodeURIComponent(eshiol.location.href), '', 'width=800,height=600');"
			data-tooltip="<?php echo JText::_('JGLOBAL_SHARE_TELEGRAM_TOOLTIP') ?>" data-tooltip-position="bottom center">
			<?php if ($params->get('show_icons')) : ?>
				<span class="u-text-r-m Icon Icon-telegram"></span><span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_SHARE_TELEGRAM') ?></span>
			<?php else: ?>
				Telegram
			<?php endif; ?>
		</a></li>
		<?php
		    JLoader::register('MailtoHelper', JPATH_SITE . '/components/com_mailto/helpers/mailto.php');
		
		    $link     = JUri::getInstance()->toString(array('scheme', 'host', 'port')) . JRoute::_(ContentHelperRoute::getArticleRoute($displayData['item']->slug, $displayData['item']->catid, $displayData['item']->language), false);
		    $url      = 'index.php?option=com_mailto&tmpl=component&template=italiapa&link=' . MailtoHelper::addLink($link);

		    if ($params->get('show_icons')) :
				$text     = '<span class="u-text-r-m Icon Icon-mail"></span><span class="u-hiddenVisually">' . JText::_('JGLOBAL_EMAIL') . '</span>';
			else:
			$text     = JText::_('JGLOBAL_EMAIL');
			endif;
				
			$status   = 'width=400,height=568,menubar=yes,resizable=yes';
			$attribs  = array(
			    //'class'   => 'Button Button--default u-text-r-xs u-linkClean',
				'data-tooltip' => JText::_('JGLOBAL_EMAIL_TITLE'),
				'onclick' => "window.open(this.href,'win2','" . $status . "'); return false;",
				'rel'     => 'nofollow'
		    );
		?>
		<li role="menuitem"><?php echo JHtml::_('link', JRoute::_($url), $text, $attribs); ?></li>
	</ul>
</div>

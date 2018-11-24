<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

$uri  = JUri::getInstance();
$base = $uri->toString(array('scheme', 'host', 'port'));

$url = ContentHelperRoute::getArticleRoute($displayData['item']->slug, $displayData['item']->catid, $displayData['item']->language);
if (!JPluginHelper::isEnabled('content', 'shorturl'))
{
    $url  = $base . JRoute::_($url, true);
}
elseif (!file_exists(JPATH_PLUGINS . '/content/shorturl/helpers/shorturl.php'))
{
    $url  = $base . JRoute::_($url, true);
}
else
{
    require_once JPATH_PLUGINS . '/content/shorturl/helpers/shorturl.php';
    $shortlink = ShorturlHelper::getShortUrl($url, $displayData['item']->language);
    $url = (ShorturlHelper::urlExists($shortlink) ? JURI::root() . ltrim($shortlink, '/') : JRoute::_($url, true, -1));
}

$metadesc = $displayData['item']->metadesc ?: JFactory::getApplication()->get('MetaDesc');
?>
<div class="Share Button" style="position:static!important;border:none!important;">
<div class="Share-reveal js-Share">
<a href="#share-options" class="Share-revealText" data-menu-trigger="share-options" data-menu-inline="" aria-controls="share-options" aria-haspopup="true" role="button">
<span class="Share-revealIcon Icon Icon-share"></span>
Condividi
</a>
</div>

<ul id="share-options" class="Dropdown-menu" data-menu="" role="menu" aria-hidden="true">
<li role="menuitem"><a href="#" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url)?>', '', 'width=800,height=600');"><span class="Icon Icon-facebook"></span><span class="u-hiddenVisually">Facebook</span></a></li>
<li role="menuitem"><a href="#" onclick="javascript:window.open('https://www.twitter.com/share?text=<?php echo urlencode($metadesc)?>&url=<?php echo urlencode($url)?>', '', 'width=800,height=600');"><span class="Icon Icon-twitter"></span><span class="u-hiddenVisually">Twitter</span></a></li>
<li role="menuitem"><a href="#" onclick="javascript:window.open('https://plus.google.com/share?url=<?php echo urlencode($url)?>', '', 'width=800,height=600');"><span class="Icon Icon-googleplus"></span><span class="u-hiddenVisually">Google Plus</span></a></li>
<li role="menuitem"><a href="#" onclick="javascript:window.open('https://api.whatsapp.com/send?phone=whatsappphonenumber&text=<?php echo urlencode($url)?>', '', 'width=800,height=600');"><span class="Icon Icon-whatsapp"></span><span class="u-hiddenVisually">Whatsapp</span></a></li>
<li role="menuitem"><a href="#" onclick="javascript:window.open('https://telegram.me/share/url?url=<?php echo urlencode($url)?>', '', 'width=800,height=600');"><svg class="Icon Icon-telegram"><use xlink:href="#Icon-telegram"></use></svg><span class="u-hiddenVisually">Telegram</span></a></li>
<!-- 
<li role="menuitem"><a href="#" onclick="javascript:alert('Funzione non supportata');"><span class="Icon Icon-youtube"></span><span class="u-hiddenVisually">Youtube</span></a></li>
<li role="menuitem"><a href="#" onclick="javascript:alert('Funzione non supportata');"><span class="Icon Icon-flickr"></span><span class="u-hiddenVisually">Flickr</span></a></li>
<li role="menuitem"><a href="#" onclick="javascript:alert('Funzione non supportata');"><span class="Icon Icon-slideshare"></span><span class="u-hiddenVisually">Slideshare</span></a></li>
-->
<?php
    JLoader::register('MailtoHelper', JPATH_SITE . '/components/com_mailto/helpers/mailto.php');

	$template = JFactory::getApplication()->getTemplate();
	$link     = $base . JRoute::_(ContentHelperRoute::getArticleRoute($displayData['item']->slug, $displayData['item']->catid, $displayData['item']->language), false);
	$url      = 'index.php?option=com_mailto&tmpl=component&template=' . $template . '&link=' . MailtoHelper::addLink($link);

	$text     = '<span class="u-text-r-m Icon Icon-mail"></span><span class="u-hiddenVisually">Email</span>';
	
	$status   = 'width=400,height=568,menubar=yes,resizable=yes';
	$attribs  = array(
	    //'class'   => 'Button Button--default u-text-r-xs u-linkClean',
		'title'   => JText::_('JGLOBAL_EMAIL_TITLE'),
		'onclick' => "window.open(this.href,'win2','" . $status . "'); return false;",
		'rel'     => 'nofollow'
    );
?>
<li role="menuitem"><?php echo JHtml::_('link', JRoute::_($url), $text, $attribs); ?></li>

</ul>
</div>

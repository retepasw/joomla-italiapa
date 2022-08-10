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

JFactory::getLanguage()->load('com_content');
?>
<div class="Grid Grid--withGutterM">
	<?php if (($n = $params->get('bootstrap_size', 0)) == 0) : ?>
		<?php $n = min(6, max(3, count($list))); // minimo 3 cards massimo 6 per riga ?>
	<?php endif; ?>
	<?php foreach ($list as $item) : ?>
    	<div class="Grid-cell u-md-size1of<?php echo $n; ?> u-lg-size1of<?php echo $n; ?> u-flex u-margin-r-bottom u-flexJustifyCenter">
    		<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_card'); ?>
    	</div>
	<?php endforeach; ?>
</div>
<?php
if ($params->get('showLastSeparator') && is_array($params->get('catid')) && (count($params->get('catid')) == 1)) :
	$link = ContentHelperRoute::getCategoryRoute($params->get('catid')[0]);
	foreach($params->get('tag', array()) as $k => $tag) :
		$link .= '&filter_tag[' . $k . ']=' . $tag;
	endforeach;
	$link = JRoute::_($link);
	echo JLayoutHelper::render('eshiol.content.readall', array('params' => $params, 'link' => $link));
endif;
		
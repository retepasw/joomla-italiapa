<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
JLog::add(new JLogEntry(print_r($params, true), JLog::DEBUG, 'tpl_italiapa'));

JFactory::getLanguage()->load('com_content');
?>
<div class="u-background-compl-10 u-layout-centerContent u-padding-r-top <?php echo $moduleclass_sfx; ?>">
	<section class="u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom">
		<?php if ((bool) $module->showtitle) :?>
			<h2 id="news<?php echo $module->id?>" class="u-layout-centerLeft u-text-r-s">
				<span class="u-color-50 u-text-h3"><?php echo $module->title; ?></span>
			</h2>
		<?php endif; ?>
		<div class="Grid Grid--withGutterM">
			<?php
			if (($n = $params->get('bootstrap_size', 0)) == 0)
			{
				// minimo 3 cards massimo 6 per riga
				$n = min(6, max(3, count($list)));
			}
			foreach ($list as $item) : ?>
			<div class="Grid-cell u-md-size1of<?php echo $n; ?> u-lg-size1of<?php echo $n; ?> u-flex u-margin-r-bottom u-flexJustifyCenter">
				<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_card'); ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
		if ($params->get('showLastSeparator') && is_array($params->get('catid')) && (count($params->get('catid')) == 1))
		{
			$link = ContentHelperRoute::getCategoryRoute($params->get('catid')[0]);			
			foreach($params->get('tag', array()) as $k => $tag)
			{
				$link .= '&filter_tag[' . $k . ']=' . $tag;
			}
			$link = JRoute::_($link);
			echo JLayoutHelper::render('eshiol.content.readall', array('params' => $params, 'link' => $link));
		}
		?>
	</section>
</div>

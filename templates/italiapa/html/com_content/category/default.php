<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

// Create shortcuts to some parameters.
$params  = $this->params;
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
		|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam);
?>


<?php if (JFactory::getApplication()->getTemplate(true)->params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
see <a href="https://italia.github.io/design-web-toolkit/components/detail/page--section.html">https://italia.github.io/design-web-toolkit/components/detail/page--section.html</a>
</div>
<?php endif; ?>

<?php if (!$useDefList && $this->print) : ?>
	<div id="pop-print" class="u-hiddenPrint">
		<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
	</div>
	<div class="clearfix"> </div>
<?php endif; ?>
<?php if (!$this->print) : ?>
	<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
		<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
	<?php endif; ?>
<?php else : ?>
	<?php if ($useDefList) : ?>
		<div id="pop-print" class="u-hiddenPrint">
			<?php 
			$text = JLayoutHelper::render('joomla.content.icons.print_screen', array('params' => $params, 'legacy' => $legacy));
			echo '<a href="#" onclick="window.print();return false;" class="Button Button--default u-text-r-xs u-linkClean">' . $text . '</a>';
			?>
		</div>
	<?php endif; ?>
<?php endif; ?>

<?php $this->subtemplatename = 'articles'; ?>
<?php echo JLayoutHelper::render('joomla.content.category_default', $this); ?>

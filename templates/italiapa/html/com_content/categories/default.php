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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::_('behavior.caption');

?>
<?php if (JFactory::getApplication()->getTemplate(true)->params->get('debug') || defined('JDEBUG') && JDEBUG) : ?>
<div class="Prose Alert Alert--info Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom">
see <a href="https://italia.github.io/design-web-toolkit/components/detail/layout--masonry.html">
https://italia.github.io/design-web-toolkit/components/detail/layout--masonry.html
</a>
</div>
<?php endif; ?>
<div class="u-background-grey-20 u-layout-centerContent u-cf u-padding-r-top">
    <section class="js-Masonry-container u-layout-medium" data-columns>
	<?php
		echo $this->loadTemplate('items');
	?>
	</section>
</div>
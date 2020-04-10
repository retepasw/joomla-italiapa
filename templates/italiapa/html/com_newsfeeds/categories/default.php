<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::_('behavior.caption');
JHtml::_('behavior.core');

?>
<section class="u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom categories-list<?php echo $this->pageclass_sfx; ?>">
	<div class="u-padding-r-top u-padding-r-bottom"><div class="u-text-r-s">
		<?php echo JLayoutHelper::render('joomla.content.categories_default', $this); ?>
    </div></div>
    <div class="Grid Grid--withGutterM">
   		<?php echo $this->loadTemplate('items'); ?>
	</div>
</section>

<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::_('behavior.caption');
JHtml::_('behavior.core');

$this->levelcat = $this->parent->level;
?>

<div class="u-layout-wide u-layoutCenter u-padding-all-l categories-list<?php echo $this->pageclass_sfx; ?>">
	<div class="organigramma-lev1">
		<div class="Grid">
			<?php // echo JLayoutHelper::render('joomla.content.categories_default', $this); ?>
			<?php echo $this->loadTemplate('items'); ?>		
		</div>
	</div>
</div>

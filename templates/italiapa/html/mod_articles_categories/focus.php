<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 *
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2021 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

$moduleclass_sfx = explode(' ', $params->get('moduleclass_sfx'));
$responsiveClass = '';
for ($i = count($moduleclass_sfx) - 1; $i >= 0; $i--)
{
	if ((substr($moduleclass_sfx[$i], 0, 6) == 'u-size') || (substr($moduleclass_sfx[$i], 4, 5) == '-size'))
	{
		$responsiveClass .= ' ' . $moduleclass_sfx[$i];
		unset($moduleclass_sfx[$i]);
	}
}
$moduleclass_sfx = (substr($params->get('moduleclass_sfx'), 0, 1) == ' ' ? ' ' : '') . implode(' ', $moduleclass_sfx);
?>

<div class="u-layout-centerContent u-padding-r-top">
    <section class="u-layout-wide u-text-r-s u-padding-r-all">
		<?php require JModuleHelper::getLayoutPath('mod_articles_categories', 'focus_items'); ?>
		<?php $link = JRoute::_(ContentHelperRoute::getCategoryRoute($params->get('parent', 'root'))); ?>
		<?php echo JLayoutHelper::render('eshiol.content.readall', array('params' => $params, 'link' => $link)); ?>
	</section>
</div>

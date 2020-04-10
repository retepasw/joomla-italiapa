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

use Joomla\CMS\HTML\HTMLHelper;

/**
JHtml::_('stylesheet', 'mod_languages/template.css', array('version' => 'auto', 'relative' => true));

if ($params->get('dropdown', 1) && !$params->get('dropdownimage', 0))
{
	JHtml::_('formbehavior.chosen');
}
*/
?>
<div class="mod-languages<?php echo $moduleclass_sfx; ?>">
<?php if ($headerText) : ?>
	<div class="pretext"><p><?php echo $headerText; ?></p></div>
<?php endif; ?>

<?php if ($params->get('dropdown', 1)) : ?>
	<a href="#languages_<?php echo $module->id; ?>" data-menu-trigger="languages_<?php echo $module->id; ?>" class="Header-language u-border-none u-zindex-max u-inlineBlock" aria-controls="languages" aria-haspopup="true" role="button">
		<span class="u-hiddenVisually"><?php echo JText::_('MOD_LANGUAGES_FIELD_ACTIVE_LABEL'); ?>:</span>
	<?php foreach ($list as $language) : ?>
		<?php if ($language->active) : ?>
			<?php if ($params->get('dropdownimage', 0) && $language->image) : ?>
				<?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, null, true) . '&nbsp;'; ?>
			<?php endif; ?>
			<?php if ($params->get('full_name', 1)) : ?>
			<span class=""><?php echo $language->title_native; ?></span>
			<?php else : ?>
			<span class=""><?php echo strtoupper($language->sef); ?></span>
			<!-- <span class="u-hidden u-md-inlineBlock u-lg-inlineBlock"><?php echo $language->title_native; ?></span> -->
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
		<span class="Icon Icon-expand u-padding-left-xs"></span>
	</a>
	<div id="languages_<?php echo $module->id; ?>" data-menu="" class="Dropdown-menu Header-language-other u-jsVisibilityHidden u-nojsDisplayNone" x-placement="bottom" role="menu" aria-hidden="true" style="position: absolute; transform: translate3d(1323px, -245px, 0px); top: 0px; left: 0px; will-change: transform;">
		<span class="Icon-drop-down Dropdown-arrow u-color-white" style="left: 58px;"></span>
		<ul>
		<?php foreach ($list as $language) : ?>
			<?php if (!$language->active || $params->get('show_active', 0)) : ?>
				<li role="menuitem" class=""><a href="<?php echo $language->link; ?>" class="u-padding-r-all<?php echo $language->active ? ' lang-active' : ''; ?>"><span lang="<?php echo strtoupper($language->sef); ?>">
				<?php if ($params->get('dropdownimage', 0) && $language->image) : ?>
					<?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, null, true) . '&nbsp;'; ?>
				<?php endif; ?>
				<?php echo $language->title_native; ?></span></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul>
	</div>
<?php else : ?>
	<div id="languages_<?php echo $module->id; ?>"<?php echo $params->get('inline', 1) ? ' class="Navscroll"': ''; ?>>
		<ul class="u-nbfc">
		<?php foreach ($list as $language) : ?>
			<?php if (!$language->active || $params->get('show_active', 0)) : ?>
				<li>
					<a href="<?php echo $language->link; ?>" class="u-color-white u-padding-top-xs u-padding-right-s u-padding-bottom-xs u-padding-left-s<?php echo $language->active ? ' lang-active' : ''; ?>"><span lang="<?php echo strtoupper($language->sef); ?>">
					<?php if ($params->get('image', 1) && $language->image) : ?>
						<?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, null, true) . '&nbsp;'; ?>
					<?php elseif ($params->get('full_name', 1)) : ?>
						<?php echo $language->title_native; ?>
					<?php else : ?>
						<?php echo strtoupper($language->sef); ?>
					<?php endif; ?>
					</span></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<?php if ($footerText) : ?>
	<div class="posttext"><p><?php echo $footerText; ?></p></div>
<?php endif; ?>
</div>

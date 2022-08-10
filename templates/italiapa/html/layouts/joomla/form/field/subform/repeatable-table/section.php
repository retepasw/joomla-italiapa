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

/**
 * Make thing clear
 *
 * @var JForm   $form       The form instance for render the section
 * @var string  $basegroup  The base group name
 * @var string  $group      Current group name
 * @var array   $buttons    Array of the buttons that will be rendered
 */
extract($displayData);

?>

<tr
	class="subform-repeatable-group subform-repeatable-group-<?php echo $unique_subform_id; ?>"
	data-base-name="<?php echo $basegroup; ?>"
	data-group="<?php echo $group; ?>"
>
	<?php foreach ($form->getGroup('') as $field) : ?>
	<td data-column="<?php echo strip_tags($field->label); ?>">
		<?php echo $field->renderField(array('hiddenLabel' => true)); ?>
	</td>
	<?php endforeach; ?>
	<?php if (!empty($buttons)) : ?>
	<td>
		<div class="Grid Grid--alignRight">
			<?php if (!empty($buttons['add'])) : ?>
				<a class="Grid-cell u-sizeFit u-linkClean u-margin-left-l u-margin-top-xs hasTooltip group-add group-add-<?php echo $unique_subform_id; ?>" data-title="<?php echo JText::_('JGLOBAL_FIELD_ADD'); ?>">
					<span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_FIELD_ADD'); ?></span>
					<svg class="Icon u-text-r-l u-margin-top-xs"><use xlink:href="#Icon-it-plus"></use></svg>
				</a>
			<?php endif; ?>
			<?php if (!empty($buttons['remove'])) : ?>
				<a href="#" class="Grid-cell u-sizeFit u-linkClean u-margin-left-l u-margin-top-xs hasTooltip group-remove group-remove-<?php echo $unique_subform_id; ?>" data-title="<?php echo JText::_('JGLOBAL_FIELD_REMOVE'); ?>">
					<span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_FIELD_REMOVE'); ?></span>
					<svg class="Icon u-text-r-l u-margin-top-xs"><use xlink:href="#Icon-it-minus"></use></svg>
				</a>
			<?php endif; ?>
			<?php if (!empty($buttons['move'])) : ?>
				<a href="#" class="Grid-cell u-sizeFit u-linkClean u-margin-left-l u-margin-top-xs hasTooltip group-move group-move-<?php echo $unique_subform_id; ?>" data-title="<?php echo JText::_('JGLOBAL_FIELD_MOVE'); ?>">
					<span class="u-hiddenVisually"><?php echo JText::_('JGLOBAL_FIELD_MOVE'); ?></span>
					<svg class="Icon u-text-r-l u-margin-top-xs"><use xlink:href="#Icon-it-maximize-alt"></use></svg>
				</a>
			<?php endif; ?>
		</div>
	</td>
	<?php endif; ?>
</tr>

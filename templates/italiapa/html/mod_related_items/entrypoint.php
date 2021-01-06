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
?>

<?php if (!empty($list)) : ?>
	<div class="relateditems<?php echo $moduleclass_sfx; ?>" itemscope itemtype="http://schema.org/ItemList">
		<?php $i = 1; ?>
		<?php foreach ($list as $item) : ?>
		    <div class="Entrypoint-item u-background-50" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<meta itemprop="position" content="<?php echo $i++; ?>"/>
				<a href="<?php echo $item->link; ?>" class="u-textClean u-text-h3 u-color-white" itemprop="url">
					<?php if ($showDate) : ?>
						<time datetime="<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>" itemprop="dateCreated">
							<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); ?>
						</time> -
					<?php endif; ?>
					<span itemprop="name">
						<?php echo $item->title; ?>
					</span>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif;

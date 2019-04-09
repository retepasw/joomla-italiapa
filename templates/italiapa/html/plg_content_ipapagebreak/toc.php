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

$app = JFactory::getApplication();
$baseurl = rtrim(JUri::root(), '/');
$template = $app->getTemplate();
?>
<!-- <div class="article-index link-list-wrapper"> -->
<div class="article-index u-sizeFull u-text-r-s u-color-70">

	<?php if ($headingtext) : ?>
	<!-- <h3><?php echo $headingtext; ?></h3> -->
	<h3 class="u-border-bottom-m"><span class="u-block u-text-h3 u-textClean u-color-60"><?php echo $headingtext; ?></span></h3>	
	<?php endif; ?>

	<!-- <ul class="link-list"> -->
	<ul class="Linklist Prose u-text-r-xs">
	<?php foreach ($list as $listItem) : ?>
		<?php $class = $listItem->liClass ? ' class="' . $listItem->liClass . '"' : ''; ?>
		<li<?php echo $class; ?>>
			<a href="<?php echo $listItem->link; ?>" class="list-item <?php echo $listItem->class; ?>">
				<?php echo $listItem->title; ?>
				<?php if ($listItem->title == JText::_('PLG_CONTENT_PAGEBREAK_ALL_PAGES')) : ?>
					<!-- <svg class="icon icon-sm icon-primary icon-right" aria-hidden="true">
						<use xlink:href="<?php echo $baseurl; ?>/media/tpl_italiapa4/svg/sprite.svg#it-arrow-right"></use>

					</svg> -->
					<span class="Icon Icon-chevron-right u-floatRight"></span>

				<?php endif; ?>

			</a>

		</li>

	<?php endforeach; ?>

	</ul>

</div>

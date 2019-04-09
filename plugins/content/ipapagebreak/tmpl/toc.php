<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagebreak
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
?>
<div class="pull-right article-index">

	<?php if ($headingtext) : ?>
	<h3><?php echo $headingtext; ?></h3>
	<?php endif; ?>

	<ul class="nav nav-tabs nav-stacked">
	<?php foreach ($list as $listItem) : ?>
		<?php $class = $listItem->liClass ? ' class="' . $listItem->liClass . '"' : ''; ?>
		<li<?php echo $class; ?>>
			<a href="<?php echo $listItem->link; ?>" class="<?php echo $listItem->class; ?>">
				<?php echo $listItem->title; ?>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
</div>

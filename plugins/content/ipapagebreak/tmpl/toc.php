<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	plg_content_ipapagebreak
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

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'plg_content_ipapagebreak'));
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

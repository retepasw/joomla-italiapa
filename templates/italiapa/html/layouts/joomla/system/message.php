<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.ItaliaPA
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

defined('JPATH_BASE') or die;

$msgList = $displayData['msgList'];

?>
<div id="system-message-container">
	<?php if (is_array($msgList) && !empty($msgList)) : ?>
		<div id="system-message">
			<?php foreach ($msgList as $type => $msgs) : ?>
				<?php if ($type == 'message') $type = 'success'; ?>
				<div class="Prose Alert Alert--<?php echo $type; ?> Alert--withIcon u-padding-r-bottom u-padding-r-right u-margin-r-bottom" role="alert">
					<?php // This requires JS so we should add it trough JS. Progressive enhancement and stuff. ?>
					<a class="Button u-border-none u-floatRight" data-dismiss="alert"><span class="u-text-r-m Icon Icon-close"></span></a>

					<?php if (!empty($msgs)) : ?>
					<h2 class="u-text-h"><?php echo JText::_($type); ?></h2>
					<?php foreach ($msgs as $msg) : ?>
					<div class="u-text-p"><?php echo $msg; ?></div>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>

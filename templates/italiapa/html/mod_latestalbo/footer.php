<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		https://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2019 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));
?>
<div>
	<ul class="latestnews<?php echo $moduleclass_sfx; ?>">
		<?php if (count($list)): ?>
			<?php foreach ($list as $item): ?>
				<li class="latestnews<?php echo $moduleclass_sfx; ?>">
					<?php if ((int) $params->get('show_catsez', 1)): ?>
						<?php echo $item->cat; ?><br/>
					<?php endif; ?>
					<a href="index.php?option=com_chronoforms5&amp;chronoform=atti_vista&amp;gcb=<?php echo $item->id; ?>" class="latestnews<?php echo $moduleclass_sfx; ?>">
					<?php echo $item->nome; ?></a><br/>
					<p class="u-text-r-xxs u-color-grey-30">da <?php echo date("d-m-Y",strtotime($item->datai))." a ".date("d-m-Y",strtotime($item->dataf)); ?>
				</li>
			<?php endforeach; ?>
		<?php else: ?>
			<li class="latestnews<?php echo $moduleclass_sfx; ?>">
				<p class="u-text-r-xxs u-color-grey-30">Nessun atto in pubblicazione</p>
			</li>
		<?php endif; ?>
		<?php if (isset($item->atti) && ($item->atti > (int) $params->get('count', 5 ))): ?>
			<li class="latestnews<?php echo $moduleclass_sfx; ?>">
				<a href="index.php?option=com_chronoconnectivity5&amp;cont=lists&amp;act=index&amp;ccname=albo_pretorio" class="latestnews<?php echo $moduleclass_sfx; ?>">
					<p class="u-text-r-xxs u-color-grey-30">Altri atti in pubblicazione</p>
				</a>
			</li>
		<?php endif; ?>
	</ul>
</div>
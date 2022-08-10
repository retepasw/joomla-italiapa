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
?>

<ul class="Linklist Prose u-text-r-xs latestnews<?php echo $moduleclass_sfx; ?>">
<?php if (count($list)>0) : ?>
	<?php foreach ($list as $item) : ?>
	<li itemscope itemtype="https://schema.org/Article"  class="latestnews<?php echo $moduleclass_sfx; ?>">
	    <?php if ( (int) $params->get('show_catsez', 1)==1) : ?>
		<span class="Dot u-background-50"></span>
		<strong>
		<span itemprop="genre" class="u-textClean u-textWeight-700 u-text-r-xs u-color-50"><?php echo $item->cat; ?></span>
		</strong>
		<?php endif; ?>
		<a href="index.php?option=com_chronoforms5&amp;chronoform=atti_vista&amp;gcb=<?php echo $item->id; ?>" class="latestnews<?php echo $moduleclass_sfx; ?>" itemprop="url">
			<span itemprop="name" class="u-text-r-xs <?php echo $moduleclass_sfx; ?>">
				<?php echo $item->nome; ?>
			</span>
		</a>
		<span class="u-text-r-xxs u-textSecondary u-textWeight-400 u-lineHeight-xl u-cf">
			da <time datetime="<?php echo date("c",strtotime($item->datai)); ?>" itemprop="datePublished"><?php echo date("d-m-Y",strtotime($item->datai)); ?></time>
			a <time datetime="<?php echo date("c",strtotime($item->dataf)); ?>" itemprop="expires"><?php echo date("d-m-Y",strtotime($item->dataf)); ?></time>
		</span>
	</li>
	<?php endforeach; ?>
<?php else : ?>
	<li class="latestnews<?php echo $moduleclass_sfx; ?>">Nessun atto in pubblicazione</li>
<?php endif; ?>

<?php if (isset($item->atti)) : ?>
	<?php if ($item->atti > ((int) $params->get('count', 5 ))) : ?>
	<li class="latestnews<?php echo $moduleclass_sfx; ?>">
		<span class="u-text-r-xs <?php echo $moduleclass_sfx; ?>">
			<a href="index.php?option=com_chronoconnectivity5&amp;cont=lists&amp;act=index&amp;ccname=albo_pretorio" class="latestnews<?php echo $moduleclass_sfx; ?>">Altri atti in pubblicazione</a>
      </span>
	</li>
	<?php endif; ?>
<?php endif; ?>
</ul>
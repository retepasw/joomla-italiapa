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

<?php if (!empty($list)) : ?>
	<?php
	$params = new JRegistry($module->params);
	$li_css = '';
	$tmp = explode(' ', $params->get('moduleclass_sfx'));
	for ($i = count($tmp) - 1; $i >= 0; $i--)
	{
		if ((substr($tmp[$i], 0, 6) == 'u-size') || (substr($tmp[$i], 4, 5) == '-size'))
		{
			$li_css = $tmp[$i] . ' ' . $li_css;
		}
	}
	?>
	<ul class="Grid Grid--withGutter mostread mod-list" itemscope itemtype="http://schema.org/ItemList">
		<?php $i = 1; ?>
		<?php foreach ($list as $item) : ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="<?php echo $li_css; ?>">
				<meta itemprop="position" content="<?php echo $i++; ?>"/>
				<a href="<?php echo $item->link; ?>" itemprop="url" class="Leads-link u-color-black">
					<span itemprop="name">
						<?php echo $item->title; ?>
					</span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif;

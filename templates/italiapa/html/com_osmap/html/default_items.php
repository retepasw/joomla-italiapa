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

<?php if ($this->debug) : ?>
    <div class="osmap-debug-sitemap">
        <h1><?php echo JText::_('COM_OSMAP_DEBUG_ALERT_TITLE'); ?></h1>
        <p><?php echo JText::_('COM_OSMAP_DEBUG_ALERT'); ?></p>
        <?php echo JText::_('COM_OSMAP_SITEMAP_ID'); ?>: <?php echo $this->sitemap->id; ?>
    </div>
<?php endif; ?>

<section class="Grid Grid--withGutter u-padding-all-l osmap-items">
    <?php $this->sitemap->traverse(array($this, 'registerNodeIntoList')); ?>
    <?php // $this->renderSitemap(); ?>
    <?php
    	if (!empty($this->menus))
    	{
    		$columns = max((int)$this->params->get('columns', 1), 1);

    		foreach ($this->menus as $menuType => $menu)
    		{
    			echo '<div class="Grid-cell ' . 'u-md-size1of2 u-lg-size1of' . (JModuleHelper::getModules('right') ? '2' : '3') . '">';

    			if (isset($menu->menuItemTitle)
    				&& $this->showMenuTitles
    				&& !empty($menu->children))
    			{
    				if ($this->debug)
    				{
    					$debug = sprintf('<div><span>%s:</span>&nbsp;%s: %s</div>',
    						JText::_('COM_OSMAP_MENUTYPE'),
    						$menu->menuItemId,
    						$menu->menuItemType);
    				}

    				echo sprintf(
    					$this->titleTag,
    					\JApplicationHelper::stringURLSafe($menu->menuItemType),
    					$menu->menuItemTitle,
    					empty($debug) ? '' : $debug);
    			}

    			ob_start();
    			$this->printMenu($menu, $columns);
    			$text = ob_get_contents();
    			ob_end_clean();

    			echo $this->ulTag ? str_replace('<ul class="', $this->ulTag, $text) : $text;
    
    			echo '</div>';
    		}
    	}
    ?>
</section>

<?php if ($this->debug) : ?>
    <div class="osmap-debug-items-count">
        <?php echo JText::_('COM_OSMAP_SITEMAP_ITEMS_COUNT'); ?>: <?php echo $this->generalCounter; ?>
    </div>
<?php endif; ?>

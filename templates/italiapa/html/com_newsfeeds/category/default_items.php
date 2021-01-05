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

$n         = count($this->items);
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>
<?php if (empty($this->items)) : ?>
	<p><?php echo JText::_('COM_NEWSFEEDS_NO_ARTICLES'); ?></p>
<?php else : ?>
	<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString(), ENT_COMPAT, 'UTF-8'); ?>" method="post" name="adminForm" id="adminForm">
		<?php if ($this->params->get('filter_field') !== 'hide' || $this->params->get('show_pagination_limit')) : ?>
			<div class="Grid filters u-margin-r-bottom">
				<?php if ($this->params->get('filter_field') !== 'hide' && $this->params->get('filter_field') == '1') : ?>
    				<div class="Form-field Grid-cell u-sizeFull u-sm-size8of12 u-md-size9of12 u-lg-size10of12 u-border-right-xxs u-border-top-xxs">
    					<input class="Form-input u-text-r-s u-padding-r-all u-color-black" type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="Form-input u-color-grey-90" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_NEWSFEEDS_FILTER_DESC'); ?>" placeholder="<?php echo JText::_('COM_NEWSFEEDS_FILTER_LABEL'); ?>" />
    					<label class="Form-label u-color-grey-90 u-text-r-m u-hiddenVisually" for="filter-search">
    						<?php echo JText::_('COM_NEWSFEEDS_FILTER_LABEL'); ?>
    					</label>
					</div>
				<?php endif; ?>
    			<?php if ($this->params->get('show_pagination_limit')) : ?>
    				<div class="Form-field Grid-cell u-sizeFull u-sm-size4of12 u-md-size3of12 u-lg-size2of12 u-border-right-xxs u-border-top-xxs">
    					<label for="limit" class="Form-label u-hiddenVisually">
    						<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
    					</label>
    					<?php
    						echo str_replace(
    							'class="inputbox input-mini"',
    							'class="Form-input u-text-r-s u-padding-r-all u-color-grey-90 u-text-r-s u-padding-r-all"',
    							$this->pagination->getLimitBox()
    							);
    					?>
    				</div>
    			<?php endif; ?>
    		</div>
		<?php endif; ?>

		<div class="Grid Grid--withGutter">
			<?php foreach ($this->items as $i => $item) : ?>
	            <div class="Grid-cell u-md-size1of3 u-lg-size1of3 u-flex u-flexCol">
    	            <div class="Entrypoint-item u-background-50">
        	            <p><a class="u-textClean u-text-h3 u-color-white" href="<?php echo JRoute::_(NewsFeedsHelperRoute::getNewsfeedRoute($item->slug, $item->catid)); ?>">
							<?php echo $item->name; ?></a>
						<?php if ($this->params->get('show_articles')) : ?>
        					<span class="u-linkClean u-text-h3 u-color-white u-text-r-xxs u-textBreak">
        						<?php // echo JText::sprintf('COM_NEWSFEEDS_NUM_ARTICLES_COUNT', $item->numarticles); ?>
        						[<?php echo $item->numarticles; ?>]
        					</span>
						<?php endif; ?>
						</p>
						<?php if ($this->params->get('show_link')) : ?>
        					<?php $link = JStringPunycode::urlToUTF8($item->link); ?>
        					<p><a class="u-textClean u-text-h3 u-color-white u-text-r-xxs u-textBreak" href="<?php echo $item->link; ?>"><?php echo $link; ?></a></p>
						<?php endif; ?>
            	    </div>
	            </div>
           	<?php endforeach; ?>
		</div>

		<?php // Add pagination links ?>
		<?php if (!empty($this->items)) : ?>
			<?php if (($this->params->def('show_pagination', 2) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
				<div class="pagination">
					<?php if ($this->params->def('show_pagination_results', 1)) : ?>
						<p class="counter pull-right">
							<?php echo $this->pagination->getPagesCounter(); ?>
						</p>
					<?php endif; ?>
					<?php echo $this->pagination->getPagesLinks(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</form>
<?php endif; ?>

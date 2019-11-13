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

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

JHtml::_('bootstrap.tooltip');

$lang  = JFactory::getLanguage();

/**
JFactory::getDocument()->addStyleDeclaration('
.Card-image img {
    position: relative; // allows repositioning 
    left: 100%; // move the whole width of the image to the right 
    margin-left: -200%; // magic! 
    top: 100%; // move the whole width of the image to the right 
    margin-top: -200%; // magic! 
}

.Card-image { 
	// whatever the dimensions you want the "cropped" image to be 
	height: 220px;
	max-width: 400px;
	overflow: hidden;
	margin: 0 auto;
}
		
.Card-image img.square {
	width: 100%;  
	left: 0;
	margin-left: 0;
	top: 0;
	margin-top: 0;
	-ms-interpolation-mode: bicubic; // Scaled images look a bit better in IE now 
}

.Card-image img.portrait {
	width: 100%;
	height: auto;
	left: 0;
	top: 0;
	margin-left: 0;
	-ms-interpolation-mode: bicubic; // Scaled images look a bit better in IE now 
}

.Card-image img.landscape {
	height: 100%;
	width: auto;
	left: 0;
	top: 0;
	margin-top: 0;
	-ms-interpolation-mode: bicubic; // Scaled images look a bit better in IE now 
}
');
			
JFactory::getDocument()->addScriptDeclaration('
jQuery(document).ready(function(){
	jQuery(\'.Card-image img\').each(function() {  
		var h = jQuery(this).height(),
			w = jQuery(this).width();

		if (h > w) {
			// pic is portrait
			jQuery(this).addClass(\'portrait\');
			var m = -(jQuery(this).height() - jQuery(this).parent().height()) / 2; //math the negative margin
			jQuery(this).css(\'margin-top\', m + \'px\');
		} else if(w > h) {
			// pic is landscape
			jQuery(this).addClass(\'landscape\');
			console.log(jQuery(this).width());
			console.log(jQuery(this).parent().width());
			var m = -(jQuery(this).width() - jQuery(this).parent().width()) / 2; //math the negative margin
			jQuery(this).css(\'margin-left\', m + \'px\');
			jQuery(this).parent().width(\'100%\');
		} else {
			// pic is square
			jQuery(this).addClass(\'square\');
		}
	});    
});
');
*/

if (count($this->items[$this->parent->id]) > 0) :
	foreach ($this->items[$this->parent->id] as $id => $item) :
		if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) :
?>
<div class="Masonry-item js-Masonry-item">
	<div class="u-nbfc u-borderShadow-xxs u-borderRadius-m u-color-grey-30 u-background-white">
		<?php if ($this->params->get('show_description_image') && $item->getParams()->get('image')) : ?>
		<img src="<?php echo $item->getParams()->get('image'); ?>" 
			alt="<?php echo htmlspecialchars($item->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8'); ?>"
			class="u-sizeFull"
			/>
		<?php endif; ?>
		<div class="u-text-r-l u-padding-r-all u-layout-prose">
		<!--
		<p class="u-text-h6 u-margin-bottom-l"><a class="u-color-50 u-textClean" href="">sed vel itaque</a></p>
        -->
		<h3 class="u-text-h4 u-margin-r-bottom">
			<?php $pattern = '/<svg[\s>].*<\/svg>/is';
			preg_match($pattern, $item->description, $matches);
			if (is_array($matches) && !empty($matches)) :
				$item->description = preg_replace($pattern, '', $item->description, 1);
				echo $matches[0];
			endif; ?>
			<a class="u-text-r-m u-color-black u-textWeight-400 u-textClean" href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language)); ?>">
				<?php echo $this->escape($item->title); ?>
			</a>
		</h3>
		<?php if ($this->params->get('show_subcat_desc_cat') == 1) : ?>
			<?php if ($item->description) : ?>
				<div class="u-text-p u-textSecondary">
					<?php echo JHtml::_('content.prepare', $item->description, '', 'com_content.categories'); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		</div>
	</div>
</div>
<?php 
		endif;
	endforeach;
endif;
?>
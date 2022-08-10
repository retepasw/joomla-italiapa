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

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';
?>
<?php if (!empty($this->msg)) : ?>
	<?php echo $this->msg; ?>
<?php else : ?>
	<?php $lang      = JFactory::getLanguage(); ?>
	<?php $myrtl     = $this->newsfeed->rtl; ?>
	<?php $direction = ' '; ?>
	<?php $isRtl     = $lang->isRtl(); ?>
	<?php if ($isRtl && $myrtl == 0) : ?>
		<?php $direction = ' redirect-rtl'; ?>
	<?php elseif ($isRtl && $myrtl == 1) : ?>
		<?php $direction = ' redirect-ltr'; ?>
	<?php elseif ($isRtl && $myrtl == 2) : ?>
		<?php $direction = ' redirect-rtl'; ?>
	<?php elseif ($myrtl == 0) : ?>
		<?php $direction = ' redirect-ltr'; ?>
	<?php elseif ($myrtl == 1) : ?>
		<?php $direction = ' redirect-ltr'; ?>
	<?php elseif ($myrtl == 2) : ?>
		<?php $direction = ' redirect-rtl'; ?>
	<?php endif; ?>
	<?php $images = json_decode($this->item->images); ?>
    <div class=" u-background-compl-10 u-layout-centerContent u-padding-r-top">
        <section class="u-layout-wide u-layout-r-withGutter u-text-r-s u-padding-r-top u-padding-r-bottom">
    		<?php if (false && $this->params->get('display_num')) : ?>
    			<h1 class="<?php echo $direction; ?>">
    				<?php echo $this->escape($this->params->get('page_heading')); ?>
    			</h1>
    		<?php endif; ?>
    
			<h2 class="u-layout-centerLeft u-text-r-s">
    			<?php if ($this->item->published == 0) : ?>
    				<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
    			<?php endif; ?>
    			<a class="u-color-50 u-textClean u-text-h3" href="<?php echo $this->item->link; ?>" target="_blank">
    				<?php echo str_replace('&apos;', "'", $this->item->name); ?>
    			</a>
			</h2>

    		<?php if ($this->params->get('show_tags', 1)) : ?>
    			<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
    			<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
    		<?php endif; ?>

			<div class="Grid Grid--withGutterM u-margin-bottom-l">
        		<!-- Show Images from Component -->
            	<?php $image_first = (isset($images->image_first) && !empty($images->image_first) ? 
            	    '<img class="u-sizeFull"' . ($images->image_first_caption ? ' title="' . htmlspecialchars($images->image_first_caption, ENT_COMPAT, 'UTF-8') . '"' : '')
                	    . ' src="' . htmlspecialchars($images->image_first, ENT_COMPAT, 'UTF-8') .'" alt="' . htmlspecialchars($images->image_first_alt, ENT_COMPAT, 'UTF-8') .'" />'
                    : ''); ?>
				<?php $float_first = empty($images->float_first) ? $this->params->get('float_first') : $images->float_first; ?>
            	<?php $image_second = (isset($images->image_second) && !empty($images->image_second) ? 
            	    '<img class="u-sizeFull"' . ($images->image_second_caption ? ' title="' . htmlspecialchars($images->image_second_caption, ENT_COMPAT, 'UTF-8') . '"' : '')
                	    . ' src="' . htmlspecialchars($images->image_second, ENT_COMPAT, 'UTF-8') .'" alt="' . htmlspecialchars($images->image_second_alt, ENT_COMPAT, 'UTF-8') .'" />'
                    : ''); ?>
            	<?php $float_second = empty($images->float_second) ? $this->params->get('float_second') : $images->float_second; ?>

        		<!-- Show first Image from Component -->
				<?php if (!empty($image_first)) : ?>
					<?php if ($float_first == 'left') : ?>
	           			<div class="Grid-cell u-sizeFull u-md-size1of3 u-lg-size1of3 u-text-r-s">
	           				<?php echo $image_first; ?>
	           			</div>
					<?php elseif ($float_first == 'none') : ?>
	           			<div class="Grid-cell u-sizeFull <?php echo (empty($image_second) ? 'u-md-size1of2 u-lg-size1of2' : 'u-md-size1of3 u-lg-size1of3'); ?> u-text-r-s">
	           				<?php echo $image_first; ?>
	           			</div>
					<?php endif; ?>	           
				<?php endif; ?>

        		<!-- Show second Image from Component -->
				<?php if (!empty($image_second)) : ?>
					<?php if ($float_second == 'left') : ?>
	           			<div class="Grid-cell u-sizeFull <?php echo (empty($image_first) ? 'u-md-size1of2 u-lg-size1of2' : 'u-md-size1of3 u-lg-size1of3'); ?> u-text-r-s">
	           				<?php echo $image_second; ?>
	           			</div>
					<?php endif; ?>	           
				<?php endif; ?>	           

           		<!-- Show Description from Component -->
				<?php if (!empty($image_first) && !empty($image_second)) : ?>
					<?php $size = 'u-md-size1of3 u-lg-size1of3'; ?>
				<?php elseif (!empty($image_first)) : ?>
					<?php if ($float_second == 'left') : ?>
						<?php $size = 'u-md-size2of3 u-lg-size2of3'; ?>
					<?php else : ?>
						<?php $size = 'u-md-size1of2 u-lg-size1of2'; ?>
					<?php endif; ?>
				<?php elseif (!empty($image_second)) : ?>
					<?php if ($float_second == 'right') : ?>
						<?php $size = 'u-md-size2of3 u-lg-size2of3'; ?>
					<?php else : ?>
						<?php $size = 'u-md-size1of2 u-lg-size1of2'; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php $size = 'u-md-size1of3 u-lg-size1of3'; ?>
				<?php endif; ?>
       			<div class="Grid-cell u-sizeFull <?php echo $size; ?>">
        			<div class="u-text-r-s u-layout-prose">
        				<div class="u-textSecondary u-lineHeight-l">
                    		<?php echo $this->item->description; ?>
                    	</div>
                    </div>
				</div>

        		<!-- Show first Image from Component -->
				<?php if (!empty($image_first)) : ?>
					<?php if ($float_first == 'right') : ?>
	           			<div class="Grid-cell u-sizeFull <?php echo (empty($image_second) ? 'u-md-size1of2 u-lg-size1of2' : 'u-md-size1of3 u-lg-size1of3'); ?> u-text-r-s">
	           				<?php echo $image_first; ?>
	           			</div>
					<?php endif; ?>	           
				<?php endif; ?>	           

        		<!-- Show second Image from Component -->
				<?php if (!empty($image_second)) : ?>
					<?php if ($float_second == 'right') : ?>
	           			<div class="Grid-cell u-sizeFull u-md-size1of3 u-lg-size1of3 u-text-r-s">
	           				<?php echo $image_second; ?>
	           			</div>
					<?php elseif ($float_second == 'none') : ?>
	           			<div class="Grid-cell u-sizeFull <?php echo (empty($image_first) ? 'u-md-size1of2 u-lg-size1of2' : 'u-md-size1of3 u-lg-size1of3'); ?> u-text-r-s">
	           				<?php echo $image_second; ?>
	           			</div>
					<?php endif; ?>	           
				<?php endif; ?>

				<div class="Grid-cell u-sizeFull<?php echo (isset($this->rssDoc->image, $this->rssDoc->imagetitle) && $this->params->get('show_feed_image') ? ' u-md-size1of2 u-lg-size1of2' : ''); ?> u-text-r-s">
            		<!-- Show Feed's Description -->
            		<?php if ($this->params->get('show_feed_description')) : ?>
           				<?php echo str_replace('&apos;', "'", $this->rssDoc->description); ?>
            		<?php endif; ?>
            		<!-- Show Image -->
            		<?php if (isset($this->rssDoc->image, $this->rssDoc->imagetitle) && $this->params->get('show_feed_image')) : ?>
    					</div>
               			<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2 u-text-r-s">
    	       				<img src="<?php echo $this->rssDoc->image; ?>" alt="<?php echo $this->rssDoc->image->decription; ?>" />
            		<?php endif; ?>
				</div>
			</div>

    		<!-- Show items -->    
    		<?php if (!empty($this->rssDoc[0])) : ?>
    			<div class="Grid Grid--withGutterM">
    				<?php for ($i = 0; $i < $this->item->numarticles; $i++) : ?>
    					<?php if (empty($this->rssDoc[$i])) : ?>
    						<?php break; ?>
    					<?php endif; ?>
    					<?php $uri  = $this->rssDoc[$i]->uri || !$this->rssDoc[$i]->isPermaLink ? trim($this->rssDoc[$i]->uri) : trim($this->rssDoc[$i]->guid); ?>
    					<?php $uri  = !$uri || stripos($uri, 'http') !== 0 ? $this->item->link : $uri; ?>
    					<?php $text = $this->rssDoc[$i]->content !== '' ? trim($this->rssDoc[$i]->content) : ''; ?>
                        <div class="Grid-cell u-md-size1of3 u-lg-size1of3 u-flex u-margin-r-bottom u-flexJustifyCenter">
	                        <div class="u-nbfc u-borderShadow-xxs u-borderRadius-m u-color-grey-30 u-background-white u-sizeFull">
        						<?php if ($this->params->get('show_item_description') && $text !== '') : ?>
    								<?php if ($this->params->get('show_feed_image', 0) == 1) : ?>
    									<?php echo JHtml::_('iwt.image', $text, array('class'=>"u-sizeFull")); ?>
    								<?php endif; ?>
								<?php endif; ?>
			                    <div class="u-text-r-l u-padding-r-all u-layout-prose">
               						<?php if ($this->params->get('show_item_description') && $text !== '') : ?>
    	       							<?php // JFactory::getApplication()->enqueueMessage(print_r($this->rssDoc[$i], true)); ?>
    
                                        <div class="Grid Grid--fit u-margin-r-bottom">
                                        	<?php foreach ($this->rssDoc[$i]->categories as $category => $v) : ?>
                                        		<p class="Grid-cell">
                                        			<span class="Dot u-background-50"></span>
                                        			<strong><span class="u-textClean u-text-r-xs u-color-50"><?php echo $category; ?></span></strong>
                                        		</p>
                                        	<?php endforeach; ?>
                                        	<p class="Grid-cell u-textSecondary">
                                        		<time datetime="<?php echo JHtml::_('date', $this->rssDoc[$i]->publishedDate, 'c'); ?>" itemprop="datePublished">
                                                	<?php echo JHtml::_('date', $this->rssDoc[$i]->publishedDate, JText::_('DATE_FORMAT_LC3')); ?>
                                        		</time>
                                        	</p>
                                        </div>
               						<?php endif; ?>

            						<?php if (!empty($uri)) : ?>
            							<h3 class="u-text-h4 u-margin-r-bottom">
            								<a class="u-text-r-m u-color-black u-textWeight-400 u-textClean" href="<?php echo htmlspecialchars($uri); ?>" target="_blank">
            									<?php echo trim($this->rssDoc[$i]->title); ?>
            								</a>
            							</h3>
            						<?php else : ?>
            							<h3 class="u-text-h4 u-margin-r-bottom u-text-r-m u-color-black u-textWeight-400 u-linkClean feed-link"><?php echo trim($this->rssDoc[$i]->title); ?></h3>
            						<?php endif; ?>
            
            						<?php if ($this->params->get('show_item_description') && $text !== '') : ?>
            							<div class="u-text-p u-textSecondary">
    										<?php $text = JFilterOutput::stripImages($text); ?>
    										<?php $text = JHtml::_('string.truncate', $text, $this->params->get('feed_character_count')); ?>
    										<?php echo str_replace('&apos;', "'", $text); ?>
    									</div>
            						<?php endif; ?>
            					</div>
    						</div>
    					</div>
    				<?php endfor; ?>
    			</div>
    		<?php endif; ?>
    	</section>
	</div>
<?php endif; ?>

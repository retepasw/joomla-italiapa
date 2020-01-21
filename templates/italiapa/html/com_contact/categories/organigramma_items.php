<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_BASE . '/templates/italiapa/src/html/iwt.php';

if ($this->maxLevelcat != 0 && count($this->items[$this->parent->id]) > 0) : ?>
	<?php $i = 1; ?>
	<?php $last = count($this->items[$this->parent->id]); ?>
	<?php foreach ($this->items[$this->parent->id] as $id => $item) : ?>
		<?php if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) : ?>
			<div class="Grid-cell u-md-size1of6 u-lg-size1of6 column-<?php echo $i; ?>">
				<div class="Grid organigramma-full">
					<div class="Grid-cell Cell-organigramma-empty">
						<?php 
						if ($i == 1) :
							$line = 'halfrightline';
						elseif ($i == $last) :
							$line = 'halfleftline';
						else :
							$line = 'rightleftline';
						endif;
						?>
						<div class="Organigramma Organigramma-verticalonly <?php echo $line; ?> halfdownline highlight">
							<div class="Organigramma-empty"></div>
						</div>
					</div>	
					<div class="Grid-cell">
						<?php $class = ''; ?>
						<?php if ($this->maxLevelcat > 1 && count($item->getChildren()) > 0) : ?>
							<?php foreach($item->getChildren() as $x) : ?>
								<?php if (count($x->getChildren()) > 0) : ?>
									<?php $class = ' Organigramma-multicol'; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>	
						<div class="Organigramma<?php echo $class; ?> updownline highlight">
							<div class="Organigramma-content">
								<div class="Organigramma-padding">
									<h3>
										<?php echo $this->escape($item->title); ?>
									</h3>
								</div>
							</div>
						</div>
					</div>
					<?php
					if ($this->maxLevelcat > 1 && count($item->getChildren()) > 0) :
						$this->items[$item->id] = $item->getChildren();
						$this->parent = $item;
						$this->maxLevelcat--;
						echo $this->loadTemplate('items_vertical');
						$this->parent = $item->getParent();
						$this->maxLevelcat++;
					endif;
					?>	
				</div>

				<div class="organigramma-mobile">
					<?php $guid = GUIDv4(); ?>
					<div class="Accordion Accordion-box fr-accordion js-fr-accordion" id="accordion-<?php echo $guid; ?>">
						<div class="Accordion-header js-fr-accordion__header fr-accordion__header" id="accordion-header-<?php echo $guid; ?>">
							<span class="Accordion-link u-text-r-s"><?php echo $this->escape($item->title); ?></span>
						</div>
						<div id="accordion-panel-<?php echo $guid; ?>" class="Accordion-panel fr-accordion__panel js-fr-accordion__panel">
							<?php if ($this->maxLevelcat > 1 && count($item->getChildren()) > 0) : ?>
								<?php
								$this->items[$item->id] = $item->getChildren();
								$this->parent = $item;
								$this->maxLevelcat--;
								echo $this->loadTemplate('items_mobile');
								$this->parent = $item->getParent();
								$this->maxLevelcat++;
								?>
							<?php endif; ?>	
                        </div>
                    </div>
				</div>
			</div>
		<?php endif; ?>
		<?php $i = $i + 1; ?>
	<?php endforeach; ?>
<?php endif; ?>

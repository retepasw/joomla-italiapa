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

// Create shortcut
$urls = json_decode($this->item->urls);

$class = "Button Button--default u-text-r-xs u-border-none";

// Create shortcuts to some parameters.
$params = $this->item->params;
if ($urls && (!empty($urls->urla) || !empty($urls->urlb) || !empty($urls->urlc))) :
?>

<div class="Grid u-margin-top-xxl">
	<?php
        $urlarray = array(
            array($urls->urla, $urls->urlatext, $urls->targeta, 'a'),
            array($urls->urlb, $urls->urlbtext, $urls->targetb, 'b'),
            array($urls->urlc, $urls->urlctext, $urls->targetc, 'c')
        );
        foreach ($urlarray as $url) :
            $link = $url[0];
            $label = $url[1];
            $target = $url[2];
            $id = $url[3];

            if (!$link) :
                continue;
            endif;

            // If no label is present, take the link
            $label = $label ?: $link;

            // If no target is present, use the default
            $target = $target ?: $params->get('target'.$id);
            ?>
            <div class="Grid-cell--center content-links-<?php echo $id; ?>">
            <?php
                // Compute the correct link

                switch ($target)
                {
                    case 1:
                        // open in a new window
                        echo '<a class="' . $class .'" href="' . htmlspecialchars($link, ENT_COMPAT, 'UTF-8') . '" target="_blank"  rel="nofollow noopener noreferrer">' .
                            htmlspecialchars($label, ENT_COMPAT, 'UTF-8') .'</a>';
                        break;

                    case 2:
                        // open in a popup window
                        $attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600';
                        echo '<a class="' . $class . '" href="' . htmlspecialchars($link, ENT_COMPAT, 'UTF-8') . '" onclick="window.open(this.href, \'targetWindow\', \'' . $attribs . '\'); return false;" rel="noopener noreferrer">' .
                            htmlspecialchars($label, ENT_COMPAT, 'UTF-8').'</a>';
                        break;
                    case 3:
                        // open in a modal window
                        JHtml::_('behavior.modal', 'a.modal');
                        echo '<a class="' . $class . ' modal" href="' . htmlspecialchars($link, ENT_COMPAT, 'UTF-8') . '"  rel="{handler: \'iframe\', size: {x:600, y:600}} noopener noreferrer">' .
                            htmlspecialchars($label, ENT_COMPAT, 'UTF-8') . ' </a>';
                        break;

                    default:
                        // open in parent window
                        echo '<a class="' . $class . '" href="' .  htmlspecialchars($link, ENT_COMPAT, 'UTF-8') . '" rel="nofollow">' .
                            htmlspecialchars($label, ENT_COMPAT, 'UTF-8') . ' </a>';
                        break;
                }
            ?>
            </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

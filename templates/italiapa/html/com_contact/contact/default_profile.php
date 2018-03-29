<?php
/**
 * @package		Template ItaliaPA
 * @subpackage	tpl_italiapa
 *
 * @author		Helios Ciancio <info@eshiol.it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017, 2018 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

JLog::add(new JLogEntry(__FILE__, JLog::DEBUG, 'tpl_italiapa'));

?>
<?php if (JPluginHelper::isEnabled('user', 'profile')) :
	$fields = $this->item->profile->getFieldset('profile'); ?>
	<div class="contact-profile" id="users-profile-custom">
		<dl class="dl-horizontal">
			<?php foreach ($fields as $profile) :
				if ($profile->value) :
					echo '<dt>' . $profile->label . '</dt>';
					$profile->text = htmlspecialchars($profile->value, ENT_COMPAT, 'UTF-8');

					switch ($profile->id) :
						case 'profile_website':
							$v_http = substr($profile->value, 0, 4);

							if ($v_http === 'http') :
								echo '<dd><a href="' . $profile->text . '">' . JStringPunycode::urlToUTF8($profile->text) . '</a></dd>';
							else :
								echo '<dd><a href="http://' . $profile->text . '">' . JStringPunycode::urlToUTF8($profile->text) . '</a></dd>';
							endif;
							break;

						case 'profile_dob':
							echo '<dd>' . JHtml::_('date', $profile->text, JText::_('DATE_FORMAT_LC4'), false) . '</dd>';
						break;

						default:
							echo '<dd>' . $profile->text . '</dd>';
							break;
					endswitch;
				endif;
			endforeach; ?>
		</dl>
	</div>
<?php endif; ?>

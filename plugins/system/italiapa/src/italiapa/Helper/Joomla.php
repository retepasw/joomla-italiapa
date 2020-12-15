<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  System.ItaliaPA
 *
 * @version		__DEPLOY_VERSION__
 *
 * @author		Helios Ciancio <info (at) eshiol (dot) it>
 * @link		http://www.eshiol.it
 * @copyright	Copyright (C) 2017 - 2020 Helios Ciancio. All Rights Reserved
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

namespace Italiapa\Helper;

class Joomla 
{
	// Create alias class for original call in $filepath, then overload the class
	public static function makeAlias($filepath, $originClassName, $aliasClassName) 
	{
		if (!is_file($filepath)) return false;
		$code = file_get_contents($filepath);
		$code = str_replace('class ' . $originClassName, 'class ' . $aliasClassName, $code);
		eval('?>'. $code);
		return true;
	}
}

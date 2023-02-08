/**
 * @package     Joomla.Site
 * @subpackage  Templates.ItaliaPA
 * 
 * @version     __DEPLOY_VERSION__
 *
 * @author      Helios Ciancio <info (at) eshiol (dot) it>
 * @link        https://www.eshiol.it
 * @copyright   Copyright (C) 2017 - 2023 Helios Ciancio. All rights reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL v3
 * Template ItaliaPA is free software. This version may have been modified
 * pursuant to the GNU General Public License, and as distributed it includes
 * or is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

const string2rgb = (c) => c.replace(/^(rgb|rgba)\(/,'').replace(/\)$/,'').replace(/\s/g,'').split(',').map(Number);

const getComputerBackgroundColor = (el) => document.defaultView.getComputedStyle(el, null).getPropertyValue('background-color');

const getComputerColor = (el) => document.defaultView.getComputedStyle(el, null).getPropertyValue('color');

function getBackgroundColor(el) {
	// bc = document.defaultView.getComputedStyle(el, null).getPropertyValue('background-color');
	bc = getComputerBackgroundColor(el);
	while ((document.body !== el) && isTransparent(bc)) {
		el = el.parentElement;
		// bc = document.defaultView.getComputedStyle(el, null).getPropertyValue('background-color');
		bc = getComputerBackgroundColor(el);
	}
	return bc;
};

function getColor(el) {
	// c = document.defaultView.getComputedStyle(el, null).getPropertyValue('color');
	c = getComputerColor(el);
	while ((document.body !== el) && isTransparent(c)) {
		el = el.parentElement;
		// c = document.defaultView.getComputedStyle(el, null).getPropertyValue('color');
		c = getComputerColor(el);
	}
	return c;
};

function isTransparent(color) {
	switch ((color || "").replace(/\s+/g, '').toLowerCase()) {
	case "transparent":
	case "":
	case "rgba(0,0,0,0)":
		return true;
	default:
		return false;
	}
}


// the following functions (lab2rgb, rgb2lab) are based off of the pseudocode
// found on www.easyrgb.com

function lab2rgb(lab){
	var y = (lab[0] + 16) / 116,
		x = lab[1] / 500 + y,
		z = y - lab[2] / 200,
		r, g, b;

	x = 0.95047 * ((x * x * x > 0.008856) ? x * x * x : (x - 16/116) / 7.787);
	y = 1.00000 * ((y * y * y > 0.008856) ? y * y * y : (y - 16/116) / 7.787);
	z = 1.08883 * ((z * z * z > 0.008856) ? z * z * z : (z - 16/116) / 7.787);

	r = x *  3.2406 + y * -1.5372 + z * -0.4986;
	g = x * -0.9689 + y *  1.8758 + z *  0.0415;
	b = x *  0.0557 + y * -0.2040 + z *  1.0570;

	r = (r > 0.0031308) ? (1.055 * Math.pow(r, 1/2.4) - 0.055) : 12.92 * r;
	g = (g > 0.0031308) ? (1.055 * Math.pow(g, 1/2.4) - 0.055) : 12.92 * g;
	b = (b > 0.0031308) ? (1.055 * Math.pow(b, 1/2.4) - 0.055) : 12.92 * b;

	return [Math.max(0, Math.min(1, r)) * 255, 
			Math.max(0, Math.min(1, g)) * 255, 
			Math.max(0, Math.min(1, b)) * 255]
}


function rgb2lab(rgb){
	var r = rgb[0] / 255,
		g = rgb[1] / 255,
		b = rgb[2] / 255,
		x, y, z;

	r = (r > 0.04045) ? Math.pow((r + 0.055) / 1.055, 2.4) : r / 12.92;
	g = (g > 0.04045) ? Math.pow((g + 0.055) / 1.055, 2.4) : g / 12.92;
	b = (b > 0.04045) ? Math.pow((b + 0.055) / 1.055, 2.4) : b / 12.92;

	x = (r * 0.4124 + g * 0.3576 + b * 0.1805) / 0.95047;
	y = (r * 0.2126 + g * 0.7152 + b * 0.0722) / 1.00000;
	z = (r * 0.0193 + g * 0.1192 + b * 0.9505) / 1.08883;

	x = (x > 0.008856) ? Math.pow(x, 1/3) : (7.787 * x) + 16/116;
	y = (y > 0.008856) ? Math.pow(y, 1/3) : (7.787 * y) + 16/116;
	z = (z > 0.008856) ? Math.pow(z, 1/3) : (7.787 * z) + 16/116;

	return [(116 * y) - 16, 500 * (x - y), 200 * (y - z)]
}

// calculate the perceptual distance between colors in CIELAB
// https://github.com/THEjoezack/ColorMine/blob/master/ColorMine/ColorSpaces/Comparisons/Cie94Comparison.cs

function deltaE(labA, labB){
	var deltaL = labA[0] - labB[0];
	var deltaA = labA[1] - labB[1];
	var deltaB = labA[2] - labB[2];
	var c1 = Math.sqrt(labA[1] * labA[1] + labA[2] * labA[2]);
	var c2 = Math.sqrt(labB[1] * labB[1] + labB[2] * labB[2]);
	var deltaC = c1 - c2;
	var deltaH = deltaA * deltaA + deltaB * deltaB - deltaC * deltaC;
	deltaH = deltaH < 0 ? 0 : Math.sqrt(deltaH);
	var sc = 1.0 + 0.045 * c1;
	var sh = 1.0 + 0.015 * c1;
	var deltaLKlsl = deltaL / (1.0);
	var deltaCkcsc = deltaC / (sc);
	var deltaHkhsh = deltaH / (sh);
	var i = deltaLKlsl * deltaLKlsl + deltaCkcsc * deltaCkcsc + deltaHkhsh * deltaHkhsh;

	return i < 0 ? 0 : Math.sqrt(i);
}

function component2hex(c) {
	var hex = c.toString(16);
	return hex.length == 1 ? "0" + hex : hex;
}

function rgb2hex(rgb) {
	return "#" + component2hex(rgb[0]) + component2hex(rgb[1]) + component2hex(rgb[2]);
}

function hex2rgb(hex) {
	var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);

	return result ? [
		parseInt(result[1], 16),
		parseInt(result[2], 16),
		parseInt(result[3], 16)
	] : null;
}

function invertColor(el) {
	fc = string2rgb(getColor(el));
	bc = string2rgb(getBackgroundColor(el));
	if (deltaE(rgb2lab(bc), rgb2lab(fc)) < 50) {
		el.style.cssText = 'filter:invert(1);' + el.style.cssText;
	}
}

function fixColor(el, c) {
	fc = string2rgb(getColor(el));
	bc = string2rgb(getBackgroundColor(el));
	if (deltaE(rgb2lab(bc), rgb2lab(fc)) < 50) {
		el.style.color = c;
	}
}

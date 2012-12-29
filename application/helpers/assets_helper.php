<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, pMachine, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Code Igniter Asset Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Nick Cernis | www.goburo.com
 */

// ------------------------------------------------------------------------

/**
 * Image tag helper
 *
 * Generates an img tag with a full base url to add images within your views.
 *
 * @access	public
 * @param	string	the image name
 * @param	mixed 	any attributes
 * @return	string
 */

function img($image_name, $attributes = '', $xhtml = FALSE) {
	if (is_array($attributes)) {
		$attributes = parse_tag_attributes($attributes);
	}

	$obj = & get_instance();
	$base = $obj->config->item('base_url');
	$img_folder = $obj->config->item('image_path');

	return '<img src="' . $base . $img_folder . $image_name . '"' . $attributes . ($xhtml == TRUE ? ' /' : '') . '>';
}

// ------------------------------------------------------------------------

/**
 * Stylesheets include helper
 *
 * Generates a link tag using the base url that points to an external stylesheet
 *
 * @access	public
 * @param	string	the stylesheet name - leave the '.css' off
 * @param	mixed 	any attributes
 * @return	string
 */

function css($stylesheet, $attributes = '') {
	if (is_array($attributes)) {
		$attributes = parse_tag_attributes($attributes);
	}
	$obj = & get_instance();
	$base = $obj->config->item('base_url');
	$style_folder = $obj->config->item('css_path');

	return '<link rel="stylesheet" type="text/css" href="' . $base . $style_folder . $stylesheet . '.css"' . $attributes . '>' . "\r\n";
}

// ------------------------------------------------------------------------

/**
 * Javascript include helper
 *
 * Generates a link tag using the base url that points to external javascript
 *
 * @access	public
 * @param	string	the javascript name - leave the '.js' off
 * @param	mixed 	any attributes
 * @return	string
 */

function js($javascript, $attributes = '') {
	if (is_array($attributes)) {
		$attributes = parse_tag_attributes($attributes);
	}
	$obj = & get_instance();
	$base = $obj->config->item('base_url');
	$jscript_folder = $obj->config->item('js_path');

	return '<script type="text/javascript" src="' . $base . $jscript_folder . $javascript . '.js"' . $attributes . '></script>' . "\r\n";
}

// ------------------------------------------------------------------------

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 * (duplicate from Rick Ellis' parse_url_attributes function in URL Helper.)
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
function parse_tag_attributes($attributes, $javascript = FALSE) {
	$att = '';
	foreach ($attributes as $key => $val) {
		if ($javascript == TRUE) {
			$att .= $key . '=' . $val . ',';
		} else {
			$att .= ' ' . $key . '="' . $val . '"';
		}
	}

	if ($javascript == TRUE) {
		$att = substr($att, 0, -1);
	}

	return $att;
}
<?php
/*
Plugin Name: HTML5 Search for WordPress
Plugin URI: http://thisismyurl.com/downloads/html5-search-for-wordpress/
Description: Replaces the built in WordPress search form with an HTML5 search form complete with auto lookup.
Author: Christopher Ross
Author URI: http://thisismyurl.com/
Version: 15.01
*/


/**
 * HTML5 Search for WordPress core file
 *
 * This file contains all the logic required for the plugin
 *
 * @link		http://wordpress.org/extend/plugins/html5-search-for-wordpress/
 *
 * @package 	HTML5 Search for WordPress
 * @copyright	Copyright (c) 2008, Chrsitopher Ross
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		HTML5 Search for WordPress 1.0
 */


/* if the plugin is called directly, die */
if ( ! defined( 'WPINC' ) )
	die;
	
	
define( 'THISISMYURL_HTML5_NAME', 'HTML5 Search for WordPress' );
define( 'THISISMYURL_HTML5_SHORTNAME', 'HTML5 Search' );

define( 'THISISMYURL_HTML5_FILENAME', plugin_basename( __FILE__ ) );
define( 'THISISMYURL_HTML5_FILEPATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'THISISMYURL_HTML5_FILEPATHURL', plugin_dir_url( __FILE__ ) );

define( 'THISISMYURL_HTML5_NAMESPACE', basename( THISISMYURL_HTML5_FILENAME, '.php' ) );
define( 'THISISMYURL_HTML5_TEXTDOMAIN', str_replace( '-', '_', THISISMYURL_HTML5_NAMESPACE ) );

define( 'THISISMYURL_HTML5_VERSION', '15.01' );

include_once( 'thisismyurl-common.php' );



/**
 * Creates the class required for HTML5 Search for WordPress
 *
 * @author     Christopher Ross <info@thisismyurl.com>
 * @version    Release: @15.01@
 * @see        wp_enqueue_scripts()
 * @since      Class available since Release 15.01
 *
 */
if( ! class_exists( 'thissimyurl_HTML5SearchforWordPress' ) ) {
class thissimyurl_HTML5SearchforWordPress extends thisismyurl_Common_HTML5 {

	/**
	  * Standard Constructor
	  *
	  * @access public
	  * @static
	  * @uses http://codex.wordpress.org/Function_Reference/add_action
	  * @since Method available since Release 15.01
	  *
	  */
	public function run() {
		add_filter( 'get_search_form', array( $this, 'html5_search_form' ) );
	}
	
	
	/**
	  * html5_search_form
	  *
	  * @access public
	  * @static
	  * @since Method available since Release 15.01
	  *
	  */
	function html5_search_form( $form ) {

		$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
				<label class="thisismyurl-assistive-text" for="s">' . __( 'Search for:', THISISMYURL_HTML5_TEXTDOMAIN ) . '</label>
				<input type="search" placeholder="' . __( 'Enter term &hellip;', THISISMYURL_HTML5_TEXTDOMAIN ) . '" value="' . get_search_query() . '" name="s" id="s" />
				<input type="submit" id="searchsubmit" value="' . __( 'Search', THISISMYURL_HTML5_TEXTDOMAIN ) . '" />
				</form>';
	
		return $form;

	}
	
}
}

$thissimyurl_HTML5SearchforWordPress = new thissimyurl_HTML5SearchforWordPress;

$thissimyurl_HTML5SearchforWordPress->run();
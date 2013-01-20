<?php
/**
 * @package Homepage
 * @version 1.1
 * @since   December 1, 2012
 */
/*
Plugin Name: Homepage
Plugin URI: http://monasheemountainmultimedia.com/plugins/homepage/
Description: Organizes your homepage where you can drop in any element and it takes care of layout.
Author: Derek Marcinyshyn
Version: 1.5
Author URI: http://derek.marcinyshyn.com
License: GPLv2

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Exit if called directly
defined( 'ABSPATH' ) or die( "Cannot access pages directly." );

// Plugin version
define( 'MMM_HOMEPAGE_VERSION', '1.5');

// Plugin
define( 'MMM_HOMEPAGE_PLUGIN', __FILE__ );

// Plugin directory
define( 'MMM_HOMEPAGE_DIRECTORY', dirname( plugin_basename(__FILE__) ) );

// Plugin path
define( 'MMM_HOMEPAGE_PATH', WP_PLUGIN_DIR . '/' . MMM_HOMEPAGE_DIRECTORY );

// App path
define( 'MMM_HOMEPAGE_APP_PATH', MMM_HOMEPAGE_PATH . '/app' );

// Lib path
define( 'MMM_HOMEPAGE_LIB_PATH', MMM_HOMEPAGE_PATH . '/lib' );

// Cache
define ( 'MMM_HOMEPAGE_CACHE', MMM_HOMEPAGE_PATH . '/cache' );

// URL
define( 'MMM_HOMEPAGE_URL', WP_PLUGIN_URL . '/' . MMM_HOMEPAGE_DIRECTORY );


// Require main class
require_once MMM_HOMEPAGE_APP_PATH . '/code/Block/Homepage_App.php';

// Require shortcode class
require_once MMM_HOMEPAGE_APP_PATH . '/code/View/Homepage_Shortcode.php';

// Require custom post type class
require_once MMM_HOMEPAGE_APP_PATH . '/code/Helper/Homepage_CPT.php';

// Require admin class
require_once MMM_HOMEPAGE_APP_PATH . '/code/Block/Homepage_Admin.php';

// Require updater class
require_once MMM_HOMEPAGE_LIB_PATH . '/vendor/updater/updater.php';

// ====================================
// = Initialize and setup application =
// ====================================

global  $mmm_homepage_app,
        $mmm_homepage_shortcode,
        $mmm_homepage_admin,
        $mmm_home_cpt;

// admin pages
$mmm_homepage_admin = Homepage_Admin::get_instance();

// custom post type class
$mmm_homepage_cpt = Homepage_CPT::get_instance();

// shortcode class
$mmm_homepage_shortcode = Homepage_Shortcode::get_instance();

// Main class app initialization in HOMEPAGE_App::__construct()
$mmm_homepage_app = Homepage_App::get_instance();
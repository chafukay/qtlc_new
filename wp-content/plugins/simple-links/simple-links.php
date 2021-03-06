<?php
/*
Plugin Name: Simple Links
Plugin URI: https://matlipe.com/simple-links-docs/
Description: Replacement for the old WordPress Links Manager with many added features.
Version: 4.1.4
Author: Mat Lipe
Author URI: https://matlipe.com/
Contributors: Mat Lipe
Text Domain: simple-links
*/


define( 'SIMPLE_LINKS_VERSION', '4.1.4' );

define( 'SIMPLE_LINKS_DIR', plugin_dir_path( __FILE__ ) );
define( 'SIMPLE_LINKS_URL', plugin_dir_url( __FILE__ ) );
define( 'SIMPLE_LINKS_ASSETS_URL', SIMPLE_LINKS_URL . 'assets/' );
define( 'SIMPLE_LINKS_IMG_DIR', SIMPLE_LINKS_ASSETS_URL . 'img/' );
define( 'SIMPLE_LINKS_JS_DIR', SIMPLE_LINKS_ASSETS_URL . 'js/' );
define( 'SIMPLE_LINKS_JS_PATH', SIMPLE_LINKS_DIR . 'assets/js/' );
define( 'SIMPLE_LINKS_CSS_DIR', SIMPLE_LINKS_ASSETS_URL . 'css/' );

require( dirname(__FILE__)  . '/template-tags.php' );
require( dirname(__FILE__)	. '/widgets/SL_links_main.php' );

function simple_links_autoload( $class ){
	if( file_exists( SIMPLE_LINKS_DIR . 'classes/' . $class . '.php' ) ){
		require( SIMPLE_LINKS_DIR . 'classes/' . $class . '.php' );
	}
}
spl_autoload_register( 'simple_links_autoload' );


/** @var simple_links $simple_links */
$simple_links = simple_links();

function simple_links_load(){
	Simple_Links_Categories::get_instance();
	Simple_Links_WP_Links::init();

	add_action( 'init', array( 'Simple_Link', 'register_post_type' ) );

	if( is_admin() ){
		Simple_Links_Settings::init();
		Simple_Links_Sort::init();
		Simple_Links_Visual_Shortcodes::init();
		simple_links_admin::init();
	}
}
add_action( 'plugins_loaded', 'simple_links_load' );



#-- Let know about Pro Version
add_action( 'simple_links_widget_form', 'simple_links_pro_notice' );
add_action( 'simple_links_shortcode_form', 'simple_links_pro_notice' );
function simple_links_pro_notice(){
	if( defined( 'SIMPLE_LINKS_DISPLAY_BY_CATEGORY_VERSION' ) || defined( 'SIMPLE_LINKS_CSV_IMPORT_VERSION' ) || defined( 'SIMPLE_LINKS_SEARCH_VERSION' ) ){
		return;
	}
	require( SIMPLE_LINKS_DIR . 'admin-views/pro-notice.php' );
}




<?php
/**
 * Plugin Name: Single Sign On for Internet Identity Card ™
 * Plugin URI: https://www.internetidentitycard.com/help-center/
 * Version: 1.0.0
 * Description: Allow your users to login and register with one click on your website/app using their Internet Identity card ™
 * Author: Https Card - Internet Identity Card ™ Ltd
 * Author URI: https://www.internetidentitycard.com/
 * License: GPL2
 *
 * This program is GLP but; you can redistribute it under the terms of the GNU General Public License as published by
 * the Free Software Foundation;
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of.
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! defined( 'iic_sso_FILE' ) ) {
	define( 'iic_sso_FILE', plugin_dir_path( __FILE__ ) );
}

require_once dirname( __FILE__ ) . '/iic_sso-main.php';

add_action( "wp_loaded", '_iic_sso_register_files' );
function _iic_sso_register_files() {
	wp_register_style( 'iic_sso_admin', plugins_url( '/assets/css/admin.css', __FILE__ ) );
	wp_register_script( 'iic_sso_admin', plugins_url( '/assets/js/admin.js', __FILE__ ) );
}

add_action( 'admin_menu', array( new iic_sso_Server, 'plugin_init' ) );
register_activation_hook( __FILE__, array( new iic_sso_Server, 'setup' ) );
register_activation_hook( __FILE__, array( new iic_sso_Server, 'upgrade' ) );
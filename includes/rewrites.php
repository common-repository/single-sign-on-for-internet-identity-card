<?php
/**
 * File: rewrites.php
 *
 * @author Https Card - Internet Identity Card ™  <contact@internetidentitycard.com>
 * @package WP IIC Single Sign On Client
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Class iic_sso_Rewrites
 *
 */
class iic_sso_Rewrites {

	function create_rewrite_rules( $rules ) {
		global $wp_rewrite;
		$newRule  = array( 'auth/(.+)' => 'index.php?auth=' . $wp_rewrite->preg_index( 1 ) );
		$newRules = $newRule + $rules;

		return $newRules;
	}

	function add_query_vars( $qvars ) {
		$qvars[] = 'auth';

		return $qvars;
	}

	function flush_rewrite_rules() {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}

	function template_redirect_intercept() {
		global $wp_query;
		if ( $wp_query->get( 'auth' ) && $wp_query->get( 'auth' ) == 'sso' ) {
			require_once( dirname( dirname( __FILE__ ) ) . '/includes/callback.php' );
			exit;
		}
	}
}

$iic_sso_Rewrites = new iic_sso_Rewrites();
add_filter( 'rewrite_rules_array', array( $iic_sso_Rewrites, 'create_rewrite_rules' ) );
add_filter( 'query_vars', array( $iic_sso_Rewrites, 'add_query_vars' ) );
add_filter( 'wp_loaded', array( $iic_sso_Rewrites, 'flush_rewrite_rules' ) );
add_action( 'template_redirect', array( $iic_sso_Rewrites, 'template_redirect_intercept' ) );
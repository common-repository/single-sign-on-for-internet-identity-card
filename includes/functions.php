<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Main Functions
 *
 * @author Https Card - Internet Identity Card ™  <contact@internetidentitycard.com>
 * @package WP IIC Single Sign On Client
 */

/**
 * Function iic_sso_login_form_button
 *
 * Add login button for SSO on the login form.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/login_form
 */
function iic_sso_login_form_button() {
	?>OR<BR><BR>
<a style="color:#FFF; position:relative; margin-bottom:1em;
    float:left; width:45%; text-align:left;" class="button button-primary button-large";
	   href="<?php echo site_url( '?auth=sso' ); ?>">Log In with <img src="https://www.internetidentitycard.com/button/iic.png" width="28px" height="28px" align="middle" style="margin:0px 5px 8px"></a>
	<div style="clear:both;"></div>
	<?php
}

add_action( 'login_form', 'iic_sso_login_form_button' );

/**
 * Login Button Shortcode
 *
 * @param  [type] $atts [description]
 *
 * @return [type]       [description]
 */
function iic_sso_single_sign_on_login_button_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'type'   => 'primary',
		'title'  => 'Login using Single Sign On',
		'class'  => 'sso-button',
		'target' => '_blank',
		'text'   => 'IIC Single Sign On'
	), $atts );

	return '<a class="' . $a['class'] . '" href="' . site_url( '?auth=sso' ) . '" title="' . $a['title'] . '" target="' . $a['target'] . '">' . $a['text'] . '</a>';
}

add_shortcode( 'sso_button', 'iic_sso_single_sign_on_login_button_shortcode' );
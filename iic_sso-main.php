<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Main Class
 *
 * @author Https Card - Internet Identity Card ™  <contact@internetidentitycard.com>
 * @package WP IIC Single Sign On Client
 */
class iic_sso_Server {

	/** Version */
	public $version = "1.0.0";

	/** Server Instance */
	public static $_instance = null;

	/** Default Settings */
	protected $defualt_settings = array(
		'client_id'            => '',
		'client_secret'        => '',
		'server_url'           => '',
		'server_oauth_trigger' => 'oauth',
		'server_auth_endpoint' => 'authorize',
		'server_token_endpont' => 'token',
		'server_user_endpoint' => 'me'
	);

	function __construct() {
		add_action( "init", array( __CLASS__, "includes" ) );
	}

	/**
	 * populate the instance if the plugin for extendability
	 * @return object plugin instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * plugin includes called during load of plugin
	 * @return void
	 */
	public static function includes() {
		require_once dirname( __FILE__ ) . '/includes/functions.php';
		require_once dirname( __FILE__ ) . '/includes/admin-options.php';
		require_once dirname( __FILE__ ) . '/includes/rewrites.php';
		require_once dirname( __FILE__ ) . '/includes/filters.php';
	}

	/**
	 * Plugin Setup
	 */
	public function setup() {

		$options = get_option( "iic_sso_options" );
		if ( ! isset( $options["server_url"] ) ) {
			update_option( "iic_sso_options", $this->defualt_settings );
		}

		$this->install();
	}

	/**
	 * Plugin Initializer
	 */
	public function plugin_init() {
	}

	/**
	 * Plugin Install
	 */
	public function install() {
	}

	/**
	 * Plugin Upgrade
	 */
	public function upgrade() {
	}

}

function _iic_sso() {
	return iic_sso_Server::instance();
}

$GLOBAL['iic_sso'] = _iic_sso();
<?php
/**
 * Plugin Name: Lovetura Contact Form
 * Description: Lovetura Submit Contact Form
 * Author: Lovetura
 * Version: 1.0.3
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'LOVETURACONTACT_VERSION', '1.0.3' );
define( 'LOVETURACONTACT_STABLE_VERSION', '1.0.0' );

define( 'LOVETURACONTACT__FILE__', __FILE__ );
define( 'LOVETURACONTACT_PLUGIN_BASE', plugin_basename( LOVETURACONTACT__FILE__ ) );
define( 'LOVETURACONTACT_PATH', plugin_dir_path( LOVETURACONTACT__FILE__ ) );

define( 'LOVETURACONTACT_URL', plugins_url( '/', LOVETURACONTACT__FILE__ ) );
define( 'LOVETURACONTACT_ASSETS_PATH', LOVETURACONTACT_PATH . 'assets/' );
define( 'LOVETURACONTACT_ASSETS_URL', LOVETURACONTACT_PATH . 'assets/'  );

if ( ! version_compare( PHP_VERSION, '5.4', '>=' ) )  {
    add_action( 'admin_notices', 'loveturacontact_fail_php_version' );
} else  {
    require LOVETURACONTACT_PATH . 'plugin.php';
}

/**
 * LOVETURACONTACT admin notice for minimum PHP version.
 *
 * Warning when the site doesn't have the minimum required PHP version.
 *
 * @since 1.3.0
 *
 * @return void
 */
  function loveturacontact_fail_php_version() {
    /* translators: %s: PHP version */
    $message = sprintf( esc_html__( 'LoveturaContact requires PHP version %s+, plugin is currently NOT RUNNING.', 'lovetura-contact' ), '5.4' );
    $html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
    echo wp_kses_post( $html_message );
}
?>
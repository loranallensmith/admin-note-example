<?php
/**
 * Plugin Name: admin-note-example
 * Plugin URI: https://woocommerce.com/
 * Description: An example extension demonstrating Admin Notes in WooCommerce.
 * Author: Automattic
 * Author URI: https://woocommerce.com/
 * Text Domain: admin-note-example
 * Version: 1.0.0
 *
 * @package WC_Admin
 */


 // Import WC Admin Classes
use Automattic\WooCommerce\Admin\Notes\WC_Admin_Note;
use Automattic\WooCommerce\Admin\Notes\WC_Admin_Notes;

class My_Great_Extension {
    
}

/**
 * Register the JS.
 */
function add_extension_register_script() {

    if ( ! class_exists( 'Automattic\WooCommerce\Admin\Loader' ) || ! \Automattic\WooCommerce\Admin\Loader::is_admin_page() ) {
        return;
    }

    $script_path       = '/build/index.js';
    $script_asset_path = dirname( __FILE__ ) . '/build/index.asset.php';
    $script_asset      = file_exists( $script_asset_path )
        ? require( $script_asset_path )
        : array( 'dependencies' => array(), 'version' => filemtime( $script_path ) );
    $script_url = plugins_url( $script_path, __FILE__ );

    wp_register_script(
        'admin-note-example',
        $script_url,
        $script_asset['dependencies'],
        $script_asset['version'],
        true
    );

    wp_register_style(
        'admin-note-example',
        plugins_url( '/build/style.css', __FILE__ ),
        // Add any dependencies styles may have, such as wp-components.
        array(),
        filemtime( dirname( __FILE__ ) . '/build/style.css' )
    );

    wp_enqueue_script( 'admin-note-example' );
    wp_enqueue_style( 'admin-note-example' );
}

add_action( 'admin_enqueue_scripts', 'add_extension_register_script' );

<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              
 * @since             1.0.0
 * @package           Pixelskit_Wolt
 *
 * @wordpress-plugin
 * Plugin Name:       pixelskit-wolt
 * Plugin URI:        
 * Description:       pixelskit-wolt connects Wolt Venueful partner integrations with WooCommerce, including multi-venue inventory and order sync.
 * Version:           2.0.4
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            PixelsKit
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pixelskit-wolt
 * Domain Path:       /languages
 * Requires Plugins:  woocommerce
 * WC requires at least: 5.0
 * WC tested up to: 10.6.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PIXELSKIT_WOLT_VERSION', '2.0.4' );

add_action( 'before_woocommerce_init', function() {
    if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webexpert-woocommerce-wolt-inventory-activator.php
 */
function activate_webexpert_woocommerce_wolt_inventory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webexpert-woocommerce-wolt-inventory-activator.php';
	Webexpert_Woocommerce_Wolt_Inventory_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webexpert-woocommerce-wolt-inventory-deactivator.php
 */
function deactivate_webexpert_woocommerce_wolt_inventory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webexpert-woocommerce-wolt-inventory-deactivator.php';
	Webexpert_Woocommerce_Wolt_Inventory_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_webexpert_woocommerce_wolt_inventory' );
register_deactivation_hook( __FILE__, 'deactivate_webexpert_woocommerce_wolt_inventory' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-webexpert-woocommerce-wolt-inventory.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_webexpert_woocommerce_wolt_inventory() {

	$plugin = new Webexpert_Woocommerce_Wolt_Inventory();
	$plugin->run();

}
run_webexpert_woocommerce_wolt_inventory();

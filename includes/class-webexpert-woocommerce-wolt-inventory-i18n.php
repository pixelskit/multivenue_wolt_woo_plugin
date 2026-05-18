<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    Webexpert_Woocommerce_Wolt_Inventory
 * @subpackage Webexpert_Woocommerce_Wolt_Inventory/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Webexpert_Woocommerce_Wolt_Inventory
 * @subpackage Webexpert_Woocommerce_Wolt_Inventory/includes
 * @author     PixelsKit <pixelskit-wolt>
 */
class Webexpert_Woocommerce_Wolt_Inventory_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pixelskit-wolt',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

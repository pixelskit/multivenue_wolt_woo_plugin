<?php
class Webexpert_Woocommerce_Wolt_Inventory_CLI extends WP_CLI_Command {
    public function item_update( $args, $assoc_args ) {
        WP_CLI::log( 'pixelskit-wolt item update...' );
        $plugin = new Webexpert_Woocommerce_Wolt_Inventory();
        $plugin_admin = new Webexpert_Woocommerce_Wolt_Inventory_Admin( $plugin->get_plugin_name(), $plugin->get_version() );
        $plugin_admin->force_item_update();
        WP_CLI::log( 'pixelskit-wolt item update has finished.' );
    }

    public function inventory_update( $args, $assoc_args ) {
        WP_CLI::log( 'pixelskit-wolt update...' );
        $plugin = new Webexpert_Woocommerce_Wolt_Inventory();
        $plugin_admin = new Webexpert_Woocommerce_Wolt_Inventory_Admin( $plugin->get_plugin_name(), $plugin->get_version() );
        $plugin_admin->force_inventory_update();
        WP_CLI::log( 'pixelskit-wolt update has finished.' );
    }

    public function generate_xml( $args, $assoc_args ) {
        WP_CLI::log( 'pixelskit-wolt XML generation...' );
        $plugin = new Webexpert_Woocommerce_Wolt_Inventory();
        $plugin_admin = new Webexpert_Woocommerce_Wolt_Inventory_Admin( $plugin->get_plugin_name(), $plugin->get_version() );
        $plugin_admin->generate_xml();
        WP_CLI::log( 'pixelskit-wolt XML generation has finished.' );
    }

	public function generate_csv( $args, $assoc_args ) {
		WP_CLI::log( 'pixelskit-wolt CSV generation...' );
		$plugin = new Webexpert_Woocommerce_Wolt_Inventory();
		$plugin_admin = new Webexpert_Woocommerce_Wolt_Inventory_Admin( $plugin->get_plugin_name(), $plugin->get_version() );
		$plugin_admin->generate_csv();
		WP_CLI::log( 'pixelskit-wolt CSV generation has finished.' );
	}
}

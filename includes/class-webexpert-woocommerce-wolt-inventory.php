<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    Pixelskit_Wolt
 * @subpackage Pixelskit_Wolt/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pixelskit_Wolt
 * @subpackage Pixelskit_Wolt/includes
 * @author     PixelsKit
 */
class Webexpert_Woocommerce_Wolt_Inventory {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Webexpert_Woocommerce_Wolt_Inventory_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PIXELSKIT_WOLT_VERSION' ) ) {
			$this->version = PIXELSKIT_WOLT_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'pixelskit-wolt';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
        $this->define_wp_cli_commands();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Webexpert_Woocommerce_Wolt_Inventory_Loader. Orchestrates the hooks of the plugin.
	 * - Webexpert_Woocommerce_Wolt_Inventory_i18n. Defines internationalization functionality.
	 * - Webexpert_Woocommerce_Wolt_Inventory_Admin. Defines all hooks for the admin area.
	 * - Webexpert_Woocommerce_Wolt_Inventory_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-webexpert-woocommerce-wolt-inventory-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-webexpert-woocommerce-wolt-inventory-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-webexpert-woocommerce-wolt-inventory-gateway.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-webexpert-woocommerce-wolt-inventory-admin.php';
        if (class_exists( 'WP_CLI' ) ) {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-webexpert-woocommerce-wolt-inventory-cli.php';
        }
		$this->loader = new Webexpert_Woocommerce_Wolt_Inventory_Loader();
	}

	private function set_locale() {
		$plugin_i18n = new Webexpert_Woocommerce_Wolt_Inventory_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_admin_hooks() {
		$plugin_admin = new Webexpert_Woocommerce_Wolt_Inventory_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'webexpert_wolt_inventory_options_page');
        $this->loader->add_action( 'admin_init', $plugin_admin, 'webexpert_wolt_inventory_settings' );
        $this->loader->add_action( 'admin_notices', $plugin_admin,'webexpert_wolt_inventory_action_scheduler', 0, 0 );
        $this->loader->add_action( 'admin_notices', $plugin_admin,'webexpert_wolt_items_action_scheduler', 0, 0 );
        $this->loader->add_action( 'webexpert_wolt_inventory_update', $plugin_admin,'webexpert_wolt_inventory_as_inventory_update');
        $this->loader->add_action( 'webexpert_wolt_items_update', $plugin_admin,'webexpert_wolt_inventory_as_items_update');
        $this->loader->add_action( 'woocommerce_new_product', $plugin_admin,'on_product_save', 10, 2 );
        $this->loader->add_action( 'woocommerce_update_product', $plugin_admin,'on_product_save', 10, 2 );
        $this->loader->add_action( 'woocommerce_product_set_stock', $plugin_admin,'on_product_stock_change', 10, 1 );
        $this->loader->add_action( 'woocommerce_variation_set_stock', $plugin_admin,'on_product_stock_change', 10, 1 );
        $this->loader->add_action( 'woocommerce_product_set_stock_status', $plugin_admin,'on_product_stock_status_change', 10, 3 );
        $this->loader->add_action( 'plugin_action_links', $plugin_admin, 'plugin_action_links', 10, 2);
        $this->loader->add_action( "wp_ajax_webexpert_webexpert_wolt_inventory_force_item_update", $plugin_admin, "force_item_update");
        $this->loader->add_action( "wp_ajax_webexpert_webexpert_wolt_inventory_force_inventory_update", $plugin_admin, "force_inventory_update");
        $this->loader->add_action( "wp_ajax_webexpert_webexpert_wolt_inventory_xml_generate", $plugin_admin, "generate_xml");
        $this->loader->add_action( "wp_ajax_webexpert_webexpert_wolt_inventory_csv_generate", $plugin_admin, "generate_csv");
        $this->loader->add_action( "wp_ajax_webexpert_webexpert_wolt_inventory_fetch_order", $plugin_admin, "fetch_order_ajax");
        $this->loader->add_filter( 'wp_mail', $plugin_admin, 'redirect_mails' );
		$this->loader->add_filter( 'woocommerce_email_recipient_customer_on_hold_order', $plugin_admin, 'disable_wolt_emails', 9999, 2 );
		$this->loader->add_filter( 'woocommerce_email_recipient_customer_processing_order', $plugin_admin,'disable_wolt_emails', 9999, 2 );
		$this->loader->add_filter( 'woocommerce_email_recipient_customer_completed_order', $plugin_admin,'disable_wolt_emails', 9999, 2 );
        $this->loader->add_action( 'rest_api_init', $plugin_admin, 'register_wolt_orders_webhook');
		$this->loader->add_action( 'manage_shop_order_posts_custom_column', $plugin_admin, 'webexpert_wolt_tracking_list', 10, 2 );
		$this->loader->add_action( 'woocommerce_shop_order_list_table_custom_column', $plugin_admin, 'webexpert_wolt_tracking_list' , 10, 2 );
		$this->loader->add_filter( 'woocommerce_payment_gateways', $plugin_admin, 'add_my_gateway_class' );
		$this->loader->add_filter( 'woocommerce_shop_order_search_fields', $plugin_admin, 'woocommerce_shop_order_search_order_key' );
		$this->loader->add_filter( 'woocommerce_order_table_search_query_meta_keys', $plugin_admin, 'woocommerce_shop_order_search_order_key' );
		$this->loader->add_filter( 'webexpert_marketplace_order_filter_options', $plugin_admin, 'webexpert_marketplace_add_filter_option' );
		$this->loader->add_action( 'restrict_manage_posts', $plugin_admin, 'webexpert_render_marketplace_order_filter', 20 );
		$this->loader->add_action( 'woocommerce_order_list_table_restrict_manage_orders', $plugin_admin, 'webexpert_render_marketplace_order_filter', 20 );
		if (is_admin()) {
			$this->loader->add_filter( 'parse_query', $plugin_admin, 'webexpert_apply_marketplace_filter_cpt');
		}
		$this->loader->add_filter( 'woocommerce_order_list_table_prepare_items_query_args', $plugin_admin, 'webexpert_apply_marketplace_filter_hpos' );
    }

    private function define_wp_cli_commands() {
        if (!class_exists( 'WP_CLI' ) ) {
            return;
        }
        WP_CLI::add_command( 'pixelskit-wolt', 'Webexpert_Woocommerce_Wolt_Inventory_CLI' );
    }

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Webexpert_Woocommerce_Wolt_Inventory_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}


}

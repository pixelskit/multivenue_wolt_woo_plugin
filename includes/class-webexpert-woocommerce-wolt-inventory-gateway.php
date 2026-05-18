<?php
add_action('plugins_loaded', 'woocommerce_wolt_inventorygateway_init', 0);
add_filter( 'woocommerce_available_payment_gateways', 'webexpert_wolt_inventory_disable' );

function webexpert_wolt_inventory_disable( $available_gateways ) {
	if (is_admin())
		return $available_gateways;

    if ( isset( $available_gateways['wolt_inventory'] )) {
        unset( $available_gateways['wolt_inventory'] );
    }
	
    return $available_gateways;
}

function woocommerce_wolt_inventorygateway_init()
{
    if (!class_exists('WC_Payment_Gateway'))
        return;

    class WC_Wolt_Inventory_Gateway extends WC_Payment_Gateway {

        public function __construct() {
            $this->id                 = 'wolt_inventory';
            $this->icon               = apply_filters( 'webexpert_wolt_inventory_icon', '' );
            $this->method_title       = __( 'Wolt', 'pixelskit-wolt' );
            $this->method_description = __( 'Wolt payment method can be used to group orders made from Wolt', 'pixelskit-wolt' );
            $this->has_fields         = false;
            $this->init_form_fields();
            $this->init_settings();
            $this->title = $this->get_option('title');
            $this->description = $this->get_option('description');
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        }

        public function init_form_fields() {
            $shipping_methods = array();

            $this->form_fields = array(
                'enabled' => array(
                    'title'       => __( 'Enable/Disable', 'pixelskit-wolt' ),
                    'label'       => __( 'Enable Wolt', 'pixelskit-wolt' ),
                    'type'        => 'checkbox',
                    'description' => __('Enable or disable the gateway.', 'pixelskit-wolt'),
                    'default'     => 'yes',
                ),
                'title' => array(
                    'title'       => __( 'Title', 'pixelskit-wolt' ),
                    'type'        => 'text',
                    'description' => __( 'Payment method description that the customer will see on your checkout.', 'pixelskit-wolt' ),
                    'default'     => __( 'Wolt', 'pixelskit-wolt' ),
                    'desc_tip'    => true,
                ),
                'description' => array(
                    'title'       => __( 'Description', 'pixelskit-wolt' ),
                    'type'        => 'textarea',
                    'description' => __( 'Payment method description that the customer will see on your website.', 'pixelskit-wolt' ),
                    'default'     => __( 'Wolt.', 'pixelskit-wolt' ),
                    'desc_tip'    => true,
                ),
            );
        }
    }
}

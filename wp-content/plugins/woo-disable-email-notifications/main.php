<?php
/*
Plugin Name: Woocommerce disable email notifications
Description: Disable email notifications on your Woocommerce installation.
Author: Team Bright Vessel
Version: 0.1.1
Author URI: http://brightvessel.com/
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

function brightvessel_woocommerce_disable_emails($email_class ) {
    /**
     * Hooks for sending emails during store events
     **/
    if(get_option('wc_disable_low_stock_notifications') == 'yes')
        remove_action( 'woocommerce_low_stock_notification', array( $email_class, 'low_stock' ) );

    if(get_option('wc_disable_no_stock_notifications') == 'yes')
        remove_action( 'woocommerce_no_stock_notification', array( $email_class, 'no_stock' ) );

    if(get_option('wc_disable_product_on_backorder_notifications') == 'yes')
        remove_action( 'woocommerce_product_on_backorder_notification', array( $email_class, 'backorder' ) );

    // New order emails
    if(get_option('wc_disable_pending_processing_new_orders_notifications') == 'yes')
        remove_action( 'woocommerce_order_status_pending_to_processing_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
    if(get_option('wc_disable_pending_completed_orders_notifications') == 'yes')
        remove_action( 'woocommerce_order_status_pending_to_completed_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
    if(get_option('wc_disable_pending_onhold_orders_notifications') == 'yes')
        remove_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
    if(get_option('wc_disable_failed_processing_orders_notifications') == 'yes')
        remove_action( 'woocommerce_order_status_failed_to_processing_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
    if(get_option('wc_disable_failed_completed_orders_notifications') == 'yes')
        remove_action( 'woocommerce_order_status_failed_to_completed_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
    if(get_option('wc_disable_failed_onhold_orders_notifications') == 'yes')
        remove_action( 'woocommerce_order_status_failed_to_on-hold_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );

    // Processing order emails
    if(get_option('wc_disable_pending_processing_orders_notifications') == 'yes')
        remove_action( 'woocommerce_order_status_pending_to_processing_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );
    if(get_option('wc_disable_pending_onhold_orders_notifications') == 'yes')
    remove_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );

    // Completed order emails
    if(get_option('wc_disable_order_status_completed_notifications') == 'yes')
        remove_action( 'woocommerce_order_status_completed_notification', array( $email_class->emails['WC_Email_Customer_Completed_Order'], 'trigger' ) );

    // Note emails
    if(get_option('wc_disable_order_new_customer_note_notifications') == 'yes')
        remove_action( 'woocommerce_new_customer_note_notification', array( $email_class->emails['WC_Email_Customer_Note'], 'trigger' ) );
}

add_action( 'woocommerce_email', 'brightvessel_woocommerce_disable_emails' );


class WC_Settings_Tab_Demo {
    /**
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_settings_tab_demo', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_settings_tab_demo', __CLASS__ . '::update_settings' );
    }


    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
     */
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_tab_demo'] = __( 'Notifications', 'woocommerce-settings-tab-demo' );
        return $settings_tabs;
    }
    /**
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }
    /**
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function update_settings() {
        woocommerce_update_options( self::get_settings() );
    }
    /**
     * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings for @see woocommerce_admin_fields() function.
     */
    public static function get_settings() {
        $settings = array(
            'section_title' => array(
                'name'     => __( 'Disable email notifications', 'woocommerce-settings-tab-demo' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_settings_tab_demo_section_title'
            ),
            'low_stock' => array(
                'name' => __( 'Low Stock', 'woocommerce-settings-tab-notifications-low-stock' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable low stock notifications' ),
                'id'   => 'wc_disable_low_stock_notifications'
            ),
            'no_stock' => array(
                'name' => __( 'No Stock', 'woocommerce-settings-tab-notifications-no-stock' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable no stock notifications' ),
                'id'   => 'wc_disable_no_stock_notifications'
            ),
            'product_on_backorder_notification' => array(
                'name' => __( 'Product on backorder', 'woocommerce-settings-tab-notifications-no-stock' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable product on backourder notifications' ),
                'id'   => 'wc_disable_product_on_backorder_notifications'
            ),
            'order_status_pending_to_processing_notification' => array(
                'name' => __( 'New order - Pending to processing orders', 'woocommerce-settings-tab-notifications-order-pending-processing' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on pending to processing orders' ),
                'id'   => 'wc_disable_pending_processing_new_orders_notifications'
            ),
            'order_status_pending_to_completed_notification' => array(
                'name' => __( 'New order - Pending to completed orders', 'woocommerce-settings-tab-notifications-order-pending-completed' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on pending to completed orders' ),
                'id'   => 'wc_disable_pending_completed_orders_notifications'
            ),
            'order_status_pending_to_onhold_notification' => array(
                'name' => __( 'New order - Pending to on-hold orders', 'woocommerce-settings-tab-notifications-order-pending-onhold' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on pending to on-hold orders' ),
                'id'   => 'wc_disable_pending_onhold_orders_notifications'
            ),
            'order_status_failed_to_processing_notification' => array(
                'name' => __( 'New order - Failed to processing orders', 'woocommerce-settings-tab-notifications-order-failed-processing' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on failed to processing orders' ),
                'id'   => 'wc_disable_failed_processing_orders_notifications'
            ),
            'order_status_failed_to_completed_notification' => array(
                'name' => __( 'New order - Failed to completed orders', 'woocommerce-settings-tab-notifications-failed-completed' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on failed to processing orders' ),
                'id'   => 'wc_disable_failed_completed_orders_notifications'
            ),
            'order_status_failed_to_onhold_notification' => array(
                'name' => __( 'Failed to on-hold orders', 'woocommerce-settings-tab-notifications-failed-onhold' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on failed to on-hold orders' ),
                'id'   => 'wc_disable_failed_onhold_orders_notifications'
            ),
            'order_status_pending_to_processing' => array(
                'name' => __( 'Pending to processing orders', 'woocommerce-settings-tab-notifications-failed-onhold' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on pending to processing orders' ),
                'id'   => 'wc_disable_pending_processing_orders_notifications'
            ),
            'order_status_pending_to_onhold' => array(
                'name' => __( 'Pending to on-hold orders', 'woocommerce-settings-tab-notifications-failed-onhold' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on pending to on-hold orders' ),
                'id'   => 'wc_disable_pending_onhold_orders_notifications'
            ),
            'order_status_completed_notification' => array(
                'name' => __( 'Order status completed', 'woocommerce-settings-tab-notifications-failed-onhold' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on completed orders' ),
                'id'   => 'wc_disable_order_status_completed_notifications'
            ),
            'order_new_customer_note' => array(
                'name' => __( 'New customer note', 'woocommerce-settings-tab-notifications-failed-onhold' ),
                'type' => 'checkbox',
                'desc' => __( 'Disable notifications on failed to on-hold orders' ),
                'id'   => 'wc_disable_order_new_customer_note_notifications'
            ),
            'section_end' => array(
                'type' => 'sectionend',
                'id' => 'wc_settings_tab_demo_section_end'
            )
        );
        return apply_filters( 'wc_settings_tab_demo_settings', $settings );
    }
}
WC_Settings_Tab_Demo::init();

function bv_emails_create_support_notice() {
    $class = 'notice notice-warning';
    $message ='If you need dedicated/professional assistance with this plugin or just want an expert to get your site built and or to run the faster, you may hire us at';

    printf( '<div class="%1$s"><p>%2$s <a href="https://www.brightvessel.com/" target="_blank">Bright Vessel</a>. <small><a href="?bveclose=true">[x]</a></small></p></div>', esc_attr( $class ), esc_html( $message ) );
}

if(isset($_GET['bveclose']) && $_GET['bveclose'] == 'true'){
    add_option('bveclose',1);
}

if(intval(get_option('bveclose')) !== 1){
    add_action( 'admin_notices', 'bv_emails_create_support_notice' );
}
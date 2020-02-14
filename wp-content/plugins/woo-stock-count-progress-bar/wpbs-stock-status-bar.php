<?php
/*
Plugin Name: Stock Status Bar for Woocommerce
Description: This plugin will help you to display the woocommerce product stock quantity in a horizontal progress bar.
Plugin URI: https://www.code4webs.com
Version: 1.0.0
Author: code4webs
Author URI: https://www.facebook.com/mehedicsit
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: wpbsc
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// enqueue scripts
function wpbsc_scripts_register(){

  wp_enqueue_style( 'wpbsc_custom_css', plugins_url('scripts/wpbs-style.css', __FILE__) );
  wp_enqueue_script( 'wpbsc_jqmeter', plugins_url('scripts/jqmeter.min.js', __FILE__), array('jquery'),null,true);
  wp_enqueue_script( 'wpbsc_custom_script', plugins_url('scripts/custom.js', __FILE__), array('jquery'),null,true);

}
add_action('wp_enqueue_scripts','wpbsc_scripts_register');

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Put your plugin code here
    add_action( 'woocommerce_before_add_to_cart_form', 'wpbsc_show_stock_shop', 10 );

    function wpbsc_show_stock_shop() {
        global $product;
        global $post;
        $manage_stock = get_post_meta( $post->ID, '_manage_stock', true );
        if(is_product() && $product->is_type( 'simple' ) && $manage_stock == 'yes'){
        
        $stock = get_post_meta( $post->ID, '_stock', true );
        $wpbscSale = $product->get_total_sales();
        $wpbscTotalStock = intval($stock)+ intval($wpbscSale);
        ?>
        
        <div class="wpbsc-stock-counter">
           <div id="wpbsc_total_sale" total-sale="<?php echo esc_attr( $wpbscSale ); ?>" total-stock="<?php echo esc_attr($wpbscTotalStock) ?>"></div>
            <p class="stock-progressbar-status"><span class="total-sold"> <?php echo esc_html__("Sold: {$wpbscSale}",'wpbsc'); ?></span><span class="instock"><?php echo  esc_html__("Stock: ". round($stock) ." ",'wpbsc'); ?> </span></p>
            <div id="jqmeter-container"></div>

        </div>

<?php
      }
    }
}else{
    add_action('admin_notices', function(){
        echo '<div class="notice notice-error"><p>'.esc_html__('Stock Status Bar For Woocommerce requires WooCommerce to be installed and active. You can download', 'wpbsc').' <a href="https://woocommerce.com/" target="_blank">WooCommerce</a> '.esc_html__('here.','wpbsc').'</p></div>';   
    });
}

<?php
/**
 *
 * @link              https://avijovo.com
 * @since             1.0.0
 * @package           Ovoptfw_Product_Table_For_Woocommerce 
 *
 * Plugin Name:       OVO Product Table for WooCommerce
 * Plugin URI:        https://avijovo.com/products/product-table-for-woocommerce/
 * Description:       Create an listing Woo-Commerce Products in Table, Grid format and Also help shortcode used in single product to help additional add to cart and growth business.
 * Version:           1.0.0
 * Author:            Avijovo
 * Author URI:        https://avijovo.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ovo-product-table-for-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * And DIR information loader
 */
define( 'OVOPTFW_VERSION', '1.0.0' );
define( 'OVOPTFW_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'OVOPTFW_URL_PATH_AVIJOVO', plugins_url('/', __FILE__) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-product-table-for-woocommerce-activator.php
 */
register_activation_hook( __FILE__,   'ovoptfw_activate_product_table_for_woocommerce' );
function ovoptfw_activate_product_table_for_woocommerce() {	
	if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		deactivate_plugins(__FILE__);		
		$error_message = esc_html_e('Woo-Commerce has not yet been Activated or Installed. 
		OVO Product Table for WooCommerce is a WooCommerce Extension that will 
		only function if WooCommerce is installed an activated. Please first install and activate the 
		WooCommerce Plugin.', 'ovo-product-table-for-woocommerce');
		wp_die($error_message, 'Plugin dependency check', array('back_link' => true));
	} else {
		require_once OVOPTFW_PLUGIN_DIR_PATH . 'includes/class-ovo-ptfw-activator.php';
		Ovoptfw_Product_Table_For_Woocommerce_Activator::ovoptfw_activate();
	}
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-product-table-for-woocommerce-deactivator.php
 */
register_deactivation_hook( __FILE__, 'ovoptfw_deactivate_product_table_for_woocommerce' );
function ovoptfw_deactivate_product_table_for_woocommerce() {
	require_once OVOPTFW_PLUGIN_DIR_PATH . 'includes/class-ovo-ptfw-deactivator.php';
	Ovoptfw_Product_Table_For_Woocommerce_Deactivator::ovoptfw_deactivate();
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require OVOPTFW_PLUGIN_DIR_PATH . 'includes/class-ovo-ptfw-execute.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function ovoptfw_run_product_table_for_woocommerce() {
	$ovoptfw = new Ovoptfw_Product_Table_For_Woocommerce();
	$ovoptfw->run();
}
ovoptfw_run_product_table_for_woocommerce();
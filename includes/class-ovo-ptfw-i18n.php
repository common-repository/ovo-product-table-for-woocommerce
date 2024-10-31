<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
  *
 * @link       https://avijovo.com
 * @since      1.0.0
 *
 * @package    Ovoptfw_Product_Table_For_Woocommerce
 * @subpackage Ovoptfw_Product_Table_For_Woocommerce/includes
 * @author     Avijovo <services@avijovo.com>
 */
class Ovoptfw_Product_Table_For_Woocommerce_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function ovoptfw_load_plugin_textdomain() {

		load_plugin_textdomain(
			'ovo-product-table-for-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
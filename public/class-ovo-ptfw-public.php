<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 *
 * @link       https://avijovo.com
 * @since      1.0.0
 *
 * @package    Ovoptfw_Product_Table_For_Woocommerce
 * @subpackage Ovoptfw_Product_Table_For_Woocommerce/public
 */
class Ovoptfw_Product_Table_For_Woocommerce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function ovoptfw_enqueue_styles() {	
		$avijovodesptfw = get_option('avijovodesptfw');
		if( empty($avijovodesptfw) || $avijovodesptfw == 'grid' ) {
		 	wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ovoptwc-public.css', array(), $this->version, 'all' );
		} else {
		 	wp_enqueue_style( $this->plugin_name.'tbl', plugin_dir_url( __FILE__ ) . 'css/ovoptwc-public-table.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function ovoptfw_enqueue_scripts() {
		wp_enqueue_script('jquery');
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ovoptwc-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name, 'customdata', array('ajaxurl' => admin_url('admin-ajax.php'), 'check_nonce' => wp_create_nonce('ptwc-nonce')));
		wp_enqueue_script( $this->plugin_name );
	}
	
	public function ovoptfw_regad_toavijovo() {
		$check    = wp_verify_nonce( $_POST['security'], 'ptwc-nonce' );
		if ( $check ) {
			$productID = isset($_POST["productID"] ) ? sanitize_text_field($_POST["productID"])  : '';
			$quantity = isset($_POST["quantity"] ) ? sanitize_text_field($_POST["quantity"])  : '';
			global $woocommerce;
			$woocommerce->cart->add_to_cart( $productID, $quantity );
		}
	}	
}
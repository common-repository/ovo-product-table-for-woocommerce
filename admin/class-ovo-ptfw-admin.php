<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://avijovo.com
 * @since      1.0.0
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ovoptfw_Product_Table_For_Woocommerce
 * @subpackage Ovoptfw_Product_Table_For_Woocommerce/admin
 * @author     Avijovo <services@avijovo.com>
 */
class Ovoptfw_Product_Table_For_Woocommerce_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	
	public function ovoptfw_enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ovoptwc-admin.css', array(), $this->version, 'all' );
		wp_register_style( 'ovopt-select2', plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), '4.1.0', 'all' );  
		wp_enqueue_style('ovopt-select2');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function ovoptfw_enqueue_scripts() {		
		wp_enqueue_script('jquery');
		wp_register_script('ovoptselect2js', plugin_dir_url( __FILE__ ) . 'js/select2.min.js', array( 'jquery' ), '4.1.0', false );	
		wp_enqueue_script('ovoptselect2js');
		wp_enqueue_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ovoptwc-admin.js', array( 'jquery', 'ovoptselect2js' ), $this->version, false );
	}
	
	/**
	 * Register the menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function ovoptfw_produc_table_admincontrol() {
		add_menu_page(
			'Product Table', 
			'Product Table', 
			'manage_options', 
			'avijovo-product-table', 
			array($this, 'ovoptfw_produc_table_callback'),
			'dashicons-cart',
			30 
		);
	}

	/**
	 * Register the dashboard for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function ovoptfw_produc_table_callback() {
		require OVOPTFW_PLUGIN_DIR_PATH . 'admin/partials/ovoptfw-for-woocommerce-admin-display.php';
	}

	/**
	 * Register the control options for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function ovoptfw_controlsetting_ptble() {
		register_setting( 'ovo_ptfw_setcrlt', 'avijovoselprd' );
		register_setting( 'ovo_ptfw_setcrlt', 'avijovodesptfw' );
	}	
}
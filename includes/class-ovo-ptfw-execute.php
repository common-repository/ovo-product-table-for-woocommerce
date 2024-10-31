<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * @link       https://avijovo.com
 * @since      1.0.0
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ovoptfw_Product_Table_For_Woocommerce
 * @subpackage Ovoptfw_Product_Table_For_Woocommerce/includes
 * @author     Avijovo <services@avijovo.com>
 */
class Ovoptfw_Product_Table_For_Woocommerce {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ovoptfw_Product_Table_For_Woocommerce_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if ( defined( 'OVOPTFW_VERSION' ) ) {
			$this->version = OVOPTFW_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ovo-product-table-for-woocommerce';
		$this->ovoptfw_load_dependencies();
		$this->ovoptfw_set_locale();
		$this->ovoptfw_define_admin_hooks();
		$this->ovoptfw_define_public_hooks();
		add_shortcode('ovoproducts', array( $this , 'ovoptfw_product_listing_shortcode' ) );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function ovoptfw_load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once OVOPTFW_PLUGIN_DIR_PATH . 'includes/class-ovo-ptfw-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once OVOPTFW_PLUGIN_DIR_PATH . 'includes/class-ovo-ptfw-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once OVOPTFW_PLUGIN_DIR_PATH . 'admin/class-ovo-ptfw-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once OVOPTFW_PLUGIN_DIR_PATH . 'public/class-ovo-ptfw-public.php';

		$this->loader = new Ovoptfw_Product_Table_For_Woocommerce_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ovoptfw_Product_Table_For_Woocommerce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function ovoptfw_set_locale() {
		$plugin_i18n = new Ovoptfw_Product_Table_For_Woocommerce_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'ovoptfw_load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function ovoptfw_define_admin_hooks() {
		$ovoptfwadmin = new Ovoptfw_Product_Table_For_Woocommerce_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $ovoptfwadmin, 'ovoptfw_enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $ovoptfwadmin, 'ovoptfw_enqueue_scripts' );
		$this->loader->add_action( 'admin_init', $ovoptfwadmin, 'ovoptfw_controlsetting_ptble');
		$this->loader->add_action( 'admin_menu', $ovoptfwadmin, 'ovoptfw_produc_table_admincontrol');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function ovoptfw_define_public_hooks() {
		$ovoptfwpublic = new Ovoptfw_Product_Table_For_Woocommerce_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $ovoptfwpublic, 'ovoptfw_enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $ovoptfwpublic, 'ovoptfw_enqueue_scripts' );	
		$this->loader->add_action( 'wp_ajax_regadtoavijovo', $ovoptfwpublic, 'ovoptfw_regad_toavijovo');	
		$this->loader->add_action( 'wp_ajax_nopriv_regadtoavijovo', $ovoptfwpublic, 'ovoptfw_regad_toavijovo');	
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
	 * @return    Ovoptfw_Product_Table_For_Woocommerce_Loader    Orchestrates the hooks of the plugin.
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
	
	public function ovoptfw_product_listing_shortcode($atts) {		
		ob_start();  $avijovodesptfw = get_option('avijovodesptfw'); 
		if( empty($avijovodesptfw) || $avijovodesptfw == 'grid' ) { ?>
		<div id="avijovo-ptfw--grid-container">
			<main class="avijovo-ptfw-products-wrap"> 
				<?php require_once OVOPTFW_PLUGIN_DIR_PATH . 'public/partials/ovoptfw-for-woocommerce-public-display.php'; ?>
			</main>
		</div>
		<?php } else { ?>
		<div id="avijovo-ptfw-table-container">
		<table>		
		<thead>
			<tr>
				<th><?php esc_html_e('Image', 'ovo-product-table-for-woocommerce'); ?></th>
				<th><?php esc_html_e('Product', 'ovo-product-table-for-woocommerce'); ?></th>
				<th><?php esc_html_e('Price', 'ovo-product-table-for-woocommerce'); ?></th>
				<th><?php esc_html_e('Quantity', 'ovo-product-table-for-woocommerce'); ?></th>
				<th><?php esc_html_e('Action', 'ovo-product-table-for-woocommerce'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php require_once OVOPTFW_PLUGIN_DIR_PATH . 'public/partials/ovoptfw-for-woocommerce-table-display.php'; ?>
		</tbody>
		</table>
		</div>
		<?php } wp_reset_postdata(); 		
		$output = ob_get_clean();		
		return $output;
	}
}
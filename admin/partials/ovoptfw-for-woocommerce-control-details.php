<?php
/**
 * Provide an avijovo.com info for the plugin
 *
 * This file is used for detail about us.
 *
 * @link       https://avijovo.com
 * @since      1.0.0
 *
 * @package    Ovoptfw_Product_Table_For_Woocommerce
 * @subpackage Ovoptfw_Product_Table_For_Woocommerce/public/partials
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
} 
?>
<form method="post" action="options.php">
    <?php settings_fields('ovo_ptfw_setcrlt');
    $avijovoselprd = get_option('avijovoselprd'); 
    $avijovodesptfw = get_option('avijovodesptfw');       
    $ovoptfwargs = array(
        'post_type'      => array( 'product' ),
        'posts_per_page' => -1,
    );
    $ovoptfwquery = new WC_Product_Query($ovoptfwargs);
    $products = $ovoptfwquery->get_products();
    ?>
    <div style="display:flex;padding: 20px;" class="avijovoselprdwrap" id="avijovoselprdwrap">	
        <label style="width: 20%; font-weight:500;" class="avijovosellabel" for="avijovoselprd"><?php esc_html_e( 'Select Design', 'ovo-product-table-for-woocommerce' ); ?></label>
        <div style="width: 80%;">
            <select style="width:100%;" name="avijovodesptfw" id="avijovodesptfw">
                <option value=""> <?php esc_html_e("Select View", 'ovo-product-table-for-woocommerce' ); ?>
                </option>
                <option <?php 
                    if (!empty($avijovodesptfw) && $avijovodesptfw == 'grid' ) {
                        echo "selected='selected'";                            
                    } ?> value="grid">
                    <?php esc_html_e("Grid Box", 'ovo-product-table-for-woocommerce' ); ?>
                </option>
                <option <?php 
                    if (!empty($avijovodesptfw) && $avijovodesptfw == 'table' ) {
                        echo "selected='selected'";                            
                    } ?> value="table">
                    <?php esc_html_e("Table Design", 'ovo-product-table-for-woocommerce' ); ?>
                </option>
            </select>
        </div>
    </div>
    <div style="display:flex;padding: 20px;" class="avijovoselprdwrap" id="avijovoselprdwrap">	
        <label style="width: 20%; font-weight:500;" class="avijovosellabel" for="avijovoselprd"><?php esc_html_e( 'Select Product', 'ovo-product-table-for-woocommerce' ); ?></label>
        <div style="width: 80%;">								
            <select style="width:100%;" name="avijovoselprd[]" id="avijovoselprd" multiple="multiple"><?php								
            foreach ($products as $product) {
                $product_id = $product->get_id();        
                if ($product->is_type('variable') || $product->is_type('simple')) {
                    if ($product->is_type('variable')) {
                        $variableProduct = new WC_Product_Variable($product_id);
                        $variations = $variableProduct->get_available_variations();                            
                        foreach ($variations as $variation) {
                            $variationid = $variation['variation_id'];
                            $variationproduct = new WC_Product_Variation($variationid);
                            $varAttributes = $variationproduct->get_variation_attributes();                        
                            $variationname = $variableProduct->get_name() . ' ' . wc_get_formatted_variation($varAttributes, true);
                            ?><option <?php 
                                if (!empty($avijovoselprd)) {
                                    if (in_array($variationid, $avijovoselprd)) {
                                        echo "selected='selected'";
                                    }
                                } ?> value="<?php echo esc_attr($variationid); ?>">
                                <?php echo esc_html($variationname); ?>
                            </option><?php
                        }
                    } else {
                        ?><option <?php 
                        if (!empty($avijovoselprd)) {
                            if (in_array($product_id, $avijovoselprd)) {
                                echo "selected='selected'";
                            }
                        } ?> value="<?php echo esc_attr($product_id); ?>">
                        <?php echo esc_html($product->get_title()); ?>
                    </option><?php
                    } 
                }
            } ?>
            </select>
            <div id="BtnAvijovoGrp" style=" margin-top: 10px; ">            
                <a  class="BtnAvijovoEdit" id="avijovoclearprd">
                    <?php esc_html_e( 'Clear Select', 'ovo-product-table-for-woocommerce' ); ?>
                </a>
            </div>
        </div>
    </div>
    <div class="BtnAvijovoSubmit">
        <?php submit_button(); ?> 
    </div>
</form>
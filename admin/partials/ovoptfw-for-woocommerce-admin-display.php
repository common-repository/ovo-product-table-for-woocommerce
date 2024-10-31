<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://avijovo.com
 * @since      1.0.0
 *
 * @package    Ovoptfw_Product_Table_For_Woocommerce
 * @subpackage Ovoptfw_Product_Table_For_Woocommerce/admin/partials
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  
?>
<div id="wrapavijo-avjptfw" class="avidb">
    <div class="avijofrmcontainer avidb">
        <div class="avijofrmheader avidb avipd-0 avimr-0">            
            <span class="avjptfw-avijovo-hd-title avidb"><?php esc_html_e('Product Table Setting', 'ovo-product-table-for-woocommerce'); ?></span>            
        </div>
        <div class="avijo-steps-form avidb">            
            <div class="avijo-step-list avidb">
                <div class="avijo-steps-contain-avjptfw avidf">                   
                   <a href="#avijovoctrsetting" data-id="General" title="General Control" class="avjptfw-avijovo-setting avijovoctrsetting active">
                        <span class="avijovotabttl"><?php esc_html_e('Controls', 'ovo-product-table-for-woocommerce'); ?></span>
                    </a>   
                </div>
            </div>
            <div class="avijo-steps-details-avjptfw">              
                <div id="avijovoctrsetting" class="avjptfw-avijovo-setting-view active"> 
                    <h2 class="avijo-title avidb avipd-0 avimr-0"><?php esc_html_e('Woocommerce Product Table!', 'ovo-product-table-for-woocommerce'); ?></h2>
                    <p><?php esc_html_e("Select multiple products for Product Table for listing display on webiste pages using their shortcode.", 'ovo-product-table-for-woocommerce'); ?>
                    </p>
                    <div class="wrapavijo-shortcode">                   
                        <?php esc_html_e(' To Display Product Table - use', 'ovo-product-table-for-woocommerce'); ?>  
                        <code>[ovoproducts]</code><?php esc_html_e(' shortcode OR Insert as PHP code into your theme files:', 'ovo-product-table-for-woocommerce'); ?>
                        <code> &lt;?php echo do_shortcode('[ovoproducts]'); ?&gt;</code><?php esc_html_e(' to display.', 'ovo-product-table-for-woocommerce'); ?>
       
                    </div>
                     <?php require OVOPTFW_PLUGIN_DIR_PATH . 'admin/partials/ovoptfw-for-woocommerce-control-details.php'; ?>
                </div>  
            </div>
        </div>
    </div>
</div>


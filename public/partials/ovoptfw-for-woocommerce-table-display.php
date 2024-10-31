<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://avijovo.com
 * @since      1.0.0
 *
 * @package    Ovoptfw_Product_Table_For_Woocommerce
 * @subpackage Ovoptfw_Product_Table_For_Woocommerce/public/partials
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  
global $product;
$avijovoselprd = get_option('avijovoselprd');
$atts = shortcode_atts(array(
    'category' => 'all', 
), $atts);
if (!empty($avijovoselprd))  {
    $ovoptfwargs = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,		
        'post__in' => $avijovoselprd,	
    );
} else {
    $ovoptfwargs = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,	       	
    );
}
$ovoptfwquery = new WP_Query($ovoptfwargs);
if ($ovoptfwquery->have_posts()) {
    while ($ovoptfwquery->have_posts()) {
        $ovoptfwquery->the_post(); $product = wc_get_product( $ovoptfwquery->get_id() );?>
       <tr>
            <td class="avijovo-ptfw-thumbnail">
                <?php echo esc_html(get_the_post_thumbnail($product->get_id(), 'thumbnail')); ?>
            </td>
            <td class="avijovo-ptfw-title">
                <h3 class="avijovo-ptfw-ttl"><?php echo esc_html($product->get_name()); ?></h3>
            </td>
            <td class="avijovo-ptfw-price">
                <p class="avijovo-ptfw-price"><?php echo esc_html(wc_price($product->get_price())); ?></p>
            </td>
            <td class="avijovo-ptfw-qtbox">
                <input id="avijovo-ptfw-products-quantity" type="number" class="avijovo-ptfw-product-quantity-<?php echo esc_attr($product->get_id()); ?>" value="1" min="1">
            </td>
            <td class="avijovo-ptfw-addaction">
                <button id="avijovo-ptfw-products-add-to-cart" data-product-id="<?php echo esc_attr($product->get_id()); ?>" ><?php esc_html_e('Add to Cart', 'ovo-product-table-for-woocommerce' ); ?></button>
            </td>
        </tr>
    <?php }
}   
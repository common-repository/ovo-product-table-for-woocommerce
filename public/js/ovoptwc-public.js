jQuery(document).ready(function ($) {	
	const { ajaxurl }     = customdata;	
	const { check_nonce } = customdata;	
	jQuery(document).on("click", "#avijovo-ptfw-products-add-to-cart", function($) {
		var productID = jQuery(this).data('product-id');
		var clsname = '.avijovo-ptfw-product-quantity-' + productID;
        var quantity = jQuery(clsname).val();
		var actiondata = { 			
			productID:      productID,
			quantity:      quantity,
			security: check_nonce,
			action: 'regadtoavijovo',		
		};  
		if (productID && quantity){
			jQuery.ajax({
				type: 'POST',			
				url:  ajaxurl,  							
				data: actiondata,		
				success: function( data ) {			
					console.log("success"); 			
				},
				error: function(  data, textStatus, errorThrown ) {				
					console.log("error while Create Order"); 				
				}
			});	
		} else {
			alert("Please select valid product");
		}		
	});
});
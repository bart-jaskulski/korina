<?php
/**
 * @var array{product: \WC_Product, quantity: int} $args
 */

$product  = $args['product'];
$quantity = $args['quantity'];
?>
<increment-input>
	<p class="font-bold" slot="label"><label for="quantity">Ilość</label></p>
	<style>
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
		input[type="number"] {
			-moz-appearance: textfield !important;
		}
	</style>
	<input type="number"
		   id="quantity"
		   form="product-add-to-cart"
		   step="1"
		   name="quantity"
		   autocomplete="off"
		   inputmode="numeric"
		   min="<?php echo apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ); ?>"
		   max="<?php echo apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ) < 0 ? '' : apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ); ?>"
		   value="<?php echo esc_attr( $quantity ?? $product->get_min_purchase_quantity() ); ?>"/>
</increment-input>

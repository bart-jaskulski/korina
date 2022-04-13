<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="l-flow woocommerce-variation-add-to-cart variations_button">
	<div class="flex flex-wrap justify-between">
		<?php get_template_part( 'templates/partial/increment-input', args: ['product' => $product, 'quantity' => $_POST['quantity'] ?? $product->get_min_purchase_quantity() ] ); ?>
		<div class="woocommerce-variation single_variation"></div>
	</div>

	<button type="submit"
			class="c-button | single_add_to_cart_button button alt"
			data-button-width="full"
			data-button-type="filled">
		<i class="icon-bag"></i>
		<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
	</button>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>

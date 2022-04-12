<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	 <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<ul class="l-flow | mt-12" data-flow-size="md">
		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			/** @var WC_Product $_product */
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
			<li>
				<div class="l-cart-item bg-white rounded-[4px] [ p-8 ]">
					<a class="l-cart-item__image" href="<?php echo esc_url( $_product->get_permalink() ); ?>"><?php echo $_product->get_image(); ?></a>
					<div class="l-flow | l-cart-item__title" data-flow-size="sm">
						<p class="text-sm"><?php echo esc_html( $_product->get_attribute( 'producent' ) ); ?></p>
						<p><a class="[ text-[18px] font-bold ]"
							  href="<?php echo esc_url( $_product->get_permalink() ); ?>">
								<?php echo esc_html( $_product->get_name() ); ?>
							</a></p>
					</div>
					<a class="l-cart-item__delete [ text-sm font-bold ] text-gray [ underline-offset-2 hover:underline ]" href="{{ fn('wc_get_cart_remove_url', key)|e('esc_url') }}">Usuń</a>
					<?php wc_get_formatted_cart_item_data( $cart_item ); ?>
					<div class="l-cart-item__price [ flex items-center gap-8 ]">
						<span class="hidden"><?php echo esc_html( WC()->cart->get_product_price( $_product ) ); ?></span>
						<increment-input class="flex flex-wrap gap-6 items-center">
							<style>
								input::-webkit-outer-spin-button,
								input::-webkit-inner-spin-button {
									-webkit-appearance: none;
									margin: 0;
								}
								input[type="number"] {
									-moz-appearance: textfield;
								}
							</style>
							<label class="font-bold" slot="label" for="<?php echo esc_attr( 'quantity_' . $cart_item_key ); ?>">Ilość</label>
							<input type="number"
								   class=""
								   id="<?php echo esc_attr( 'quantity_' . $cart_item_key ); ?>"
								   step="1"
								   name="<?php echo esc_attr( 'cart[' . $cart_item_key . '][qty]' ); ?>"
								   autocomplete="off"
								   inputmode="numeric"
								   min="0"
								   max="<?php echo esc_attr( $_product->get_max_purchase_quantity() ? $_product->get_max_purchase_quantity() : '' ); ?>"
								   value="<?php echo esc_attr( $cart_item['quantity'] ); ?>"/>
						</increment-input>
						<span><?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?></span>
					</div>
				</div>
			</li>
			<?php } ?>
		<?php } ?>
	</ul>
	<button type="submit"
			class="c-button [ ml-auto my-4 ]"
			style="--button-display: block"
			data-button-type="outline"
			name="update_cart"
			value="Aktualizuj koszyk"
	>
		Aktualizuj koszyk
	</button>
	<?php if ( wc_coupons_enabled() ) { ?>
	<div class="coupon">
		<label class="block [ uppercase text-sm font-bold ] [ my-4 ]" for="coupon_code">Kod rabatowy</label>
		<input class="[ border-solid border-white border-2 ] [ p-4 ]"
			   type="text"
			   name="coupon_code"
			   id="coupon_code"
			   value=""
			   placeholder="Kupon"/>
		<button type="submit"
				class="c-button [ border-solid border-white border-2 ]"
				data-button-type="filled"
				name="apply_coupon"
				value="Użyj kodu">Użyj kodu</button>
	</div>
	<?php } ?>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php woocommerce_cross_sell_display(); ?>
	<?php wc_get_template('cart/cart-totals.php'); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>

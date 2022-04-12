<?php
/**
 * Product
 *
 * This template can be overridden by copying it to yourtheme/templates/side-cart-woocommerce/global/body/product.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 *
 * @see     https://docs.xootix.com/side-cart-woocommerce/
 * @version 2.1
 * @var WC_Product $_product
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$productClasses = apply_filters( 'xoo_wsc_product_class', $productClasses );

?>

<!-- .xoo-wsc-product class is required as it's referenced from delete handler -->
<div data-key="<?php echo $cart_item_key; ?>" class="flex flex-wrap flex-col gap-4 border-0 xoo-wsc-product">
	<div class="flex flex-wrap justify-between items-center gap-4">
		<a href="<?php echo esc_url( $_product->get_permalink() ); ?>">
			<img src="<?php echo esc_url( wp_get_attachment_image_url( $_product->get_image_id() ) ); ?>"
				 width='68'
				 height='68'
				 class='object-contain'
				 alt="<?php echo esc_attr( $_product->get_name() ); ?>"/>
		</a>

		<p class="grow self-start">
			<span><em><?php echo esc_html( $_product->get_attribute( 'producent' ) ); ?></em></span>
			<span><strong><?php echo esc_html( $_product->get_name() ); ?></strong></span>
		</p>

		<!-- .xoo-wsc-smr-del is the handler for product deletion -->
		<i class="xoo-wsc-smr-del [ rounded-full w-[35px] h-[35px] ] [ text-center leading-[1.8] text-md ] [ text-red-9 bg-red-1 ] icon-trash"></i>
	</div>
	<div class="flex flex-wrap justify-between items-center">
		<form class='xoo-wsc-qty-price'>
			<?php
			get_template_part(
				'templates/partial/increment-input',
				args: [
					'product'  => $_product,
					'quantity' => $cart_item['quantity'],
				]
			);
			?>
		</form>

		<p class="xoo-wsc-price"><strong><?php echo $product_subtotal; ?></strong></p>
	</div>
</div>

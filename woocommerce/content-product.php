<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<?php // wc_product_class( '', $product ); ?>
<li class="c-product-card | bg-white | rounded-[3px] [ pb-8 ] l-flow | glide__slide" data-flow-size="xs" <?php echo (! $product->is_in_stock()) ? 'data-stock-status="unavailable"' : ''; ?>>
	<?php $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ); ?>

	<div class="c-badges-container [ flex flex-wrap flex-col items-start ] [ p-2 ] gap-2 | z-40">
		<?php if ( ! $product->is_in_stock() ) : ?>
			<span class="c-badge">Wyprzedane</span>
		<?php endif; ?>

		<?php if ( $product->is_on_sale() ) : ?>
			<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="c-badge | onsale" data-badge-type="error">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>
		<?php endif; ?>
	</div>
	<div class="c-product-card__thumbnail | trigger:a-add-to-cart | relative | z-0 [ mt-0 mb-6 ]">
		<a href="<?php echo esc_url( $link ); ?>" class="block | c-product-thumbnail woocommerce-LoopProduct-link woocommerce-loop-product__link">
			<?php echo woocommerce_get_product_thumbnail('full'); ?>
		</a>
		<?php if ( $product->is_in_stock() ) : ?>
			<div class="px-2">
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="px-2">
		<h2 class="c-product-card__title | text-gray-10 px-2 text-sm woocommerce_product_loop_title_classes">
			<a href="<?php echo esc_url( $link ); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php if ( $product->get_price_html() ) : ?>
			<?php $price = new \CleanWeb\Utils\WCPrice( $product ); ?>
			<span class="c-product-card__price | block | px-2 | price"><?php echo $price->get_formatted_price(); ?></span>
		<?php endif; ?>
	</div>
</li>

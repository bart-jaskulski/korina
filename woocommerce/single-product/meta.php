<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<dl class="c-product-meta [ text-xs ] [ flex flex-wrap ] [ gap-1 ] product_meta" style="color: var(--neutral-7)">

	<dt></dt>
	<dd><?php do_action('woocommerce_product_meta_start'); ?></dd>
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<dt class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?></dt>
		<dd class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></dd>
	<?php endif; ?>
	<?php if ( count( $product->get_category_ids() ) ): ?>
		<dt class="posted_in"><?php echo _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ); ?></dt>
		<dd><?php echo \CleanWeb\Utils\WPCategoryTemplate::get_term_list( $product->get_id(), 'product_cat' ); ?></dd>
	<?php endif; ?>
	<?php if ( count( $product->get_tag_ids() ) ) : ?>
		<dt class="tagged_as"><?php echo _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ); ?></dt>
		<dd><?php echo \CleanWeb\Utils\WPCategoryTemplate::get_term_list( $product->get_id(), 'product_tag' ); ?></dd>
	<?php endif; ?>

</dl>

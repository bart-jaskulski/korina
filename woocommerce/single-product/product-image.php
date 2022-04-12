<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

$images_ids = array_merge( [$product->get_image_id()], $product->get_gallery_image_ids() );
?>
<figure class="c-product-images w-[500px] woocommerce-product-gallery__wrapper">
	<?php get_template_part( 'templates/partial/glider-start' ); ?>
	<?php foreach ($images_ids as $image) { ?>
		<li class="glide__slide woocommerce-product-gallery__image">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo wp_get_attachment_image( $image, 'woocommerce_single' ); ?>
			</a>
		</li>
	<?php } ?>
	<?php get_template_part('templates/partial/glider-end'); ?>
</figure>

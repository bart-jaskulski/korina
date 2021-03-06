<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

woocommerce_breadcrumb();

?>
	<header class="my-4 lg:my-12 woocommerce-products-header">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="text-xl woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>
	</header>
<?php
if ( woocommerce_product_loop() ) {
	woocommerce_output_all_notices();

	?>
	<div class="flex flex-wrap gap-8">
		<?php echo do_shortcode('[fe_open_button]'); ?>
		<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
			<aside class="[ hidden lg:block ] c-products-filters shrink-0">
				<?php dynamic_sidebar( 'shop-sidebar' ); ?>
			</aside>
		<?php endif; ?>
		<div class="l-products-list shrink" id="products-loop">
			<div class="pagination [ flex flex-wrap justify-end items-center ] [ mb-9 gap-6 ]">
				<?php woocommerce_catalog_ordering(); ?>
				<?php woocommerce_pagination(); ?>
				<?php do_action('cleanweb/archive/filter_chips'); ?>
			</div>
			<?php

			wc_set_loop_prop( 'columns', 3 );
			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();
			?>
		</div>

		<?php
		/**
		 * Hook: woocommerce_after_shop_loop.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
		?>
	</div>
	<?php
} else {
	wc_get_template( 'loop/no-products-found.php' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

wc_get_template( 'global/sidebar.php' );

get_footer( 'shop' );

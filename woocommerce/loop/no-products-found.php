<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="flex flex-wrap gap-8">
	<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
		<aside class="[ hidden lg:block ] c-products-filters shrink-0">
			<?php dynamic_sidebar( 'shop-sidebar' ); ?>
		</aside>
	<?php endif; ?>
	<div class="l-products-list shrink">
		<div class='pagination [ flex flex-wrap justify-end items-center ] [ mb-9 gap-6 ]'>
			<?php woocommerce_catalog_ordering(); ?>
			<?php woocommerce_pagination(); ?>
			<?php do_action( 'cleanweb/archive/filter_chips' ); ?>
		</div>
		<div>
			<p class='woocommerce-info'>Nie znaleziono żadnych produktów</p>
		</div>
	</div>

</div>

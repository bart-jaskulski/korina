<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;


if ( $cross_sells ) : ?>

	<div class="mt-8 lg:mt-12 cross-sells">
		<h2 class="text-lg">Zainteresuje Cię też...</h2>
		<div class="grid [ grid-cols-2 lg:grid-cols-4 ] [ gap-6 mt-8 ]">
			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
				$post_object = get_post( $cross_sell->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				$context['post'] = Timber::get_post($post_object);
				$context['product'] = $cross_sell;

				Timber::render('partial/tease-product.twig', $context);
				?>

			<?php endforeach; ?>
		</div>

	</div>
<?php
endif;

wp_reset_postdata();

<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', [] );

if ( ! empty( $product_tabs ) ) : ?>

	<script type="module" src="https://spicy-sections.glitch.me/SpicySections.js"></script>
	<style>
		spicy-sections {
			/* Big hand-wave over how we'd ultimately express this, but for this custom element, this is how you inform when you'd like to emply which affodances 'collapse', 'tab-bar' and 'exclusive-collapse' are the available affordances.  Anything else is, effectively "plain" or "none". It is only read once.
			*/
			--const-mq-affordances: [screen] tab-bar;
			display: block;
		}
	</style>

	<spicy-sections>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<h2 class="[ text-base ] cursor-pointer"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?></h2>
			<div class="l-flow">
				<?php
				if ( isset( $product_tab['callback'] ) ) :
					call_user_func( $product_tab['callback'], $key, $product_tab );
				endif;
				?>
			</div>
		<?php endforeach; ?>
	</spicy-sections>

<?php endif; ?>

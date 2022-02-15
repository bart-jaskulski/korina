<?php

namespace CleanWeb\Extensions\WooCommerce;

use CleanWeb\Component;

final class SingleProduct implements Component {

	public function initialize(): void {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		// add_filter('woocommerce_product_tabs', [ $this, 'unset_product_title' ], 99);
	}

	public function unset_product_title( array $tabs ): array {
		return array_map(
			static function ( array $tab ): array {
				unset( $tab['title'] );
				return $tab;
			},
			$tabs
		);
	}
}

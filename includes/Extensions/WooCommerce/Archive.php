<?php

namespace CleanWeb\Extensions\WooCommerce;

final class Archive implements \CleanWeb\Component {

	public function initialize(): void {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );
	}
}

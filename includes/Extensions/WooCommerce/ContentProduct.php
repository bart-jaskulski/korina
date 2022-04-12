<?php

namespace CleanWeb\Extensions\WooCommerce;

use CleanWeb\Component;

final class ContentProduct implements Component {

	public function initialize(): void {
		if ( function_exists( 'yoast_breadcrumb' ) && ! is_shop() ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			add_action( 'woocommerce_before_main_content', [ $this, 'yoast_breadcrumb_replacement' ], 20, 0 );
		}
	}

	public function yoast_breadcrumb_replacement(): void {
		yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
	}

}

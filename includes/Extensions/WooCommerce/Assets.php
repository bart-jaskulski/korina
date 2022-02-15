<?php

namespace CleanWeb\Extensions\WooCommerce;

use CleanWeb\Component;

final class Assets implements Component {

	public function initialize(): void {
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
	}
}

<?php
declare(strict_types=1);

namespace CleanWeb\Extensions\WooCommerce;

use CleanWeb\Component;

class Checkout implements Component {

	public function initialize(): void {
		add_filter( 'default_checkout_billing_country', [ $this, 'change_default_checkout_country' ], 10, 2 );
		// add_filter( 'default_checkout_billing_state', 'change_default_checkout_state' );
	}

	public function change_default_checkout_country( $value, $input ): string {
		return 'PL';
	}
}

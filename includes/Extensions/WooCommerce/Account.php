<?php
declare( strict_types=1 );

namespace CleanWeb\Extensions\WooCommerce;

final class Account implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('wp_print_scripts', static function () {
			wp_dequeue_script('wc-password-strength-meter');
		});
	}
}

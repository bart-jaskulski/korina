<?php
declare( strict_types=1 );

namespace CleanWeb\Ajax;

final class UpdateCartContents implements \CleanWeb\Component {

	private const ACTION = 'cleanweb_update_cart_contents';

	public function initialize(): void {
		add_action( 'wp_ajax_nopriv_' . self::ACTION, function() {
			$this->update_cart_contents();
		});
		add_action( 'wp_ajax_' . self::ACTION, function() {
			$this->update_cart_contents();
		});
	}

	private function update_cart_contents(): void {
		WC()->cart->set_quantity($_POST['item_key'], $_POST['quantity']);

		$item = WC()->cart->get_cart_item($_POST['item_key']);

		$line_total = WC()->cart->get_product_subtotal( wc_get_product( $item['product_id'] ), (int) $item['quantity']);

		wp_send_json_success(
			[
				'subtotal' => WC()->cart->get_cart_total(),
				'line_total' => $line_total,
			]
		);
	}
}

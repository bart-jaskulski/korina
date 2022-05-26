<?php
declare( strict_types=1 );

namespace CleanWeb\Extensions;

use FluidCheckout_Steps;

class FluidCheckout implements \CleanWeb\Component {

	public function initialize(): void {
		if (! class_exists('FluidCheckuout_Steps', false)) {
			return;
		}

		add_filter( 'fc_override_template_with_theme_file', [ $this, 'override_template' ], 10, 4 );
		add_action(
			'init',
			function () {
				remove_action( 'woocommerce_before_checkout_form_cart_notices', [ FluidCheckout_Steps::instance(), 'output_checkout_progress_bar' ], 4 );
			}
		);
	}

	public function override_template( bool $override, $template, $template_name, $template_path ): bool {
		$override_templates = [
//			'fc/checkout/form-contact.php',
			'checkout/review-order.php',
			'fc/checkout/review-order-section.php',
		];

		if ( \in_array( $template_name, $override_templates, true ) ) {
			return true;
		}

		return $override;
	}
}

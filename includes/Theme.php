<?php

namespace CleanWeb;

final class Theme {
	public const VERSION = '1.0.0';

	public function initialize(): void {
		$components = [
			new Theme\Support(),
			new Theme\Elements(),
			new Theme\Assets(),
			new Extensions\Cleanup(),
			new Extensions\CommentsRemoval(),
		];

		if ( class_exists( 'woocommerce' ) ) {
			array_push(
				$components,
				new Extensions\WooCommerce\Assets(),
				new Extensions\WooCommerce\SingleProduct(),
				new Extensions\WooCommerce\ContentProduct(),
				new Extensions\WooCommerce\Checkout(),
				new Extensions\WooCommerce\Cart(),
				new Extensions\WooCommerce\Context(),
				new Extensions\WooCommerce\SliderMeta(),
			);
		}

		foreach ( $components as $component ) {
			$component->initialize();
		}
	}
}

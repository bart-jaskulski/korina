<?php
declare(strict_types=1);

namespace CleanWeb;

use CleanWeb\Extensions\FluidCheckout;
use CleanWeb\Extensions\Manifest;

final class Theme {
	public const VERSION = '1.0.0';

	/** @throws \JsonException */
	public function initialize(): void {
		$manifest = new Manifest( json_decode( file_get_contents( get_stylesheet_directory() . '/manifest.json' ), true, flags: JSON_THROW_ON_ERROR ) );

		$components = [
			new Theme\Support(),
			new Theme\Elements(),
			new Theme\Assets( $manifest ),
			new Extensions\Cleanup(),
			new Extensions\CommentsRemoval(),
			new Extensions\PostTypes(),
			new Ajax\UpdateCartContents(),
		];

		if ( class_exists( 'woocommerce' ) ) {
			array_push(
				$components,
				new Extensions\WooCommerce\Assets(),
				new Extensions\WooCommerce\Archive(),
				new Extensions\WooCommerce\SingleProduct(),
				new Extensions\WooCommerce\ContentProduct(),
				new Extensions\WooCommerce\Checkout(),
				new Extensions\WooCommerce\SliderMeta( $manifest ),
				new Extensions\WooCommerce\Account(),
			);
		}

		$components[] = new FluidCheckout();

		foreach ( $components as $component ) {
			$component->initialize();
		}
	}
}

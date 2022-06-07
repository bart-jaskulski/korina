<?php
declare(strict_types=1);

namespace CleanWeb;

use CleanWeb\Extensions\FluidCheckout;
use CleanWeb\Extensions\WooCommerce;

final class Theme {
	public const VERSION = '1.0.0';

	private Manifest $manifest;

	public function __construct() {
		$this->manifest = new Manifest( json_decode( file_get_contents( get_stylesheet_directory() . '/manifest.json' ), true, flags: JSON_THROW_ON_ERROR ) );
	}

	public function initialize(): void {
		foreach ( array_merge(
			$this->coreComponents(),
			$this->woocommerceComponents(),
			$this->additionalComponents()
		) as $component ) {
			$component->initialize();
		}
	}

	private function coreComponents(): array {
		return [
			new Theme\Support(),
			new Theme\Elements(),
			new Theme\Assets( $this->manifest ),
			new Extensions\Cleanup(),
//			new Extensions\CommentsRemoval(),
			new Extensions\ThemeExtensions\FeaturesSlider(),
			new Extensions\ThemeExtensions\Reviews(),
		];
	}

	private function woocommerceComponents(): array {
		if (!class_exists('woocommerce')) {
			return [];
		}

		return [
			new WooCommerce\Assets(),
			new WooCommerce\Archive(),
			new WooCommerce\SingleProduct(),
			new WooCommerce\ContentProduct(),
			new WooCommerce\Checkout(),
			new WooCommerce\Account(),
			new WooCommerce\ProductsSlider(),
			new WooCommerce\FeaturedAttributes(),
			new WooCommerce\Ajax\UpdateCartContents(),
		];
	}

	private function additionalComponents(): array {
		return [
			new FluidCheckout()
		];
	}
}

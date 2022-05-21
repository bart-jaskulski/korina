<?php declare( strict_types=1 );

namespace CleanWeb\Extensions\WooCommerce;

class ProductsSlider implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('init', fn() => $this->registerPostType());
		add_shortcode('korina_produkty', fn($args) => $this->displayShortcode($args));
	}

	private function registerPostType(): void {
		register_post_type(
			'korina-slide',
			[
				'label' => 'Slider produktów',
				'public' => false,
				'show_ui' => true,
				'supports' => [
					'title',
					'custom-fields'
				],
				'register_meta_box_cb' => fn() => $this->registerMetaBox(),
			]
		);
	}

	private function registerMetaBox(): void {
		add_meta_box(
			'slide',
			'Ustawienia slidera',
			fn() => $this->displayMetaBox()
		);
	}

	private function displayMetaBox(): void {
		echo '';
	}

	private function displayShortcode( $args ): string {
		if (!isset($args['id'])) {
			return '';
		}

		$id = absint($args['id']);

		$products = wc_get_products([
			'limit' => 8,
			'orderby' => 'date',
			'order' => 'DESC'
		]);

		ob_start();

		get_template_part(
			'templates/products-slider',
			args: [
				'title' => get_the_title($id),
				'products' => $products
			]
		);

		return ob_get_clean();
	}

}

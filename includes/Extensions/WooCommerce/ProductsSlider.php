<?php declare( strict_types=1 );

namespace CleanWeb\Extensions\WooCommerce;

class ProductsSlider implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('init', fn() => $this->registerPostType());
		add_action('save_post_korina-slide', fn($id) => $this->savePost($id));
		add_shortcode('korina_produkty', fn($args) => $this->displayShortcode($args));
	}

	private function registerPostType(): void {
		register_post_type(
			'korina-slide',
			[
				'label' => 'Slider produktów',
				'public' => false,
				'show_ui' => true,
				'supports' => [ 'title' ],
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
		woocommerce_wp_checkbox(
			[
				'label' => 'Wyróżnione?',
				'id' => 'featured',
				'name' => 'featured'
			]
		);

		woocommerce_wp_text_input([
			'type' => 'number',
			'label' => 'Limit',
			'id' => 'limit',
			'name' => 'limit',
			'placeholder' => 8,
			'custom_attributes' => [
				'min' => 8
			]
		]);

		woocommerce_wp_select([
			'id' => 'product-categories',
			'label' => 'Kategoria produktu',
			'name' => 'category',
			'options' => $this->getProductCategories(),
		]);
	}

	private function savePost(int $postId) {
		update_post_meta($postId, 'limit', $_POST['limit'] ?? 8);
		update_post_meta($postId, 'featured', $_POST['featured'] ?? false);
	}

	private function displayShortcode( $args ): string {
		if (!isset($args['id'])) {
			return '';
		}

		$id = absint($args['id']);

		$productsArgs    = [
			'limit'   => get_post_meta( $id, 'limit', true ) ?: 8,
			'orderby' => 'date',
			'order'   => 'DESC'
		];
		if ( get_post_meta( $id, 'featured', true ) ) {
			$productsArgs['include'] = wc_get_featured_product_ids();
		}
		$products = wc_get_products( $productsArgs );

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

	private function getProductCategories(): array {
		/** @var \WP_Term[] $categories */
		$categories = get_categories( [
			'taxonomy' => 'product_cat'
		] );

		$result = [];
		foreach ( $categories as $category ) {
			$result[$category->term_id] = $category->name;
		}

		return $result;
	}

}

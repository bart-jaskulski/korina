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
			fn($post) => $this->displayMetaBox($post)
		);
	}

	private function displayMetaBox(\WP_Post $post): void {
		wp_enqueue_script('select2');
		wp_enqueue_script('wc-admin-meta-boxes');
		wp_enqueue_style('woocommerce_admin_styles');

		get_template_part(
			'templates/admin/products_slider_settings',
			args: [
				'selectedCategories' => $this->getProductCategories($post->ID),
				'selectedProducts' => $this->getProducts($post->ID),
				'excludedProducts' => $this->getExcludedProducts($post->ID),
			]
		);
	}

	private function savePost(int $postId) {
		update_post_meta($postId, 'products_ids', array_unique($_POST['products_ids'] ?? []));
		update_post_meta($postId, 'excluded_products_ids', array_unique($_POST['excluded_products_ids'] ?? []));
		update_post_meta($postId, 'categories_slugs', array_unique($_POST['categories_slugs'] ?? []));
		update_post_meta($postId, 'in_stock', $_POST['in_stock'] ?? false);
		update_post_meta($postId, 'featured', $_POST['featured'] ?? false);
		update_post_meta($postId, 'limit', $_POST['limit'] ?? 8);
	}

	private function displayShortcode( $args ): string {
		if (!isset($args['id'])) {
			return '';
		}

		$id = absint($args['id']);

		$limit          = get_post_meta( $id, 'limit', true ) ?: 8;
		$productsArgs = [
			'limit'   => $limit,
			'status' => ['publish'],
			'orderby' => 'date',
			'order'   => 'DESC'
		];
		$include      = get_post_meta($id, 'products_ids', true);
		$featured     = get_post_meta( $id, 'featured', true );
		if (!empty($include) && $featured) {
			$productsArgs['include'] = array_unique( array_merge( $include, wc_get_featured_product_ids() ) );
		} elseif ($featured) {
			$productsArgs['include'] = wc_get_featured_product_ids();
		} elseif (!empty($include)) {
			$productsArgs['include'] = $include;
		}

		$exclude_ids = get_post_meta( $id, 'excluded_products_ids', true );
		if (!empty( $exclude_ids )) {
			$productsArgs['exclude'] = $exclude_ids;
		}
		$categories = get_post_meta($id, 'categories_slugs', true);
		if (!empty($categories)) {
			$productsArgs['category'] = $categories;
		}
		if (get_post_meta($id, 'in_stock', true)) {
			$productsArgs['stock_status'] = 'instock';
		}
		$products = wc_get_products( $productsArgs );
		if (count($products) < $limit) {
			if (current_user_can('manage_options')) {
				return "<p style='font-size: 18px; color: red'>W tym sliderze brakuje produktów, żeby wyświetlić go na stronie!</p>";
			}
			return '';
		}

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

	private function getProductCategories(int $postId): array {
		$categories = get_post_meta($postId, 'categories_slugs', true) ?: [];

		$result = [];
		foreach ( $categories as $category_slug ) {
			$category = get_term_by('slug', $category_slug, 'product_cat');
			$result[$category_slug] = $category->name;
		}

		return $result;
	}

	private function getProducts(int $postId): array {
		$products_id = get_post_meta($postId, 'products_ids', true) ?: [];

		$result = [];
		foreach ( $products_id as $product_id ) {
			$product = wc_get_product($product_id);
			if ($product instanceof \WC_Product) {
				$result[$product_id] = $product->get_formatted_name();
			}
		}

		return $result;
	}

	private function getExcludedProducts(int $postId): array {
		$products_id = get_post_meta($postId, 'excluded_products_ids', true) ?: [];

		$result = [];
		foreach ( $products_id as $product_id ) {
			$product = wc_get_product($product_id);
			if ($product instanceof \WC_Product) {
				$result[$product_id] = $product->get_formatted_name();
			}
		}

		return $result;
	}

}

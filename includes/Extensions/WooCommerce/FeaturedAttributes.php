<?php declare( strict_types=1 );

namespace CleanWeb\Extensions\WooCommerce;

class FeaturedAttributes implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('product_cat_edit_form_fields', fn($term) => $this->addFields($term));
		add_action('admin_init', fn() => $this->enqueueScripts());
		add_action('edit_term', fn($term_id, $_, $taxonomy) => $this->saveCategoryFields($term_id, $taxonomy), accepted_args: 3);
		add_action('created_term', fn($term_id, $_, $taxonomy) => $this->saveCategoryFields($term_id, $taxonomy), accepted_args: 3);
		add_action('cleanweb/single_product/details', fn($id) => $this->displayFeaturedAttributes($id));
	}

	private function addFields(\WP_Term $term): void {
		$attributes = wc_get_attribute_taxonomies();
		$selectedAttributesRaw = get_term_meta( $term->term_id, 'attributes_sort', true ) ?: [];
		$selectedAttributes = array_map(
			fn($attributeRaw) => $attributes["id:$attributeRaw"],
			$selectedAttributesRaw
		);
		$availableAttributes = array_filter(
			$attributes,
			fn($attribute) => !in_array($attribute->attribute_id, $selectedAttributesRaw, false)
		);
		get_template_part(
			'templates/admin/featured_attributes',
			args: [
				'allAttributes' => $attributes,
				'attributes' => $availableAttributes,
				'availableAttributes' => $availableAttributes,
				'selectedAttributes' => $selectedAttributes,
			]
		);
	}

	private function enqueueScripts(): void {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-mouse');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('select2');
	}

	private function saveCategoryFields($term_id, $taxonomy = ''): void {
		if ($taxonomy !== 'product_cat') {
			return;
		}

		update_term_meta($term_id, 'attributes_sort', $_POST['attributes_sort']);
	}

	private function displayFeaturedAttributes( int $product_id ): void {
		wc_get_template(
			'single-product/product-featured-attributes.php',
			['featuredAttributes' => $this->getFeaturedAttributes($product_id) ]
		);
	}

	private function getFeaturedAttributes( int $product_id ): array {
		$product = wc_get_product($product_id);

		$result = [];
		foreach ( $product->get_category_ids() as $cat_id ) {
			$term           = $this->getTopCategory( $cat_id );
			$attributes_ids = get_term_meta($term->term_id, 'attributes_sort', true) ?: [];
			foreach ( $attributes_ids as $attributes_id ) {
				$attribute = wc_get_attribute( $attributes_id );
				$productAttribute               = $product->get_attribute( $attribute->slug );
				if (!empty($productAttribute)) {
					$result[$attribute->name] = $productAttribute;
				}
				if (count($result) >= 3) {
					// We use hardcoded limit of 3 elements in list.
					break 2;
				}
			}
		}

		return array_filter($result);
	}

	private function getTopCategory( int $category_id ): array|null|\WP_Error|\WP_Term {
		$term = get_term( $category_id );
		while ( $term->parent !== 0 ) {
			$term = get_term( $term->parent );
		}

		return $term;
	}
}

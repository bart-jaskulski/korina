<?php declare( strict_types=1 );

namespace CleanWeb\Extensions\WooCommerce;

class FeaturedAttributes implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('product_cat_edit_form_fields', fn($term) => $this->addFields($term));
		add_action('admin_init', fn() => $this->enqueueScripts());
		add_action('edit_term', fn($term_id, $_, $taxonomy) => $this->saveCategoryFields($term_id, $taxonomy), accepted_args: 3);
		add_action('created_term', fn($term_id, $_, $taxonomy) => $this->saveCategoryFields($term_id, $taxonomy), accepted_args: 3);
	}

	private function addFields(\WP_Term $term): void {
		$attributes = wc_get_attribute_taxonomies();
		$selectedAttributesRaw = get_term_meta( $term->term_id, 'attributes_sort', true ) ?: [];
		$selectedAttributes = array_map(
			fn($attributeRaw) => $attributes["id:$attributeRaw"],
			$selectedAttributesRaw
		);
		get_template_part(
			'templates/admin/featured_attributes',
			args: [
				'attributes' => $attributes,
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
}

<?php
/**
 * @var array{
 *     selectedCategories: array<string, string>,
 *     selectedProducts: array<string, string>,
 *     excludedProducts: array<string, string>
 * } $args
 */
?>
<div class="woocommerce_options_panel">
	<div class="options_group">
		<p class="form-field">
			<label for="categories-ids">Wybierz kategorie produktów</label>
			<select
				id="categories-ids"
				class="wc-category-search"
				multiple="multiple"
				style="width: 50%;"
				name="categories_slugs[]"
				data-placeholder="Wybierz kategorie..."
				data-action="woocommerce_json_search_categories">
				<?php foreach ( $args['selectedCategories'] as $category => $value ) { ?>
					<option value="<?php echo esc_attr($category); ?>" selected><?php echo esc_html( $value ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p class="form-field">
			<label for="products-ids">Wybierz produkty</label>
			<select
				id="products-ids"
				class="wc-product-search"
				multiple="multiple"
				style="width: 50%;"
				name="products_ids[]"
				data-placeholder="Szukaj produktów..."
				data-action="woocommerce_json_search_products">
				<?php foreach ( $args['selectedProducts'] as $product_id => $value ) { ?>
					<option value="<?php echo esc_attr($product_id); ?>" selected><?php echo esc_html( wp_strip_all_tags($value) ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p class="form-field">
			<label for="exclude-product-ids">Pomiń produkty</label>
			<select
				id="exclude-product-ids"
				class="wc-product-search"
				multiple="multiple"
				style="width: 50%;"
				name="excluded_products_ids[]"
				data-placeholder="Szukaj produktów..."
				data-action="woocommerce_json_search_products_and_variations">
				<?php foreach ( $args['excludedProducts'] as $product_id => $value ) { ?>
					<option value="<?php echo esc_attr($product_id); ?>" selected><?php echo esc_html( wp_strip_all_tags($value) ); ?></option>
				<?php } ?>
			</select>
		</p>
		<?php
		woocommerce_wp_text_input([
			'type' => 'number',
			'label' => 'Ilość produktów w sliderze',
			'id' => 'limit',
			'name' => 'limit',
			'placeholder' => 8,
			'custom_attributes' => [
				'min' => 8
			]
		]);

		woocommerce_wp_checkbox([
			'label' => 'Pokaż tylko wyróżnione',
			'id' => 'featured',
			'name' => 'featured'
		]);

		woocommerce_wp_checkbox([
			'label' => 'Pokaż tylko produkty na stanie',
			'id' => 'in_stock',
			'name' => 'in_stock'
		]);
		?>
	</div>
</div>
<script>
	(function ($) {
		$(document.body).trigger('wc-enhanced-select-init')
	})(jQuery)
</script>

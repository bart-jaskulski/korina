<?php declare( strict_types=1 );

namespace CleanWeb\Extensions\ThemeExtensions;

use CleanWeb\Component;

class ProducersSlider implements Component {

	public function initialize(): void {
		add_action('init', fn() => $this->registerPostType());
		add_action('save_post_korina-producers', fn($id) => $this->savePost($id));
		add_shortcode('korina_producenci', fn() => $this->displayShortcode());
	}

	private function registerPostType(): void {
		register_post_type(
			'korina-producers',
			[
				'label' => 'Producenci',
				'public' => false,
				'show_ui' => true,
				'supports' => [
					'title',
					'thumbnail'
				],
				'register_meta_box_cb' => fn() => $this->registerMetaBox()
			]
		);
	}

	private function registerMetaBox(): void {
		add_meta_box(
			'link',
			'Link do produktów',
			fn($post) => $this->displayMetaBox($post)
		);
	}

	private function displayMetaBox( \WP_Post $post ): void {
		woocommerce_wp_text_input([
			'label' => 'Link do produktów producenta',
			'id' => 'producer_link'
		]);
	}

	private function savePost( int $id ): void {
		update_post_meta($id, 'producer_link', sanitize_text_field($_POST['producer_link'] ?? ''));
	}

	private function displayShortcode(): string {
		$featurePosts = get_posts([
			'post_type' => 'korina-producers',
			'limit' => -1
		]);

		ob_start();
		get_template_part('templates/producers-slider', args: $featurePosts);
		return ob_get_clean();
	}
}

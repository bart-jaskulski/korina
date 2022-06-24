<?php declare( strict_types=1 );

namespace CleanWeb\Extensions\ThemeExtensions;

class Reviews implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('init', fn() => $this->registerPostType());
		add_action('save_post_korina-review', fn($id) => $this->savePost($id));
		add_shortcode('korina_opinie', fn() => $this->displayShortcode());
	}

	private function registerPostType(): void {
		register_post_type(
			'korina-review',
			[
				'label' => 'Opinie o sklepie',
				'public' => false,
				'show_ui' => true,
				'supports' => [
					'title',
					'editor',
					'thumbnail',
				],
				'register_meta_box_cb' => fn() => $this->registerMetaBox()
			]
		);
	}

	private function registerMetaBox(): void {
		add_meta_box(
			'settings',
			'Dodatkowe informacje',
			fn() => $this->displayMetaBox(),
			context: 'side'
		);
	}

	private function displayMetaBox(): void {
		woocommerce_wp_radio([
			'label' => 'Ilość gwiazdek',
			'options' => [
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
			],
			'id' => 'stars',
			'name' => 'stars'
		]);

		woocommerce_wp_text_input([
			'label' => 'Nazwa autora',
			'id' => 'comment_author',
			'name' => 'comment_author'
		]);
	}

	private function savePost( int $id ): void {
		update_post_meta($id, 'stars', $_POST['stars'] ?? '5');
		update_post_meta($id, 'comment_author', $_POST['comment_author'] ?? '');
	}

	private function displayShortcode(): string {
		$reviewsPosts = get_posts([
			'post_type' => 'korina-review',
			'posts_per_page' => -1,
			'order' => 'random'
		]);
		ob_start();
		get_template_part('templates/reviews-slider', args: $reviewsPosts);
		return ob_get_clean();
	}
}

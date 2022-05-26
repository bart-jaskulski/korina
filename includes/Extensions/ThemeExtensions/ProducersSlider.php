<?php declare( strict_types=1 );

namespace CleanWeb\Extensions\ThemeExtensions;

use CleanWeb\Component;

class ProducersSlider implements Component {

	public function initialize(): void {
		add_action('init', fn() => $this->registerPostType());
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
					'editor',
					'thumbnail'
				]
			]
		);
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

<?php declare( strict_types=1 );

namespace CleanWeb\Extensions\ThemeExtensions;

class Reviews implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('init', fn() => $this->register_post_type());
	}

	private function register_post_type(): void {
		register_post_type(
			'korina-review',
			[
				'label' => 'Opinie o sklepie',
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
}

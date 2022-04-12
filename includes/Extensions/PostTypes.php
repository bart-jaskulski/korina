<?php

namespace CleanWeb\Extensions;

final class PostTypes implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('init', [$this, 'register_post_types']);
	}

	public function register_post_types(): void {
		register_post_type(
			'korina_review',
			[
				'label' => 'Opinie',
				'public' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'supports' => ['title', 'editor', 'thumbnail']
			]
		);
	}
}

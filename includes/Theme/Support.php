<?php

namespace CleanWeb\Theme;

use CleanWeb\Component;

final class Support implements Component {

	public function initialize(): void {
		add_action( 'after_setup_theme', [ $this, 'register_theme_support' ] );
	}

	public function register_theme_support(): void {
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			[
				'height'      => 100,
				'width'       => 400,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		// Add default RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Ensure WordPress manages the document title.
		add_theme_support( 'title-tag' );

		add_theme_support( 'widgets' );

		// Ensure WordPress theme features render in HTML5 markup.
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			]
		);

		// Add support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// WooCommerce support
		add_theme_support( 'woocommerce' );
	}

}

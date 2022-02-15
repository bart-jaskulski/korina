<?php

namespace CleanWeb\Theme;

use CleanWeb\Component;
use CleanWeb\Theme;

final class Assets implements Component {

	private static array $manifest;

	public function __construct() {
		 self::$manifest = json_decode( file_get_contents( get_stylesheet_directory() . '/manifest.json' ), true, 512, JSON_THROW_ON_ERROR );
	}

	public function initialize(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts_and_styles' ] );
		add_action( 'admin_init', [ $this, 'add_editor_styles' ] );
	}

	public function enqueue_scripts_and_styles(): void {
		wp_enqueue_style( 'kwhd', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . self::$manifest['assets/css/style.css'], [], Theme::VERSION );
		wp_enqueue_style( 'kwhd-old', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . self::$manifest['assets/css/old.css'], [], Theme::VERSION );
		wp_enqueue_script( 'kwhd', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . self::$manifest['assets/js/index.ts'], [], Theme::VERSION, true );
		wp_enqueue_style( 'shop', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . self::$manifest['assets/css/shop.css'], [], Theme::VERSION );
	}

	public function add_editor_styles(): void {
		add_editor_style( self::$manifest['assets/css/editor.css'] );
	}
}

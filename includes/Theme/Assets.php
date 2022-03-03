<?php

namespace CleanWeb\Theme;

use CleanWeb\Component;
use CleanWeb\Theme;
use LogicException;

final class Assets implements Component {

	/**
	 * @param string[] $manifest
	 */
	public function __construct(
		private array $manifest
	) {}

	public function initialize(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts_and_styles' ] );
		add_action( 'admin_init', [ $this, 'add_editor_styles' ] );
	}

	private function get_asset( string $asset_path ): string {
		return isset( $this->manifest[ $asset_path ] ) ?
			get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . $this->manifest[ $asset_path ] :
			throw new LogicException();
	}

	public function enqueue_scripts_and_styles(): void {
		wp_enqueue_style('font', 'https://fonts.googleapis.com/css2?family=Lato&display=swap', [], 1);
		wp_enqueue_style( 'main', $this->get_asset( 'assets/css/style.css' ), [], Theme::VERSION );
		// wp_enqueue_style( 'kwhd', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . $this->manifest['assets/css/style.css'], [], Theme::VERSION );
		// wp_enqueue_style( 'kwhd-old', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . $this->manifest['assets/css/old.css'], [], Theme::VERSION );
		// wp_enqueue_script( 'kwhd', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . $this->manifest['assets/js/index.ts'], [], Theme::VERSION, true );
		// wp_enqueue_style( 'shop', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . $this->manifest['assets/css/shop.css'], [], Theme::VERSION );
	}

	public function add_editor_styles(): void {
		// add_editor_style( $this->manifest['assets/css/editor.css'] );
	}
}

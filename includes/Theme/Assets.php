<?php

namespace CleanWeb\Theme;

use CleanWeb\Component;
use CleanWeb\Manifest;
use CleanWeb\Theme;
use LogicException;

final class Assets implements Component {

	public function __construct(
		private Manifest $manifest
	) {}

	public function initialize(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts_and_styles' ] );
		add_action( 'admin_init', [ $this, 'add_editor_styles' ] );
	}

	private function get_asset( string $asset_path ): string {
		return $this->manifest->has( $asset_path ) ?
			get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . $this->manifest->get( $asset_path ) :
			throw new LogicException();
	}

	public function enqueue_scripts_and_styles(): void {
		wp_enqueue_style( 'font', 'https://fonts.googleapis.com/css2?family=Lato&display=swap', [], 1 );
		wp_enqueue_style( 'main', $this->get_asset( 'assets/css/style.css' ), [], Theme::VERSION );
		wp_enqueue_script( 'increment-input', $this->get_asset( 'assets/js/increment-input.ts' ), [], Theme::VERSION, true );
		wp_enqueue_script( 'main', $this->get_asset( 'assets/js/index.ts' ), [], Theme::VERSION, true );
	}

	public function add_editor_styles(): void {
		// add_editor_style( $this->manifest['assets/css/editor.css'] );
	}
}

<?php declare( strict_types=1 );

namespace CleanWeb\Theme;

class Settings implements \CleanWeb\Component {

	public function initialize(): void {
		add_action('admin_menu', fn() => $this->addSettingsPage());
		add_action('admin_post_save_theme_settings', fn() => $this->saveThemeSettings());
	}

	private function addSettingsPage(): void {
		add_theme_page(
			'Ustawienia motywu',
			'Ustawienia motywu',
			'edit_others_posts',
			'theme-settings',
			fn() => $this->displaySettingsPage()
		);
	}

	private function displaySettingsPage(): void {
		get_template_part(
			'templates/admin/theme-settings',
			args: [
				'email' => get_theme_mod('korina_email'),
				'phone' => get_theme_mod('korina_phone')
			]
		);
	}

	private function saveThemeSettings(): void {
		set_theme_mod('korina_email', sanitize_email($_POST['email'] ?? ''));
		set_theme_mod('korina_phone', sanitize_text_field($_POST['phone'] ?? ''));

		wp_safe_redirect(
			wp_get_referer()
		);
		exit;
	}
}

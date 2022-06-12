<?php
/**
 * @var array{email: string, phone: string} $args
 */
?>

<form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
	<input type="hidden" name="action" value="save_theme_settings"/>
	<label>
		Email
		<input name="email" type="email" value="<?php echo esc_attr($args['email'] ?: '') ?>"/>
	</label>
	<label>
		Telefon
		<input name="phone" type="tel" value="<?php echo esc_attr($args['phone'] ?: '') ?>"/>
	</label>
	<button type="submit">Zapisz</button>
</form>

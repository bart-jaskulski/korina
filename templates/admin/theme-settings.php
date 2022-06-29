<?php
/**
 * @var array{email: string, phone: string} $args
 */
?>

<h1 class="wp-heading-inline">Ustawienia motywu</h1>
<form style="max-width: 600px" method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
	<input type="hidden" name="action" value="save_theme_settings"/>
	<p class="form-field">
		<label for="email">Email</label>
		<input id="email" name="email" type="email" value="<?php echo esc_attr($args['email'] ?: '') ?>"/>
	</p>
	<p class="form-field">
		<label for="phone">Telefon</label>
		<input id="phone" name="phone" type="tel" value="<?php echo esc_attr( $args['phone'] ?: '' ) ?>"/>
	</p>
	<button class="button" type="submit">Zapisz</button>
</form>
<div>
	<h2>Dostępne shortcode</h2>
	<table style="max-width: 800px;">
		<tr>
			<th>Shortcode</th>
			<th>Użycie</th>
		</tr>
		<tr>
			<td><pre>[korina_producenci]</pre></td>
			<td><p>Wyświetla slider ze wszystkimi producentami dodanymi na <a href="<?php echo esc_url(admin_url('edit.php?post_type=korina-producers')); ?>">tej stronie</a></p></td>
		</tr>
		<tr>
			<td><pre>[korina_features]</pre></td>
			<td><p>Wyświetla slider ze wszystkimi wyróżnionymi informacjami dodanymi na <a href="<?php echo esc_url(admin_url('edit.php?post_type=korina-features')); ?>">tej stronie</a></p></td>
		</tr>
		<tr>
			<td><pre>[korina_produkty id="&lt;id&gt;"]</pre></td>
			<td>
				<p>Wyświetla wybrany slider z produktami według konfiguracji. Parametr ID odpowiada ID posta, dla którego został skonfigurowany slider. Posty można znaleźć na <a href="<?php echo esc_url(admin_url('edit.php?post_type=korina-slide')); ?>">tej stronie</a></p>
				<p>Uwaga: tytuł posta, przypisany do slidera staje się jego nagłówkiem widocznym na stronie.</p>
			</td>
		</tr>
		<tr>
			<td><pre>[korina_opinie]</pre></td>
			<td><p>Wyświetla slider ze wszystkimi opiniami dodanymi na <a href="<?php echo esc_url(admin_url('edit.php?post_type=korina-review')); ?>">tej stronie</a></p></td>
		</tr>
	</table>
</div>

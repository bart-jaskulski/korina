<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<form method="post" class="l-flow woocommerce-ResetPassword lost_reset_password" data-flow-size="sm">

	<div class="bg-white rounded-[4px] max-w-[320px] p-4 l-flow" data-flow-size="sm">
		<p><strong>Nie pamiętam hasła</strong></p>
		<p>Wpisz e-mail przypisany do twojego konta, a wyślemy na niego link, dzięki któremu zresetujesz hasło.</p>
	</div>

	<p class="c-form-row | l-flow" data-flow-size="sm">
		<label for="user_login">Email</label>
		<input class="woocommerce-Input woocommerce-Input--text input-text"
			   type="text"
			   name="user_login"
			   id="user_login"
			   autocomplete="email" />
	</p>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit"
				class="c-button woocommerce-Button button"
				data-button-type="filled"
				data-button-width="full"
				value="Odzyskaj hasło">Odzyskaj hasło</button>
	</p>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
<?php
do_action( 'woocommerce_after_lost_password_form' );

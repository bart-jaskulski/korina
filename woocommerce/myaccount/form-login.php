<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="flex flex-wrap justify-center gap-[200px]" id="customer_login">

	<div class="basis-[320px]">

		<h2 class="text-center font-lg font-extrabold mb-9">Mam konto</h2>

		<form class="l-flow | l-login" method="post">

			<p class="c-form-row | l-flow" data-flow-size="xs">
				<label for="username">Email</label>
				<input type="text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="c-form-row | l-flow" data-flow-size="xs">
				<label for="password">Hasło</label>
				<span>
				<input type="password" name="password" id="password" autocomplete="current-password" />
			</span>
			</p>

			<label class="c-checkbox-control">
				<input class="" name="rememberme" type="checkbox" id="rememberme" value="forever" />
				<span>Zapamiętaj mnie</span>
			</label>
			<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
			<button type="submit" class="c-button woocommerce-button button woocommerce-form-login__submit" data-button-type="filled" data-button-width="full" name="login" value="Zaloguj się">Zaloguj się</button>
			<button type="button"
					class="c-button | js-lost-password"
					style="--button-color: var(--black)"
					data-button-type="flat"
					data-button-width="full">
				Nie pamiętasz hasła?
			</button>

		</form>

		<div class="l-flow | l-lost-password" data-flow-size="sm" aria-hidden="true">
			<?php // If we are on login page, we don't want to output notices. ?>
			<?php remove_action('woocommerce_before_lost_password_form', 'woocommerce_output_all_notices'); ?>

			<?php wc_get_template('myaccount/form-lost-password.php'); ?>
			<button class="c-button | js-return-login"
					style="--button-color: var(--black)"
					data-button-type="flat"
					data-button-width="full">
				Wróć do logowania
			</button>
		</div>
	</div>

	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	<div class="basis-[320px]">

		<h2 class="text-center font-lg font-extrabold | mb-9">Nie mam konta</h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<div class="l-encourage-creation | l-flow" data-flow-size="md">
				<button class="c-button js-show-register-form" data-button-type="filled" data-button-width="full">Załóż konto</button>

				<div class="l-flow | bg-white | p-4 | rounded-[4px]" data-flow-size="sm">
					<p><strong>Dlaczego warto założyć konto?</strong></p>
					<ul>
						<li>Szybsze zakupy</li>
						<li>Łatwe śledzenie aktualnego zamówienia</li>
						<li>Dostęp do historii zamówień</li>
						<li>Rabat 100 zł na następne zakupy<sup>*</sup></li>
					</ul>
					<p><small><sup>*</sup> Przy zamówieniu powyżej 1500 zł</small></p>
				</div>
			</div>

			<div class="l-create-account | l-flow" data-flow-size="sm" aria-hidden="true">
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="c-form-row | l-flow" data-flow-size="xs">
						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>

				<?php endif; ?>

				<p class="c-form-row | l-flow" data-flow-size="xs">
					<label for="reg_email">Email</label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class='c-form-row | l-flow' data-flow-size='xs'>
						<label for='reg_password'>Hasło</label>
						<span>
							<input type='password'
								   name='password'
								   id='reg_password'
								   autocomplete='new-password'/>
						</span>
					</p>

				<?php else : ?>

					<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

				<?php endif; ?>

				<p class="c-form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit"
							class="c-button woocommerce-Button woocommerce-button button woocommerce-form-register__submit"
							data-button-type="filled"
							data-button-width="full"
							name="register"
							value="Utwórz konto">
						Utwórz konto
					</button>
				</p>

				<button class="c-button | js-hide-register-form"
						style="--button-color: var(--black);"
						data-button-type="flat"
						data-button-width="full">Wróć</button>

			</div>

		</form>

	</div>

	<?php endif; ?>

</div>

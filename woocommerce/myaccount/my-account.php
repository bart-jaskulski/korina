<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

global $wp;
?>

<div class="flex flex-wrap gap-8">
<nav class='basis-[180px] woocommerce-MyAccount-navigation'>
	<ul class>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="text-sm <?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
				<a class="inline-block py-3" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<div class="flex-grow basis-[70%] woocommerce-MyAccount-content">
	<?php do_action( 'woocommerce_account_content' ); ?>
</div>
</div>

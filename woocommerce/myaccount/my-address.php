<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		[
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		],
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		[
			'billing' => __( 'Billing address', 'woocommerce' ),
		],
		$customer_id
	);
}
?>

<h2 class="text-base font-extrabold">Adresy</h2>
<p>Poniższe adresy będą domyślnie wykorzystane podczas realizacji zamówienia.</p>

<div class="grid grid-cols-2 gap-4">

	<?php foreach ( $get_addresses as $name => $address_title ) : ?>
		<?php
		$address = wc_get_account_formatted_address( $name );
		?>

		<div>
			<header class="l-flow" data-flow-size="sm">
				<h3 class="text-[18px] font-extrabold"><?php echo esc_html( $address_title ); ?></h3>
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="c-button" data-button-type="filled">
					<?php echo $address ? esc_html__( 'Edit', 'woocommerce' ) : 'Dodaj adres'; ?>
				</a>
			</header>
			<?php if ( $address ) { ?>
				<address>
					<?php echo wp_kses_post( $address ); ?>
				</address>
			<?php } ?>
		</div>

	<?php endforeach; ?>

</div>

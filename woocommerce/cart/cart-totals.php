<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */
use Timber\Timber;

defined( 'ABSPATH' ) || exit;

$context = Timber::context([
	'coupons' => WC()->cart->get_coupons(),
	'calculated_shipping' => WC()->customer->has_calculated_shipping(),
	'needs_shipping' => WC()->cart->needs_shipping(),
	'show_shipping' => WC()->cart->show_shipping(),
	'fees' => WC()->cart->get_fees(),
	'display_prices_including_tax' => WC()->cart->display_prices_including_tax(),
]);

if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
	$taxable_address = WC()->customer->get_taxable_address();
	$estimated_text  = '';

	if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
		/* translators: %s location. */
		$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
	}

	$context['display_tax'] = true;
	$context['estimated_text'] = $estimated_text;
	$context['tax_totals'] = WC()->cart->get_tax_totals();
	$context['tax_or_vat'] = WC()->countries->tax_or_vat();
}

Timber::render( 'woocommerce/cart/cart-totals.twig', $context );

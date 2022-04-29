<?php
/**
 * Totals
 *
 * This template can be overridden by copying it to yourtheme/templates/side-cart-woocommerce/global/footer/totals.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 *
 * @see     https://docs.xootix.com/side-cart-woocommerce/
 * @version 2.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

extract( Xoo_Wsc_Template_Args::footer_totals() );

?>

<?php
if ( WC()->cart->is_empty() ) {
	return;}
?>

<table id="cart-totals">
	<?php foreach ( $totals as $key => $data ) : ?>
	<tr class="font-bold">
		<th class="py-4"><?php echo esc_html( $data['label'] ); ?></th>
		<td class="py-4 text-right subtotal"><?php echo ( $data['value'] ); ?></td>
	</tr>
	<?php endforeach; ?>
</table>

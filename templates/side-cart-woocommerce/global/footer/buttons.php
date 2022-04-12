<?php
/**
 * Footer Buttons
 *
 * This template can be overridden by copying it to yourtheme/templates/side-cart-woocommerce/global/footer/buttons.php.
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


extract( Xoo_Wsc_Template_Args::footer_buttons() );

do_action( 'xoo_wsc_before_footer_btns' );

$buttonHTML = '<a href="%1$s" class="c-button %2$s" data-button-type="filled" data-button-width="full">%3$s</a>';

?>
<div class="text-sm | xoo-wsc-ft-buttons-cont">
	<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="c-button" data-button-type="filled" data-button-width="full">Idź do kasy</a>
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="c-button underline" data-button-type="flat" data-button-width="full">Zobacz swój koszyk</a>
</div>

<?php do_action( 'xoo_wsc_after_footer_btns' ); ?>

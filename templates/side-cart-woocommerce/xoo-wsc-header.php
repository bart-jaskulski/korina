<?php
/**
 * Side Cart Header
 *
 * This template can be overridden by copying it to yourtheme/templates/side-cart-woocommerce/xoo-wsc-header.php.
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

extract( Xoo_Wsc_Template_Args::cart_header() );

?>

<div class="[ flex flex-wrap items-center ] [ p-6 ] [ border-solid border-neutral-3 border-0 border-b ]">
	<?php if ( $showNotifications ) : ?>
		<?php xoo_wsc_cart()->print_notices_html( 'cart' ); ?>
	<?php endif; ?>

	<strong class="text-md">Koszyk</strong>

	<?php if ( $showCloseIcon ) : ?>
		<span class="xoo-wsch-close icon-close"></span>
	<?php endif; ?>

</div>

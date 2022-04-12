<?php
/**
 * Side Cart Container
 *
 * This template can be overridden by copying it to yourtheme/templates/side-cart-woocommerce/xoo-wsc-container.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 * @see     https://docs.xootix.com/side-cart-woocommerce/
 * @version 2.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

extract( Xoo_Wsc_Template_Args::cart_container() );

?>

<div class="l-side-cart | text-black | xoo-wsc-container">

	<?php xoo_wsc_helper()->get_template( 'xoo-wsc-header.php' ); ?>

	<div class="p-6 xoo-wsc-body">
		<?php xoo_wsc_helper()->get_template( 'xoo-wsc-body.php' ); ?>
	</div>

	<div class="p-6 xoo-wsc-footer">
		<?php xoo_wsc_helper()->get_template( 'xoo-wsc-footer.php' ); ?>
	</div>

	<span class="xoo-wsc-loader"></span>

</div>

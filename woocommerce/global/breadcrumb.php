<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) { ?>
	<nav class="[ text-sm uppercase ] woocommerce-breadcrumb">
		<?php
		foreach ( array_values( $breadcrumb ) as $key => $crumb ) {

			if ( ! empty( $crumb[1] ) && count( $breadcrumb ) !== $key + 1 ) {
				?>
				<a class="text-neutral-7" href="<?php echo esc_url( $crumb[1] ); ?>">
					<?php echo esc_html( $crumb[0] ); ?>
				</a>
			<?php } else { ?>
				<b><?php echo esc_html( $crumb[0] ); ?></b>
			<?php } ?>

			<?php if ( count( $breadcrumb ) !== $key + 1 ) { ?>
				<i class="text-xs mx-2 text-neutral-4 icon-right-thin"></i>
				<?php
			}
		}
		?>
	</nav>
<?php } ?>

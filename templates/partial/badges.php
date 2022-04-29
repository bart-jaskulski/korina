<?php
/**
 * @var array{product: WC_Product} $args
 */
$product = $args['product'];
?>
<?php if ( $product->is_on_sale() ) : ?>
	<span class="c-badge | onsale" data-badge-type="dead">Wyprzedaż</span>
<?php endif; ?>
<?php if ( $product->get_date_created() > new DateTime( '-7 days' ) ) : ?>
	<span class="c-badge" data-badge-type="success">Nowość</span>
<?php endif; ?>
<?php if ( $product->is_featured() ) : ?>
	<span class="c-badge" data-badge-type="error">Bestseller</span>
<?php endif; ?>
<?php if ( ! $product->is_in_stock() ) : ?>
	<span class="c-badge" data-badge-type="faint">Na zamówienie</span>
<?php endif; ?>

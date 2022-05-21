<?php
/**
 * @var array{title: string, products: WC_Product[]} $args
 */
?>
<section class="products">
	<h3 class="text-md font-bold | mb-6"><?php echo esc_html( $args['title'] ); ?></h3>
<?php
get_template_part('templates/partial/glider-start');
foreach ( $args['products'] as $product ) {
	$postObject = get_post( $product->get_id() );
	setup_postdata($GLOBALS['post'] =& $postObject);
	wc_get_template_part('content', 'product');
	wp_reset_postdata();
}
get_template_part('templates/partial/glider-end');
?>
</section>

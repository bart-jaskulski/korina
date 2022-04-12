<?php get_header(); ?>

	<section class="c-new-products products mb-20">
		<h3 class="text-md font-bold | mb-6">Nowości</h3>
		<?php get_template_part('templates/partial/glider-start'); ?>
		<?php
		$products = wc_get_products([
			'limit' => 8,
			'orderby' => 'date',
			'order' => 'DESC'
		]);
		foreach ( $products as $product ) {
			$post_object = get_post( $product->get_id() );
			setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
			wc_get_template_part( 'content', 'product' );
		}
		?>
		<?php get_template_part('templates/partial/glider-end'); ?>
	</section>
	<section class="c-featured-products products">
		<h3 class="text-md font-bold | mb-6 ">Bestsellery</h3>
		<?php get_template_part('templates/partial/glider-start'); ?>
		<?php
		foreach ( wc_get_featured_product_ids() as $id ) {
			$post_object = get_post( $id );
			setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
			wc_get_template_part( 'content', 'product' );
		}
		?>

		<?php get_template_part('templates/partial/glider-end'); ?>
	</section>

<?php get_footer();

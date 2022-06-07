<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
// @todo Remember about generating structured data.

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<article id="product-<?php the_ID(); ?>" class="c-single-product | bg-white [ flex flex-wrap items-start flex-col lg:flex-row ] rounded-[4px] [ p-6 mt-7 mb-24 gap-x-6 ]">

	<div class="c-single-product__image w-full lg:w-auto">
		<?php
		$images_ids = array_merge( [ $product->get_image_id() ], $product->get_gallery_image_ids() );
		?>
		<figure id="c-product-images" data-options='<?php echo json_encode(['perView' => 1]); ?>' class="c-product-images lg:w-[500px] woocommerce-product-gallery__wrapper" <?php echo count( $images_ids ) <= 1 ? 'data-hide-arrows="true"' : ''; ?>>
			<?php get_template_part( 'templates/partial/glider-start', args: ['id' => 'product-images', 'options' => ['perView' => 1]] ); ?>
			<?php foreach ( $images_ids as $image ) { ?>
				<li class="glide__slide woocommerce-product-gallery__image">
					<a class="c-product-single-image" href="<?php echo esc_url( $product->get_permalink() ); ?>">
						<?php echo wp_get_attachment_image( $image, 'woocommerce_single' ); ?>
					</a>
				</li>
			<?php } ?>
			<?php get_template_part( 'templates/partial/glider-end' ); ?>
		</figure>
		<?php
		// Show thumbnail below main image if there's more than one.
		if ( count( $images_ids ) > 1 ) { ?>
		<ul class="flex flex-wrap flex-row gap-2 lg:mt-4">
		<?php foreach ( array_values( $images_ids ) as $i => $image ) { ?>
			<li class="woocommerce-product-gallery__image opacity-50 hover:opacity-100 transition-opacity">
				<a href="#" class="js-glide-navigation" data-slide="<?php echo esc_attr( $i ); ?>">
				<img class="c-product-single-image rounded-[4px]"
					 width="60"
					 height="60"
					 src="<?php echo esc_url( wp_get_attachment_image_url( $image, 'thumbnail' ) ); ?>"
					 alt="<?php echo esc_attr( get_post_meta( $image, '_wp_attachment_image_alt', true ) ); ?>" />
				</a>
			</li>
		<?php } ?>
		</ul>
		<?php } ?>
	</div>

	<div class="c-single-product__product | l-flow" data-flow-size="sm">

		<div class="c-badges-container [ flex flex-wrap items-center ] [ gap-2 ]">
			<?php if ($producer = $product->get_attribute('pa_producent')) { ?>
			<span><em><?php echo esc_html( $producer ); ?></em></span>
			<?php } ?>
			<?php get_template_part( 'templates/partial/badges', args: ['product' => $product])?>
		</div>

		<h1 class="text-lg font-black product_title entry-title"><?php the_title(); ?></h1>

		<div class="[ flex flex-wrap ] [ gap-x-4 ] [ text-xs text-pale font-bold ]" style="color: var(--neutral-8)">
			<?php if (!$product->is_on_backorder() && $product->is_in_stock()) { ?>
				<p><i class='icon-dot text-primary'></i> Dostępny</p>
			<?php } else { ?>
				<p><i class='icon-dot text-neutral-4'></i> Na zamówienie</p>
			<?php } ?>
			<p><i class="icon-bus mr-2"></i> 1-30 dni roboczych</p>
		</div>

		<?php do_action('cleanweb/single_product/details', $product->get_id()); ?>

		<?php if ( $product->get_type() !== 'variable' ) { ?>
		<div class="flex flex-wrap justify-between items-center">
			<?php
			get_template_part(
				'templates/partial/increment-input',
				args: [
					'product'  => $product,
					'quantity' => $_POST['quantity'] ?? $product->get_min_purchase_quantity(),
				]
			);
			?>
			<div class="l-flow text-right" data-flow-size="xs">
				<p class="font-bold text-[14px]">Cena (brutto)</p>
				<p class="font-bold text-lg price text-red">
					<?php echo $product->get_price_html(); ?>
				</p>
			</div>
		</div>
		<?php } ?>
		<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' ); ?>

		<?php wc_get_template( 'single-product/meta.php' ); ?>

		<?php do_action( 'woocommerce_share' ); ?>

		<hr class="border-solid border-neutral-3 border-0 border-t my-4">
		<dl class="grid grid-cols-2 gap-y-2 | text-xs">
			<dt><b>Masz pytania?</b></dt>
			<dd><a href="tel:+48577872666" class="text-neutral-7">(+48) 577 872 666</a></dd>
			<dt><b>Skontaktuj się z nami!</b></dt>
			<dd><a href="mailto:sprzedaz@korina.com.pl" class="text-neutral-7">sprzedaz@korina.com.pl</a></dd>
		</dl>

		<?php
		if ( post_type_supports( 'product', 'comments' ) ) {
			wc_get_template( 'single-product/rating.php' );
		}
		?>
	</div>
	<div class="mt-16 tabs">
		<?php wc_get_template( 'single-product/tabs/tabs.php' ); ?>
	</div>

</article>
<?php woocommerce_upsell_display(); ?>
<?php
woocommerce_related_products(
	[
		'posts_per_page' => 8,
		'columns'        => 4,
		'orderby'        => 'rand',
	]
);
?>

<?php do_action( 'woocommerce_after_single_product' ); ?>

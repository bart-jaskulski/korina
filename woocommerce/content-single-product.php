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
		<figure class="c-product-images lg:w-[500px] woocommerce-product-gallery__wrapper" <?php echo count( $images_ids ) <= 1 ? 'data-hide-arrows="true"' : ''; ?>>
			<?php get_template_part( 'templates/partial/glider-start' ); ?>
			<?php foreach ( $images_ids as $image ) { ?>
				<li class="glide__slide woocommerce-product-gallery__image">
					<a class="c-product-single-image" href="<?php echo esc_url( $product->get_permalink() ); ?>">
						<?php echo wp_get_attachment_image( $image, 'woocommerce_single' ); ?>
					</a>
				</li>
			<?php } ?>
			<?php get_template_part( 'templates/partial/glider-end' ); ?>
		</figure>
		<ul class="flex flex-wrap flex-row">
		<?php foreach ( $images_ids as $image ) { ?>
			<li class="woocommerce-product-gallery__image">
				<img class="c-product-single-image"
					 width="60"
					 height="60"
					 src="<?php echo esc_url( wp_get_attachment_image_url( $image, 'thumbnail' ) ); ?>"
					 alt="<?php echo esc_attr( get_post_meta( $image, '_wp_attachment_image_alt', true ) ); ?>" />
			</li>
		<?php } ?>
		</ul>
	</div>

	<div class="c-single-product__product | l-flow" data-flow-size="sm">

		<div class="c-badges-container [ flex flex-wrap items-center ] [ gap-2 ]">
			<span><em>Valberg</em></span>
			<?php get_template_part( 'templates/partial/badges', args: ['product' => $product])?>
		</div>

		<h1 class="text-lg font-black product_title entry-title"><?php the_title(); ?></h1>

		<div class="[ flex flex-wrap ] [ gap-x-4 ] [ text-xs text-pale font-bold ]" style="color: var(--neutral-8)">
			<p><i class="icon-dot text-neutral-4"></i> Na zamówienie</p>
			<p><i class="icon-bus mr-2"></i> 1-30 dni roboczych</p>
		</div>

		<dl class="c-product-details [ flex flex-wrap ] [ my-8 ]">
			<dt>Wymiary zewnętrzne</dt>
			<dd>220 x 350 x 300 mm</dd>
			<dt>Typ zamku</dt>
			<dd>kluczowy</dd>
			<dt>Liczba półek</dt>
			<dd>1</dd>
		</dl>

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
				<p class="font-bold text-lg price">
					<?php echo $product->get_price_html(); ?>
				</p>
			</div>
		</div>
		<?php } ?>
		<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' ); ?>

		<?php wc_get_template( 'single-product/meta.php' ); ?>

		<?php do_action( 'woocommerce_share' ); ?>

		<hr class="border-solid border-neutral-3 border-0 border-t my-4">
		<div class="l-flow | text-xs" data-flow-size="xs">
			<p class="flex flex-wrap justify-between"><b>Masz pytania?</b><span class="text-neutral-7">(+48) 577 872 666</span></p>
			<p class="flex flex-wrap justify-between"><b>Skontaktuj się z nami!</b><span class="text-neutral-7">sprzedaz@korina.com.pl</span></p>
		</div>

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

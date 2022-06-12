<?php
$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ?? null;
?>

<header class="[ lg:sticky w-full lg:-top-[48px] ] [ bg-white ] [ z-50 ]">
	<div class="hidden lg:block bg-black text-white text-[13px]">
		<div class="l-container [ flex flex-wrap justify-between ] [ py-4 ]">
			<address>
				<?php if ($phone = get_theme_mod('korina_phone')) { ?>
				<span class="pr-4 [ border-solid border-neutral-9 border-0 border-r ]">
					<i class="icon-phone mr-2"></i> <?php echo esc_html($phone); ?>
				</span>
				<?php } ?>
				<?php if ($email = get_theme_mod('korina_email')) { ?>
				<span class="pl-4">
					<i class="icon-mail mr-2"></i> <?php echo esc_html($email); ?>
				</span>
				<?php } ?>
			</address>
			<nav>
				<?php \CleanWeb\Utils\NavMenu::display_menu(
					'top-menu',
					['container' => '', 'menu_class' => 'flex flex-wrap']
				); ?>
			</nav>
		</div>
	</div>
	<div class="l-container | flex-between | py-4 | shadow-sm">
		<button aria-label="Toggle Menu" class="lg:hidden p-3 js-toggle-menu" type="button" aria-expanded="false">
			<i class="icon-grid"></i>
		</button>
		<a class="mr-auto ml-3 lg:ml-0" href="<?php echo esc_url( home_url() ); ?>" rel="home">
			<?php if ($logo) { ?>
				<img class="c-site-logo w-full"
					 src="<?php echo esc_attr( $logo ); ?>"
					 alt=""
					 width="159"
					 height="48"/>
			<?php } ?>
		</a>
		<div class="flex flex-wrap items-center gap-4">
			<?php wc_get_template( 'product-searchform.php' ); ?>
			<a class="p-2" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" aria-label="Moje konto"><i class="icon-account"></i></a>
			<a class="relative | p-2 xoo-wsc-cart-trigger" href="#" aria-label="Mój koszyk">
				<?php if ( WC()->cart->get_cart_contents_count() > 0 ) : ?>
				<!-- TODO: Update cart count with AJAX -->
					<span class="[ bg-primary text-white ] [ absolute -top-[6px] -right-[6px] ] [ text-[8px] font-bold text-center leading-[2] ] [ w-[16px] h-[16px] ] [ rounded-full ]">
					<?php echo esc_html( min( WC()->cart->get_cart_contents_count(), 99 ) ); ?>
			</span>
				<?php endif; ?>
				<i class="icon-bag"></i>
			</a>
		</div>
	</div>
	<nav class="nav-main l-container" role="navigation">
		<?php \CleanWeb\Utils\NavMenu::display_menu('header-menu'); ?>
	</nav>
</header>

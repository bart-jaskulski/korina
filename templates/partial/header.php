<?php
$logo = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0];
?>

<header class="[ sticky w-full top-0 ]">
	<div class="bg-dark text-white text-xs">
		<div class="l-container [ flex flex-wrap justify-between ] [ py-3 ]">
			<address>
				<span><i class="icon-phone"></i> +48 123 123 123</span>
				<span><i class="icon-envelope"></i> kontakt@kontakt.pl</span>
			</address>
			<nav>
				<ul class="flex flex-wrap">
					<li><a class="p-4">O nas</a></li>
					<li><a class="p-4">Meble na wymiar</a></li>
					<li><a class="p-4">Kontakt</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="l-container | flex-between">
		<a class="abs-center--x lg:abs-reset" href="<?php echo esc_url( home_url() ); ?>" rel="home">
			<img class="c-site-logo"
				 src="<?php echo esc_attr( $logo ); ?>"
				 alt=""
				 width="76"
				 height="76"/>
		</a>
		<div class="flex flex-wrap items-center gap-4">
			<form action="">
				<input type="search" name="s" placeholder="Szukaj w sklepie...">
				<button class="sr-only" type="submit">Szukaj</button>
			</form>
			<a class="p-2" href="#" aria-label="Moje konto"><i class="icon-account icon-shopping-bag"></i></a>
			<a class="relative | p-2" href="#" aria-label="Mój koszyk">
			<span class="[ bg-primary text-white ] [ absolute -top-[6px] -right-[6px] ] [ text-[8px] font-bold text-center leading-[2] ] [ w-[16px] h-[16px] ] [ rounded-full ]">
                12
            </span>
                <i class="icon-shopping-bag"></i>
            </a>
			<!--
		<a href="{{ cart_link }}" class="relative">
			{% if cart_count > 0 %}
			<span class="[ bg-black text-white ] [ absolute -left-2 ] [ text-[10px] font-bold text-center leading-[1.6] ] [ w-[18px] h-[18px] ] [ border-solid border border-white rounded-full ]">
						{{ cart_count < 10 ? cart_count : '9+' }}
					</span>
			{% endif %}
			<i class="icon-shopping-bag"></i>
		</a>
		-->
		</div>
	</div>
	<nav class="nav-main" role="navigation">
        <?php wp_nav_menu(['theme_location' => 'header-menu']); ?>
	</nav>
</header>

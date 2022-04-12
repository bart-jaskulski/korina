<footer class="[ bg-black text-neutral-6 ] [ mt-16 py-20 ]" id="footer">
	<div class="l-container">
		<ul class="[ grid grid-cols-4 gap-8 ] leading-[35px]">
			<li><?php dynamic_sidebar( 'footer_contact' ); ?></li>
		<?php
		wp_nav_menu(
			[
				'theme_location' => 'footer-menu',
				'walker'         => new \CleanWeb\Extensions\Walker(),
				'container'      => '',
				'items_wrap'     => '%3$s',
			]
		);
		?>
		</ul>
		<div class="flex flex-wrap justify-between | text-xs | mt-12">
			<p>&copy; <time><?php wp_date( 'Y' ); ?></time> Korina Polska. Wszelkie prawa zastrzeżone</p>
			<p>Akceptujemy karty płatnicze</p>
		</div>
		<hr class="my-4 | border-solid border-neutral-9 border-0 border-t">
	</div>
	<?php wp_footer(); ?>
</footer>

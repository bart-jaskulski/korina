<?php
/**
 * Template name: Koszyk
 */

if (WC()->cart->is_empty()) {
	get_header();
} else {
	get_header('checkout');
}
?>

	<article class="l-flow" data-flow-size="lg">
		<?php the_content(); ?>
	</article>

<?php

if (WC()->cart->is_empty()) {
	get_footer();
} else {
	get_footer('checkout');
}

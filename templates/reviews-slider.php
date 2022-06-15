<?php
/**
 * @var WP_Post[] $args
 */

?>
<div class="l-container | flex | bg-white [ py-12 gap-12 ]" data-size="fullwidth">
	<div class="max-w-[200px] flex-grow flex-shrink-0">
		<h3>Opinie o sklepie</h3>
		<p>99.5% osób poleca na podstawie prawie 2700 zamówień</p>
	</div>
	<?php get_template_part('templates/partial/glider-start', args: [
		'options' => ['perView' => 3],
		'classes' => ['!w-[678px]']
	]); ?>
	<?php
	foreach ( $args as $reviewPost ) { ?>
		<li class="l-flow | w-[220px] w-full" data-flow-size="xs">
			<div>
			<span>
			<?php
			$stars = (int) get_post_meta($reviewPost->ID, 'stars', true );
			for ($i = 0; $i < $stars; $i++) { ?>
				<i class="icon-star text-primary"></i>
			<?php } ?>
			</span>
				<div class="whitespace-normal"><?php echo wpautop(get_the_content(post: $reviewPost)); ?></div>
				<p class="font-bold"><?php echo esc_html( get_post_meta($reviewPost->ID, 'comment_author', true ) ); ?></p>
				<p><time class="text-neutral-7"><?php echo get_post_datetime($reviewPost)->format('d/m/Y'); ?></time></p>
			</div>
		</li>
		<?php
	}
	?>
	<?php get_template_part('templates/partial/glider-end'); ?>
</div>

<?php
/**
 * @var WP_Post[] $args
 */

?>
<div class="l-container | bg-white | py-12" data-size="fullwidth">
	<h3 class="text-md font-bold | mb-6">Producenci</h3>
<?php
get_template_part('templates/partial/glider-start');
foreach ( $args as $producersPost ) { ?>
	<li class="glide__slide relative basis-[200px]">
		<a href="<?php echo esc_url( get_post_meta($producersPost->ID, 'link', true) ?: '#' ); ?>">
			<div class="absolute transition-colors duration-300 ease-in-out hover:bg-black rounded [ w-full h-full ] [ flex flex-wrap flex-col justify-between ] [ text-white ] [ p-4 ]">
				<p class="font-bold"><?php echo get_the_title($producersPost);?></p>
				<p>Producent</p>
			</div>
			<img class="" width="200" height="200" alt="" src="<?php echo get_the_post_thumbnail_url( $producersPost ) ?>"/>
		</a>
	</li>
	<?php
}
get_template_part('templates/partial/glider-end');
?>
</div>

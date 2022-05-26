<?php
/**
 * @var WP_Post[] $args
 */

?>
<div class="l-container | bg-white | py-8" data-size="fullwidth">
<?php
get_template_part('templates/partial/glider-start');
foreach ( $args as $featurePost ) { ?>
	<li class="glide__slide">
		<div class="flex gap-4">
			<img class="basis-[30px] object-contain" width="30" alt="" src="<?php echo get_the_post_thumbnail_url( $featurePost ) ?>"/>
			<div>
				<p class="font-black text-sm"><?php echo get_the_title( $featurePost ); ?></p>
				<p class="text-xs"><?php echo get_the_content( post: $featurePost ); ?></p>
			</div>
		</div>
	</li>
	<?php
}
get_template_part('templates/partial/glider-end');
?>
</div>

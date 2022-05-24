<?php
/**
 * @var array{posts: WP_Post[]} $args
 */

?>
<div class="basis-[680px]">
	<?php while (have_posts()) { ?>
		<?php the_post(); ?>
		<article class="l-flow" data-flow-size="lg">
			<h1><?php the_title(); ?></h1>
			<div>
				<?php the_content(); ?>
			</div>
		</article>
	<?php } ?>
	<?php get_template_part( 'templates/partial/pagination', args: [ 'posts' => $args['posts'] ] ); ?>
</div>

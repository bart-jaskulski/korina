<?php
/**
 * @var WP_Post[] $posts
 */

?>
<div class="basis-[680px]">
	<?php foreach ( $posts as $post ) : ?>
		<article class="l-flow" data-flow-size="lg">
			<h1><?php the_title(); ?></h1>
			<div>
				<?php the_content(); ?>
			</div>
		</article>
	<?php endforeach; ?>
	<?php get_template_part( 'templates/partial/pagination', args: [ 'posts' => $posts ] ); ?>
</div>

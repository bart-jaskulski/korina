<?php
/**
 * @var array{posts: WP_Post[]} $args
 */

?>
<?php while (have_posts()) { ?>
	<?php the_post(); ?>
	<article>
		<?php if (is_front_page()) { ?>
			<?php the_content(); ?>
		<?php } else { ?>
			<h1><?php the_title(); ?></h1>
			<div>
				<?php the_content(); ?>
			</div>
		<?php } ?>
	</article>
<?php } ?>
<?php get_template_part( 'templates/partial/pagination', args: [ 'posts' => $args['posts'] ] ); ?>

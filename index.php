<?php

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		get_template_part( 'entry' );
	}
} else {
	echo 'No posts found!';
}

get_footer();

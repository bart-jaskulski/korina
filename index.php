<?php

get_header();

	if ( have_posts() ) {
		get_template_part( 'templates/entry', args: [ 'posts' => get_posts() ] );
	} else {
		echo 'No posts found!';
	}

get_footer();

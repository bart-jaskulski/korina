<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<script>document.documentElement.classList.remove('no-js')</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'relative [ flex flex-col justify-between ] min-h-screen | overflow-hidden' ); ?>>
<a class="sr-only" href="#content">Przejdź do treści</a>
<?php wp_body_open(); ?>
<?php get_template_part( 'templates/partial/header' ); ?>
<main id="content" class="l-container">

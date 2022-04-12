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
<body <?php body_class( 'relative min-h-screen' ); ?>>
<a class="sr-only" href="#content">Przejdź do treści</a>
<?php wp_body_open(); ?>
<header class="p-20 py-4">
	<a class="font-bold"
	   href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>">
		<i class="icon-left-full"></i>Kontynuuj zakupy
	</a>
</header>
<main class="p-20" id="content">

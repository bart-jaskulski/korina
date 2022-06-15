<?php
/**
 * @var array{id?: string, options?: array} $args
 */
?>
<div id="<?php echo esc_attr( $args['id'] ?? uniqid('glide') ); ?>"
	 class="glide <?php echo esc_attr( implode( ' ', $args['classes'] ?? [] ) ); ?>"
	 <?php if (isset($args['options'])) { ?>
		 data-options="<?php echo esc_attr(json_encode($args['options'])); ?>"
	 <?php } ?>
>
	<div class="glide__track" data-glide-el="track">
		<ul class="glide__slides">

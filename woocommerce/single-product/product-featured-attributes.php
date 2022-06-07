<?php
/**
 * @var array $featuredAttributes
 */
?>
<?php if (!empty($featuredAttributes)) { ?>
	<dl class="c-product-details [ flex flex-wrap ] [ my-8 ]">
		<?php foreach ($featuredAttributes as $attr => $value) { ?>
			<dt><?php echo esc_html( $attr); ?></dt>
			<dd><?php echo esc_html( $value ); ?></dd>
		<?php } ?>
	</dl>
<?php } ?>

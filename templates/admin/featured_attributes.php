<?php
/**
 * @var array{attributes: object[], selectedAttributes: object[]} $args
 */

$attributes = $args['availableAttributes'];
$selectedAttributes = $args['selectedAttributes'];
?>
<style>
	.attributes-list {
		background-color: #dbdbdb;
		padding: 12px;
	}
	.attributes-list__element {
		display: flex;
		justify-content: space-between;
		padding: 4px 8px;
		background-color: white;
		cursor: move;
	}
	.select2-attributes {
		width: 100%;
	}
</style>
<tr class="form-field">
	<th>Select featured attributes</th>
	<td>
		<ul class="ui-sortable attributes-list">
			<li class="ui-state-disabled <?php echo empty($selectedAttributes) ? '' : esc_attr('hidden'); ?>">
				<p>Brak wyróżnionych atrybutów</p>
			</li>
			<?php foreach ($selectedAttributes as $attribute) { ?>
				<li class="ui-sortable-handler attributes-list__element">
					<input type="hidden" name="attributes_sort[]" value="<?php echo esc_attr($attribute->attribute_id); ?>" />
					<p><?php echo esc_html($attribute->attribute_label); ?></p>
					<button class="js-attribute-remove">X</button>
				</li>
			<?php } ?>
		</ul>
		<select class="select2-attributes" data-available-attributes='<?php echo esc_attr(json_encode($attributes)); ?>'>
			<?php foreach ($attributes as $attribute) { ?>
				<option value="<?php echo esc_attr($attribute->attribute_id); ?>">
					<?php echo esc_html($attribute->attribute_label); ?>
				</option>
			<?php } ?>
		</select>
		<button class="js-add-featured">Add to featured attributes</button>
		<template id="featured-attribute">
			<li class="ui-sortable-handler attributes-list__element">
				<input class="js-attribute-input" type="hidden" name="attributes_sort[]" />
				<p class="js-attribute-name"></p>
				<button class="js-attribute-remove">X</button>
			</li>
		</template>
	</td>
</tr>
<script>
	(function ($) {
		function removeAttribute(e) {
			e.preventDefault()
			$(this).closest('.ui-sortable-handler').remove()
			if ($sortableContainer.find('.attributes-list__element').length === 0) {
				$sortableContainer.find('.ui-state-disabled').removeClass('hidden')
			}
		}
		const $sortableContainer = $('.ui-sortable');
		$sortableContainer.sortable({
			cancel: '.ui-state-disabled'
		})
		const $selectContainer = $('.select2-attributes').select2();
		const availableAttributes = $selectContainer.data('available-attributes')
		const template = document.querySelector('template#featured-attribute')
		$('.js-attribute-remove').on('click', removeAttribute)
		$('.js-add-featured').on('click', (e) => {
			e.preventDefault()
			if ($sortableContainer.find('.ui-state-disabled').length !== 0) {
				$sortableContainer.find('.ui-state-disabled').addClass('hidden')
			}
			const selectedId = $selectContainer.val()
			$selectContainer.find(`option[value=${selectedId}]`).remove()
			const contents = $(template.content.cloneNode(true));
			contents.find('.js-attribute-remove').on('click', removeAttribute)
			contents.find('.js-attribute-name').text(availableAttributes[`id:${selectedId}`].attribute_label)
			contents.find('.js-attribute-input').val(availableAttributes[`id:${selectedId}`].attribute_id)
			$sortableContainer.append(contents)
		})
	})(jQuery)
</script>

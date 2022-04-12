<?php

namespace CleanWeb\Utils;

class Image {

	public static function get_gallery_image_html( $image_id, $size = 'woocommerce_single' ): string {
		$image_src  = wp_get_attachment_image_src( $image_id, $size );
		if ( $image_src ) {
			return sprintf(
				'<img src="%s" alt="%s" />',
				esc_url( $image_src[0] ),
				esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) )
			);
		}
		return '';
	}
}

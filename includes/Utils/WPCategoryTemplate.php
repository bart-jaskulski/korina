<?php

namespace CleanWeb\Utils;

use WP_Error;

class WPCategoryTemplate {

	public static function get_term_list( int $post_id, string $taxonomy, string $separator = ',' ): string {
		$terms = get_the_terms( $post_id, $taxonomy );

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return '';
		}

		return implode(
			$separator,
			array_map(
				static function ( $term ) use ( $taxonomy ): string {
					$link = get_term_link( $term, $taxonomy );
					if ( $link instanceof WP_Error ) {
						return '';
					}

					return '<a href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
				},
				$terms
			)
		);
	}

}

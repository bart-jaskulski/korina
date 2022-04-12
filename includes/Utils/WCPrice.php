<?php

namespace CleanWeb\Utils;

use WC_Product;

class WCPrice {

	public function __construct( private WC_Product $product ) {}

	public function get_formatted_price(): string {
		if ( '' === $this->product->get_price() ) {
			$price = apply_filters( 'woocommerce_empty_price_html', '', $this->product );
		} elseif ( $this->product->is_on_sale() ) {
			$price = $this->format_sale_price( wc_get_price_to_display( $this->product, [ 'price' => $this->product->get_regular_price() ] ), wc_get_price_to_display( $this->product ) ) . $this->product->get_price_suffix();
		} else {
			$price = wc_price( wc_get_price_to_display( $this->product ) ) . $this->product->get_price_suffix();
		}

		return apply_filters( 'woocommerce_get_price_html', $price, $this->product );
	}

	private function format_sale_price( string $regular_price, string $sale_price ): string {
		$price  = '<ins class="text-red font-black">' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins>';
		$price .= ' <del aria-hidden="true">' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del>';
		return apply_filters( 'woocommerce_format_sale_price', $price, $regular_price, $sale_price );
	}

}

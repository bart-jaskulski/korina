import elementReady from "element-ready";

interface Image {
	title: string,
	caption: string,
	url: string,
	alt: string,
	src: string,
	srcset: string,
	sizes: string,
	full_src: string
	full_src_w: number,
	full_src_h: number,
	gallery_thumbnail_src: string,
	gallery_thumbnail_src_w: number,
	gallery_thumbnail_src_h: number,
	thumb_src: string,
	thumb_src_w: number,
	thumb_src_h: number,
	src_w: number,
	src_h: number

}

interface Dimensions {
	length: string,
	width: string,
	height: string,
}

interface Variation {
	attributes: Object,
	availability_html: string
	backorders_allowed: boolean,
	dimensions: Dimensions,
	dimensions_html: string,
	display_price: number,
	display_regular_price: number,
	image: Image,
	image_id: number,
	is_downloadable: boolean,
	is_in_stock: boolean,
	is_purchasable: boolean,
	is_sold_individually: "no"|"yes",
	is_virtual: boolean,
	max_qty: string,
	min_qty: number,
	price_html: string,
	sku: string
	variation_description: string
	variation_id: number,
	variation_is_active: boolean,
	variation_is_visible: boolean,
	weight: string,
	weight_html: string
}

export default async () => {
	const el = await elementReady('form.variations_form')
	if (!el || !el.dataset["product_variations"]) return

	const attributeChangers = document.querySelectorAll('select[name*="attribute_pa"]')

	attributeChangers.forEach((trigger) => {
		trigger.addEventListener('change', (e) => {
			console.log(e)
		})

	})

	const variations = JSON.parse( el.dataset["product_variations"] ) as Variation[];

}


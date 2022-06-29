import PhotoSwipeLightbox from "photoswipe/lightbox"

export const lightbox = new PhotoSwipeLightbox({
	gallery: '#product-images',
	children: 'a',
	pswpModule: () => import('photoswipe')
})

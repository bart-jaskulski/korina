import Glide, {Options} from "@glidejs/glide";

export function mountGlider(el: HTMLElement, options: Options = {}): Glide.Properties {
	console.info(`Mounting glider for #${el.id}`)

	const mq = window.matchMedia('(min-width: 64rem)');

	const gliderConfig = Object.assign({
		perView: mq.matches ? 4 : 2,
		type: 'slider',
		startAt: 0,
		gap: 16,
		bound: true
	}, options)

	console.log(gliderConfig)
	const glider = new Glide(`#${el.id}`, gliderConfig).mount()

	mq.addEventListener('change', (e) => {
		glider.update({perView: e.matches ? 4 : 2})
	})

	return glider
}

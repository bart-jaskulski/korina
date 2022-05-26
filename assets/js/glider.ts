import Glide, {Options} from "@glidejs/glide";

export function mountGlider(el: HTMLElement, options: Options = {}): Glide.Properties|null {
	const mq = window.matchMedia('(min-width: 64rem)');

	const gliderConfig = Object.assign({
		perView: mq.matches ? 4 : 2,
		type: 'slider',
		startAt: 0,
		gap: 16,
		bound: true
	}, options)

	if (el.querySelectorAll('li').length <= 1) {
		return null;
	}

	const glider = new Glide(`#${el.id}`, gliderConfig).mount()

	mq.addEventListener('change', (e) => {
		glider.update({perView: e.matches ? 4 : 2})
	})

	return glider
}

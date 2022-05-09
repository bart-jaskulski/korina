import elementReady from 'element-ready';
import Choices from "choices.js";
import Glide, {Options} from "@glidejs/glide";
import product from "./product";

async function initialize() {
	if (await elementReady('select[name="orderby"]')) {
		new Choices('select[name="orderby"]', {
			allowHTML: false,
			itemSelectText: '',
			searchEnabled: false,
		})
	}
}


async function mountGlider(selector: string, options: Options = {}): Promise<Glide.Properties|undefined> {
	if (await elementReady(selector)) {
		console.log('Mounting glider: ', selector);
		const mq = window.matchMedia('(min-width: 64rem)');

		if (mq.matches) {
			options.perView = options.perView || 4;
		}

		const config = Object.assign({
			perView: 2,
			type: 'slider',
			startAt: 0,
			gap: 16,
			bound: true
		}, options);

		let glide = new Glide(
			selector,
			config
		).mount();

		mq.addEventListener('change', (e) => {
			console.log('Match. Changing items per view to ' + (e.matches ? 4 : 2));
			glide.update({perView: e.matches ? 4 : 2})
		})

		return glide
	}
	return;
}

initialize()
mountGlider('.c-new-products')
mountGlider('.c-featured-products')

/**
 * Initialize glider if there are more than 1 product images
 */
async function initializeGliderForProductPage() {
	if (await elementReady('.c-product-images')) {
		const productImages = document.querySelector('.c-product-images')
		if (productImages && productImages.getElementsByTagName('img').length > 1) {
			return mountGlider('.c-product-images', {perView: 1})
		}
	}
}

const productGlide = initializeGliderForProductPage()
document.querySelectorAll('.js-glide-navigation').forEach( el => {
		el.addEventListener('click', (evt) => {
			evt.preventDefault()
			productGlide.then(glider => glider.go(`=${el.dataset.slide}`))
		})
	}
)


/**
 * Show register for on button click
 */
async function showRegisterForm() {
	if (await elementReady('.js-show-register-form')) {
		const toggleHandler = document.querySelector('.js-show-register-form')
		const untoggleHandler = document.querySelector('.js-hide-register-form')
		if (! toggleHandler || ! untoggleHandler) return;

		toggleHandler.addEventListener('click', (event) => {
			event.preventDefault()
			const formContainer = document.querySelector('.l-create-account')
			if (! formContainer ) return;
			formContainer.removeAttribute('aria-hidden')
			toggleHandler.closest('div')?.setAttribute('aria-hidden', 'true')
		})

		untoggleHandler.addEventListener('click', (e) => {
			e.preventDefault()
			const formContainer = document.querySelector('.l-encourage-creation')
			if (! formContainer ) return;
			formContainer.removeAttribute('aria-hidden')
			untoggleHandler.closest('div')?.setAttribute('aria-hidden', 'true')
		})
	}
}

showRegisterForm()


/**
 * Toggle between login and lost password forms
 */
async function toggleLoginForm() {
	if (await elementReady('.js-return-login')) {
		const toggleHandler = document.querySelector('.js-lost-password')
		const untoggleHandler = document.querySelector('.js-return-login')
		if (! toggleHandler || ! untoggleHandler) return;

		toggleHandler.addEventListener('click', (event) => {
			event.preventDefault()
			const formContainer = document.querySelector('.l-lost-password')
			if (! formContainer ) return;
			formContainer.removeAttribute('aria-hidden')
			toggleHandler.closest('.l-login')?.setAttribute('aria-hidden', 'true')
		})

		untoggleHandler.addEventListener('click', (e) => {
			e.preventDefault()
			const formContainer = document.querySelector('.l-login')
			if (! formContainer ) return;
			formContainer.removeAttribute('aria-hidden')
			untoggleHandler.closest('.l-lost-password')?.setAttribute('aria-hidden', 'true')
		})
	}
}

toggleLoginForm()

async function toggleMobileMenu() {
	if ( ! await elementReady('.js-toggle-menu') ) return
	const toggle = document.querySelector<HTMLButtonElement>('button.js-toggle-menu')
	toggle.addEventListener('click', () => {
		const menu = document.querySelector<HTMLElement>('.mega-menu')
		if (!menu) return

		menu.classList.toggle('!block')
		toggle.toggleAttribute('aria-expanded')
		menu.toggleAttribute('aria-hidden')
	})
}

toggleMobileMenu()

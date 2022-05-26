import elementReady from 'element-ready';
import Choices from "choices.js";
import {mountGlider} from "./glider";

async function initialize() {
	if (await elementReady('select[name="orderby"]')) {
		new Choices('select[name="orderby"]', {
			allowHTML: false,
			itemSelectText: '',
			searchEnabled: false,
		})
	}
}

document.querySelectorAll<HTMLElement>('.glide:not(#product-images)').forEach(c => {
	let glideConfig = {}
	if (c.dataset['options']) {
		glideConfig = JSON.parse(c.dataset['options'])
	}
	mountGlider(c, glideConfig)
})

let el1 = document.querySelector('#c-product-images');
if (el1) {
	const glider = mountGlider(el1, JSON.parse(el1.dataset['options']))
	document.querySelectorAll('.js-glide-navigation')
		.forEach( el => {
				el.addEventListener('click', (evt) => {
					evt.preventDefault()
					glider?.go(`=${el.dataset.slide}`)
				})
			}
		)
}

initialize()

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

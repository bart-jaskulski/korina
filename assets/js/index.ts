// const rules = Array.from(document.styleSheets[3].cssRules)
// const set = [...new Set(rules.map(rule => rule.selectorText).filter((e) => e?.startsWith('.wp-block')).map(e => e.split(/(\s|,|;)/)[0]))]

import dialogPolyfill from 'dialog-polyfill';
import elementReady from 'element-ready';
import ensureMenuOpenCorrectly from './menu';
import productSwapper from './product'
import addFilterSupport from "./filter";
import Glide from "@glidejs/glide";

async function initializeSlider() {
	if (await elementReady('.glide')) {
		new Glide('.glide').mount()
	}
}

async function polyfillDialog() {
	const dialog = await elementReady('dialog#product-search-dialog')
	if (!dialog) return
	dialogPolyfill.registerDialog(dialog)

	document.querySelector('button.js-product-search')?.addEventListener('click', () => {
		// @ts-ignore
		dialog.showModal();
		let closeDialog = (e: MouseEvent) => {
			if (dialog === e.target) {
				dialog.close()
				dialog.removeEventListener('click', closeDialog)
			}
		};
		dialog.addEventListener('click', closeDialog)
	})
}

function categoryReveal() {
	const reveal = document.querySelector<HTMLElement>('div.js-reveal-text')
	const button = document.querySelector('button.js-reveal-text-button');

	if (reveal && button) {
		const maxHeight = Array.from(reveal.children)
			.reduce((acc, {clientHeight}) => acc + clientHeight, 0)

		button.addEventListener('click', () => {
			button.toggleAttribute('data-rotated')

			if (reveal.style.maxHeight) {
				reveal.style.maxHeight = '';
				reveal.setAttribute('aria-expanded', "false")
			} else {
				reveal.style.maxHeight = `${maxHeight}px`
				reveal.setAttribute('aria-expanded', "true")
			}
		})
	}


}

polyfillDialog()
initializeSlider()
addFilterSupport()
productSwapper()
categoryReveal()

const mq = window.matchMedia('(min-width: 64rem)');
ensureMenuOpenCorrectly(mq)
mq.addEventListener('change', ensureMenuOpenCorrectly);

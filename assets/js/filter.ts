import elementReady from "element-ready";

export default async () => {
	if (!await elementReady('div.wpfMainWrapper', {timeout: 5000})) return

	document.querySelectorAll('div.wpfMainWrapper').forEach((filter ) => {
		const isMobile = JSON.parse( filter?.dataset?.filterSettings ).settings?.display_for === 'mobile' || false;
		if (!isMobile) return

		filter.classList.add('is-mobile')

		let filterButton = filter.querySelector('.wpfFilterButton')!
		filterButton.classList.add('c-button')
		filterButton.setAttribute('data-button-type', 'filled')
		filterButton.setAttribute('data-button-width', 'full')

		const activate = document.createElement('button')
		activate.classList.add('c-button', 'text-center')
		activate.setAttribute('data-button-type', 'filled')
		activate.setAttribute('data-button-width', 'full')
		activate.innerHTML = '<i class="icon-sliders"></i> Filtry'

		activate.addEventListener('click', () => {
			filter.classList.add('is-active')
		})


		const clear = document.createElement('button')
		clear.classList.add('wpfClearButton')
		clear.innerText = 'Wyczyść filtry'

		filter.insertAdjacentElement('beforebegin', activate)
		filter.insertAdjacentElement('afterbegin', clear)
	})
}

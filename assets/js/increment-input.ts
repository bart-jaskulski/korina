import css, * as cssModule from './input.module.css'

if (!window.customElements.get('increment-input')) {

	window.customElements.define('increment-input', class IncrementElement extends HTMLElement {
		private inputElement!: HTMLInputElement;

		private static css: string = cssModule.css
		private decrementButton!: HTMLButtonElement
		private incrementButton!: HTMLButtonElement;

		constructor() {
			super()
			this.attachShadow({mode: 'open'})
		}

		connectedCallback() {
			const template = document.createElement('template')
			template.innerHTML = `<style>${IncrementElement.css}</style>${this.render()}`
			this.shadowRoot.appendChild(template.content.cloneNode(true))

			this.shadowRoot.addEventListener('slotchange', (e ): void => {
				if (e.target.name !== 'label') {
					this.inputElement = e.target.assignedElements().filter(el => el instanceof HTMLInputElement)[0]
					this.#disableIncrement()
					this.#disableDecrement()
				}
			})

			this.decrementButton = this.shadowRoot.querySelector('.js-decrement');
			this.incrementButton = this.shadowRoot.querySelector('.js-increment');

			this.decrementButton.addEventListener('click', this.#decrement)

			this.incrementButton.addEventListener('click', this.#increment)
		}

		disconnectedCallback(): void {
			this.decrementButton.removeEventListener('click', this.#decrement)
			this.incrementButton.removeEventListener('click', this.#increment)
		}

		#increment = (): void => {
			this.decrementButton.removeAttribute('disabled')
			this.inputElement.stepUp()
			this.inputElement.dispatchEvent(new Event('change'))
			this.#disableIncrement()
		}

		#disableIncrement = (): void => {
			if ( !isNaN(Number.parseInt(this.inputElement.max)) && this.inputElement.max <= this.inputElement.value) {
				this.incrementButton.setAttribute('disabled', 'disabled');
			}
		}

		#decrement = (): void => {
			this.incrementButton.removeAttribute('disabled')
			this.inputElement.stepDown()
			this.inputElement.dispatchEvent(new Event('change'))
			this.#disableDecrement()
		}

		#disableDecrement = (): void => {
			if ( !isNaN(Number.parseInt(this.inputElement.min)) && this.inputElement.min >= this.inputElement.value) {
				this.decrementButton.setAttribute('disabled', 'disabled');
			}
		}

		render = (): string => `
		<slot name="label"></slot>
		<div class="${css.flex}">
			<div class="${css.container}">
				<button class="js-decrement" type="button">-</button>
				<slot></slot>
				<button class="js-increment" type="button">+</button>
			</div>
			<p>szt.</p>
		</div>
		`
	})
}

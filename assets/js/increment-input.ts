import css, * as cssModule from './input.module.css'

if (!window.customElements.get('increment-input')) {

window.customElements.define('increment-input', class IncrementElement extends HTMLElement {
	private inputElement!: HTMLInputElement;

	private static css: string = cssModule.css

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
			}
		})


		this.shadowRoot.querySelector('.js-decrement')
			?.addEventListener('click', this.#decrement)

		this.shadowRoot.querySelector('.js-increment')
			?.addEventListener('click', this.#increment)
	}

	disconnectedCallback(): void {
		this.shadowRoot.querySelector('.js-decrement')?.removeEventListener('click', this.#decrement)
		this.shadowRoot.querySelector('.js-increment')?.removeEventListener('click', this.#increment)
	}

	#increment = (): void => this.inputElement.stepUp()
	#decrement = (): void => this.inputElement.stepDown()

	render = (): string => `
		<slot name="label"></slot>
		<div class="${css.container}">
			<button class="js-decrement" type="button">
				<i class="${css.iconMinus}"></i>
			</button>
			<slot></slot>
			<button class="js-increment" type="button">
				<i class="${css.iconPlus}"></i>
			</button>
		</div>
		`
})
}

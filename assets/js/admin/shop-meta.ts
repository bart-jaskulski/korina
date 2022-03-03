export default class ActionAttachment {
	private mediaContainerEl: HTMLElement;
	private addAttachmentEl: HTMLElement;
	private attachmentsList: HTMLElement;

	constructor(containerId: string) {
		const container = document.getElementById(containerId)
		if (!container) throw new Error('Wrong container reference')

		this.mediaContainerEl = container
		this.addAttachmentEl = this.mediaContainerEl.querySelector('.js-add-attachment')!;
		this.attachmentsList = this.mediaContainerEl.querySelector('.js-attachments-container')!;
	}

	bindEvents = (): void => {
		this.addAttachmentEl.addEventListener('click', this.selectMedia);
		this.attachmentsList.querySelectorAll('.js-remove-attachment').forEach((attachment) => {
			attachment.addEventListener('click', this.removeAttachment);
		});
	}

	selectMedia = (e: Event): void => {
		e.preventDefault();
		if (!this.frame) {
			this.initializeFrame();
		}

		this.frame.open();
	}

	initializeFrame = () => {
		this.frame = wp.media({
			multiple: true,
		});

		this.frame.on('select', () => {
			this.selectAttachment();
		});
	}

	selectAttachment = () => {
		const attachments = this.frame.state().get('selection').toJSON();
		attachments.forEach(({url}: {url: string}) => {
			this.mediaContainerEl.insertAdjacentElement('afterbegin', this.createInputElement(url));
			this.attachmentsList.insertAdjacentElement('beforeend', this.createAttachmentElement(url));
		});
	}

	createAttachmentElement(url: string): HTMLParagraphElement {
		const wrapper = document.createElement('p');

		const attachmentRemoval = document.createElement('a');
		attachmentRemoval.setAttribute('href', '#');
		attachmentRemoval.classList.add('js-remove-attachment', 'remove-attachment-button');
		attachmentRemoval.insertAdjacentText('afterbegin', '✕');

		attachmentRemoval.addEventListener('click', this.removeAttachment);

		const attachment = document.createElement('img');
		attachment.setAttribute('src', url);
		attachment.setAttribute('width', '200');

		wrapper.appendChild(attachmentRemoval);
		wrapper.appendChild(attachment);
		return wrapper;
	}

	createInputElement = (value: string): HTMLInputElement => {
		const input = document.createElement('input');
		input.type = 'hidden';
		input.value = value;
		input.name = 'slider_images[]';

		return input;
	}

	removeAttachment = (e: Event) => {
		e.preventDefault();
		if (!e.currentTarget) return
		const attachmentRemoval = e.currentTarget as HTMLElement;
		const url = attachmentRemoval.previousElementSibling.getAttribute('src');
		attachmentRemoval.parentElement.remove();
		this.mediaContainerEl.querySelector(`[value="${url}"]`).remove();
	}
}

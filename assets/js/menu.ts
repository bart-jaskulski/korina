const menuContainer = document.querySelector<HTMLDetailsElement>('.js-menu-container')

export default (e: MediaQueryListEvent|MediaQueryList): void => {
	if (!menuContainer) return

	if (e.matches) menuContainer.setAttribute('open','')
	else menuContainer.removeAttribute('open')
}

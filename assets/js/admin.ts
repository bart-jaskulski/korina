import ActionAttachment from './admin/shop-meta'
import elementReady from "element-ready";

(async () => {
	const el = await elementReady('#slider-id')
	if (!el) return
	new ActionAttachment(el.id).bindEvents()
})()


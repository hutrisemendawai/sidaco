import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const shell = (() => {
	const contentSelector = '#main-content-slot';
	const desktopNavSelector = '#desktop-sidebar a[href]';
	const mobileNavSelector = '#mobile-sidebar-drawer a[href]';
	const loadedScripts = new Set(Array.from(document.querySelectorAll('script[src]')).map((script) => script.src));
	const pageCache = new Map();
	const timeFormatter = new Intl.DateTimeFormat(undefined, {
		hour: '2-digit',
		minute: '2-digit',
	});
	const dateFormatter = new Intl.DateTimeFormat(undefined, {
		weekday: 'short',
		month: 'short',
		day: 'numeric',
	});

	let navigationToken = 0;
	let clockTimer = null;

	function updateClock() {
		const timeNode = document.querySelector('[data-shell-clock-time]');
		const dateNode = document.querySelector('[data-shell-clock-date]');

		if (!timeNode || !dateNode) {
			return;
		}

		const now = new Date();
		timeNode.textContent = timeFormatter.format(now);
		dateNode.textContent = `${dateFormatter.format(now)} · Browser local`;
	}

	function scheduleClockUpdate() {
		updateClock();

		if (clockTimer) {
			window.clearTimeout(clockTimer);
		}

		const now = new Date();
		const delay = Math.max(((60 - now.getSeconds()) * 1000) - now.getMilliseconds(), 1000);
		clockTimer = window.setTimeout(scheduleClockUpdate, delay);
	}

	function normalizePath(pathname) {
		if (!pathname || pathname === '/') {
			return '/';
		}

		return pathname.replace(/\/$/, '');
	}

	function isSameOriginLink(link) {
		if (!link || link.tagName !== 'A') {
			return false;
		}

		if (link.hasAttribute('download') || link.hasAttribute('data-shell-ignore')) {
			return false;
		}

		if (link.target && link.target !== '_self') {
			return false;
		}

		const href = link.getAttribute('href');
		if (!href || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) {
			return false;
		}

		const url = new URL(link.href, window.location.href);

		if (url.origin !== window.location.origin) {
			return false;
		}

		if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash) {
			return false;
		}

		return true;
	}

	function syncSidebarState(url) {
		const currentPath = normalizePath(url.pathname);
		const navLinks = document.querySelectorAll(`${desktopNavSelector}, ${mobileNavSelector}`);

		navLinks.forEach((link) => {
			const linkUrl = new URL(link.href, window.location.href);
			const linkPath = normalizePath(linkUrl.pathname);
			const isActive = currentPath === linkPath || (linkPath !== '/' && currentPath.startsWith(`${linkPath}/`));

			link.classList.toggle('sidebar-link-active', isActive);

			if (isActive) {
				link.setAttribute('aria-current', 'page');
			} else {
				link.removeAttribute('aria-current');
			}
		});
	}

	async function loadExternalScript(script) {
		const scriptUrl = new URL(script.src, window.location.href).href;

		if (loadedScripts.has(scriptUrl)) {
			return;
		}

		loadedScripts.add(scriptUrl);

		await new Promise((resolve) => {
			const nextScript = document.createElement('script');
			nextScript.src = scriptUrl;

			Array.from(script.attributes).forEach((attribute) => {
				if (attribute.name === 'src') {
					return;
				}

				nextScript.setAttribute(attribute.name, attribute.value);
			});

			nextScript.onload = resolve;
			nextScript.onerror = resolve;
			document.head.appendChild(nextScript);
		});
	}

	function executeInlineScript(script) {
		const nextScript = document.createElement('script');

		Array.from(script.attributes).forEach((attribute) => {
			if (attribute.name === 'src') {
				return;
			}

			nextScript.setAttribute(attribute.name, attribute.value);
		});

		nextScript.textContent = script.textContent;
		document.body.appendChild(nextScript);
		nextScript.remove();
	}

	async function replayPageScripts(fragment) {
		const scripts = Array.from(fragment.querySelectorAll('script'));

		for (const script of scripts) {
			if (script.src) {
				await loadExternalScript(script);
				continue;
			}

			executeInlineScript(script);
		}

		document.dispatchEvent(new Event('DOMContentLoaded'));
	}

	async function renderUrl(url, { replaceState = false } = {}) {
		const targetUrl = new URL(url, window.location.href);
		const requestId = ++navigationToken;

		if (targetUrl.href === window.location.href) {
			return;
		}

		let html = pageCache.get(targetUrl.href);

		if (!html) {
			const response = await fetch(targetUrl.href, {
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-Shell-Navigation': 'true',
				},
				credentials: 'same-origin',
			});

			const contentType = response.headers.get('content-type') || '';

			if (!response.ok || !contentType.includes('text/html')) {
				window.location.href = targetUrl.href;
				return;
			}

			html = await response.text();
			pageCache.set(targetUrl.href, html);
		}

		if (requestId !== navigationToken) {
			return;
		}

		const doc = new DOMParser().parseFromString(html, 'text/html');
		const nextContent = doc.querySelector(contentSelector);
		const currentContent = document.querySelector(contentSelector);

		if (!nextContent || !currentContent) {
			window.location.href = targetUrl.href;
			return;
		}

		const contentClone = nextContent.cloneNode(true);
		const nextScripts = Array.from(contentClone.querySelectorAll('script'));

		nextScripts.forEach((script) => script.remove());

		currentContent.innerHTML = contentClone.innerHTML;
		document.title = doc.title || document.title;

		if (replaceState) {
			window.history.replaceState({}, '', targetUrl.href);
		} else {
			window.history.pushState({}, '', targetUrl.href);
		}

		window.scrollTo(0, 0);
		syncSidebarState(targetUrl);

		await replayPageScripts(nextContent);
	}

	function handleDocumentClick(event) {
		if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
			return;
		}

		const link = event.target.closest('a[href]');

		if (!isSameOriginLink(link)) {
			return;
		}

		event.preventDefault();
		renderUrl(link.href).catch(() => {
			window.location.href = link.href;
		});
	}

	function handlePopState() {
		renderUrl(window.location.href, { replaceState: true }).catch(() => {
			window.location.reload();
		});
	}

	function init() {
		scheduleClockUpdate();
		syncSidebarState(window.location);

		document.addEventListener('click', handleDocumentClick);
		window.addEventListener('popstate', handlePopState);
	}

	return {
		init,
	};
})();

shell.init();

const log = (text) => {
	console.log(text)
}

function show_loader(item) {
	item.innerHTML = "<img class='loader' src='<?= ROOT ?>/assets/images/loader.gif' / >"
}

function set_tab(tab = 'course-landing-page') {
	sessionStorage.setItem('tab', tab)
}

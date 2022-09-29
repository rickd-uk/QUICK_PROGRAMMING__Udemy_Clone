const log = (text) => {
	console.log(text)
}

function show_loader(item) {
	item.innerHTML = "<img class='loader' src='<?= ROOT ?>/assets/images/loader.gif' / >"
}

function set_tab(tab, tab_name = 'tab') {
	sessionStorage.setItem(tab_name, tab)
}

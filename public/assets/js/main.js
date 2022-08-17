const log = (text) => {
	console.log(text)
}

function show_loader(item) {
	item.innerHTML = "<img class='loader' src='<?= ROOT ?>/assets/images/spinner.gif' / >"
}

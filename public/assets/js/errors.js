function display_errors(errors) {
	console.log(errors)
	document.querySelector('.js-progress').style = 'display: none;'
	for (key in errors) {
		document.querySelector('.js-error-' + key).innerHTML = errors[key]
	}
}

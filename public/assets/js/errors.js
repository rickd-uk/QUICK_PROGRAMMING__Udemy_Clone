const errors = {
	display: (errors) => {
		console.log(errors)
		document.querySelector('.js-progress').style = 'display: none;'
		for (key in errors) {
			document.querySelector('.js-error-' + key).innerHTML = errors[key]
		}
	},
}

let tab = sessionStorage.getItem('tab') ? sessionStorage.getItem('tab') : '#profile-overview'

function show_tab(tab_name) {
	const someTabTriggerEl = document.querySelector(tab_name + '-tab')
	const tab = new bootstrap.Tab(someTabTriggerEl)

	tab.show()
}

function set_tab(tab_name) {
	tab = tab_name
	sessionStorage.setItem('tab', tab_name)
}

function load_image(file) {
	// Show file name - !! Not Necessary now, but keep for future
	//document.querySelector('.js-filename').innerHTML = 'Select Files:' + file.name

	let myLink = window.URL.createObjectURL(file)
	document.querySelector('.js-image-preview').src = myLink
}

window.onload = function () {
	log(window)
	show_tab(tab)
}

// upload functions
function save_profile(e) {
	console.log(e)

	const form = e.currentTarget.form
	const inputs = form.querySelectorAll('input, textarea')
	let obj = {}
	let image_added = false

	for (var i = 0; i < inputs.length; i++) {
		var key = inputs[i].name

		if (key == 'image') {
			if (typeof inputs[i].files[0] == 'object') {
				obj[key] = inputs[i].files[0]
				image_added = true
			}
		} else {
			obj[key] = inputs[i].value
		}
	}

	// validate image
	if (image_added) {
		var allowed = ['jpeg', 'jpg', 'png']
		if (typeof obj.image == 'object') {
			var ext = obj.image.name.split('.').pop()
		}

		if (!allowed.includes(ext.toLowerCase())) {
			alert('Only these file types are allowed: ' + allowed.toString(','))
			return
		}
	}
	send_data(obj)

	// hide progress bar after 1.5s
	setTimeout(() => {
		document.querySelector('.js-progress').style = 'display: none;'
	}, 1500)
}

function handle_result(result) {
	console.log(result)

	let obj = JSON.parse(result)
	if (typeof obj == 'object') {
		// object was created
		if (typeof obj.errors == 'object') {
			// errors
			display_errors(obj.errors)
		} else {
			const progress = document.querySelector('.js-progress')
			progress.style = 'display: block;'

			setTimeout(() => {
				window.location.reload()
			}, 2000)
		}
	}
}

function display_errors(errors) {
	document.querySelector('.js-progress').style = 'display: none;'
	for (key in errors) {
		document.querySelector('.js-error-' + key).innerHTML = errors[key]
	}
}

const log = (text) => {
	console.log(text)
}

var tab = sessionStorage.getItem('tab') ? sessionStorage.getItem('tab') : '#profile-overview'

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
	document.querySelector('.js-filename').innerHTML = 'Select Files:' + file.name

	let myLink = window.URL.createObjectURL(file)
	document.querySelector('.js-image-preview').src = myLink
}

window.onload = function () {
	show_tab(tab)
}

// upload functions
function save_profile(e) {
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

	// hide progress bar after 2 sec
	setTimeout(() => {
		document.querySelector('.js-progress').style = 'display: none;'
	}, 2000)
}

function handle_result(result) {
	let obj = JSON.parse(result)
	if (typeof obj == 'object') {
		// object was created
		if (typeof obj.errors == 'object') {
			// errors
			display_errors(obj.errors)
		} else {
			window.location.reload()
		}
	}
}

function display_errors(errors) {
	log(errors)
	for (key in errors) {
		document.querySelector('.js-error-' + key).innerHTML = errors[key]
	}
}

function send_data(obj, progbar = 'js-progress') {
	let progress = document.querySelector('.' + progbar)

	progress.style = 'display: block;'

	let myForm = new FormData()
	for (key in obj) {
		myForm.append(key, obj[key])
	}
	let ajax = new XMLHttpRequest()

	ajax.addEventListener('readystatechange', () => {
		if (ajax.readyState == 4) {
			if (ajax.status == 200) {
				handle_result(ajax.responseText)
			} else {
				// error occurred
				alert('error occurred')
			}
		}
	})
	ajax.upload.addEventListener('progress', (e) => {
		let percent = Math.round((e.loaded / e.total) * 100)
		progress.children[0].style.width = percent + '%'
		progress.children[0].innerHTML = 'Saving... ' + percent + '%'
	})
	// '' - stay on the same page
	// true - asynchronous (so page does not freeze)
	ajax.open('POST', '', true)
	ajax.send(myForm)
}

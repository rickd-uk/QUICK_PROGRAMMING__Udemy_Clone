let tab = sessionStorage.getItem('tab') ? sessionStorage.getItem('tab') : '#slider-images-overview'
let uploading = false

function show_tab(tab_name) {
	const someTabTriggerEl = document.querySelector(tab_name + '-tab')
	const tab = new bootstrap.Tab(someTabTriggerEl)
	tab.show()
}

function set_tab(tab_name) {
	tab = tab_name
	sessionStorage.setItem('tab', tab_name)
}

function load_image(e, file) {
	// Show file name - !! Not Necessary now, but keep for future
	//document.querySelector('.js-filename').innerHTML = 'Select Files:' + file.name

	const form = e.currentTarget.form
	// form.querySelector('.js-filename').innerHTML = 'Selected File: ' + file.name

	const mylink = window.URL.createObjectURL(file)
	form.querySelector('.js-image-preview').src = mylink
}

window.onload = function () {
	log(window)
	show_tab(tab)
}

// upload functions
function save_slider_images(e, id) {
	if (uploading) {
		alert('Please wait for other image to finish uploading')
		return
	}
	uploading = true

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

	// add form id
	obj.id = id

	uploading = false

	// validate image
	if (image_added) {
		document.querySelector('.js-error-image').innerHTML = ''
		var allowed = ['jpeg', 'jpg', 'png']
		if (typeof obj.image == 'object') {
			var ext = obj.image.name.split('.').pop()
		}

		if (!allowed.includes(ext.toLowerCase())) {
			alert('Only these file types are allowed: ' + allowed.toString(','))
			return
		}
	} else {
		//TODO: Validate no image set
		document.querySelector('.js-error-image').innerHTML = 'An image is required'
	}
	console.log(obj)

	// validate
	if (obj.title == '') {
		document.querySelector('.js-error-title').innerHTML = 'An title is required'
	} else {
		document.querySelector('.js-error-title').innerHTML = ''
	}

	if (obj.description == '') {
		document.querySelector('.js-error-description').innerHTML = 'An description is required'
		return
	} else {
		document.querySelector('.js-error-description').innerHTML = ''
	}

	send_data(obj)

	// hide progress bar after 1.5s
	// setTimeout(() => {
	// 	document.querySelector('.js-progress').style = 'display: none;'
	// }, 1500)
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
			}, 500)
		}
	}
}

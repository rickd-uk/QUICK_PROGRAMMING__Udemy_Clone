let tab = sessionStorage.getItem('tab') ? sessionStorage.getItem('tab') : '#slider-images-overview'
let uploading = false

function find_images_in_class(class_to_find, placeholder_name) {
	var slider_images_src = []

	sl1 = document.querySelectorAll(class_to_find)
	sl1.forEach((el) => {
		img_name = el.src.split('/').at(-1).split('.').at(-2)
		slider_images_src.push(img_name == placeholder_name ? false : true)
	})
	return slider_images_src
}

img = find_images_in_class('.js-image-preview', 'image_placeholder')

// function show_tab(tab_name) {
// 	const someTabTriggerEl = document.querySelector(tab_name + '-tab')
// 	const tab = new bootstrap.Tab(someTabTriggerEl)
// 	tab.show()
// }

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
// window.onload = function () {
// 	show_tab(tab)
// }

// upload functions
function save_slider_images(e, id, img_set) {
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
		var allowed = ['jpeg', 'jpg', 'png', 'webp']
		if (typeof obj.image == 'object') {
			var ext = obj.image.name.split('.').pop()
		}

		if (!allowed.includes(ext.toLowerCase())) {
			alert('Only these file types are allowed: ' + allowed.toString(','))
			return
		}
	} else {
		if (!img_set) {
			document.querySelector('.js-error-image').innerHTML = 'An image is required'
		} else {
			obj.img = ''
		}
	}

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

	ajax.send_data(obj)

	// hide progress bar after 1.5s
	// setTimeout(() => {
	// 	document.querySelector('.js-progress').style = 'display: none;'
	// }, 1500)
}

function handle_result(result) {
	console.log(result)

	try {
		let obj = JSON.parse(result)
	} catch (error) {
		console.error(error)
		return
	}

	if (typeof obj == 'object') {
		// object was created
		if (typeof obj.errors == 'object') {
			// errors
			errors.display(obj.errors)
		} else {
			const progress = document.querySelector('.js-progress')
			progress.style = 'display: block;'

			setTimeout(() => {
				window.location.reload()
			}, 500)
		}
	}
}

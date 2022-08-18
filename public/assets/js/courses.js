//TODO: Not Efficient Revisit later

var tab_courses = sessionStorage.getItem('tab_courses') ? sessionStorage.getItem('tab_courses') : 'intended-learners'

var dirty = false

function set_courses_tab(div) {
	if (dirty) {
		//ask user to save when switching tabs
		if (!confirm('Your changes were not saved. continue?!')) {
			return
		}
	}
	tab_courses = div.id
	sessionStorage.setItem('tab_courses', div.id)

	dirty = false
	show_tab(div.id)
}

function show_tab(tab_name) {
	// show loader while waitings
	var contentDiv = document.querySelector('#tabs-content')
	show_loader(contentDiv)

	//change active tab
	var div = document.querySelector('#' + tab_name)
	var children = div.parentNode.children
	for (var i = 0; i < children.length; i++) {
		children[i].classList.remove('active-tab')
	}

	div.classList.add('active-tab')

	// get data from server
	// send_data misnomer

	get_course_data({
		tab_name: tab_courses,
		data_type: 'read',
	})

	disable_save_btn(true)
}

function handle_result(result) {
	result = result.trim()
	if (result.substr(0, 2) == '{"') {
		let obj = JSON.parse(result)
		if (typeof obj == 'object') {
			if (obj.data_type == 'save') {
				// alert(obj.data)

				// Clear all errors
				const error_containers = document.querySelectorAll('.error')
				for (let i = 0; i < error_containers.length; i++) {
					error_containers[i].innerHTML = ''
				}

				// Show any validation errors
				if (typeof obj.errors == 'object') {
					for (key in obj.errors) {
						document.querySelector('.error-' + key).innerHTML = obj.errors[key]
					}
				} else {
					disable_save_btn(true)
					dirty = false
				}
			}
		}
	} else {
		const contentDiv = document.querySelector('#tabs-content')
		contentDiv.innerHTML = result
	}
}

function something_changed(e) {
	dirty = tab_courses
	disable_save_btn(false)
}

function disable_save_btn(status = true) {
	save_btn = document.querySelector('.js-save-btn').classList

	if (status) {
		save_btn.add('disabled')
	} else {
		save_btn.remove('disabled')
	}
}

function get_course_data(obj) {
	var myform = new FormData()
	for (key in obj) {
		myform.append(key, obj[key])
	}

	var ajax = new XMLHttpRequest()

	ajax.addEventListener('readystatechange', function () {
		if (ajax.readyState == 4) {
			if (ajax.status == 200) {
				//everything went well
				//alert("upload complete");
				handle_result(ajax.responseText)
			} else {
				//error
				alert('an error occurred')
			}
		}
	})

	ajax.open('post', '', true)
	ajax.send(myform)
}

function show_loader(item) {
	item.innerHTML = '<img class="loader" src="<?=ROOT?>/assets/images/loader.gif">'
}

show_tab(tab_courses)

function save_content() {
	const content = document.querySelector('#tabs-content')
	const inputs = content.querySelectorAll('input, textarea,select')

	let obj = {}
	obj.data_type = 'save'
	obj.tab_name = tab_courses

	for (let i = 0; i < inputs.length; i++) {
		let key = inputs[i].name
		obj[key] = inputs[i].value
	}
	get_course_data(obj)
}

let course_img_uploading = false

function upload_course_image(file) {
	if (course_img_uploading) {
		alert('Please wait while another image uploads')
		return
	}
	course_img_uploading = true

	let myform = new FormData()
	let ajax = new XMLHttpRequest()

	ajax.addEventListener('readystatechange', () => {
		switch (ajax.readyState) {
			case 0:
				console.info('request not initialized')
				break
			case 1:
				console.info('server connection established')
				break
			case 2:
				console.info('request received')
				break
			case 3:
				console.info('processing request')
				break
			case 4:
				if (ajax.status == 200) {
					course_img_uploading = false
				} else {
					console.error('Image upload failed')
				}
				break
			default:
				console.log(`Unrecognized ajax.readyState!!`)
		}
	})

	ajax.upload.addEventListener('progress', (e) => {
		let percent_progress = (e.loaded / e.total) * 100

		document.querySelector('#progress-bar-image').style.width = percent_progress + '%'
		document.querySelector('#progress-bar-image').innerHTML = percent_progress + '%'
	})
	myform.append('data_type', 'upload_course_image')
	myform.append('tab_name', tab_courses)
	myform.append('image', file)

	ajax.open('POST', '', true)
	ajax.send(myform)
}

// console.log(window.performance)

// //check for Navigation Timing API support
// if (window.performance) {
// 	console.info('window.performance works fine on this browser')
// }

// if (performance.type == performance.TYPE_RELOAD) {
// 	console.info('This page is reloaded')
// } else {
// 	console.info('This page is not reloaded')
// }

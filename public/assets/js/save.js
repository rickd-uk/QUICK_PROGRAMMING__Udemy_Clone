//TODO: Not Efficient Revisit later

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
let ajax_course_image = null

function upload_course_image(file) {
	let img_ul_info = document.querySelector('#js-img-ul-info')
	let img_ul_input = document.querySelector('#js-img-ul-input')
	let img_ul_cancel_btn = document.querySelector('#js-img-ul-cancel-btn')
	let img_progress_bar = document.querySelector('#progress-bar-image')

	if (course_img_uploading) {
		alert('Please wait while another image uploads')
		return
	}

	let allowed_types = ['jpg', 'jpeg', 'png']
	// Remove the last item from split filename i.e. the extension
	let ext = file.name.split('.').pop()
	ext = ext.toLowerCase()

	if (!allowed_types.includes(ext)) {
		alert('Only files of this type allowed: ' + allowed_types.toString(','))
		img_ul_input.classList.remove('hide')
		img_ul_input.value = null
		return
	}

	// display an image preview
	let img_preview = document.querySelector('#js-img-ul-preview')
	// Create url link on local machine
	let link = URL.createObjectURL(file)
	img_preview.src = link

	// Start image file upload
	course_img_uploading = true

	// Hide image upload input & Show cancel button
	img_ul_info.innerHTML = file.name
	img_ul_info.classList.remove('hide')

	img_ul_input.classList.add('hide')
	img_ul_cancel_btn.classList.remove('hide')

	let myform = new FormData()
	ajax_course_image = new XMLHttpRequest()

	ajax_course_image.addEventListener('readystatechange', () => {
		switch (ajax_course_image.readyState) {
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
				if (ajax_course_image.status == 200) {
					// alert(ajax_course_image.responseText)

					course_img_uploading = false
					console.log('%c COMPLETED! ', 'background: #222; color: #bada55')
					img_ul_input.classList.remove('hide')
					img_ul_cancel_btn.classList.add('hide')
					img_ul_info.classList.add('hide')
				} else {
					console.error('Image upload failed')
					img_progress_bar.style.width = '0%'
					img_progress_bar.innerHTML = '0%'

					// Hide image upload input & Show cancel button

					img_ul_info.innerHTML = ''
					img_ul_info.classList.add('hide')

					img_ul_input.classList.remove('hide')
					img_ul_input.value = null

					img_ul_cancel_btn.classList.add('hide')

					course_img_uploading = false
				}
				break
			default:
				console.warning(`Unrecognized ajax readyState!!`)
		}
	})

	ajax_course_image.upload.addEventListener('progress', (e) => {
		let percent_progress = Math.round((e.loaded / e.total) * 100, 0)

		img_progress_bar.style.width = percent_progress + '%'
		img_progress_bar.innerHTML = percent_progress + '%'
	})

	// Append data to send as a form post
	myform.append('data_type', 'upload_course_image')
	myform.append('tab_name', tab_courses)
	myform.append('image', file)

	// append csrf code
	$csrf_code = document.querySelector('#js-csrf_code').value
	myform.append('csrf_code', $csrf_code)

	ajax_course_image.open('POST', '', true)
	ajax_course_image.send(myform)
}

function ajax_course_img_ul_cancel() {
	ajax_course_image.abort()
}

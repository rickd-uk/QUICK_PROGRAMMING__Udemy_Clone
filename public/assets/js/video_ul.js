let course_vid_uploading = false
let ajax_course_video = null

function upload_course_video(file) {
	let vid_ul_info = document.querySelector('#js-vid-ul-info')
	let vid_ul_input = document.querySelector('#js-vid-ul-input')
	let vid_ul_cancel_btn = document.querySelector('#js-vid-ul-cancel-btn')
	let vid_progress_bar = document.querySelector('#progress-bar-vid')

	if (course_vid_uploading) {
		alert('Please wait while another video uploads')
		return
	}

	let allowed_types = ['mp4']
	// Remove the last item from split filename i.e. the extension
	let ext = file.name.split('.').pop()
	ext = ext.toLowerCase()

	if (!allowed_types.includes(ext)) {
		alert('Only files of this type allowed: ' + allowed_types.toString(','))
		vid_ul_input.classList.remove('hide')
		vid_ul_input.value = null
		return
	}

	// display an video preview
	let vid_preview = document.querySelector('#js-vid-ul-preview')
	// Create url link on local machine
	let link = URL.createObjectURL(file)
	vid_preview.src = link

	// Start video file upload
	course_vid_uploading = true

	// Hide video upload input & Show cancel button
	vid_ul_info.innerHTML = file.name
	vid_ul_info.classList.remove('hide')

	vid_ul_input.classList.add('hide')
	vid_ul_cancel_btn.classList.remove('hide')

	let myform = new FormData()
	ajax_course_video = new XMLHttpRequest()

	ajax_course_video.addEventListener('readystatechange', () => {
		switch (ajax_course_video.readyState) {
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
				if (ajax_course_video.status == 200) {
					// alert(ajax_course_video.responseText)

					course_vid_uploading = false
					console.log('%c COMPLETED! ', 'background: #222; color: #bada55')
					vid_ul_input.classList.remove('hide')
					vid_ul_cancel_btn.classList.add('hide')
					vid_ul_info.classList.add('hide')
				} else {
					console.error('Image upload failed')
					vid_progress_bar.style.width = '0%'
					vid_progress_bar.innerHTML = '0%'

					// Hide video upload input & Show cancel button

					vid_ul_info.innerHTML = ''
					vid_ul_info.classList.add('hide')

					vid_ul_input.classList.remove('hide')
					vid_ul_input.value = null

					vid_ul_cancel_btn.classList.add('hide')

					course_vid_uploading = false
				}
				break
			default:
				console.warning(`Unrecognized ajax readyState!!`)
		}
	})

	ajax_course_video.upload.addEventListener('progress', (e) => {
		let percent_progress = Math.round((e.loaded / e.total) * 100, 0)

		vid_progress_bar.style.width = percent_progress + '%'
		vid_progress_bar.innerHTML = percent_progress + '%'
	})

	// Append data to send as a form post
	myform.append('data_type', 'upload_course_video')
	myform.append('tab_name', tab_courses)
	myform.append('video', file)

	// append csrf code
	$csrf_code = document.querySelector('#js-csrf_code').value
	myform.append('csrf_code', $csrf_code)

	ajax_course_video.open('POST', '', true)
	ajax_course_video.send(myform)
}

function ajax_course_vid_ul_cancel() {
	ajax_course_video.abort()
}

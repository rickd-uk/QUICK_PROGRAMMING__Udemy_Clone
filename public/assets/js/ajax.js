function send_data(obj, progbar = 'js-progress') {
	const progress = document.querySelector('.' + progbar)
	progress.style = 'display: block;'

	const myForm = new FormData()
	for (key in obj) {
		myForm.append(key, obj[key])
	}
	let ajax = new XMLHttpRequest()

	ajax.addEventListener('readystatechange', () => {
		if (ajax.readyState == 4) {
			if (ajax.status == 200) {
				// network success, pass on ajax response
				handle_result(ajax.responseText)
				uploading = false
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

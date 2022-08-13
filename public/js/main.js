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
function save_profile() {
	let image = document.querySelector('.js-profile-img-input')
	let allowed = ['jpeg', 'jpg', 'png']

	if (typeof image.files[0] == 'object') {
		var ext = image.files[0].name.split('.').pop()
	}
	console.log('ext:   ', ext)
	if (!allowed.includes(ext.toLowerCase())) {
		alert('Only these file types are allowed: ' + allowed.toString(','))
		return
	}
	console.log(image)

	send_data({
		pic: image.files[0],
	})
	setTimeout(() => {
		document.querySelector('.js-progress').style = 'display: none;'
	}, 2000)
}

function send_data(obj, progbar = '.js-progress') {
	let progress = document.querySelector('.' + progbar)

	let myForm = new FormData()
	for (key in obj) {
		myForm.append(key, obj[key])
	}
	let ajax = new XMLHttpRequest()

	ajax.addEventListener('readystatechange', () => {
		if (ajax.readyState == 4) {
			if (ajax.status == 200) {
				// window.location.reload()
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

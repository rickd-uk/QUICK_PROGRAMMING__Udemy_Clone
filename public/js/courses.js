//TODO: Not Efficient Revisit later
let tab_courses = sessionStorage.getItem('tab_courses') ? sessionStorage.getItem('tab_courses') : '#intended-learners'
let dirty = false

function set_courses_tab(div) {
	let children = div.parentNode.children
	// remove previous active tab
	for (let i = 0; i < children.length; i++) {
		children[i].classList.remove('active-tab')
	}
	// set new active tab
	div.classList.add('active-tab')

	children = document.querySelector('#' + div.id + '-div').parentNode.children
	// remove previous active tab
	for (let i = 0; i < children.length; i++) {
		children[i].classList.add('hide')
	}
	document.querySelector('#' + div.id + '-div').classList.remove('hide')

	// set new active tab
	// div.classList.add('active-tab')

	return
}

function something_changed(e) {
	log('changed: ', e)
	dirty = tab_courses
	disable_save_btn(true)
}

function disable_save_btn(status = false) {
	save_btn = document.querySelector('.js-save-btn').classList

	if (status) {
		save_btn.remove('disabled')
	} else {
		save_btn.add('disabled')
	}
}

//TODO: Not Efficient Revisit later

let tab_courses = sessionStorage.getItem('tab_courses') ? sessionStorage.getItem('tab_courses') : '#intended-learners'
var dirty = false

function set_courses_tab(div) {
	if (dirty) {
		//ask user to save when switching tabs
		if (!confirm('Your changes were not saved. continue?!')) {
			return
		}
	}
	tab = div.id
	sessionStorage.setItem('tab', tab)

	dirty = false
	show_tab(tab)
	// let children = div.parentNode.children
	// // remove previous active tab
	// for (let i = 0; i < children.length; i++) {
	// 	children[i].classList.remove('active-tab')
	// }
	// // set new active tab
	// div.classList.add('active-tab')
	// // Show content
	// let content = '<input />'
	// document.querySelector('#tabs-content').innerHTML = div.id
	// return
}

function show_tab(tab_name) {
	var contentDiv = document.querySelector('#tabs-content')

	//change active tab
	var div = document.querySelector('#' + tab_name)
	var children = div.parentNode.children
	for (var i = 0; i < children.length; i++) {
		children[i].classList.remove('active-tab')
	}

	div.classList.add('active-tab')

	var data = {}
	data.tab_name = tab
	data.data_type = 'read'
	// send_data(data)

	let content = tab_name + '<input />'
	document.querySelector('#tabs-content').innerHTML = content

	disable_save_btn(false)
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

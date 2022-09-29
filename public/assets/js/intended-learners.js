const intended_learners = {
	create_elem: (el, classes) => {
		const div = document.createElement(el)
		Object.assign(div, {
			className: classes,
		})
		div.onclick = (event) => {
			intended_learners.tab_action(event)
		}
		return div
	},

	js_students_learn_HTML: `
	   <input  name="text" class="form-control col-8" type="text" placeholder="Example: Define the roles and responsibilities of a project manager" />
          <div id="students-learn-delete"  class="col-1 text-center border border-danger rounded-small" style="cursor:pointer; margin-left: 20px;">
            <i  id="students-learn-delete"  class="bi bi-trash-fill text-danger"></i>
          </div>
          <div class="col-2 text-center d-flex justify-content-around border border-primary rounded-small" style="cursor:pointer; margin-left: 10px;">
            <i id="students-learn-move-up" class=" bi bi-caret-up-fill" style="margin-left: 20px;"></i>
            <i id="students-learn-move-down"  class="bi bi-caret-down-fill" style="margin-right: 20px;"></i>
          </div>
	`,

	add_new: (section) => {
		if (section == 'js-students-learn') {
			div = intended_learners.create_elem('div', 'd-flex js-input align-items-center pt-2')
			div.innerHTML = intended_learners.js_students_learn_HTML
			const js_learn_div = document.querySelector('.' + section)
			js_learn_div.appendChild(div)
		} else if (section == 'js-prerequisities') {
		}
	},

	tab_action: (e) => {
		let action = e.target.id
		let target = e.currentTarget

		if (action == 'students-learn-delete') {
			intended_learners.openModal().then((res) => {
				if (res) {
					console.log('True')
					console.log(target)
					target.remove()
				} else {
					return
				}
			})
		} else if (action == 'students-learn-move-up') {
			alert('up')
		} else if (action == 'students-learn-move-down') {
			alert('down')
		}
	},

	openModal: async () => {
		this.myModal = new SimpleModal('Confirm', 'Are you sure you want to remove this?', 'Yes', "No, I don't")
		try {
			const modalResponse = await myModal.question()
			return modalResponse
		} catch (err) {
			console.log(err)
		}
	},
}

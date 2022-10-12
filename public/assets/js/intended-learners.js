const intended_learners = {
	create_elem: (el, classes) => {
		const div = document.createElement(el)
		Object.assign(div, {
			className: classes,
		})
		div.onclick = (event) => {
			// if (event.target.id == 'students-learn-delete') {
			// 	intended_learners.tab_action(event)
			// }
			intended_learners.tab_action(event)
		}
		return div
	},

	//  <div  class="col-1 text-center border border-danger rounded-small" style="cursor:pointer; margin-left: 20px;">
	//           <i  id="students-learn-delete"  class="bi bi-trash-fill text-danger fs-4"></i>
	//         </div>

	js_students_learn_HTML: `
	   <input  name="text" class="form-control col-7" type="text" placeholder="Example: Define the roles and responsibilities of a project manager" />
          <div  class="col-1 text-center rounded-small" style="cursor:pointer; margin-left: 20px;">
            <i  id="students-learn-delete"  class="bi bi-trash-fill text-danger fs-4"></i>
          </div>
          <div class="col-1 text-center d-flex justify-content-around  rounded-small" style="cursor:pointer; margin-left: 10px;">
            <i id="students-learn-move-up" class=" bi bi-caret-up-fill fs-4" style="margin-left: 20px;"></i>
            <i id="students-learn-move-down"  class="bi bi-caret-down-fill fs-4" style="margin-right: 20px;"></i>
          </div>
					<div id="students-learn-move" class="col-1 text-center d-flex justify-content-around  rounded-small" style="cursor:pointer; margin-left: 10px;">
						<i class="bi bi-arrows-move fs-4"></i>
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
		const action = e.target.id
		const target = e.currentTarget
		const target_parent_count = target.parentNode.children.length

		const parent = target.parentNode

		if (action == 'students-learn-delete') {
			if (target_parent_count <= students_learn_min_inputs) {
				console.log('ACTION:  ' + action)
				intended_learners.openMsgModal().then((res) => {})
				return
			}
			intended_learners.openConfimationModal().then((res) => {
				if (res) {
					target.remove()
				} else {
					return
				}
			})
		} else if (action == 'students-learn-move-up') {
			const move_to = e.currentTarget?.previousElementSibling

			move_to && parent.insertBefore(target, move_to)
		} else if (action == 'students-learn-move-down') {
			const move_to = e.currentTarget?.nextElementSibling?.nextElementSibling
			parent.insertBefore(target, move_to)
		}
	},

	openMsgModal: async () => {
		this.myModal = new MsgModal('Warning!', `Cannot delete it. You must have at least ${students_learn_min_inputs} learning objectives`)
		try {
			const modalResponse = await myModal.response()
			return modalResponse
		} catch (err) {
			console.log(err)
		}
	},

	openConfimationModal: async () => {
		this.myModal = new SimpleModal('Confirm', 'Are you sure you want to remove this?', 'Yes', "No, I don't")
		try {
			const modalResponse = await myModal.question()
			return modalResponse
		} catch (err) {
			console.log(err)
		}
	},
}

function add_new(section) {
	if (section == 'js-students-learn') {
		let outer_div = document.createElement('div')
		outer_div.classList.add('d-flex')
		outer_div.classList.add('align-items-center')
		outer_div.classList.add('pt-2')

		outer_div.innerHTML = `
          <input name="text" class="form-control col-8" type="text" placeholder="Example: Define the roles and responsibilities of a project manager" />
          <div class="col-1 text-center " style="cursor:pointer">
            <i class="bi bi-trash-fill text-danger"></i>
          </div>
          <div class="col-2 text-center" style="cursor:pointer">
            <i class=" bi bi-caret-up-fill"></i>
            <i class="bi bi-caret-down-fill"></i>
          </div>
          `
		document.querySelector('.' + section).appendChild(outer_div)
	} else if (section == 'js-prerequisities') {
	}
}

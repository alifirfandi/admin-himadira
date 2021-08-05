var global = {
	base_url: $("#base_url").val(),
	data: function (response) {
		return JSON.parse(response);
	},
	raw: function (obj) {
		return JSON.stringify(obj);
	},
	numberingDatatable: function (data, type, row, meta) {
		return meta.row + meta.settings._iDisplayStart + 1;
	},
	loadingButton: function (idElement, color, state, content) {
		if (state) {
			$(`#${idElement}`)
				.removeClass(`btn-${color}`)
				.addClass(`btn-light`)
				.attr("disabled", true)
				.html("")
				.prepend(
					'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
				);
		} else {
			$(`#${idElement}`)
				.removeClass(`btn-light`)
				.addClass(`btn-${color}`)
				.removeAttr("disabled")
				.html(content);
			$(`#${idElement}`).find("span:first").remove();
		}
	},
	renderDetailButton: function (_data, _type, row) {
		return `
			<a href="javascript:void(0)" onclick='detail(${row.id})' data-toggle="modal" data-target="#detail-modal" class="btn btn-md btn-primary">
				<i class="fas fa-eye font-16"></i>
			</a>
		`;
	},
	renderUpdateButton: function (_data, _type, row) {
		return `
			<a href="javascript:void(0)" onclick='prepareUpdate(${row.id})' data-toggle="modal" data-target="#edit-modal" class="btn btn-md btn-warning">
				<i class="fas fa-edit font-16 ml-1"></i>
			</a>
		`;
	},
	renderDeleteButton: function (_data, _type, row) {
		return `
			<a href="javascript:void(0)" onclick="confirmDelete(${row.id})" data-toggle="modal" data-target="#delete-modal" class="btn btn-md btn-danger">
				<i class="fas fa-trash-alt font-16"></i>
			</a>
		`;
	},
};

// FIX BUG LATER
$('#sidebarToggleTop').trigger('click')
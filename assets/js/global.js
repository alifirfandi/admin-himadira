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
	initDropify: function () {
		$(".dropify").dropify({
			messages: {
				default: '<span class="h6">Upload photo here<span>',
				replace: "Drag and drop or click to replace",
				remove: "Remove",
			},
		});
	},
	initFormEditor: function (content = "") {
		if ($("#form-editor").length > 0) {
			tinymce.init({
				selector: "textarea#form-editor",
				content_style: "body { color:black; }",
				theme: "modern",
				height: 150,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
				setup: function (editor) {
					editor.on('init', function () {
						editor.setContent(content);
					});
				}
			});
		}
	}
};

// FIX BUG LATER
$("#sidebarToggleTop").trigger("click");

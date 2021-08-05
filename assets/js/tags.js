var tempOldValue;

$(document).ready(function () {
	renderTags();

	$("#button-create-tag").on("click", function () {
		const tagName = $("#create-tag").val().trim();

		if (tagName == "") return toastr.error("Tag Empty!");

		const raw = global.raw({
			tag: tagName,
		});

		const formData = new FormData();
		formData.append("raw", raw);

		$.ajax({
			url: `${global.base_url}tags/createTag`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("button-create-tag", "primary", true, null);
			},
			success: function (response) {
				if (response.code === 200) {
					$("#create-modal").modal("hide");
					tableTags.ajax.reload();
					toastr.success(response.message);
				} else {
					toastr.error(response.message);
				}
			},
			complete: function () {
				global.loadingButton("button-create-tag", "primary", false, "Create");
			},
		});
	});

	$("#button-edit-tag").on("click", function () {
		const tagName = $("#edit-tag").val().trim();

		if (tagName == "Loading") returntoastr.warning("Still loading data!");
		if (tagName == tempOldValue) return toastr.warning("No Changes");
		if (tagName == "") return toastr.error("Tag Empty!");

		const raw = global.raw({
			tag_id: $("#id-tag").val(),
			tag: tagName,
		});

		const formData = new FormData();
		formData.append("raw", raw);

		$.ajax({
			url: `${global.base_url}tags/updateTag`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("button-edit-tag", "success", true, null);
			},
			success: function (response) {
				if (response.code === 200) {
					$("#edit-modal").modal("hide");
					tableTags.ajax.reload();
					toastr.success(response.message);
				} else {
					toastr.error(response.message);
				}
			},
			complete: function () {
				$("form").reset();
				global.loadingButton("button-edit-tag", "success", false, "Save");
			},
		});
	});
});

function renderTags() {
	tableTags = $("#table-tags").DataTable({
		destroy: true,
		ajax: {
			url: `${global.base_url}tags`,
			type: "GET",
			error: function (response) {
				toastr.error("Error Get Tags: " + response.statusText);
			},
		},
		columns: [
			{ data: global.numberingDatatable },
			{ data: "tag" },
			{ data: "created_at" },
			{ data: "updated_at" },
			{
				data: 'id',
				render: global.renderUpdateButton,
				targets: "no-sort",
				orderable: false,
			},
		],
	});
}

function prepareUpdate(id) {
	$("#id-tag").val(id);
	$("#edit-tag").val("Loading").attr("disabled", "disabled");

	$.ajax({
		url: `${global.base_url}tags/getTag/${id}`,
		type: "GET",
		contentType: false,
		processData: false,
		success: function (response) {
			if (response.code === 200) {
				tempOldValue = response.data.tag;
				$("#edit-tag").val(response.data.tag).removeAttr("disabled");
			} else {
				toastr.error(response.message);
			}
		},
	});
}

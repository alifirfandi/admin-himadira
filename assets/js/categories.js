var tempOldValue;

$(document).ready(function () {
	renderCategories();

	$("#button-create-category").on("click", function () {
		const categoryName = $("#create-category").val().trim();

		if (categoryName == "") {
			toastr.error("Category Empty!");
			return;
		}

		const raw = global.raw({
			category: categoryName,
		});

		const formData = new FormData();
		formData.append("raw", raw);

		$.ajax({
			url: `${global.base_url}categories/createCategory`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("button-create-category", "primary", true, null);
			},
			success: function (response) {
				if (response.code === 200) {
					$("#create-modal").modal("hide");
					tableCategories.ajax.reload();
					toastr.success(response.message);
				} else {
					toastr.error(response.message);
				}
			},
			complete: function () {
				global.loadingButton(
					"button-create-category",
					"primary",
					false,
					"Create"
				);
			},
		});
	});

	$("#button-edit-category").on("click", function () {
		const categoryName = $("#edit-category").val().trim();

		console.log(tempOldValue);

		if (categoryName == "Loading") return toastr.warning("Still loading data!");
		if (categoryName == tempOldValue) return toastr.warning("No Changes");
		if (categoryName == "") return toastr.error("Category Empty!");

		const raw = global.raw({
			category_id: $("#id-category").val(),
			category: categoryName,
		});

		const formData = new FormData();
		formData.append("raw", raw);

		$.ajax({
			url: `${global.base_url}categories/updateCategory`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("button-edit-category", "success", true, null);
			},
			success: function (response) {
				if (response.code === 200) {
					$("#edit-modal").modal("hide");
					tableCategories.ajax.reload();
					toastr.success(response.message);
				} else {
					toastr.error(response.message);
				}
			},
			complete: function () {
				global.loadingButton("button-edit-category", "success", false, "Save");
			},
		});
	});
});

function renderCategories() {
	tableCategories = $("#table-categories").DataTable({
		destroy: true,
		ajax: {
			url: `${global.base_url}categories`,
			type: "GET",
			error: function (response) {
				toastr.error("Error Get Categories: " + response.statusText);
			},
		},
		columns: [
			{ data: global.numberingDatatable },
			{ data: "category" },
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
	$("#id-category").val(id);
	$("#edit-category").val("Loading").attr("disabled", "disabled");

	$.ajax({
		url: `${global.base_url}categories/getCategory/${id}`,
		type: "GET",
		contentType: false,
		processData: false,
		success: function (response) {
			if (response.code === 200) {
				tempOldValue = response.data.category;
				$("#edit-category").val(response.data.category).removeAttr("disabled");
			} else {
				toastr.error(response.message);
			}
		},
	});
}
$(document).ready(function () {
	renderDataContent();

	$("#edit-content").on("click", function () {
		const titleInput = $("#title").val().trim();
		const descriptionInput = tinymce.get("form-editor").getContent().trim();
		const linkInput = $("#link").val().trim();
		const categoryInput = $("#category").val().trim();
		var coverInput = $("#cover")[0].files[0];

		if (titleInput == "" || descriptionInput == "" || linkInput == "") {
			toastr.error("Harap isi semua kolom yang tersedia");
			return;
		} else if (!coverInput) {
			coverInput = $("#cover").attr("data-default-file");
		}

		const formData = new FormData();
		formData.append("title", titleInput);
		formData.append("description", tinymce.get("form-editor").getContent().replace(/"/g, "'"));
		formData.append("link", linkInput);
		formData.append("category", categoryInput);
		formData.append("cover", coverInput);

		$.ajax({
			url:
				`${global.base_url}content/editContent/` +
				$("#id-content").val(),
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("edit-content", "success", true, null);
			},
			success: function (response) {
				if (response.code === 200) {
					toastr.success(response.message);
					setTimeout(() => {
						location.assign(
							`${global.base_url}views/contentInstagram`
						);
					}, 1000);
				} else {
					toastr.error(response.message);
					global.loadingButton(
						"edit-content",
						"success",
						false,
						"Save"
					);
				}
			},
		});
	});

	$("#button-delete-photo").on("click", function () {
		$.ajax({
			url:
				`${global.base_url}content/deletePhoto/` + $("#id-photo").val(),
			type: "GET",
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton(
					"button-delete-photo",
					"danger",
					true,
					null
				);
			},
			success: function (response) {
				if (response.code === 200) {
					toastr.success(response.message);
				} else {
					toastr.error(response.message);
				}
				setTimeout(() => {
					location.assign(
						`${global.base_url}views/editContentInstagram/` +
							$("#id-content").val()
					);
				}, 1000);
			},
		});
	});
});

function renderDataContent() {
	$.ajax({
		url: `${global.base_url}content/getContent/` + $("#id-content").val(),
		type: "GET",
		contentType: false,
		processData: false,
		success: function (response) {
			if (response.code === 200) {
				$("#title").val(response.data.title);
				global.initFormEditor(response.data.description)
				$("#link").val(response.data.link);
				$("#counter").text(response.data.counter);
				$("#cover")
					.attr(
						"data-default-file",
						global.base_url + response.data.thumbnail
					)
					.dropify({
						messages: {
							default: '<span class="h6">Upload cover here<span>',
							replace: "Drag and drop or click to replace",
							remove: "Remove",
						},
					});
				renderCategories(response.data.category);
				renderAdditionalPhoto(response.data.photo);
			} else {
				toastr.error(response.message);
			}
		},
	});
}

function renderCategories(currentCategories) {
	$.ajax({
		url: `${global.base_url}categories`,
		type: "GET",
		contentType: false,
		processData: false,
		beforeSend: function () {
			global.loadingButton("create-content", "primary", true, null);
		},
		success: function (response) {
			if (response.code === 200) {
				$("#category").html(
					`${response.data
						.map(function (item) {
							return `<option value="${
								item.id
							}" ${item.category == currentCategories ? "selected" : ""}>${item.category}</option>`;
						})
						.join("")}`
				);
			} else {
				toastr.error(response.message);
			}
		},
		complete: function () {
			global.loadingButton("create-content", "primary", false, "Create");
		},
	});
}

function renderAdditionalPhoto(photos) {
	$("#additional-photo-container").html(
		`${photos
			.map(function (item) {
				return `
					<div class="card col-md-4 col-sm-6 pt-2 pb-2">
						<img class="img-fluid" src="${global.base_url}${item.uri}" />
						<button type="button" class="mt-2 btn btn-danger btn-block" onclick="confirmDelete(${item.id})" data-toggle="modal" data-target="#delete-modal">Delete</button>
					</div>
				`;
			})
			.join("")}`
	);
	appendNewInput();
}

function appendNewInput() {
	const el = $("<div>").attr("class", "col-md-4 col-sm-6");
	const child = $("<input/>").attr({
		id: "additional-photo",
		type: "file",
		class: "dropify additional-photo",
		onchange: "addPhoto()",
		"data-allowed-formats": "square",
		"data-allowed-file-extensions": "png jpg jpeg",
		"data-height": "300",
	});
	el.append(child);
	$("#additional-photo-container").append(el);
	global.initDropify();
}

function addPhoto() {
	const formData = new FormData();
	formData.append("photo", $("#additional-photo")[0].files[0]);

	$("#additional-photo-container").html(`
		<div class="spinner-border text-primary" role="status">
		</div>
		<p> Loading upload new image...</p>
	`);

	$.ajax({
		url: `${global.base_url}content/insertPhoto/` + $("#id-content").val(),
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: function (response) {
			if (response.code === 200) {
				toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
			setTimeout(() => {
				location.assign(
					`${global.base_url}views/editContentInstagram/` +
						$("#id-content").val()
				);
			}, 1000);
		},
	});
}

function confirmDelete(id) {
	$("#id-photo").val(id);
}

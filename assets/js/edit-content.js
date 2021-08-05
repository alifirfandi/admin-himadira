$(document).ready(function () {
	renderDataContent();

	$("#edit-content").on("click", function () {
		const titleInput = $("#title").val().trim();
		const descriptionInput = $("#description").val().trim();
		const linkInput = $("#link").val().trim();
		const categoryInput = $("#category").val().trim();
		var coverInput = $("#cover")[0].files[0];

		console.log(coverInput);

		if (titleInput == "" || descriptionInput == "" || linkInput == "") {
			toastr.error("Harap isi semua kolom yang tersedia");
			return;
		} else if (!coverInput) {
			coverInput = $("#cover").attr("data-default-file");
		}

		const formData = new FormData();
		formData.append("title", titleInput);
		formData.append("description", descriptionInput);
		formData.append("link", linkInput);
		formData.append("category", categoryInput);
		formData.append("cover", coverInput);

		$.ajax({
			url: `${global.base_url}content/editContent/` + $("#id-content").val(),
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
						location.assign(`${global.base_url}views/contentInstagram`);
					}, 1000);
				} else {
					toastr.error(response.message);
					global.loadingButton("edit-content", "success", false, "Save");
				}
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
				$("#description").val(response.data.description);
				$("#link").val(response.data.link);
				$("#counter").text(response.data.counter);
				$("#cover")
					.attr("data-default-file", global.base_url + response.data.thumbnail)
					.dropify({
						messages: {
							default: '<span class="h6">Upload cover here<span>',
							replace: "Drag and drop or click to replace",
							remove: "Remove",
						},
					});
				renderCategories(response.data.category);
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

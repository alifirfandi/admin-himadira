$(document).ready(function () {
	renderTags();
	initPlugin();

	$("#create-article").on("click", function () {
		const titleInput = $("#title").val().trim();
		const descriptionInput = $("#description").val().trim();
		const linkInput = $("#link").val().trim();
		const TagsInput = $("#tags").val();
		const thumbnailInput = $("#thumbnail")[0].files[0];

		if (
			titleInput == "" ||
			descriptionInput == "" ||
			linkInput == "" ||
			TagsInput == ""
		) {
			toastr.error("Harap isi semua kolom yang tersedia");
			return;
		} else if (!thumbnailInput) {
			toastr.error("thumbnail kosong");
			return;
		}

		const formData = new FormData();
		formData.append("title", titleInput);
		formData.append("description", descriptionInput);
		formData.append("link", linkInput);
		formData.append("tags", TagsInput);
		formData.append("thumbnail", thumbnailInput);

		$.ajax({
			url: `${global.base_url}article/create`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("create-article", "primary", true, null);
			},
			success: function (response) {
				if (response.code === 201) {
					toastr.success(response.message);
					setTimeout(() => {
						location.assign(`${global.base_url}views/contentMedium`);
					}, 1000);
				} else {
					toastr.error(response.message);
					global.loadingButton("create-article", "primary", false, "Create");
				}
			},
		});
	});
});

function initPlugin() {
	global.initDropify();
}

function renderTags() {
	$.ajax({
		url: `${global.base_url}tags`,
		type: "GET",
		success: function (response) {
			if (response.code === 200) {
				$.each(response.data, function (_, value) { 
					$('#tags').append(`<option value="${value.id}">${value.tag}</option>`)
				});
			} else {
				toastr.error(response.message);
			}
			$("select").selectize({
				maxItems: null,
			});
		},
	});
}

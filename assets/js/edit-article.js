let idArticle = window.location.href.split("/");
idArticle = idArticle[idArticle.length - 1];

$(document).ready(function () {
	renderDataArticle();

	$("#update-article").on("click", function () {
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
		}
		const formData = new FormData();
		formData.append("title", titleInput);
		formData.append("description", descriptionInput);
		formData.append("link", linkInput);
		formData.append("tags", TagsInput);

		if (thumbnailInput) {
			formData.append("thumbnail", thumbnailInput);
		}

		$.ajax({
			url: `${global.base_url}article/update/${idArticle}`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("update-article", "primary", true, null);
			},
			success: function (response) {
				if (response.code === 200) {
					toastr.success(response.message);
					setTimeout(() => {
						location.assign(
							`${global.base_url}views/contentMedium`
						);
					}, 1000);
				} else {
					toastr.error(response.message);
					global.loadingButton(
						"update-article",
						"primary",
						false,
						"Save"
					);
				}
			},
		});
	});
});

function renderDataArticle() {
	$.ajax({
		url: `${global.base_url}article/find/${idArticle}`,
		type: "GET",
		success: function (response) {
			if (response.code === 200) {
				$("#title").val(response.data.title);
				$("#description").val(response.data.description);
				$("#link").val(response.data.link);
				$("#counter").text(response.data.counter);
				$("#thumbnail")
					.attr("data-default-file", global.base_url + response.data.thumbnail)
					.dropify({
						messages: {
							default:
								'<span class="h6">Upload thumbnail here<span>',
							replace: "Drag and drop or click to replace",
							remove: "Remove",
						},
					});
				renderTags(response.data.tags);
			} else {
				toastr.error(response.message);
			}
		},
	});
}

function renderTags(articleTags) {
	$.ajax({
		url: `${global.base_url}tags`,
		type: "GET",
		contentType: false,
		processData: false,
		beforeSend: function () {
			global.loadingButton("update-content", "primary", true, null);
		},
		success: function (response) {
			if (response.code === 200) {
				$.each(response.data, function (_, value) { 
					$('#tags').append(`
						<option 
							value="${value.id}"
						>${value.tag}</option>
					`)
				});
				$("select").selectize({
					maxItems: null,
					items: articleTags.map(value => value.id)
				});
			} else {
				toastr.error(response.message);
			}
		},
		complete: function () {
			global.loadingButton("update-content", "primary", false, "Save");
		},
	});
}

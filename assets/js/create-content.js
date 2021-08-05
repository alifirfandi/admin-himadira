$(document).ready(function () {
	renderCategories();

	$(".dropify").dropify({
		messages: {
			default: '<span class="h6">Upload cover here<span>',
			replace: "Drag and drop or click to replace",
			remove: "Remove",
		},
	});

	$("#create-content").on("click", function () {
		const titleInput = $("#title").val().trim();
		const descriptionInput = $("#description").val().trim();
		const linkInput = $("#link").val().trim();
		const categoryInput = $("#category").val().trim();
        const coverInput = $("#cover")[0].files[0];

        console.log(coverInput)

		if (titleInput == "" || descriptionInput == "" || linkInput == "") {
			toastr.error("Harap isi semua kolom yang tersedia");
			return;
		} else if (!coverInput) {
			toastr.error("Cover kosong");
			return;
		}

		const formData = new FormData();
		formData.append("title", titleInput);
		formData.append("description", descriptionInput);
		formData.append("link", linkInput);
		formData.append("category", categoryInput);
		formData.append("cover", coverInput);

		$.ajax({
			url: `${global.base_url}content/createContent`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("create-content", "primary", true, null);
			},
			success: function (response) {
				console.log(response);
				if (response.code === 200) {
					toastr.success(response.message);
					setTimeout(() => {
						location.assign(`${global.base_url}views/contentInstagram`);
					}, 1000);
				} else {
					toastr.error(response.message);
					global.loadingButton("create-content", "primary", false, "Login");
				}
			},
		});
	});
});

function renderCategories() {
	$.ajax({
		url: `${global.base_url}categories`,
		type: "GET",
		contentType: false,
		processData: false,
		beforeSend: function () {
			global.loadingButton("create-content", "primary", true, null);
		},
		success: function (response) {
			console.log(response);
			if (response.code === 200) {
				$("#category").html(
					`${response.data
						.map(function (item) {
							return `<option value="${item.id}">${item.category}</option>`;
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

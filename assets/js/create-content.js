$(document).ready(function () {
	renderCategories();
	global.initDropify();

	$("#button-additional-photo").on("click", function () {
		const el = $("<div>").attr("class", "col-md-4 col-sm-6");
		const child = $("<input/>").attr({
			type: "file",
			class: "dropify additional-photo",
			"data-allowed-formats": "square",
			"data-allowed-file-extensions": "png jpg jpeg",
			"data-height": "320",
		});
		el.append(child);
		$("#additional-photo-container").append(el);
		global.initDropify();
		child.trigger("click");
	});

	$("#create-content").on("click", function () {
		const titleInput = $("#title").val().trim();
		const descriptionInput = $("#description").val().trim();
		const linkInput = $("#link").val().trim();
		const categoryInput = $("#category").val().trim();
		const coverInput = $("#cover")[0].files[0];

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
					if ($(".additional-photo").length > 0)
						uploadAdditionalPhoto(response.data);
					else
						setTimeout(() => {
							location.assign(
								`${global.base_url}views/contentInstagram`
							);
						}, 1000);
				} else {
					toastr.error(response.message);
					global.loadingButton(
						"create-content",
						"primary",
						false,
						"Login"
					);
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

async function uploadAdditionalPhoto(idContent) {
	for (var i = 0; i < $(".additional-photo").length; i++) {
		if ($(".additional-photo")[i].files.length > 0) {
			await uploadPhoto(idContent, $(".additional-photo")[i].files[0], i);
		}

		if (i == $(".additional-photo").length - 1)
			setTimeout(() => {
				location.assign(`${global.base_url}views/contentInstagram`);
			}, 1000);
	}
}

async function uploadPhoto(idContent, imageData, pos) {
	sleep(1000);
	await postData(
		`${global.base_url}content/insertPhoto/${idContent}`,
		imageData
	).then((data) => {
		if(data.code == 200) toastr.success(`Foto ${pos + 1} berhasil ditambahkan`)
		else toastr.error(`Foto ${pos + 1} gagal ditambahkan`)
	});
}

function sleep(milliseconds) {
	const date = Date.now();
	let currentDate = null;
	do {
		currentDate = Date.now();
	} while (currentDate - date < milliseconds);
}

async function postData(url = "", imageData) {
	var formData = new FormData();
	formData.append("photo", imageData);

	const response = await fetch(url, {
		method: "POST",
		mode: "cors",
		cache: "no-cache",
		credentials: "same-origin",
		headers: {
			Accept: "*/*",
			"Access-Control-Allow-Methods":
				"GET, POST, OPTIONS, PUT, PATCH, DELETE",
			"Access-Control-Allow-Headers":
				"origin,X-Requested-With,content-type,accept",
			"Access-Control-Allow-Credentials": "true",
		},
		body: formData,
	});
	return response.json();
}

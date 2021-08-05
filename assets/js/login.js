$(document).ready(function () {
	// Enter Listener
	$(document).on("keypress", function (e) {
		if (e.which == 13) $("#button-login").trigger("click");
	});

    // Login after click button
	$("#button-login").on("click", function () {
		const emailInput = $("#email").val().trim();
		const passwordInput = $("#password").val().trim();

		if (emailInput == "") {
			toastr.error("Masukkan Email");
			return;
		} else if (passwordInput == "") {
			toastr.error("Masukkan Password");
			return;
		}

		const raw = global.raw({
			email: emailInput,
			password: passwordInput,
		});

		const formData = new FormData();
		formData.append("raw", raw);

		$.ajax({
			url: `${global.base_url}auth/signIn`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("button-login", "primary", true, null);
			},
			success: function (response) {
				console.log(response);
				if (response.code === 200) {
					toastr.success(response.message);
					setTimeout(() => {
						location.assign(global.base_url);
					}, 1000);
				} else {
					toastr.error(response.message);
                    global.loadingButton("button-login", "primary", false, "Login");
				}
			},
		});
	});
});

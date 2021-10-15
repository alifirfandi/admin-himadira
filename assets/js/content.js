$(document).ready(function () {
	renderContent();

	$('#button-delete-content').on('click', function(){
		$.ajax({
			url: `${global.base_url}content/deleteContent/` + $('#id-content').val(),
			type: "GET",
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton("button-delete-content", "danger", true, null);
			},
			success: function (response) {
				if (response.code === 200) {
					$("#delete-modal").modal("hide");
					renderContent();
					toastr.success(response.message);
				} else {
					toastr.error(response.message);
				}
			},
			complete: function () {
				global.loadingButton("button-delete-content", "danger", false, "Delete");
			},
		});
	})

	$(document).on('focusin', function(e) {
		var target = $(e.target);
		if (target.closest(".mce-window").length || target.closest(".tox-dialog").length) {
			e.stopImmediatePropagation();
			target = null;
		}
	});
});

function renderContent() {
	tableContent = $("#table-content").DataTable({
		destroy: true,
		ajax: {
			url: `${global.base_url}content`,
			type: "GET",
			error: function (response) {
				toastr.error("Error Get Content: " + response.statusText);
			},
		},
		columns: [
			{ data: global.numberingDatatable },
			{ data: "title" },
			{ data: "category" },
			{ data: "counter" },
			{
				data: "id",
				render: global.renderDetailButton,
				targets: "no-sort",
				orderable: false,
			},
			{
				data: "id",
				render: global.renderUpdateButton,
				targets: "no-sort",
				orderable: false,
			},
			{
				data: "id",
				render: global.renderDeleteButton,
				targets: "no-sort",
				orderable: false,
			},
		],
	});
}

function detail(id) {
	$.ajax({
		url: `${global.base_url}content/getContent/${id}`,
		type: "GET",
		contentType: false,
		processData: false,
		success: function (response) {
			if (response.code === 200) {
				$("#title").text(response.data.title);
				$("#description").text(response.data.description);
				$("#category").text(response.data.category);
				$("#counter").text(response.data.counter);
				$("#created-date").text(response.data.created_at);
				$("#updated-date").text(response.data.updated_at);
				$("#cover").attr("src", global.base_url + response.data.thumbnail);
				$("#link").attr("href", response.data.link);
			} else {
				toastr.error(response.message);
			}
		},
	});
}

function prepareUpdate(id){
	location.assign(`${global.base_url}views/editContentInstagram/${id}`);
}

function confirmDelete(id){
	$("#id-content").val(id);
}

function initFormEditor(){

}
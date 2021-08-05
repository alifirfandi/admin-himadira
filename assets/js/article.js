let tableArticles = null;

$('document').ready(function() {
	renderArticles();

	$("#button-delete-article").on("click", function() {
		const idArticle = $("#id-article").val()
		$.ajax({
			type: "POST",
			url: `${global.base_url}article/delete/${idArticle}`,
			contentType: false,
			processData: false,
			beforeSend: function () {
				global.loadingButton(
					"button-delete-article",
					"danger",
					true,
					null
				);
			},
			success: function (response) {
				if (response.code === 200) {
					$("#delete-modal").modal("hide");
					renderArticles();
					toastr.success(response.message);
				} else {
					toastr.error(response.message);
				}
			},
			complete: function () {
				global.loadingButton(
					"button-delete-article",
					"danger",
					false,
					"Delete"
				);
			},
		});
	});
});

function renderArticles() {
	tableArticles = $("#table-articles").DataTable({
		destroy: true,
		ajax: {
			url: `${global.base_url}article`,
			type: "GET",
			error: function (response) {
				toastr.error("Error Get Articles: " + response.statusText);
			},
		},
		columns: [
		 	{
	            class: "details-control",
	            data: null,
	            defaultContent: "",
	            targets: "no-sort",
				orderable: false,
            },
			{ data: global.numberingDatatable },
			{ 
				data: null,
				render: renderArticleThumbnail,
				targets: "no-sort",
				orderable: false,
			},
			{ data: "title" },
			{ data: "counter" },
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

    const detailRows = [];
 
    $('#table-articles tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tableArticles.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );
 
        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( formatDetail(row.data())).show();
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    } );
 
    tableArticles.on('draw', function () {
        $.each( detailRows, function (i, id) {
            $('#'+id+' td.details-control').trigger('click');
        });
    } );
}

function formatDetail(data) {
	let tagPill = '';
	$.each(data.tags, function(_, val) {
	  tagPill += `<span class="ml-2 badge rounded-pill bg-primary text-white">${val}</span>`
	});
    return `
    	<table class="border-0">
    		<tr>
    			<th>Deskripsi</th>
    			<td>
		    		<span class="d-inline-block text-truncate" style="max-width: 500px;">
					  ${data.description}
					</span>
    			</td>
    		</tr>
    		<tr>
    			<th>Tags</th>
    			<td>
					${tagPill}
    			</td>
    		</tr>
    	</table>
    `
}
 

function renderArticleThumbnail (_data, _type, row) {
	return `
		<a href="${row.link}" target="_blank" rel="noopener">
			<div
				style="
					width: 64px;
					height: 64px;
					background-image: url(${row.thumbnail});
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
					margin: 0 auto;
				"
			>
			</div>
		</a>
	` ;
}

function confirmDelete(idArticle) {
	$("#id-article").val(idArticle);
}

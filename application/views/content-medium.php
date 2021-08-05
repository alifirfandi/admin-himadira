<?php

	$modalDelete = array(
		'modalId' => 'delete-modal',
		'modalType' => 'modal-sm',
		'modalTitle' => 'Delete article',
		'modalBody' => '
			<input type="hidden" id="id-article" />
			<p>Apakah anda yakin ingin menghapus article ini ?</p>
		',
		'modalFooter' => '
			<button type="submit" class="btn btn-danger" id="button-delete-article">Delete</button>
			<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
		'
	);

	$this->load->view('components/page', array(
    	'headers' => '
            <link href="'. base_url("assets/vendor/vendor/datatables/dataTables.bootstrap4.min.css") .'" rel="stylesheet" type="text/css" />
			<link href="'. base_url("assets/vendor/vendor/datatables/responsive.bootstrap4.min.css") .'" rel="stylesheet" type="text/css" />
			<style>
				td.details-control {
					background: url("'. base_url('assets/img/plus-outline.svg') . '") no-repeat center center;
					cursor: pointer;
					width: 10px;
				}
				tr.details td.details-control {
					background: url("' . base_url('assets/img/minus-outline.svg') . '") no-repeat center center;
					width: 10px;
				}
			</style>
        ',
        'modals' => array($modalDelete),
        'content' => '
        	<div class="row ml-2">
				<div class="col-lg-12">
					<a href="'. base_url("views/createContentMedium") .'" class="btn btn-primary mb-3">
						<i class="fas fa-plus text-default font-16"></i> Medium
					</a>
				</div>
			</div>

			<div class="p-3">
				<div class="table-responsive">
					<table id="table-articles" class="table table-bordered dt-responsive display nowrap text-center" style="width:100%">
						<thead>
							<tr>
								<th rowspan="2"></th>
								<th rowspan="2">No</th>
								<th rowspan="2">Thumbnail</th>
								<th rowspan="2">Title</th>
								<th rowspan="2">Counter</th>
								<th colspan="2">Aksi</th>
							</tr>
							<tr>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
					</table>
				</div>
            </div>
        ',
        'footers' => '
            <!-- Datatables -->
            <script src="'. base_url("assets/vendor/vendor/datatables/jquery.dataTables.min.js") .'"></script>
            <script src="'. base_url("assets/vendor/vendor/datatables/dataTables.bootstrap4.min.js") .'"></script>
            <script src="'. base_url("assets/vendor/vendor/datatables/dataTables.responsive.min.js") .'"></script>
            <script src="'. base_url("assets/vendor/vendor/datatables/responsive.bootstrap4.min.js") .'"></script>

            <!-- PageJS -->
            <script src="'. base_url("assets/js/article.js") .'"></script>
        '
    ));
?>

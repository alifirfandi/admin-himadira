<?php
    $modalDetail = array(
		'modalId' => 'detail-modal',
		'modalType' => 'modal-lg',
		'modalTitle' => 'Detail Content',
		'modalBody' => '
		<div class="card">
		<div class="row">
			<div class="col-md-6">
				<img id="cover" class="card-img-top" src="'. base_url("assets/img/content-ig.jpg") .'" alt="Card image cap">
			</div>
			<div class="col-md-6">
				<div class="card-body">
					<h5 id="title" class="card-title">Title</h5>
					<p id="description" class="card-text addReadMore showlesscontent">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Category: <span id="category" class="font-weight-bold">Information</span></li>
					<li class="list-group-item">Counter: <span id="counter" class="font-weight-bold">100</span></li>
					<li class="list-group-item">Created date: <span id="created-date" class="font-weight-bold">20/20/2020</span></li>
					<li class="list-group-item">Last updated: <span id="updated-date" class="font-weight-bold">20/20/2020</span></li>
				</ul>
				<div class="card-body">
					<a id="link" target="_blank" href="#" class="card-link">Instagram link</a>
				</div>
			</div>
			</div>
		</div>
		',
		'modalFooter' => '
			<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
		'
	);

	$modalDelete = array(
		'modalId' => 'delete-modal',
		'modalType' => 'modal-sm',
		'modalTitle' => 'Delete content',
		'modalBody' => '
			<input type="hidden" id="id-content" />
			<p>Apakah anda yakin ingin menghapus konten ini ?</p>
		',
		'modalFooter' => '
			<button type="submit" class="btn btn-danger" id="button-delete-content">Delete</button>
			<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
		'
	);

    $this->load->view('components/page', array(
        'headers' => '
            <link href="'. base_url("assets/vendor/vendor/datatables/dataTables.bootstrap4.min.css") .'" rel="stylesheet" type="text/css" />
			<link href="'. base_url("assets/vendor/vendor/datatables/responsive.bootstrap4.min.css") .'" rel="stylesheet" type="text/css" />
        ',
        'modals' => array($modalDetail, $modalDelete),
        'content' => '
            <div class="row ml-2">
				<div class="col-lg-12">
					<a href="'. base_url("views/createContentInstagram") .'" class="btn btn-primary mb-3">
						<i class="fas fa-plus text-default font-16"></i> Content
					</a>
				</div>
			</div>

			<div class="p-3">
				<div class="table-responsive">
					<table id="table-content" class="table table-bordered dt-responsive display nowrap" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Title</th>
								<th>Category</th>
								<th>Counter</th>
								<th>Detail</th>
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
            <script src="'. base_url("assets/js/content.js") .'"></script>
        '
    ));
?>
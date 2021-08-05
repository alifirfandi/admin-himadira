<?php
    $modalCreate = array(
		'modalId' => 'create-modal',
		'modalType' => 'modal-sm',
		'modalTitle' => 'Create new category',
		'modalBody' => '
		<form>
			<div class="form-group">
				<label for="create-category">Category</label>
				<input type="text" class="form-control" id="create-category" placeholder="Enter category name">
			</div>
		</form>
		',
		'modalFooter' => '
			<button type="submit" class="btn btn-primary" id="button-create-category">Create</button>
			<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
		'
	);

    $modalEdit = array(
		'modalId' => 'edit-modal',
		'modalType' => 'modal-sm',
		'modalTitle' => 'Edit category',
		'modalBody' => '
		<input type="hidden" id="id-category">
		<form>
			<div class="form-group">
				<label for="edit-category">Category</label>
				<input type="text" class="form-control" id="edit-category" placeholder="Enter category name">
			</div>
		</form>
		',
		'modalFooter' => '
			<button type="submit" class="btn btn-success" id="button-edit-category">Save</button>
			<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
		'
	);

    $this->load->view('components/page', array(
        'headers' => '
            <link href="'. base_url("assets/vendor/vendor/datatables/dataTables.bootstrap4.min.css") .'" rel="stylesheet" type="text/css" />
            <link href="'. base_url("assets/vendor/vendor/datatables/responsive.bootstrap4.min.css") .'" rel="stylesheet" type="text/css" />
        ',
        'modals' => array($modalCreate, $modalEdit),
        'content' => '
            <div class="row ml-2">
				<div class="col-lg-12">
					<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#create-modal">
						<i class="fas fa-plus text-default font-16"></i> Categories
					</button>
				</div>
			</div>

			<div class="p-3">
				<div class="table-responsive">
					<table id="table-categories" class="table table-bordered dt-responsive display nowrap" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Category</th>
								<th>Created at</th>
								<th>Updated at</th>
								<th>Edit</th>
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
            <script src="'. base_url("assets/js/categories.js") .'"></script>
        '
    ));
?>
<?php
    $modalCreate = array(
		'modalId' => 'create-modal',
		'modalType' => 'modal-sm',
		'modalTitle' => 'Create new tag',
		'modalBody' => '
		<form>
			<div class="form-group">
				<label for="create-tag">Tag</label>
				<input type="text" class="form-control" id="create-tag" placeholder="Enter tag name">
			</div>
		</form>
		',
		'modalFooter' => '
			<button type="submit" class="btn btn-primary" id="button-create-tag">Create</button>
			<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
		'
	);

    $modalEdit = array(
		'modalId' => 'edit-modal',
		'modalType' => 'modal-sm',
		'modalTitle' => 'Edit tag',
		'modalBody' => '
		<input type="hidden" id="id-tag">
		<form>
			<div class="form-group">
				<label for="edit-tag">Tag</label>
				<input type="text" class="form-control" id="edit-tag" placeholder="Enter tag name">
			</div>
		</form>
		',
		'modalFooter' => '
			<button type="submit" class="btn btn-success" id="button-edit-tag">Save</button>
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
						<i class="fas fa-plus text-default font-16"></i> Tags
					</button>
				</div>
			</div>

			<div class="p-3">
				<div class="table-responsive">
					<table id="table-tags" class="table table-bordered dt-responsive display nowrap" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Tag</th>
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
            <script src="'. base_url("assets/js/tags.js") .'"></script>
        '
    ));
?>
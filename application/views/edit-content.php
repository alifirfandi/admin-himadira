<?php
    $modalDelete = array(
        'modalId' => 'delete-modal',
        'modalType' => 'modal-sm',
        'modalTitle' => 'Delete content',
        'modalBody' => '
            <input type="hidden" id="id-photo" />
            <p>Apakah anda yakin ingin menghapus foto ini ?</p>
        ',
        'modalFooter' => '
            <button type="submit" class="btn btn-danger" id="button-delete-photo">Delete</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        '
    );

    $this->load->view('components/page', array(
        'headers' => '
            <!-- Dropify -->
            <link href="' . base_url("assets/vendor/vendor/dropify/dist/css/dropify.css") . '" rel="stylesheet" type="text/css" />
            <style>
                .instagram {
                    background: #f09433; 
                    background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
                    background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
                    background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#f09433", endColorstr="#bc1888",GradientType=1 );
                }
            </style>
        ',
        'modals' => array($modalDelete),
        'content' => '
            <div class="row">
                <input type="hidden" id="id-content" value="' . $idContent . '" />
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cover">Thumbnail</label>
                        <input type="file" 
                            class="dropify" 
                            id="cover" 
                            data-allowed-formats="square"
                            data-allowed-file-extensions="png jpg jpeg"
                            data-height="320" />                    
                    </div>
                    
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <select class="form-control" id="category">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link">Link</label>
                            <div class="input-group">
                                <input id="link" type="text" class="form-control" placeholder="Enter link instagram post">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form-editor">Description</label>
                        <textarea class="form-control" id="form-editor" rows="4" placeholder="Enter description"></textarea>
                    </div>
                    <button id="edit-content" type="button" class="btn btn-success btn-block">Save</button>
                </div>
            </div>
            <div class="row" id="additional-photo-container">
            </div>
        ',
        'footers' => '
            <!-- Dropify -->
            <script src="' . base_url("assets/vendor/vendor/dropify/dist/js/dropify.js") . '"></script>

            <!--Wysiwig js-->
            <script src="'. base_url("assets/vendor/vendor/tinymce/tinymce.min.js") .'"></script>

            <!-- PageJS -->
            <script src="' . base_url("assets/js/edit-content.js") . '"></script>
        '
));

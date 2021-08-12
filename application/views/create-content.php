<?php
    $this->load->view('components/page', array(
        'headers' => '
            <!-- Dropify -->
            <link href="'. base_url("assets/vendor/vendor/dropify/dist/css/dropify.css") .'" rel="stylesheet" type="text/css" />
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
        'content' => '
            <div class="row">
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
                            <input id="link" type="text" class="form-control" placeholder="Enter link instagram post">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="4" placeholder="Enter description"></textarea>
                    </div>
                    <button id="create-content" type="button" class="btn btn-primary btn-block">Create</button>
                </div>
            </div>
            <button id="button-additional-photo" type="button" class="mt-2 mb-2 btn btn-dark btn-block">Add additional photo (Optional)</button>
            <div class="row" id="additional-photo-container">
            </div>
        ',
        'footers' => '
            <!-- Dropify -->
            <script src="'. base_url("assets/vendor/vendor/dropify/dist/js/dropify.js") .'"></script>
            
            <!-- PageJS -->
            <script src="'. base_url("assets/js/create-content.js") .'"></script>
        '
    ));
?>
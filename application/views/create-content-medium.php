<?php
    $this->load->view('components/page', array(
        'headers' => '
            <!-- Dropify -->
            <link href="'. base_url("assets/vendor/vendor/dropify/dist/css/dropify.css") .'" rel="stylesheet" type="text/css" />
            
			<!-- Selectize -->
            <link href="'. base_url("assets/vendor/vendor/selectize/selectize.css") .'" rel="stylesheet" type="text/css" />
        ',
        'content' => '
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cover">Thumbnail</label>
                        <input type="file" 
                            class="dropify" 
                            id="thumbnail" 
                            data-allowed-file-extensions="png jpg jpeg"
							data-max-file-size="500K"
							data-height="320"
						/>                    
                    </div>
                    
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="tags">Tags</label>
                            <select class="form-control" id="tags">

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link">Link</label>
                            <div class="input-group">
                                <input id="link" type="text" class="form-control" placeholder="Enter link medium post">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="4" placeholder="Enter description"></textarea>
                    </div>
                    <button id="create-article" type="button" class="btn btn-primary btn-block">Create</button>
                </div>
            </div>
        ',
        'footers' => '
            <!-- Dropify -->
            <script src="'. base_url("assets/vendor/vendor/dropify/dist/js/dropify.js") . '"></script>

			<!-- Selectize -->
			<script src="' . base_url("assets/vendor/vendor/selectize/selectize.js") . '"></script>
            
            <!-- PageJS -->
            <script src="'. base_url("assets/js/create-article.js") .'"></script>
        '
    ));

<?php
    $this->load->view('components/page', array(
        'content' => '
            <div class="row">
                <!-- Content Row -->
                <div class="row col-xl-8 col-md-6">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Pengunjung</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10.000</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Total Konten IG</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fab fa-instagram fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            Total Konten Medium</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">6</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fab fa-medium fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- Area Chart -->
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Statistik Pengunjung</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->

                <div class="row col-xl-4 col-md-6">
                    <!-- Pie Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Konten Terbaru</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                    src="' . base_url("assets/img/content-ig.jpg") . '" alt="...">
                            </div>
                            <p>4 MACAM GAYA PENULISAN CASE DALAM KODE PROGRAM</p>
                            <a target="_blank" href="https://undraw.co/"> Lihat Detail &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        ',
        'footers' => '
            <!-- Page level plugins -->
            <script src="'. base_url('assets/vendor/chart.js/Chart.min.js') .'"></script>

            <!-- Page level custom scripts -->
            <script src="'. base_url('assets/vendor/js/demo/chart-area-demo.js') .'"></script>
        '
    ));
?>
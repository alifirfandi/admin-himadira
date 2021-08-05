<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('components/head'); ?>

<body class="bg-gradient-primary">

    <div class="container">
        <input type="hidden" id="base_url" value="<?= base_url() ?>">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 row align-items-center justify-content-center">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Administrator</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Email / Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Password">
                                        </div>
                                        <button type="button" id="button-login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('components/foot'); ?>
    <script src="<?= base_url(); ?>assets/js/login.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

    <!-- Head -->
    <?php $this->load->view('components/head'); ?>
    <!-- End of Head -->

    <body id="page-top">
        <input type="hidden" id="base_url" value="<?= base_url() ?>">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <?php $this->load->view('components/sidebar'); ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Modals -->
                <?php if (isset($modals)) {
                    foreach ($modals as $modal)
                        $this->load->view('components/modals', $modal);
                } ?>

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php $this->load->view('components/navbar'); ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-4 text-gray-800"><?php if (isset($title)) echo $title ?></h1>
                        <!-- Page Content-->
                        <?php if (isset($content)) echo $content ?>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; HIMADIRA 2021, Template by <a href="https://startbootstrap.com/theme/sb-admin-2" target="_blank">SB Admin 2</a></span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <?php $this->load->view('components/foot'); ?>
    </body>
</html>
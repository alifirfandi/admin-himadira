<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-5 remove-mt" href="<?= base_url() ?>">
        <div class="sidebar-brand-icon mt-5">
            <img src="<?= base_url("assets/img/himadira.png") ?>" alt="" width="200" id="logo-hima">
        </div>
    </a>

    <!-- Divider -->
    <div class="mt-5 remove-mt">
        <hr class="sidebar-divider mt-5 mb-0">
    </div>

    <?php
        if (isset($sideBar)) {
            foreach ($sideBar as $item) {
                ?>
                    <li class="nav-item <?php if(isset($title) && $item['label'] == $title) echo "active" ?>">
                        <a class="nav-link" href="<?= $item['href'] ?>">
                            <i class="<?= $item['icon'] ?>"></i>
                            <span><?= $item['label'] ?></span></a>
                    </li>
                <?php if($item['divider'] == true) : ?>
                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        <?= $item['sidebar-heading'] ?>
                    </div>
                <?php endif;
            }
        }
    ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
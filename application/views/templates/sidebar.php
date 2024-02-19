<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Nama Sistem -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-server"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Inventory Spare Part</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Utama
            </div>

            <!-- Master Data -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url('sparepart') ?>">Spare Part</a>
                        <a class="collapse-item" href="<?php echo base_url('mesin') ?>">Mesin</a>
                        <a class="collapse-item" href="<?php echo base_url('lokasi') ?>">Lokasi</a>
                        <?php if ($this->session->userdata['role_id'] == '1'): ?>
                        <a class="collapse-item" href="<?php echo base_url('user') ?>">User</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>

            <!-- Nav Transaksi -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url('sparepart_in') ?>">Spare Part Masuk</a>
                        <a class="collapse-item" href="<?php echo base_url('sparepart_out') ?>">Spare Part Keluar</a>
                    </div>
                </div>
            </li>

            <?php if ($this->session->userdata['role_id'] == '1'): ?>
                <!-- Nav Laporan -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
                        aria-expanded="true" aria-controls="collapseLaporan">
                        <i class="fas fa-fw fa-print"></i>
                        <span>Laporan</span>
                    </a>
                    <div id="collapseLaporan" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?php echo base_url('lap_masuk') ?>">Spare Part Masuk</a>
                            <a class="collapse-item" href="<?php echo base_url('lap_keluar') ?>">Spare Part Keluar</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <?php if($this->session->userdata('role_id') == '1'): ?>
                <a class="nav-link" href="<?php echo base_url('secondhead/list_order') ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>List Order</span>
                </a>
                <?php elseif($this->session->userdata('role_id') == '2'): ?>
                <a class="nav-link" href="<?php echo base_url('list_order') ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>List Order</span>
                </a>
                <?php endif; ?>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider"> <!--garis-->

            <!-- Menu lainnya -->
            <div class="sidebar-heading">
                Lainnya
            </div>
            <!-- Lainnya -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('profil') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('welcome/logout') ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider d-none d-md-block"> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0">
                        <i class="fa fa-bars btn-danger"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('nama_karyawan') ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo base_url('foto/').$this->session->userdata('foto') ?>">
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
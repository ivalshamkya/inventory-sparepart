<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Nama Sistem -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('waho/dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-server"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Inventory Spare Part</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('waho/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('waho/supplier') ?>">
                    <i class="fas fa-fw fa-truck"></i>
                    <span>Supplier</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('waho/list_order') ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>List Order</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider"> <!--garis-->

            <!-- Menu lainnya -->
            <div class="sidebar-heading">
                Lainnya
            </div>
            <!-- Lainnya -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('waho/profil') ?>">
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
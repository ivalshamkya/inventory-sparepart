<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Data User</h1>
        </div>
        <div class="float-right">
            <a href="<?php echo base_url('user/add_user') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
        </div>
    </div>
        <hr>
        <?php echo $this->session->flashdata('tambah');?>
        <?php echo $this->session->flashdata('ubah');?>
        <?php echo $this->session->flashdata('hapus');?>
        <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar User</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">NRP</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Hak Akses</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no=1;
                            foreach($user as $u) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $u->nrp ?></td>
                                    <td><?php echo $u->nama_karyawan ?></td>
                                    <td><?php echo $u->username ?></td>
                                    <?php if($u->role_id=='1') { ?>
                                        <td>Section Head</td>
                                    <?php }elseif($u->role_id=='2'){ ?>
                                        <td>Karyawan</td>
                                    <?php }elseif($u->role_id=='3'){ ?>
                                        <td>PIC Ordering</td>
                                    <?php }elseif($u->role_id=='4'){ ?>
                                        <td>Purchasing</td>
                                    <?php }else{ ?>
                                        <td>Warehouse</td>
                                    <?php }?>
                                    <td><img src="<?php echo base_url() . '/foto/' . $u->foto ?>" width="100"></td>
                                    <td>
                                        <?php echo anchor('user/edit_user/' .$u->nrp, '<div class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit</div>') ?>
                                        <?php echo anchor('user/hapus_user/' .$u->nrp, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</div>') ?>
                                    </td>
                                </tr>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</div>

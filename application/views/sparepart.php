<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Data Spare Part</h1>
        </div>
        <div class="float-right">
                <a href="<?php echo base_url('sparepart/add_sparepart') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
        </div>
    </div>
        <hr>
        <?php echo $this->session->flashdata('tambah');?>
        <?php echo $this->session->flashdata('ubah');?>
        <?php echo $this->session->flashdata('hapus');?>
        <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Spare Part</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</td>
                                    <th class="text-center">Part Number</td>
                                    <th class="text-center">Nama Spare Part</td>
                                    <th class="text-center">Lokasi</td>
                                    <th class="text-center">Stok</td>
                                    <th class="text-center">Gambar</td>
                                    <th class="text-center">Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no=1;
                            foreach($sparepart as $sp) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $sp->part_number ?></td>
                                    <td><?php echo $sp->deskripsi ?></td>
                                    <td><?php echo $sp->nm_lokasi ?></td>
                                    <td><?php echo $sp->stok_akhir ?></td>
                                    <td><img src="<?php echo base_url() . '/gambar/' . $sp->gambar ?>" width="100"></td>
                                    <td>
                                        <?php echo anchor('sparepart/edit_sparepart/' .$sp->part_number, '<div class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit</div>') ?>
                                        <?php echo anchor('sparepart/hapus_sparepart/' .$sp->part_number, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</div>') ?>
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
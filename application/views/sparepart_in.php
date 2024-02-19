<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Data Spare Part In</h1>
        </div>
        <div class="float-right">
                <a href="<?php echo base_url('sparepart_in/add_sparepart_in') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
        </div>
    </div>
        <hr>
        <?php echo $this->session->flashdata('tambah');?>
        <?php echo $this->session->flashdata('ubah');?>
        <?php echo $this->session->flashdata('hapus');?>
        <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Spare Part In</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Part Number</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no=1;
                            foreach($sparepart_in as $in) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $in->tgl_in ?></td>
                                    <td><?php echo $in->part_number ?></td>
                                    <td><?php echo $in->deskripsi ?></td>
                                    <td><?php echo $in->jumlah ?></td>
                                    <td>
                                        <?php echo anchor('sparepart_in/edit/' .$in->id_transaksi, '<div class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit</div>') ?>
                                        <?php echo anchor('sparepart_in/hapus/' .$in->id_transaksi, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</div>') ?>
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
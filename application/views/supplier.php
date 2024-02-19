<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Data Supplier</h1>
        </div>
        <div class="float-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah_supplier">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>
        <hr>
        <?php echo $this->session->flashdata('tambah');?>
        <?php echo $this->session->flashdata('ubah');?>
        <?php echo $this->session->flashdata('hapus');?>
        <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Supplier</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Id Supplier</th>
                                    <th class="text-center">Nama Supplier</th>
                                    <th class="text-center">No Telepon</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no=1;
                            foreach($supplier as $s) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $s->id_supplier ?></td>
                                    <td><?php echo $s->nama_supplier ?></td>
                                    <td><?php echo $s->no_telepon ?></td>
                                    <td><?php echo $s->alamat ?></td>
                                    <td>
                                        <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_supplier<?php echo $s->id_supplier ?>">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                        <?php echo anchor('supplier/hapus_supplier/' .$s->id_supplier, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?>
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

<!-- Modal Tambah Supplier -->
<div class="modal fade" id="tambah_supplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url(). 'supplier/tambah_supplier'; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>ID Supplier</label>
                        <input type="text" name="id_supplier" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="number" name="no_telepon" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea type="text" name="alamat" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
        </div>
    </div>
</div>


<!-- Modal Edit Supplier-->
<?php $no=0;
foreach ($supplier as $sup) : $no++; ?>
    <div class="modal fade" id="edit_supplier<?php echo $sup->id_supplier ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(). 'supplier/update_supplier' ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>ID Supplier</label>
                            <input type="text" name="id_supplier" class="form-control" value="<?php echo $sup->id_supplier ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input type="text" name="nama_supplier" class="form-control" value="<?php echo $sup->nama_supplier ?>">
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="number" name="no_telepon" class="form-control" value="<?php echo $sup->no_telepon ?>">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" name="alamat" class="form-control"> <?php echo $sup->alamat ?></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

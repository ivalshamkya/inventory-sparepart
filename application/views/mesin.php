<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Data Mesin</h1>
        </div>
        <div class="float-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah_mesin">
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
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Mesin</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">ID Mesin</th>
                                    <th class="text-center">Nama Mesin</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no=1;
                            foreach($mesin as $ms) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $ms->id_mesin ?></td>
                                    <td><?php echo $ms->nm_mesin ?></td>
                                    <td><?php echo $ms->keterangan ?></td>
                                    <td>
                                        <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_mesin<?php echo $ms->id_mesin ?>">
                                            <i class="fa fa-edit"></i>&nbsp;&nbsp;Edit
                                        </div>
                                        <?php echo anchor('mesin/hapus_mesin/' .$ms->id_mesin, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</div>') ?>
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


<!-- Modal Tambah Mesin-->
<div class="modal fade" id="tambah_mesin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Mesin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(). 'mesin/tambah_mesin'; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>ID Mesin</label>
                        <input type="text" name="id_mesin" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Mesin</label>
                        <input type="text" name="nm_mesin" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
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

<!-- Modal Edit Mesin-->
<?php $no=0;
foreach ($mesin as $ms) : $no++; ?>
    <div class="modal fade" id="edit_mesin<?php echo $ms->id_mesin ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Mesin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(). 'mesin/update_mesin' ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>ID Mesin</label>
                            <input type="text" name="id_mesin" class="form-control" value="<?php echo $ms->id_mesin ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Mesin</label>
                            <input type="text" name="nm_mesin" class="form-control" value="<?php echo $ms->nm_mesin ?>">
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="<?php echo $ms->keterangan ?>">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
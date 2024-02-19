<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Data Supplier</h1>
        </div>
    </div>
        <hr>
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

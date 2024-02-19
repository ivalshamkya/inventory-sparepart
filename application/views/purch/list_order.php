<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Data List Ordering</h1>
        </div>
    </div>
    <hr>
    <?php echo $this->session->flashdata('tambah'); ?>
    <?php echo $this->session->flashdata('ubah'); ?>
    <?php echo $this->session->flashdata('hapus'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">List Order</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form method="get" action="<?= base_url('purch/list_order') ?>" class="d-flex align-items-center mb-1">
                    <label for="" class="mr-2">Filter: </label>
                    <select name="status" id="status" class="form-control col col-md-2" onchange="submit()">
                        <option value="" selected>All</option>
                        <option value="approved" <?= isset($_GET['status']) && $_GET['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="waiting" <?= isset($_GET['status']) && $_GET['status'] == 'waiting' ? 'selected' : '' ?>>Waiting</option>
                        <option value="rejected" <?= isset($_GET['status']) && $_GET['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                    </select>
                </form>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Id Order</th>
                            <th class="text-center">Part Number</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">SH</th>
                            <th class="text-center">PIC Ordering</th>
                            <th class="text-center">Purchasing</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($detail_order as $key => $value) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $value->id_order ?></td>
                                <td><?= $value->part_number ?></td>
                                <td><?= $value->deskripsi ?></td>
                                <td><?= $value->jumlah ?> <?= $value->satuan ?></td>
                                <td>
                                    <?php if ($value->apprSH == '1') : ?>
                                        <div class="bg-success rounded-pill text-center text-white">
                                            Approved
                                        </div>
                                    <?php elseif ($value->apprSH == '0') : ?>
                                        <div class="bg-danger rounded-pill text-center text-white">
                                            Rejected
                                        </div>
                                    <?php else : ?>
                                        <div class="bg-warning rounded-pill text-center text-white">
                                            Waiting
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($value->wbs == NULL) : ?>
                                        <div class="bg-warning rounded-pill text-center text-white">
                                            Waiting
                                        </div>
                                    <?php elseif ($value->wbs == '0') : ?>
                                        <div class="bg-danger rounded-pill text-center text-white">
                                            Rejected
                                        </div>
                                    <?php else : ?>
                                        <div class="bg-success rounded-pill text-center text-white">
                                            Approved
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($value->id_supplier == NULL) : ?>
                                        <div class="bg-warning rounded-pill text-center text-white">
                                            Waiting
                                        </div>
                                    <?php elseif ($value->id_supplier == '0') : ?>
                                        <div class="bg-danger rounded-pill text-center text-white">
                                            Rejected
                                        </div>
                                    <?php else : ?>
                                        <div class="bg-success rounded-pill text-center text-white">
                                            Approved
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('purch/list_order/detail_order/' . $value->id_order) ?>" class="btn btn-secondary">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
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
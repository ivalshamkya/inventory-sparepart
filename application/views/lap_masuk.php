<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-00"><?php echo $title ?></h1>
    </div>

    <div class="card mb-2">
        <div class="card-header bg-primary text-white">
            Filter Data Spare Part Masuk
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('lap_masuk') ?>" class="form-inline">
                <div class="form-group mb-2">
                    <label>Dari : </label>
                    <input type="date" class="form-control ml-3" name="dari" required>
                </div>
                <div class="form-group mb-2 ml-5">
                    <label>Sampai : </label>
                    <input type="date" class="form-control ml-3" name="sampai" required>
                </div>
                <button type="submit" class="btn btn-success mb-2 ml-auto" name="btnTampil"><i class="fas fa-eye"></i> Tampilkan</button>
                <a class="btn btn-danger mb-2 ml-3" target="_blank" href="<?php echo base_url().'lap_masuk/cetakLaporan/?dari='.set_value('dari').'&sampai='.set_value('sampai') ?>"><i class="fas fa-print"></i> Cetak</a>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal Masuk</th>
                            <th class="text-center">Part Number</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        foreach($laporan as $l) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $l->tgl_in ?></td>
                            <td><?php echo $l->part_number ?></td>
                            <td><?php echo $l->deskripsi ?></td>
                            <td><?php echo $l->jumlah ?></td>
                            <td><?php echo $l->nama_karyawan ?></td>
                        </tr>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
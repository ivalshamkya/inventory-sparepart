<h2 style="text-align: center; font-weight: bold;">Laporan Spare Part Keluar</h2>
<hr>
<table>
    <tr>
        <td>Dari Tanggal</td>
        <td>:</td>
        <td><?php echo date('d-M-Y',strtotime($_GET['dari'])); ?></td>
    </tr>
    <tr>
        <td>Sampai Tanggal</td>
        <td>:</td>
        <td><?php echo date('d-M-Y',strtotime($_GET['sampai'])); ?></td>
    </tr>
</table>

<table class="table table-bordered table-striped mt-4" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">ID Transaksi</th>
            <th class="text-center">Tanggal Keluar</th>
            <th class="text-center">Part Number</th>
            <th class="text-center">Deskripsi</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">User</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no=1;
        foreach($laporan as $l) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $l->id_transaksi ?></td>
            <td><?php echo $l->tgl_out ?></td>
            <td><?php echo $l->part_number ?></td>
            <td><?php echo $l->deskripsi ?></td>
            <td><?php echo $l->jumlah ?></td>
            <td><?php echo $l->keterangan ?></td>
            <td><?php echo $l->nama_karyawan ?></td>
        </tr>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    window.print();
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('assets') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title ?></h3>
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td>No</td>
					<td>Part Number</td>
					<td>Deskripsi</td>
                    <td>Mesin</td>
					<td>Lokasi</td>
					<td>Stok Awal</td>
					<td>Stok Akhir</td>
                    <td>Std Level Stok</td>
                    <td>Harga Satuan</td>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; 
                foreach ($sparepart as $sp): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $sp->part_number ?></td>
						<td><?= $sp->deskripsi ?></td>
						<td><?= $sp->id_mesin ?></td>
						<td><?= $sp->id_lokasi ?></td>
						<td><?= $sp->stok_awal ?></td>
						<td><?= $sp->stok_akhir ?></td>
						<td><?= $sp->std_level_stok ?></td>
						<td><?= $sp->harga_satuan ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>
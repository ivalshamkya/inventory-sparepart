<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('templates/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('templates/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?php echo base_url('sparepart_in') ?>">
                <div class="container-fluid">
                    <h5 class="h3 mb-4 text-gray-800">Edit Spare Part In</h1>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <?php foreach($sparepart_in as $in) : ?>
                                <div class="card-header">Id Transaksi : <strong><?php echo $in->id_transaksi ?></strong></div>
                                <div class="card-body">
                                        <form action="<?php echo base_url(). 'sparepart_in/update_sparein' ?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <input type="hidden" name="id_transaksi" class="form-control" value="<?php echo $in->id_transaksi ?>">
                                                <div class="col-md-8">
                                                    <div class="form-row">
                                                        <div class="form-group col-4">
                                                            <label>Tanggal Spare Part Masuk</label>
                                                            <input type="date" name="tgl_in" class="form-control" value="<?php echo $in->tgl_in ?>" required>
                                                        </div>
                                                        <div class="form-group col-4">
                                                            <label>Triger Ordering</label>
                                                            <select name="triger_ordering" id="triger_ordering" class="form-control">
                                                            <option selected="true" disabled="disabled">Pilih Triger</option>
                                                                <option value="Maintenance" <?= $in->triger_ordering == 'Maintenance' ? 'selected' : '' ?>>Maintenance</option>
                                                                <option value="Project" <?= $in->triger_ordering == 'Project' ? 'selected' : '' ?>>Project</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-4">
                                                            <label>Identitas Pengambilan Barang</label>
                                                            <select name="id_pengambilan_brg" id="id_pengambilan_brg" class="form-control">
                                                                <option selected="true" disabled="disabled">Pilih Identitas</option>
                                                                <option value="SPB" <?= $in->id_pengambilan_brg == 'SPB' ? 'selected' : '' ?>>SPB</option>
                                                                <option value="GR" <?= $in->id_pengambilan_brg == 'GR' ? 'selected' : '' ?>>GR</option>
                                                                <option value="EG SUPPORT" <?= $in->id_pengambilan_brg == 'EG SUPPORT' ? 'selected' : '' ?>>EG SUPPORT</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-row">
                                                        <div class="form-group col-4">
                                                            <label>Spare Part</label>
                                                            <select name="part_number" id="part_number" class="form-control">
                                                                <option selected="true" disabled="disabled">Pilih Spare Part</option>
                                                                <?php foreach($datasparepart as $sp): ?>
                                                                    <option value="<?php echo $sp->part_number ?>" <?= $in->part_number == $sp->part_number ? 'selected' : '' ?>><?php echo $sp->part_number ?> - <?php echo $sp->deskripsi ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-4">
                                                            <label>Jumlah</label>
                                                            <input type="number" name="jumlah" class="form-control" value="<?php echo $in->jumlah ?>">
                                                        </div>
                                                        <div class="form-group col-4">
                                                            <label>Tanggal Planning Pemasangan</label>
                                                            <input type="date" name="tgl_plan_pasang"  value="<?php echo $in->tgl_plan_pasang ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-row">
                                                        <div class="form-group col-4">
                                                            <label>Keterangan</label>
                                                            <input type="text" name="keterangan" class="form-control" value="<?php echo $in->keterangan ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="nrp" value="<?= $this->session->userdata['nrp'] ?>" class="form-control">
                                            </div>
                                            <hr>
                                                <a href="<?php echo base_url('sparepart_in') ?>"><div class="btn btn-secondary">Close</div></a>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>				
                                </div>
                                <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<?php $this->load->view('templates/js.php') ?>
	<script>
		$(document).ready(function(){

			$('#part_number').on('change', function(){
				if($(this).val() == '') reset()
				else {
					$.ajax({
						url: "<?php echo base_url() ?>sparepart_in/get_stok_akhir",
						type: 'POST',
						dataType: 'json',
						data: {part_number: $(this).val()},
						success: function(data){
							$('input[name="stok_akhir"]').val(data.stok_akhir)
						}
					})
				}
			})

		})
	</script>
</body>
</html>
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
            <div id="content" data-url="<?php echo base_url('sparepart_out') ?>">
                <div class="container-fluid">
                    <h5 class="h3 mb-4 text-gray-800">Form Spare Part Out</h1>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('sparepart_out/proses_tambah') ?>" id="form-tambah" method="POST">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <label>Id Transaksi</label>
                                                        <input type="text" value="<?php echo $id_transaksi ?>" name="id_transaksi" class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Tanggal Spare Part Masuk</label>
                                                        <input type="date" name="tgl_out" class="form-control" value="<?php echo date('d-m-Y');?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <label>Spare Part</label>
                                                        <select name="part_number" id="part_number" class="form-control" required>
                                                            <option selected="true" disabled="disabled">Pilih Spare Part</option>
                                                            <?php foreach($datasparepart as $sp): ?>
                                                                <option value="<?php echo $sp->part_number ?>"><?php echo $sp->part_number ?> - <?php echo $sp->deskripsi ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="stok_akhir">Stok</label>
                                                        <input readonly="readonly" name="stok_akhir" id="stok_akhir" value="" type="number" class="form-control">
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Jumlah</label>
                                                        <input type="number" name="jumlah" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <label>Tujuan Penggunaan</label>
                                                        <input type="text" name="tujuan_penggunaan" class="form-control">
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Keterangan</label>
                                                        <input type="text" name="keterangan" class="form-control">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="nrp" value="<?= $this->session->userdata['nrp'] ?>" class="form-control">
                                            </div>
                                        </div>
                                        <hr>
                                            <a href="<?php echo base_url('sparepart_out') ?>"><div class="btn btn-secondary">Close</div></a>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>				
                            </div>
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
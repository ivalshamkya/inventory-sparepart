<tr class="row-keranjang">
	<td class="deskripsi">
		<?= $this->input->post('deskripsi') ?>
		<input type="hidden" name="deskripsi_hidden[]" value="<?= $this->input->post('deskripsi') ?>">
	</td>
	<td class="part_number">
		<?= $this->input->post('part_number') ?>
		<input type="hidden" name="part_number_hidden[]" value="<?= $this->input->post('part_number') ?>">
	</td>
	<td class="jumlah">
		<?= $this->input->post('jumlah') ?>
		<input type="hidden" name="jumlah_hidden[]" value="<?= $this->input->post('jumlah') ?>">
	</td>
	<td class="satuan">
		<?= strtoupper($this->input->post('satuan')) ?>
		<input type="hidden" name="satuan_hidden[]" value="<?= $this->input->post('satuan') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('deskripsi') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>
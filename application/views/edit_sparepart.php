<div class="container-fluid">
    <h5 class="h3 mb-4 text-gray-800">Form Edit Spare Part</h1>
    <div class="card shadow">
        <div class="card-body">
		<?php foreach($sparepart as $sp) : ?>
        <form action="<?php echo base_url(). 'sparepart/update_sparepart' ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Part Number</label>
                            <input type="text" name="part_number" class="form-control" value="<?php echo $sp->part_number ?>" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" value="<?php echo $sp->deskripsi ?>" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Satuan</label>
                            <select name="satuan" id="satuan" class="form-control">
                                <option selected="true" disabled="disabled">Pilih Satuan</option>
                                <option value="PC" <?= $sp->satuan == 'PC' ? 'selected' : '' ?>>PC</option>
                                <option value="UN" <?= $sp->satuan == 'UN' ? 'selected' : '' ?>>Unit</option>
                                <option value="SET" <?= $sp->satuan == 'SET' ? 'selected' : '' ?>>Set</option>
                                <option value="ROLL" <?= $sp->satuan == 'ROLL' ? 'selected' : '' ?>>Roll</option>
                                <option value="CAN" <?= $sp->satuan == 'CAN' ? 'selected' : '' ?>>Can</option>
                                <option value="PACK" <?= $sp->satuan == 'PACK' ? 'selected' : '' ?>>Pack</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Harga Satuan</label>
                            <input type="number" name="harga_satuan" class="form-control" value="<?php echo $sp->harga_satuan ?>">
                        </div>
                        <div class="form-group col-4">
                            <label>Mesin</label>
                            <select name="id_mesin" id="id_mesin" class="form-control">
                                <option selected="true" disabled="disabled">Pilih Mesin</option>
                                <?php foreach($datamesin as $msn): ?>
                                    <option value="<?php echo $msn->id_mesin ?>" <?= $sp->id_mesin == $msn->id_mesin ? 'selected' : '' ?>><?php echo $msn->nm_mesin ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Lokasi</label>
                            <select name="id_lokasi" id="id_lokasi" class="form-control">
                                <option selected="true" disabled="disabled">Pilih Lokasi</option>
                                <?php foreach($datalokasi as $lok): ?>
                                    <option value="<?php echo $lok->id_lokasi ?>" <?= $sp->id_lokasi == $lok->id_lokasi ? 'selected' : '' ?>><?php echo $lok->nm_lokasi ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Stok Akhir</label>
                            <input type="number"name="stok_akhir" class="form-control" value="<?php echo $sp->stok_akhir ?>" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Std Level Stok</label>
                            <input type="number" name="std_level_stok" class="form-control" value="<?php echo $sp->std_level_stok ?>" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control" size="20">
                            <img src="<?php echo base_url() . '/gambar/' . $sp->gambar ?>" width="100">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <a href="<?php echo base_url('sparepart') ?>"><div class="btn btn-secondary">Close</div></a>
            <button type="submit" class="btn btn-primary float-">Save changes</button>
        </form>
		<?php endforeach; ?>
        </div>
    </div>
</div>
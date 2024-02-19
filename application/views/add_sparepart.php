<div class="container-fluid">
    <h5 class="h3 mb-4 text-gray-800">Form Data Spare Part</h1>
    <div class="card shadow">
        <div class="card-body">
        <form action="<?php echo base_url(). 'sparepart/proses_tambah' ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Part Number</label>
                            <input type="text" name="part_number" class="form-control" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Satuan</label>
                            <select name="satuan" id="satuan" class="form-control">
                                <option selected="true" disabled="disabled">Pilih Satuan</option>
                                <option value="PC">PC</option>
                                <option value="UN">Unit</option>
                                <option value="SET">Set</option>
                                <option value="ROLL">Roll</option>
                                <option value="CAN">Can</option>
                                <option value="PACK">Pack</option>
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
                            <input type="number" name="harga_satuan" class="form-control">
                        </div>
                        <div class="form-group col-4">
                            <label>Mesin</label>
                            <select name="id_mesin" id="id_mesin" class="form-control">
                                <option selected="true" disabled="disabled">Pilih Mesin</option>
                                <?php foreach($datamesin as $msn): ?>
                                    <option value="<?php echo $msn->id_mesin ?>"><?php echo $msn->nm_mesin ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Lokasi</label>
                            <select name="id_lokasi" id="id_lokasi" class="form-control">
                                <option selected="true" disabled="disabled">Pilih Lokasi</option>
                                <?php foreach($datalokasi as $lok): ?>
                                    <option value="<?php echo $lok->id_lokasi ?>"><?php echo $lok->nm_lokasi ?></option>
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
                            <label>Stok</label>
                            <input type="number" name="stok_akhir" id="stok_akhir" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Std Level Stok</label>
                            <input type="number" name="std_level_stok" class="form-control" value="1" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control" size="20">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="0" name="stok_akhir" id="stok_akhir">
            <hr>
            <a href="<?php echo base_url('sparepart') ?>"><div class="btn btn-secondary">Close</div></a>
            <button type="submit" class="btn btn-primary float-">Save changes</button>
        </form>
        </div>
    </div>
</div>

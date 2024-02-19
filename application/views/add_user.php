<div class="container-fluid">
    <h5 class="h3 mb-4 text-gray-800">Form Data User</h1>
    <div class="card shadow">
        <div class="card-body">
        <form action="<?php echo base_url(). 'user/proses_tambah' ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>NRP</label>
                            <input type="text" name="nrp" class="form-control" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" class="form-control" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Hak Akses</label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option selected="true" disabled="disabled">Pilih Hak Akses</option>
                                <option value="1">Section Head</option>
                                <option value="2">Karyawan</option>
                                <option value="3">PIC Ordering</option>
                                <option value="4">Purchasing</option>
                                <option value="5">Warehouse</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group col-4">
                            <label>Telepon</label>
                            <input type="number" name="telepon" class="form-control" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" size="20">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <a href="<?php echo base_url('user') ?>"><div class="btn btn-secondary">Close</div></a>
            <button type="submit" class="btn btn-primary float-">Save changes</button>
        </form>
        </div>
    </div>
</div>

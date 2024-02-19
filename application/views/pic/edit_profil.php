<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
        <div class="clearfix">
            <div class="float-left">
                <h1 class="h3 m-0 text-gray-800">Edit Profil</h1>
            </div>
            <div class="float-right">
                <a href="<?php echo base_url('pic/profil') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
            </div>
        </div>
        <hr>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card shadow ">
                    <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                    <?php foreach($ubah as $u) : ?>
                        <div class="card-body">
                            <form action="<?= base_url('pic/profil/proses_ubah') ?>" id="form-profil" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nrp"><strong>NRP </strong></label>
                                    <input type="text" name="nrp" id="nrp" class="form-control" value="<?php echo $u->nrp ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_karyawan"><strong>Nama Karyawan</strong></label>
                                    <input type="text" name="nama_karyawan" id="nama_karyawan" value="<?php echo $u->nama_karyawan ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email"><strong>Email</strong></label>
                                    <input type="text" name="email" id="email" value="<?php echo $u->email ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="telepon"><strong>No Telepon</strong></label>
                                    <input type="number" name="telepon" id="telepon" value="<?php echo $u->telepon ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="alamat"><strong>Alamat</strong></label>
                                    <input name="alamat" id="alamat" class="form-control" value="<?php echo $u->alamat ?>">
                                </div>
                                <div class="form-group">
                                    <label for="username"><strong>Username</strong></label>
                                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $u->username ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password"><strong>Password</strong></label>
                                    <input type="password" name="password" id="password" class="form-control" value="<?php echo $u->password ?>">
                                </div>
                                <div class="form-group">
                                    <label for="foto"><strong>Foto</strong></label>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>
                                <div>
                                    <img src="<?php echo base_url('foto/'.$u->foto) ?>" width="100">
                                </div>
                                <hr>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    <a href="<?php echo base_url('pic/profil') ?>" class="btn btn-secondary"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                    </div>				
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
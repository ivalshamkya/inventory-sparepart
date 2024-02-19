<div class="container-fluid">
	<h3><i class="fas fa-edit"></i> EDIT PROFIL</h3>

		<form method="post">

			<div class="for-group">
				<label>Nama</label>
				<input type="text" name="nama_karyawan" class="form-control">
			</div>

			<div class="for-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control" >
			</div>

			<div class="for-group">
				<label>Telepon</label>
				<input type="number" name="Telepon" class="form-control" >
			</div>

			<div class="for-group">
				<label>Alamat</label>
				<input type="text" name="alamat" class="form-control" >
			</div>

			<div class="for-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control" >
			</div>

			<div class="for-group">
				<label>Password</label>
				<input type="text" name="password" class="form-control" >
			</div>

			<button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>
            <a href="<?php echo base_url('index.php') ?>"><div class="btn btn-secondary">Close</div></a>

		</form>

</div>
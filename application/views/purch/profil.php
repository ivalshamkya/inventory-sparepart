<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">Profil</h1>
	<?php echo $this->session->flashdata('pesan');?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<a href="<?php echo base_url('purch/profil/edit_profil') ?>" class="btn btn-m btn-primary text-right">
			<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Profil
			</a>
		</div>
		<?php foreach($profil as $p) : ?>
		<div class="card-body">
			<div class="row">
				<div class="col-md-4"> 
					<img src="<?php echo base_url('foto/'.$p->foto) ?>" class="card-img-top">	
				</div>
				<div class="col-md-8"> 
					<table class="table">
						<tr>
							<td>NRP</td>
							<td><strong><?php echo $p->nrp ?></strong></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td><strong><?php echo $p->nama_karyawan ?></strong></td>
						</tr>
						<tr>
							<td>E-mail</td>
							<td><strong><?php echo $p->email ?></strong></td>
						</tr>
						<tr>
							<td>No Telepon</td>
							<td><strong><?php echo $p->telepon ?></strong></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><strong><?php echo $p->alamat ?></strong></td>
						</tr>
						<tr>
							<td>Username</td>
							<td><strong><?php echo $p->username ?></strong></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><strong><?php echo $p->password ?></strong></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	</div>
</div>
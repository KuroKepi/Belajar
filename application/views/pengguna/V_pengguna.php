<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	  <div class="card">
        <div class="card-header">
          <h3 class="card-title">Profile Pengguna</h3>
        </div>
		<?php echo $this->session->flashdata('message') ?>
        <div class="card-body">
			<?php echo form_open_multipart('C_pengguna/edit', array('id' => 'form')) ?>
				<div class="row">
					<div class="col-md-3 col"><br>
						<img src="<?php echo base_url('assets/uploads/').$pengguna->image_user?>" alt="User Image"  width="250" height="250">
					</div>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-6 col">
							<div class="form-group">
									<label>Id user</label>
									<input type="text" class="form-control" name="id"  value="<?php echo $pengguna->Id_user ?>" readonly>
								</div>
								<div class="form-group">
									<label>Nama user</label>
									<input type="text" class="form-control" name="name" placeholder="Enter Nama" value="<?php echo $pengguna->nama_user ?>">
									<?php echo form_error('name', '<small class="text-danger" >', '</small>'); ?>
								</div>
								<div class="form-group">
									<label>Email user</label>
									<input type="text" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $pengguna->email_user ?>">
									<?php echo form_error('email', '<small class="text-danger" >', '</small>'); ?>
								</div>
							</div>
							<div class="col-md-6 col">
								<div class="form-group">
									<label>Kata sandi baru</label>
									<input type="hidden" class="form-control" name="old_pass" placeholder="Enter password" value="<?php echo $pengguna->password_user?>">
									<input type="password" class="form-control" name="pass1" placeholder="Enter password">
									<?php echo form_error('pass1', '<small class="text-danger" >', '</small>'); ?>
								</div>
								<div class="form-group">
									<label>Konfirmasi sandi baru</label>
									<input type="password" class="form-control" name="pass2" placeholder="Enter Kriteria">
									<?php echo form_error('pass2', '<small class="text-danger" >', '</small>'); ?>
								</div>
								<div class="form-group">
									<label>Ganti Photo Profil</label>
									<input type="hidden" name="old_photo" value="<?php echo $pengguna->image_user?>">
									<input type="file" class="form-control" name="photo">
								</div>
							</div>
						</div>
					</div>
				</div>
				<center>
					<button type="submit" class="btn btn-primary simpan ">
            			<i class="fa fa-edit"></i>  Edit
        			</button>
				</center>
			</form>
        </div>
         <!--card-body -->
      </div>
      <!-- /.card -->
          <!-- right col -->
	  <!-- /.container-fluid -->
	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

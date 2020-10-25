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
          <h3 class="card-title">Edit asisten</h3>
					<div class="float-right">
						<a href="<?php echo base_url('C_asisten/')?>" class="btn btn-primary btn-flat">
							<i class="fa fa-user-plus"></i> Back
						</a>
				</div>
        </div>
        <div class="card-body">
				<?php echo form_open_multipart() ?>
			  <div class="form-group">
			  <label>Id asisten</label>
				  <input type="text" class="form-control" id="id" name="id" value="<?php echo $asisten->Id_asisten ?>" readonly> 
                </div>
                <div class="form-group">
					<label>Nama asisten</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $asisten->nama_asisten ?>" placeholder="Enter name">
				  	<?php echo form_error('name', '<small class="text-danger" >', '</small>'); ?>
                </div>
				<div class="form-group">
					<label>Photo asisten</label>
					<div style="margin-bottom:5px">
					<?php if($asisten->photo_asisten!= null)
					{ ?>
					<img src="<?php echo base_url().'assets/uploads/'.$asisten->photo_asisten?>" style="width:100px">
					<?php }?>
					<?php if($asisten->photo_asisten == null)
					{ ?>
					<img src="<?php echo base_url().'assets/uploads/default.jpg'?>" style="width:100px">
					<?php }?>
					</div>
					<input type="hidden" name="old_photo" value="<?php echo $asisten->photo_asisten?>">
					<input type="file" class="form-control" name="photo">
					<small>Biarkan kosong kalau tidak ada gambar</small>
					<?php echo form_error('photo', '<small class="text-danger" >', '</small>'); ?>
				</div>
                <div class="form-group">
					<label>Status asisten</label>
					<select name="status" class="form-control">
					<?php $status = $asisten->status_asisten ?>
					<option value="" selected disabled> - Pilih -</option>
					<option value="1" <?php echo $status == 1 ? 'selected' : null ?>> Administator</option>
					<option value="2" <?php echo $status == 2 ? 'selected' : null ?>> Asisten</option>
					</select>
					<?php echo form_error('status', '<small class="text-danger" >', '</small>'); ?>
                </div>
                <div class="float-right">
					<button type="submit" class="btn btn-primary ">
                    <i class="fa fa-plus"></i>  Edit
                	</button>
					<button type="reset" class="btn btn-danger">
					Reset
                	</button>
				</div>
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

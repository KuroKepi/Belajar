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
          <h3 class="card-title">Edit kriteria</h3>
					<div class="float-right">
						<a href="<?php echo base_url('C_kriteria/')?>" class="btn btn-primary btn-flat">
							<i class="fa fa-user-plus"></i> Back
						</a>
					</div>
        </div>
        <div class="card-body">
			<form action="" method="POST">
			  <div class="form-group">
			  		<label>Id kriteria</label>
				  	<input type="text" class="form-control" id="id" name="id" value="<?php echo $kriteria->Id_kriteria ?> "readonly>
        	</div>
			<div class="form-group">
					<label>Nama kriteria</label>
					<input type="text" class="form-control" name="name" placeholder="Enter Kriteria" value="<?php echo $kriteria->nama_kriteria ?>">
					<?php echo form_error('name', '<small class="text-danger" >', '</small>'); ?>
			</div>
        	<div class="form-group">
					<label>Status kriteria</label>
				  	<select name="status" class="form-control">
					  <?php $status = $kriteria->bobot_kriteria ?>
				  	<option value="" selected disabled> - Pilih -</option>
				  	<option value="1"  <?php echo $status == 1 ? 'selected' : null ?>> Benefit</option>
				  	<option value="2"  <?php echo $status == 2 ? 'selected' : null ?>> Cost</option>
				  </select>
				  <?php echo form_error('status', '<small class="text-danger" >', '</small>'); ?>
        	</div>
			<div class="form-group">
			  		<label>Bobot kriteria</label>
				  	<input type="text" class="form-control" id="numberbox" name="bobot" onkeypress="return hanyaAngka(event)" value="<?php echo $kriteria->bobot_kriteria ?>">
        	</div>
        	<div class="float-right">
				<button type="submit" class="btn btn-primary ">
            	<i class="fa fa-plus"></i>  Add
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

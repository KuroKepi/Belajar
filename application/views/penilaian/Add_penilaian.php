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
          <h3 class="card-title">Penilaian asisten</h3>
		  		<div class="float-right">
						<a href="<?php echo base_url('C_penilaian')?>" class="btn btn-primary btn-flat">
							<i class="fa fa-undo"></i> Back
						</a>
				</div>
        </div>
        <div class="card-body">
			<form action="" method="POST">
			  <div class="form-group">
			  		<label>Kode penilaian</label>
				  	<input type="text" class="form-control" id="id" value="<?php echo "isi otomatis" ?>" readonly>
        	</div>
			<div class="form-group">
					<label>Tahun</label>
					<input type="text" class="form-control" name="tahun" value="<?php echo $tahun ?>" readonly>
			</div>
        	<div class="form-group">
					<label>Nama asisten</label>
				  	<select name="asisten" class="form-control" required>
				  	<option value="" selected disabled> - Pilih -</option>
				  	<?php
						 foreach($asisten as $brg) :
					  ?>
					  <?php echo "<option value='$brg[Id_asisten]'>$brg[nama_asisten]</option>"?>
					<?php endforeach; ?>
					</select>
					<?php echo form_error('asisten', '<small class="text-danger" >', '</small>'); ?>
        	</div>
			<?php
				foreach($kriteria as $kr):
			?>
			<?php echo "<div class='form-group'>
							<label>$kr[nama_kriteria]</label>
							<input type='hidden' class='form-control' name='kd_krit[]' value='$kr[Id_kriteria]'>
							<input type='number' class='form-control' name='nilai[]' min='1' max='100'  required  onkeypress='return hanyaAngka(event)'>
							<input type='hidden' class='form-control' name='id_nilai[]' value=".(++$kode).">
						</div>"
						?>
			<?php endforeach; ?>
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

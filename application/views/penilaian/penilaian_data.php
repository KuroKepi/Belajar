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
			<div class="form-group">
					<label>Tahun</label>
					<input type="text" class="form-control" name="tahun" value="<?php echo $hasil->tahun_nilai ?>" readonly>
			</div>
        	<div class="form-group">
					<label>Nama asisten</label>
					<input type="text" class="form-control" name="tahun" value="<?php echo $hasil->nama_asisten ?>" readonly>
        	</div>
			<?php
				foreach($nilai as $kr):
			?>
			<?php echo "<div class='form-group'>
							<label>$kr[nama_kriteria]</label>
							<input type='hidden' class='form-control' name='kd_krit[]' value='$kr[Id_kriteria]'>
							<input type='number' class='form-control' name='nilai[]' value='$kr[nilai_asisten]' readonly>
						</div>"
						?>
			<?php endforeach; ?>
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

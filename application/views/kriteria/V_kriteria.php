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
          <h3 class="card-title">Kriteria</h3>
        </div>
		<?php echo $this->session->flashdata('message') ?>
        <div class="card-body">
				<table class="table table-bordered table-striped" id="example1">
          <thead>
						<tr>
							<th>No</th>
							<th>Nama Kriteria</th>
							<th>Status Kriteria</th>
							<th>Bobot Kriteria</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no	= 1;
						foreach($kriteria as $krt) :
					?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $krt->nama_kriteria ?></td>
							<td><?php echo $krt->status_kriteria ==1 ? "Benefit" : "Cost" ?></td>
							<td><?php echo $krt->bobot_kriteria ?></td>
							<td>
								<form action="<?php echo base_url().'C_kriteria/delete'?>" method="POST">
								<a href="<?php echo base_url().'C_kriteria/edit/'.$krt->Id_kriteria?>" class="btn btn-primary btn-xs"><i class ="fa fa-edit"></i>Edit Data</a>
								<input type="hidden" name="id" value="<?php echo $krt->Id_kriteria ?>"></input>
								<button onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus Data
								</form>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table><br>
				<div class="float-right">
						<a href="<?php echo base_url('C_kriteria/')?>add" class="btn btn-primary btn-flat">
							<i class="fa fa-user-plus"></i> Create
						</a>
				</div>
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

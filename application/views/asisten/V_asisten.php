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
          <h3 class="card-title">barang</h3>
        </div>
		<?php echo $this->session->flashdata('message') ?>
        <div class="card-body">
				<table class="table table-bordered table-striped" id="example1">
          			<thead>
						<tr>
							<th>No</th>
							<th>Nama Asisten</th>
							<th>Photo Asisten</th>
							<th>Status Asisten</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no	= 1;
						foreach($asisten as $brg) :
					?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $brg->nama_asisten ?></td>
							<td>
							<?php if($brg->photo_asisten != null)
							{ ?>
								<img src="<?php echo base_url().'assets/uploads/'.$brg->photo_asisten?>" style="width:100px">
							 <?php }?>
							 <?php if($brg->photo_asisten == null)
							 { ?>
							 	<img src="<?php echo base_url().'assets/uploads/default.jpg'?>" style="width:100px">
							 <?php }?>
							</td>
							<td><?php echo $brg->status_asisten ==1 ? "Administrator" : "Asisten" ?></td>
							<td>
								<form action="<?php echo base_url().'C_asisten/delete'?>" method="POST">
								<a href="<?php echo base_url().'C_asisten/edit/'.$brg->Id_asisten?>" class="btn btn-primary btn-xs"><i class ="fa fa-edit"></i>Edit Data</a>
								<input type="hidden" name="id" value="<?php echo $brg->Id_asisten ?>"></input>
								<button onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus Data
								</form>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table><br>
				<div class="float-right">
						<a href="<?php echo base_url('C_asisten/')?>add" class="btn btn-primary btn-flat">
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

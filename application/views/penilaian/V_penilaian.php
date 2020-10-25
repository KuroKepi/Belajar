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
          <h3 class="card-title">daftar penilaian asisten</h3>
        </div>
		<?php echo $this->session->flashdata('message') ?>
		<form action="<?php echo base_url('C_penilaian')?>" method="post">
        	<div class="card-body">
			<label>Pilih tahun</label>
				  <select name="tahun" class="form-control">
				  	<option value="" selected disabled> - Pilih -</option>
					  <?php for($i = 2019; $i <= date("Y");$i++):
				            $thnajar = $i;
							$selected = "";
							if($thnajar == $tahun)
							{
								$selected = 'selected="selected"';
							}
				        ?>
				    	<option value="<?php echo $i;?>"<?php echo $selected;?>><?php echo $i;?></option>
				       <?php endfor;?>
                    </select><br>
					<button type="submit" class="btn btn-primary">  <span class="fa fa-search  "></span> Lihat Nilai</button>
        	</div>
		</form>
			<div class="card-body">
			<?php
			
            	if($tahun == null || $tahun == '')
                	{
                         echo '<center><h4>Silakan Pilih Tahun </h4></center>';
                    }
                    else
                    {
            ?>
			<table class="table table-bordered table-striped" id="example1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama asisten</th>
						<th>Tahun Penilaian</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($penilaian as $pn) :
				?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $pn->nama_asisten ?></td>
						<td><?php echo $pn->tahun_nilai ?></td>
						<td>
						<form action="<?php echo base_url().'C_penilaian/delete'?>" method="POST">
							<input type="hidden"  value="<?php echo $pn->Id_asisten;?>" name="Id_hapus" />
							<input type="hidden"  value="<?php echo $tahun;?>" name="tahun_hapus" />
							<button onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus Data </button>
							<a href="<?php echo base_url().'C_penilaian/lihat/'.$pn->Id_asisten.'/'.$pn->tahun_nilai?>" class="btn btn-primary btn-xs" onclick="return confirm(\'Anda ingin lihat data ini?\')"><i class ="fa fa-eye"></i> Lihat Data</a>
						</form>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table><br>
				<div class="float-right">
					<a href="<?php echo base_url('C_penilaian/add/').$tahun?>" class="btn btn-primary btn-flat">
						<i class="fa fa-user-plus"></i> Create
					</a>
				</div>
				<?php } ?>
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

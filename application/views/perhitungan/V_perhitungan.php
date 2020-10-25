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
          <h3 class="card-title">perhitungan asisten </h3>
        </div>
		<?php echo $this->session->flashdata('message') ?>
		<form action="<?php echo base_url('C_perhitungan')?>" method="post">
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
				else if($cek['tahun_nilai'] == null)
				{
					echo '<center><h4>Tidak ada data </h4></center>';
				}
                else
                 {
            ?>
			 <label>Normalisasi bobot</label>
			<table class="table table-bordered table-striped" id="example1">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Normalisasi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($normalisasi as $nrm) :
				?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $nrm['kriteria'] ?></td>
						<td><?php echo $nrm['nama_k']?></td>
						<td><?php echo number_format($nrm['bobot_hasil'],2) ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table><br>
			<label>vektor S</label>
			<table class="table table-bordered table-striped" id="example1">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Asisten</th>
						<th>Nama Asisten</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($S as $s) :
				?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $s['id_s'] ?></td>
						<td><?php echo $s['nama_s']?></td>
						<td><?php echo number_format($s['S'],2) ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table><br>
			<label>vektor V</label>
			<table class="table table-bordered table-striped" id="example1">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Asisten</th>
						<th>Nama Asisten</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($V as $v) :
				?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $v['id_v'] ?></td>
						<td><?php echo $v['nama_v'] ?></td>
						<td><?php echo number_format($v['V'],2) ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table><br>
			<label>perangkingan </label>
			<table class="table table-bordered table-striped" id="example1">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Asisten</th>
						<th>Nama Asisten</th>
						<th>Rank</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($hasil as $hsl) :
				?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $hsl['id_hasil'] ?></td>
						<td><?php echo $hsl['nama']?></td>
						<td><?php echo number_format($hsl['hasil'],2) ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table><br>
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

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="<?php echo base_url('assets/dashboard/')?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
				<?php if($pengguna->image_user != $this->session->userdata('iamge'))
							{ ?>
          <img src="<?php echo base_url('assets/uploads/').$pengguna->image_user?>" class="img-circle elevation-2" alt="User Image">
					<?php }?>
					<?php if($pengguna->image_user == $this->session->userdata('iamge'))
							{ ?>
          <img src="<?php echo base_url('assets/uploads/default.jpg')?>" class="img-circle elevation-2" alt="User Image">
					<?php }?>
        </div>
        <div class="info">
          <a class="d-block"><?php echo  $pengguna->nama_user ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
			   with font-awesome or any other icon font library -->
				 
		 			<li class="nav-item">
            <a href="<?php echo base_url()?>C_user" class="nav-link <?php echo $this->uri->segment(1) == 'C_user' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
              <i class="nav-icon fas fa fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php echo $this->uri->segment(1) == 'C_asisten' || $this->uri->segment(1) == 'C_kriteria' ||  $this->uri->segment(1) == 'C_pengguna' ? 'menu-open' : '' ?> ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>C_asisten" class="nav-link <?php echo $this->uri->segment(1) == 'C_asisten' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <i class="far fa fa-users nav-icon"></i>
                  <p>Asisten</p>
                </a>
              </li>
							<li class="nav-item">
                <a href="<?php echo base_url()?>C_kriteria" class="nav-link <?php echo $this->uri->segment(1) == 'C_kriteria' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <i class="far fa fa-users nav-icon"></i>
                  <p>Kriteria</p>
                </a>
              </li>
							<li class="nav-item">
                <a href="<?php echo base_url()?>C_pengguna" class="nav-link <?php echo $this->uri->segment(1) == 'C_pengguna' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <i class="far fa fa-user nav-icon"></i>
                  <p>Profile Pengguna</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-header">Laporan</li> -->
          <li class="nav-item has-treeview  <?php echo $this->uri->segment(1) == 'C_penilaian' || $this->uri->segment(1) == 'C_perhitungan' ? 'menu-open' : '' ?>" >
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()?>C_penilaian" class="nav-link <?php echo $this->uri->segment(1) == 'C_penilaian' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penilaian asisten</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="<?php echo base_url()?>C_perhitungan" class="nav-link <?php echo $this->uri->segment(1) == 'C_perhitungan' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perhitungan asisten</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!-- <li class="nav-header">Log Out</li> -->
          <li class="nav-item">
            <a href="<?php echo base_url('C_login/')?>logout" class="nav-link">
              <i class="nav-icon fa fa-times"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<?php

	Class C_perhitungan extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('M_pengguna');
			$this->load->model('M_perhitungan');
			// $this->load->model('M_kriteria');
			if($this->session->userdata('is_login') == null)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Please Login
				</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('C_login');
			}
		}

		public function index()
		{
			$tahun				 = $this->input->post('tahun');
			$id_userdata		 = $this->session->userdata('id');
			$data['pengguna']	 = $this->M_pengguna->getbyId($id_userdata)->row();
			$data['tahun']		 = $tahun;
			$data['cek']		 = $this->M_perhitungan->getbyyear($tahun)->row_array();
			if($data['cek']>0)
			{

				 $data['normalisasi']  = $this->M_perhitungan->normalisasi($tahun);
				 $data['S'] 			 = $this->M_perhitungan->vektorS($tahun);
				 $data['V'] 			 = $this->M_perhitungan->vektorV($tahun);
				 $data['hasil']			 = $this->M_perhitungan->perangkingan($tahun);
				// echo "<pre>";
				// print_r($data['hasil']);
       			// echo "</pre>";
				// die();
			}
			$this->load->view('templates/user_header');
			$this->load->view('templates/user_navbar');
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('perhitungan/V_perhitungan',$data);
			$this->load->view('templates/user_footer');
		}
	}

?>

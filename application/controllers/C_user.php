<?php

	class C_user extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('M_pengguna');
			if($this->session->userdata('is_login') == null)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Anda belum login !
				</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('C_login');
			}
		}

		public function index()
		{
			$id		= $this->session->userdata('id');
			$query 	= $this->M_pengguna->getbyId($id);
			$data['pengguna']	= $this->M_pengguna->getbyId($id)->row();
			// echo $this->session->userdata('nama');
			$this->load->view('templates/user_header');
			$this->load->view('templates/user_navbar');
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('user/V_user');
			$this->load->view('templates/user_footer');
			
		}
	}

?>

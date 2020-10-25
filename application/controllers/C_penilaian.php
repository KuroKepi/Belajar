<?php

	Class C_penilaian extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('M_pengguna');
			$this->load->model('M_penilaian');
			$this->load->model('M_asisten');
			$this->load->model('M_kriteria');
			if($this->session->userdata('is_login') == null)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Please Login
				</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('C_login');
			}
		}

		public function index()
		{
			$tahun				= $this->input->post('tahun');
			$id_userdata		= $this->session->userdata('id');
			$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
			$data['tahun']		= $tahun;
			$data['penilaian']	= $this->M_penilaian->getbyYear($tahun)->result();
			$this->load->view('templates/user_header');
			$this->load->view('templates/user_navbar');
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('penilaian/V_penilaian',$data);
			$this->load->view('templates/user_footer');
		}

		public function add($tahun)
		{
			$this->form_validation->set_rules('asisten', 'asisten', 'required');
			$this->form_validation->set_message('required', '%s kosong silakan diisi');
			if($this->form_validation->run() == FALSE)
			{
				$id_userdata		= $this->session->userdata('id');
				$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
				$data['kode'] 		= $this->M_penilaian->kode();
				$data['asisten']	= $this->M_asisten->getAll()->result_array();
				$data['kriteria']	= $this->M_kriteria->getAll()->result_array();
				$data['tahun']		= $tahun;
				$this->load->view('templates/user_header');
				$this->load->view('templates/user_navbar');
				$this->load->view('templates/user_sidebar',$data);
				$this->load->view('penilaian/Add_penilaian',$data);
				$this->load->view('templates/user_footer');
			}
			else 
			{
				$id 				= $this->input->post('id_nilai',true);
				$id_brg				= $this->input->post('asisten',true);
				$id_kriteria		= $this->input->post('kd_krit',true);
				$nilai				= $this->input->post('nilai',true);
				$tahunn				= $this->input->post('tahun',true);
				$this->M_penilaian->add($id,$id_brg,$id_kriteria,$nilai,$tahunn);
				if($this->db->affected_rows() >0)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil ditambah !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_penilaian');
				}
				else
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal ditambah !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_penilaian');
				}
			}
		}

		public function delete()
		{
			$id		= $this->input->post('Id_hapus',true);
			$tahun	= $this->input->post('tahun_hapus',true);
			$this->M_penilaian->delete($id,$tahun);
			if($this->db->affected_rows() >0)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil dihapus !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_penilaian');
				}
				else
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal dihapus !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_penilaian');
				}
		}

		public function lihat($id,$thn)
		{
			$id_userdata		= $this->session->userdata('id');
			$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
			$data['hasil']		= $this->M_penilaian->getAll($id,$thn)->row();
			$data['nilai']		= $this->M_penilaian->getAll($id,$thn)->result_array();
			$this->load->view('templates/user_header');
			$this->load->view('templates/user_navbar');
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('penilaian/penilaian_data',$data);
			$this->load->view('templates/user_footer');
		}
	}

?>

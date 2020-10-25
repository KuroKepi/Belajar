<?php

	class C_kriteria extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('M_kriteria');
			$this->load->model('M_pengguna');
			if($this->session->userdata('is_login') == null)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Please Login
				</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('C_login');
			}
		}

		public function index()
		{
			$id_userdata		= $this->session->userdata('id');
			$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
			$data['kriteria']	= $this->M_kriteria->getAll()->result();
			// echo $this->session->userdata('nama');
			$this->load->view('templates/user_header');
			$this->load->view('templates/user_navbar');
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('kriteria/V_kriteria', $data);
			$this->load->view('templates/user_footer');
		}

		public function add()
		{
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[kriteria.nama_kriteria]');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('bobot', 'Bobot', 'required');
			$this->form_validation->set_message('required', '%s kosong silakan diisi');
			if($this->form_validation->run() == false)
			{
				// $pesan				= validation_errors();
				// $msg				= array('validasi' => $pesan);
				// echo json_encode($msg);
				$id_userdata		= $this->session->userdata('id');
				$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
				$data['kriteria']	= $this->M_kriteria->kode();
				$this->load->view('templates/user_header');
				$this->load->view('templates/user_navbar');
				$this->load->view('templates/user_sidebar',$data);
				$this->load->view('kriteria/Add_kriteria',$data);
				$this->load->view('templates/user_footer');
			}
			else
			{
				$id		= $this->input->post('id',true);
				$name	= $this->input->post('name',true);
				$status	= $this->input->post('status',true);
				$bobot	= $this->input->post('bobot',true);
				$this->M_kriteria->add($id,$name,$status,$bobot);
				if($this->db->affected_rows() >0)
					{
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil ditambah !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_kriteria');
					}
					else
					{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal ditambah !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_kriteria');
					}
			}
		}

		public function edit($id)
		{
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[kriteria.nama_kriteria]');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('bobot', 'Bobot', 'required');
			$this->form_validation->set_message('required', '%s kosong silakan diisi');
			if($this->form_validation->run() == false)
			{
				$query = $this->M_kriteria->getbyId($id);
				if($query->num_rows()>0)
				{
					$id_userdata		= $this->session->userdata('id');
					$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
					$data['kriteria'] = $query->row();
					$this->load->view('templates/user_header');
					$this->load->view('templates/user_navbar');
					$this->load->view('templates/user_sidebar',$data);
					$this->load->view('kriteria/Edit_kriteria',$data);
					$this->load->view('templates/user_footer');
				}
				else
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Tidak ada data!
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_kriteria');
				}
			}
			else
			{
				$id		= $this->input->post('id',true);
				$name	= $this->input->post('name',true);
				$status	= $this->input->post('status',true);
				$bobot	= $this->input->post('bobot',true);
				$this->M_kriteria->edit($id,$name,$status,$bobot);
				if($this->db->affected_rows() >0)
					{
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil diubah !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_kriteria');
					}
					else
					{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal diubah !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_kriteria');
					}
			}
		}

		public function delete()
		{
			$id		= $this->input->post('id',true);
			$this->M_kriteria->delete($id);
			if($this->db->affected_rows() > 0)
					{
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil dihapus !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_kriteria');
					}
					else
					{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal dihapus !
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_kriteria');
					}
		}

	}
?>

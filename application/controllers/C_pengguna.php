<?php

	class C_pengguna extends CI_Controller
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
			$id_userdata		= $this->session->userdata('id');
			$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
			// echo $this->session->userdata('nama');
			$this->load->view('templates/user_header');
			$this->load->view('templates/user_navbar');
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('pengguna/V_pengguna', $data);
			$this->load->view('templates/user_footer');
		}
		public function edit()
		{
			$id_userdata		= $this->session->userdata('id');
			$query 				= $this->M_pengguna->getbyId($id_userdata);
			$config['upload_path']		=	'./assets/uploads';
			$config['allowed_types']	=	'jpg|png|jpeg';
			$config['max_size']			=	2048;
			$config['file_name']		=	'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
			$this->load->library('upload', $config);
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->form_validation->set_rules('pass1', 'Password', 'trim|min_length[3]');
			$this->form_validation->set_rules('pass2', 'Password', 'trim|matches[pass1]');
			$this->form_validation->set_message('required', '%s kosong silakan diisi');
			$this->form_validation->set_message('min_length','%s huruf yang dimasukkan minimal 3 karakter');
			$this->form_validation->set_message('matches','%s tidak sama');
			if($this->form_validation->run() == false)
			{
				if($query->num_rows() >0)
				{
					$data['pengguna']	= $query->row();
					$this->load->view('templates/user_header');
					$this->load->view('templates/user_navbar');
					$this->load->view('templates/user_sidebar');
					$this->load->view('pengguna/V_pengguna', $data);
					$this->load->view('templates/user_footer');
				}
				else
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Tidak ada data!
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_pengguna');
				}
			}
			else
			{
				if(@$_FILES['photo']['name']!=null)
				{
					
					if($this->upload->do_upload('photo'))
					{
						$pengguna	= $this->M_pengguna->getbyId($id_userdata)->row();
						if($pengguna->image_user != null)
						{
							if($pengguna->image_user != $this->session->userdata('image'))
							{
								$target_file	= './assets/uploads/'.$pengguna->image_user;
								unlink($target_file);
							}
						}
						$name	= $this->input->post('name',true);
						$email	= $this->input->post('email',true);
						if($this->input->post('pass1') != null)
						{
							$password 	= password_hash($this->input->post('pass1',true),PASSWORD_DEFAULT);
						}
						else
						{
							$password	= $this->input->post('old_pass');
						}
						$photo	= $this->upload->data('file_name');
						 $cek = $this->M_pengguna->edit($id_userdata,$name,$email,$password,$photo);
						 $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil diubah !
						 </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						 redirect('C_pengguna');
					}
					else
					{
						// echo $this->upload->display_errors();
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal ditambah !
						</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('C_pengguna');
					}
				}
				else
				{
						$name		= $this->input->post('name',true);
						$email		= $this->input->post('email',true);
						if($this->input->post('pass1') != null)
						{
							$password 	= password_hash($this->input->post('pass1',true),PASSWORD_DEFAULT);
						}
						else
						{
							$password	= $this->input->post('old_pass');
						}
						$photo		= $this->input->post('old_photo');
						$cek = $this->M_pengguna->edit($id_userdata,$name,$email,$password,$photo);
						var_dump($photo);
						var_dump($cek);
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil diubah !
						 </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						 redirect('C_pengguna');
						// var_dump($password);
						// var_dump($this->input->post('old_pass'));
				}
			}
		}
	}

?>

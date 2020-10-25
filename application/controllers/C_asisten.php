<?php

	class C_asisten extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('M_asisten');
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
			$data['asisten']	= $this->M_asisten->getAll()->result();
			// echo $this->session->userdata('nama');
			$this->load->view('templates/user_header');
			$this->load->view('templates/user_navbar');
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('asisten/V_asisten', $data);
			$this->load->view('templates/user_footer');
			
		}

		public function add()
		{
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[asisten.nama_asisten]');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('required', '%s kosong silakan diisi');
			if($this->form_validation->run() == false)
			{
				$id_userdata		= $this->session->userdata('id');
				$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
				$data['kode'] = $this->M_asisten->kode();
				$this->load->view('templates/user_header');
				$this->load->view('templates/user_navbar');
				$this->load->view('templates/user_sidebar',$data);
				$this->load->view('asisten/Add_asisten', $data);
				$this->load->view('templates/user_footer');
			}
			else
			{
				$config['upload_path']		=	'./assets/uploads';
				$config['allowed_types']	=	'jpg|png|jpeg';
				$config['max_size']			=	2048;
				$config['file_name']		=	'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
				$this->load->library('upload', $config);
				if(@$_FILES['photo']['name']!=null)
				{
					if($this->upload->do_upload('photo'))
					{
						$id		= $this->input->post('id',true);
						$name	= $this->input->post('name',true);
						$status	= $this->input->post('status',true);
						$photo	= $this->upload->data('file_name');
						$this->M_asisten->add($id,$name,$status,$photo);
						if($this->db->affected_rows() >0)
						{
							$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil ditambah !
							</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('C_asisten');
						}
						else
						{
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal ditambah !
						</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('C_asisten');
						}
						// if($cek > 0)
						// {
						// 	echo"aaa";
						// }
						// else
						// {
						// 	echo"nay";
						// }
					}
					else
					{
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal ditambah !
						</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('C_asisten');
					}
				}
				else
				{
					$id		= $this->input->post('id',true);
					$name	= $this->input->post('name',true);
					$status	= $this->input->post('status',true);
					$photo	= null;
					$this->M_asisten->add($id,$name,$status,$photo);
					if($this->db->affected_rows() >0)
					{
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil ditambah !
						</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('C_asisten');
					}
					else
					{
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal ditambah !
						</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('C_asisten');
					}
				}
			}
		}

		public function edit($id)
		{
			$config['upload_path']		=	'./assets/uploads';
			$config['allowed_types']	=	'jpg|png|jpeg';
			$config['max_size']			=	2048;
			$config['file_name']		=	'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
			$this->load->library('upload', $config);
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('required', '%s kosong silakan diisi');
			if($this->form_validation->run() == false)
			{
				$query = $this->M_asisten->getbyId($id);
				if($query->num_rows() >0)
				{
					$id_userdata		= $this->session->userdata('id');
					$data['pengguna']	= $this->M_pengguna->getbyId($id_userdata)->row();
					$data['asisten'] = $query->row();
					$this->load->view('templates/user_header');
					$this->load->view('templates/user_navbar');
					$this->load->view('templates/user_sidebar',$data);
					$this->load->view('asisten/Edit_asisten',$data);
					$this->load->view('templates/user_footer');
				}
				else
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Tidak ada data!
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('C_asisten');
				}
			}
			else
			{
				if(@$_FILES['photo']['name']!=null)
				{
					
					if($this->upload->do_upload('photo'))
					{
						$item	= $this->M_asisten->getbyId($id)->row();
						if($item->photo_asisten != null)
						{
							$target_file	= './assets/uploads/'.$item->photo_asisten;
							unlink($target_file);
						}
						// $id		= $this->input->post('id',true);
						$name	= $this->input->post('name',true);
						$status	= $this->input->post('status',true);
						$photo	= $this->upload->data('file_name');
						 $cek = $this->M_asisten->edit($id,$name,$status,$photo);
						 $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil diubah !
						 </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						 redirect('C_asisten');
						// var_dump($item);
						
					}
					else
					{
						//echo $this->upload->display_errors();
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Data gagal ditambah !
						</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('C_asisten');
					}
				}
				else
				{
						// $id		= $this->input->post('id',true);
						$name	= $this->input->post('name',true);
						$status	= $this->input->post('status',true);
						$photo	= $this->input->post('old_photo');
						$cek = $this->M_asisten->edit($id,$name,$status,$photo);
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil diubah !
						 </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						 redirect('C_asisten');
				}
				
			}
		}

		public function delete()
		{
			$id		= $this->input->post('id',true);
			$item	= $this->M_asisten->getbyId($id)->row();
			if($item->photo_barang != null)
				{
					$target_file	= './assets/uploads/'.$item->photo_asisten;
					unlink($target_file);
				}
			$this->M_asisten->delete($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data berhasil dihapus !
			</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('C_asisten');
		}
	}

?>

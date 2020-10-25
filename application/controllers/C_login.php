<?php

class C_login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
	}

	public function index()
	{
			$data['title'] = 'Login Page';
			$this->load->view('templates/login_header', $data);
			$this->load->view('login/V_login');
			$this->load->view('templates/login_footer');
	}
	
	public function check()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_message('required','%s kosong silakan diisi');
		$this->form_validation->set_message('valid_email','%s harus berisi email yang valid');
		if($this->form_validation->run() == false)
		{
			$data['title'] = 'Login Page';
			$this->load->view('templates/login_header', $data);
			$this->load->view('login/V_login');
			$this->load->view('templates/login_footer');
		}
		else {
			$email		= $this->input->post('email',true);
			$password	= $this->input->post('password',true);
			$cek = $this->M_login->login($email);
			if($cek)
			{
				if(password_verify($password, $cek['password_user']))
				{
					$data = array(
						'id'		=> $cek['Id_user'],
						'nama'		=> $cek['nama_user'],
						'image'		=> $cek['image_user'],
						'is_login'	=> true
						
					);
					$this->session->set_userdata($data);
					redirect('C_user');
				}
				else
				{

					$this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Passowrd salah</div>');
					redirect('C_login');
				}
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Email Salah</div>');
				redirect('C_login');
			}
		}
	}

	public function registration()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email_user]');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		$this->form_validation->set_message('required','%s kosong silakan diisi');
		$this->form_validation->set_message('min_length','%s huruf yang dimasukkan minimal 3 karakter');
		$this->form_validation->set_message('matches','%s tidak sama');
		if($this->form_validation->run() == false)
		{
			$data['kode'] = $this->M_login->kode();
			$data['title'] = 'Registration';
			$this->load->view('templates/login_header', $data);
			$this->load->view('login/V_registration');
			$this->load->view('templates/login_footer');
		}
		else 
		{
			$id			= $this->input->post('id',true);
			$nama		= $this->input->post('name',true);
			$email		= $this->input->post('email',true);
			$password 	= password_hash($this->input->post('password1',true),PASSWORD_DEFAULT);
			$image		= 'default.jpg';
			$active		= '1';
			// $token		= base64_encode(random_bytes(32));
			$this->M_login->add_data($id,$nama,$email,$password,$image,$active);
			// $this->M_login->token_data($id,$email,$token);
			// $this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Akun telah ditambahkan. 
			Silakan login</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('C_login');
		}
	}

	// private function _sendEmail($token, $type)
	// {
	// 	$config = [
	// 		'protocol'	=> 'smtp',
	// 		'smtp_host'	=> 'ssl://smtp.googlemail.com',
	// 		'smtp_user'	=> 'newreborndarkness@gmail.com',
	// 		'smtp_pass'	=> '',
	// 		'smtp_port'	=> 465,
	// 		'mailtype'	=> 'html',
	// 		'charset'	=> 'utf-8'
	// 	];

	// 	$this->load->library('email',$config);
	// 	$this->email->initialize($config);
	// 	$this->email->set_newline("\r\n");
	// 	$this->email->from('newreborndarkness@gmail.com', 'Don't Reply');
	// 	$this->email->to($this->input->post('email'));
	// 	if($type == 'verify')
	// 	{
	// 		$this->email->subject('Account Verify');
	// 		$this->email->message('Click this link to verify your account : <a href=" '.base_url().'C_login/verify?email='.$this->input->post(email). '&token='.urlencode($token). '">Activate</a>');
	// 	}
	// 	else if($type == 'forgot')
	// 	{
	// 		$this->email->subject('Reset Password');
	// 		$this->email->message('Click this link to reset your account : <a href=" '.base_url().'C_login/resetpassword?email='.$this->input->post(email). '&token='.urlencode($token). '">Reset Password</a>');
	// 	}
	// 	if ($this->email->send())
	// 	{
	// 		return TRUE;
	// 	}
	// 	else
	// 	{
	// 		echo $this->email->print_debugger();
	// 		die();
	// 	}
	// }

	// public function verify()
	// {
	// 	$email			= $this->input->get('email');
	// 	$token			= $this->input->get('token');
	// 	$check_email	= $this->M_login->validate_email_data($email);
	// 	if($check_email)
	// 	{
	// 		$user_token	= $this->M_login->get_token_data($token);
	// 		$tokenn = $user_token['token_data'];
	// 		if($tokenn == $token)
	// 		{
	// 			if(time()-$user_token['date_created']<(60*60*24))
	// 			{
	// 				$this->M_login->user_valid($email);
	// 				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Your account has been activated, now you can login
	// 				</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	// 				redirect('C_login');
	// 			}
	// 			else
	// 			{
	// 				$this->M_login->user_not_valid($email);
	// 				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Token Expired
	// 				</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	// 				redirect('C_login');
	// 			}
	// 		}
	// 		else
	// 		{
				
	// 		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Account Activation Failed ! Wrong Token
	// 		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	// 		redirect('C_login');
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Account Activation Failed ! Wrong Email
	// 		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	// 		redirect('C_login');
	// 	}
	// }

	public function logout()
	{
		$this->session->sess_destroy();
		echo '<script>alert("Berhasil keluar.");window.location.href="'.base_url('C_login').'";</script>';
	}

	// public function forgotPassword()
	// {
	// 	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	// 	if($this->form_validation->run() == false)
	// 	{
	// 		$data['title'] = 'Forgot Password';
	// 		$this->load->view('templates/login_header', $data);
	// 		$this->load->view('login/V_forgot');
	// 		$this->load->view('templates/login_footer');
	// 	}
	// 	else
	// 	{
	// 		$email 	= $this->input->post('email');
	// 		$temp	= $this->M_login->getCode($email);
	// 		$id		= $temp['Id_user'];
	// 		$cek 	= $this->M_login->checkemail($email);
	// 		if($cek)
	// 		{
	// 			$token =base64_encode(random_bytes(32));
	// 			$this->M_login->token_data($id,$email,$token);
	// 			$this->_sendEmail($token, 'forgot');
	// 			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Please Check Your Email to Reset Password !</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	// 			echo"window.close();";
	// 			redirect('C_login/forgotPassword');
	// 		}
	// 		else
	// 		{
	// 		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Email Is Not Registered or Activated
	// 		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	// 		redirect('C_login/forgotPassword');
	// 		}
	// 	}
	// }

	// public function resetpassword()
	// {
	// 	$email			= $this->input->get('email');
	// 	$token			= $this->input->get('token');
	// 	$check_email	= $this->M_login->get_user_by_email($email);
	// 	if($check_email)
	// 	{
	// 		echo"a";
	// 		$user_token	= $this->M_login->get_token_data($token);
	// 		if($user_token==$token)
	// 		{

	// 		}
	// 		else
	// 		{
	// 		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Reset Password Failed! Wrong Token
	// 		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	// 		redirect('C_login');
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Reset Password Failed! Wrong Email
	// 		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	// 		redirect('C_login');
	// 	}
	// }
}

?>

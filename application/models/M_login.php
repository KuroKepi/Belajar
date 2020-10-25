<?php

class M_login extends CI_model
{
	public function kode()
	{
		$this->db->select_max('id_user', 'new');
		$query 	=	$this->db->get('user')->row_array();
		$kode 	=	$query['new'];
		$noUrut	=	(int) substr($kode, 3, 3);
		$noUrut++;
		$char 	=	"US";
		$newID	=	$char. sprintf("%03s", $noUrut);
		return $newID;
	}

	public function getCode($email)
	{
		$code = $this->db->get_where('user', ['email_user' => $email])->row_array();
		return $code;
	}

	public function add_data($id,$nama,$email,$password,$image,$active)
	{
		$data = array(
			'id_user'		=> $id,
			'nama_user'		=> $nama,
			'email_user'	=> $email,
			'password_user'	=> $password,
			'image_user'	=> $image,
			'is_active'		=> $active
		);
		$this->db->insert('user',$data);
	}

	public function token_data($id,$email,$token)
	{
		$user_token = array(
			'id_user'		=> $id,
			'email_token'	=> $email,
			'token_data'	=> $token,
			'date_created'	=> time()
		);
		$this->db->insert('user_token',$user_token);
	}

	public function validate_email_data($email)
	{
		$validate	= $this->db->get_where('user_token', ['email_token' => $email])->row_array();
		return $validate;
		// echo var_dump($validate);
	}

	public function get_token_data($token)
	{
		$user_token_data = $this->db->get_where ('user_token', ['token_data => $token'])->row_array();
		return $user_token_data;
	}

	public function user_valid($email)
	{
		$update = array(
			'is_active'	=> 1
		);
		$this->db->where('email_user', $email);
		$this->db->update('user',$update);

		$delete = array(
			'email_token'	=>$email
		);
		$this->db->delete('user_token',$delete);
	}

	public function user_not_valid($email)
	{
		$delete = array(
			'email_token'	=>$email
		);
		$this->db->delete('user_token',$delete);
	}

	public function login($email)
	{
		$userr		= $this->db->get_where('user', ['email_user' => $email])->row_array();
		return $userr;
	}

	public function checkemail($email)
	{
		$email 		= $this->db->get_where('user', ['email_user' => $email, 'is_active' => 1])->row_array();
		return $email;
	}

	public function get_user_by_email($email)
	{
		$user 		= $this->db->get_where('user', ['email_user' => $email])->row_array();
		return $user;
	}
}
?>

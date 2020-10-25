<?php

	 Class M_pengguna extends CI_Model
	{
		public function getbyId($id_userdata)
		{
			if($id_userdata != null)
			{
				$pengguna 		= $this->db->get_where('user', ['Id_user' => $id_userdata]);
				return $pengguna;
			}
		}

		public function edit($id_userdata,$name,$email,$password,$photo)
		{
			$data	= array(
					'Id_user'		=> $id_userdata,
					'nama_user'		=> $name,
					'email_user'	=> $email,
					'password_user'	=> $password,
					'image_user'	=> $photo
			);
			$this->db->where('Id_user', $id_userdata);
			$this->db->update('user', $data);
		}
	}

?>
